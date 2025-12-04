<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\ProjectStages;
use App\Models\StageMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StageMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map kategori ke tahap
        $map = [
            'BAHAN BAKU UTAMA' => ['Pondasi', 'Sloof & Kolom Praktis', 'Dinding Bata & Plester', 'Lantai Keramik'], // bagi vol/4
            'BAHAN FINISHING' => ['Kusen Pintu & Jendela', 'Pengecatan & Finishing'], // bagi vol/2
            'BAJA RINGAN' => ['Rangka Atap & Penutup Atap', 'Plafond'], // bagi/2
            'AC' => ['Instalasi Listrik & Air'],
            'PLUMBING' => ['Instalasi Listrik & Air'],
            'LISTRIK' => ['Instalasi Listrik & Air'],
            'ALAT BANTU' => ['Pembersihan & Serah Terima'],
        ];

        // Kebutuhan vol dari Excel (untuk 1 rumah)
        $kebutuhan = [
            // BAHAN BAKU UTAMA
            'Pasir Pasang' => 2,
            'Batu Belah' => 1,
            'Pasir cor' => 3,
            'Batu Split 1-2' => 1,
            'Semen PC @ 50 kg' => 60,
            'kawat tali beton' => 15,
            'Bata Ringan Hebel 8 cm' => 9.77,
            'Mortar (Perekat Hebel)' => 10,
            'Keramik 40 x 40 Putih Polos' => 36,
            'Keramik Dinding KM 40 x 40 polos' => 8,
            'Keramik Lanatai KM 40 x 40 Corak Kasar' => 3,
            'Keramik Meja Kompor 40 x 40 polos' => 3,
            'Kalsium' => 25,
            // Rakitan di BAHAN BAKU
            'Besi 10 mm' => 45,
            'Besi 8 mm' => 20,
            'Besi Beton 6 mm' => 30,

            // BAHAN FINISHING
            'Cat Kayu (woood eco)' => 1,
            'Cat Tembok dalam setara Avitex' => 2,
            'Cat Tembok dalam setara Cendana' => 2,
            'Engsel pintu' => 4,
            'Engsel Jendela' => 6,
            'Kunci' => 4,
            'Hak Angin' => 3,
            'Selot Jendela' => 3,
            'Pintu Fibber' => 1,
            'Closet Jongkok' => 1,
            'Saringan WC' => 1,
            'Rooster Beton 15 x 30' => 20,
            'Kaca Polos 3 mm' => 3.55,
            // Rakitan di FINISHING
            'Kusen Pintu dan Jendela Alumunium' => 40,
            'Daun Pintu Panil' => 4,
            'Daun Jendela 40 x 120' => 1,
            'Daun Jendela 40 x 150' => 2,

            // BAJA RINGAN
            'BAJA 065 C 75' => 30,
            'Reng Baja Ringan 05' => 50,
            'Roofing 10' => 1500,
            'Dina Bold' => 10,
            'Rangka Hollow 2 x 4' => 50,
            'Gypsum Board' => 20,
            'Alderon 1 play' => 45,
            'Paku Alderon' => 270,
            'Papan Lisplang' => 2,
            'Adesive/Kumpon' => 1,
            'Lakban Plafond' => 2,
            'Skrup Gypsum' => 2,

            // AC
            'Air Conditioner 0,5 PK setara (AC 0,5 PK) AQUA' => 1,
            'Pipa Tembaga AC Standar' => 3,
            'Braket Autdor' => 1,
            'Kabel 2 x 1,5' => 5,
            'Daktipe (Solasi)' => 1,
            'Selang Draine' => 3,

            // PLUMBING
            'Paralon 3" Hitam' => 5,
            'Lem Paralon' => 1,
            'Paralon 1/2"' => 5,
            'Pipa HDFE 1/2"' => 2,
            'Paralon 5/8" (pipa listrik)' => 4,
            'Aptak dus' => 10,
            'Kran Air 1/2" Plastik' => 4,
            'Tee 3"' => 1,
            'Knee 3"' => 4,
            'Knee 1/2"' => 10,
            'Knee drat 1/2"' => 4,
            'Tee 1/2"' => 10,
            'seltape besar' => 2,
            'Metaran Air Standar' => 1,
            'Strop Kran 1/2"' => 1,
            'Sokdrat luar 1/2" untuk meteran' => 2,
            'Dop PVC 3"' => 1,
            'Dop PVC 1/2"' => 2,

            // LISTRIK
            'Kabel NYM 3 x 1,5' => 1,
            'Kabel NYM 2 x 1,5' => 1,
            'Kabel NYM 3 x 2,5 (buntut)' => 1.5,
            'Fiting Plafond' => 4,
            'Stok Kontak' => 4,
            'Sakelar Tunggal' => 2,
            'Sakelar Seri' => 2,
            'NCB 10 A' => 1,
            'Box NCB' => 1,
            'Box Sekering' => 1,
            'Lampu Plafond Setaraf Inlet 12 watt' => 1,
            'Lampu Plafond Setaraf Inlet 6 watt (depan)' => 1,
            'Solasiban' => 1,
            'Ripet 20 cm' => 1,
            'Clem Kabel 9 mm' => 1,

            // ALAT BANTU
            'Papan Cor' => 0.5,
            'Kaso Kaso (Kayu Usuk)' => 0.5,
            'Bambu' => 10,
            'Paku 5, 7, 10, 12' => 15,
            'Ember Aduk' => 3,
            'Sekop' => 1,
            'Cangkul' => 1,
            'Ram ayakan' => 1.5,
            'Benang' => 5,
            'Arco Sorong' => 1,
            'Koas 4' => 1,
            'Rolan Cat' => 2,
            'Bak Rol' => 1,
            'Ampelas' => 1,
            'Kape' => 2,
        ];

        foreach ($kebutuhan as $nama => $vol) {
            $material = Material::where('nama_material', $nama)->first();
            if (!$material) continue;

            $kategori = $material->kategori;
            $tahaps = $map[$kategori] ?? [];

            foreach ($tahaps as $tahapNama) {
                $stage = ProjectStages::where('nama_tahap', $tahapNama)->first();
                if ($stage) {
                    $kebutuhanPerTahap = $vol / count($tahaps); // bagi rata per tahap di kategori
                    StageMaterial::create([
                        'id' => Str::uuid(),
                        'stage_id' => $stage->id,
                        'material_id' => $material->id,
                        'kebutuhan_total' => $kebutuhanPerTahap,
                        'kebutuhan_terpenuhi' => 0,
                    ]);
                }
            }
        }
    }
}
