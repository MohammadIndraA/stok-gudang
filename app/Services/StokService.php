<?php

use App\Models\Material;
use App\Models\MaterialRequest;
use App\Models\StokTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StokService
{

    public function prosesPengeluaranRequest(MaterialRequest $request)
    {
        if ($request->status !== 'dipenuhi') {
            throw new \Exception('Hanya request dengan status "dipenuhi" yang bisa diproses pengeluaran stok.');
        }

        if ($request->tanggal_dipenuhi && $request->items()->where('jumlah_dikeluarkan', '>', 0)->exists()) {
            throw new \Exception('Request ini sudah pernah diproses pengeluaran stok.');
        }

        DB::transaction(function () use ($request) {
            foreach ($request->items as $item) {
                $material = $item->material;
                $jumlahKeluar = $item->jumlah_diminta; // atau bisa pakai jumlah_dikeluarkan kalau ada partial

                // Cek stok cukup
                if ($material->current_stock < $jumlahKeluar) {
                    throw new \Exception("Stok {$material->nama_material} tidak mencukupi. Dibutuhkan: {$jumlahKeluar}, Tersedia: {$material->current_stock}");
                }

                if ($material->is_rakitan) {
                    // Kurangi komponen rakitan
                    $this->kurangiKomponenRakitan($material, $jumlahKeluar, $request);
                } else {
                    // Kurangi material biasa
                    $this->kurangiStokLangsung($material, $jumlahKeluar, $request);
                }

                // Update jumlah yang sudah dikeluarkan
                $item->jumlah_dikeluarkan = $jumlahKeluar;
                $item->save();
            }

            // Update tanggal dipenuhi
            $request->tanggal_dipenuhi = now();
            $request->save();
        });
    }

    private function kurangiKomponenRakitan(Material $rakitan, $jumlahRakitan, MaterialRequest $request)
    {
        foreach ($rakitan->rakitan->items as $komponenItem) {
            $komponen = $komponenItem->material;
            $jumlahDibutuhkan = $komponenItem->jumlah * $jumlahRakitan;

            if ($komponen->current_stock < $jumlahDibutuhkan) {
                throw new \Exception("Komponen rakitan tidak cukup: {$komponen->nama_material} (butuh {$jumlahDibutuhkan})");
            }

            $komponen->decrement('current_stock', $jumlahDibutuhkan);

            StokTransaction::create([
                'id' => Str::uuid(),
                'material_id' => $komponen->id,
                'project_id' => $request->kapling_id,
                'jenis_transaksi' => 'keluar',
                'referensi_jenis' => 'permintaan',
                'referensi_id' => $request->id,
                'jumlah' => -$jumlahDibutuhkan,
                'stok_setelah_transaksi' => $komponen->current_stock,
                'catatan' => "Komponen rakitan {$rakitan->nama_material} (x{$jumlahRakitan}) - Request #{$request->nomor_permintaan}",
                'dibuat_oleh' => auth()->id() ?? $request->diajukan_oleh,
            ]);
        }

        // Catat transaksi rakitan (untuk history)
        StokTransaction::create([
            'id' => Str::uuid(),
            'material_id' => $rakitan->id,
            'project_id' => $request->kapling_id,
            'jenis_transaksi' => 'keluar',
            'referensi_jenis' => 'permintaan',
            'referensi_id' => $request->id,
            'jumlah' => -$jumlahRakitan,
            'stok_setelah_transaksi' => $rakitan->current_stock, // tetap, karena rakitan tidak punya stok fisik
            'catatan' => "Pengeluaran rakitan: {$rakitan->nama_material} (x{$jumlahRakitan}) - Request #{$request->nomor_permintaan}",
            'dibuat_oleh' => auth()->id() ?? $request->diajukan_oleh,
        ]);
    }

    private function kurangiStokLangsung(Material $material, $jumlah, MaterialRequest $request)
    {
        $material->decrement('current_stock', $jumlah);

        StokTransaction::create([
            'id' => Str::uuid(),
            'material_id' => $material->id,
            'project_id' => $request->kapling_id,
            'jenis_transaksi' => 'keluar',
            'referensi_jenis' => 'permintaan',
            'referensi_id' => $request->id,
            'jumlah' => -$jumlah,
            'stok_setelah_transaksi' => $material->current_stock,
            'catatan' => "Pengeluaran material - Request #{$request->nomor_permintaan}",
            'dibuat_oleh' => auth()->id() ?? $request->diajukan_oleh,
        ]);
    }

    // Bonus: fungsi untuk batalin request (jika salah keluarin)
    public function batalkanPengeluaranRequest(MaterialRequest $request)
    {
        if ($request->status !== 'dipenuhi' || !$request->tanggal_dipenuhi) {
            return;
        }

        DB::transaction(function () use ($request) {
            foreach ($request->items as $item) {
                $material = $item->material;
                $jumlahKeluar = $item->jumlah_dikeluarkan;

                if ($material->is_rakitan) {
                    foreach ($material->rakitan->items as $komponenItem) {
                        $komponen = $komponenItem->material;
                        $jumlahKembali = $komponenItem->jumlah * $jumlahKeluar;
                        $komponen->increment('current_stock', $jumlahKembali);

                        StokTransaction::create([
                            'id' => Str::uuid(),
                            'material_id' => $komponen->id,
                            'project_id' => $request->kapling_id,
                            'jenis_transaksi' => 'penyesuaian',
                            'referensi_jenis' => 'pembatalan',
                            'referensi_id' => $request->id,
                            'jumlah' => +$jumlahKembali,
                            'stok_setelah_transaksi' => $komponen->current_stock,
                            'catatan' => "Pembatalan komponen rakitan (Request #{$request->nomor_permintaan})",
                            'dibuat_oleh' => auth()->id(),
                        ]);
                    }
                } else {
                    $material->increment('current_stock', $jumlahKeluar);
                }

                StokTransaction::create([
                    'id' => Str::uuid(),
                    'material_id' => $material->id,
                    'project_id' => $request->kapling_id,
                    'jenis_transaksi' => 'penyesuaian',
                    'referensi_jenis' => 'pembatalan',
                    'referensi_id' => $request->id,
                    'jumlah' => +$jumlahKeluar,
                    'stok_setelah_transaksi' => $material->current_stock,
                    'catatan' => "Pembatalan pengeluaran - Request #{$request->nomor_permintaan}",
                    'dibuat_oleh' => auth()->id(),
                ]);

                $item->jumlah_dikeluarkan = 0;
                $item->save();
            }

            $request->tanggal_dipenuhi = null;
            $request->save();
        });
    }
}
