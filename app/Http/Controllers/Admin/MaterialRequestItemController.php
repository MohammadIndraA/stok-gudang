<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\MaterialRequest;
use App\Models\StokTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MaterialRequestItemController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            MaterialRequest::where('id', $request->id)->update([
                'status' => 'disetujui',
                'catatan' => $request->catatan ?? null,
            ]);

            foreach ($request->items as $item) {
                StokTransaction::create([
                    'material_id'            => $item['material_id'],
                    'project_id'             => $item['project_id'] ?? null,
                    'jenis_transaksi'        => 'keluar',
                    'referensi_jenis'        => 'permintaan',
                    'referensi_id'           => $request->id,
                    'jumlah'                 => $item['jumlah_dikeluarkan'],
                    'stok_setelah_transaksi' => $this->hitungStokSetelah($item['material_id'], $item['jumlah_dikeluarkan']),
                    'dibuat_oleh'            => Auth::user()->nama_lengkap,
                    'catatan' => $request->catatan ?? null,

                ]);
            }

            DB::commit();

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.permintaan-material.index')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return ResponseJson::error($th->getMessage(), 500);
        }
    }

    protected function hitungStokSetelah($materialId, $jumlahMasuk)
    {
        $stokSebelum = StokTransaction::where('material_id', $materialId)
            ->latest('id')
            ->value('stok_setelah_transaksi') ?? 0;

        return $stokSebelum - $jumlahMasuk;
    }
}
