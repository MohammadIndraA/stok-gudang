<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $materials = [
            // 1. BAHAN BAKU UTAMA
            [
                'nama_material' => 'Pasir Pasang',
                'satuan' => 'truk',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Batu Belah',
                'satuan' => 'truk',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Pasir cor',
                'satuan' => 'm3',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Batu Split 1-2',
                'satuan' => 'm3',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Semen PC @ 50 kg',
                'satuan' => 'zak',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Besi 10 mm',
                'satuan' => 'lt',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Besi 8 mm',
                'satuan' => 'lt',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Besi Beton 6 mm',
                'satuan' => 'lt',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'kawat tali beton',
                'satuan' => 'kg',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Bata Ringan Hebel 8 cm',
                'satuan' => 'm3',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Mortar (Perekat Hebel)',
                'satuan' => 'zak',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Keramik 40 x 40 Putih Polos',
                'satuan' => 'duz',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Keramik Dinding KM 40 x 40 polos',
                'satuan' => 'duz',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Keramik Lanatai KM 40 x 40 Corak Kasar',
                'satuan' => 'duz',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Keramik Meja Kompor 40 x 40 polos',
                'satuan' => 'dz',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Kalsium',
                'satuan' => 'zak',
                'kategori' => 'BAHAN BAKU UTAMA',
                'stok_minimum' => 100,
            ],

            // 2. BAHAN FINISHING
            [
                'nama_material' => 'Kusen Pintu dan Jendela Alumunium',
                'satuan' => 'm1',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Daun Pintu Panil',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Daun Jendela 40 x 120',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Daun Jendela 40 x 150',
                'satuan' => 'b',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Kaca Polos 3 mm',
                'satuan' => 'm2',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Rooster Beton 15 x 30',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Cat Kayu (woood eco)',
                'satuan' => 'klg',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Cat Tembok dalam setara Avitex',
                'satuan' => 'fail',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Cat Tembok dalam setara Cendana',
                'satuan' => 'gln',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Engsel pintu',
                'satuan' => 'stel',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Engsel Jendela',
                'satuan' => 'stel',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Kunci',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Hak Angin',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Selot Jendela',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Pintu Fibber',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Closet Jongkok',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Saringan WC',
                'satuan' => 'bh',
                'kategori' => 'BAHAN FINISHING',
                'stok_minimum' => 100,
            ],

            // 3. BAHAN BAJA RINGAN dan Plafond
            [
                'nama_material' => 'BAJA 065 C 75',
                'satuan' => 'btg',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Reng Baja Ringan 05',
                'satuan' => 'btg',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Roofing 10',
                'satuan' => 'bh',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Dina Bold',
                'satuan' => 'bh',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Rangka Hollow 2 x 4',
                'satuan' => 'btg',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Gypsum Board',
                'satuan' => 'lbr',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Alderon 1 play',
                'satuan' => 'm2',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Paku Alderon',
                'satuan' => 'bh',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Papan Lisplang',
                'satuan' => 'lbr',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Adesive/Kumpon',
                'satuan' => 'Zak',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Lakban Plafond',
                'satuan' => 'rol',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Skrup Gypsum',
                'satuan' => 'dz',
                'kategori' => 'BAHAN BAJA RINGAN dan Plafond',
                'stok_minimum' => 100,
            ],

            // 4. PEMASANGAN AC 0,5 PK
            [
                'nama_material' => 'Air Conditioner 0,5 PK setara (AC 0,5 PK) AQUA',
                'satuan' => 'unit',
                'kategori' => 'PEMASANGAN AC 0,5 PK',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Pipa Tembaga AC Standar',
                'satuan' => 'm',
                'kategori' => 'PEMASANGAN AC 0,5 PK',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Braket Autdor',
                'satuan' => 'paket',
                'kategori' => 'PEMASANGAN AC 0,5 PK',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Kabel 2 x 1,5',
                'satuan' => 'm',
                'kategori' => 'PEMASANGAN AC 0,5 PK',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Daktipe (Solasi)',
                'satuan' => 'rol',
                'kategori' => 'PEMASANGAN AC 0,5 PK',
                'stok_minimum' => 100,
            ],
            [
                'nama_material' => 'Selang Draine',
                'satuan' => 'm',
                'kategori' => 'PEMASANGAN AC 0,5 PK',
                'stok_minimum' => 100,
            ],
        ];

        foreach ($materials as $data) {
            Material::create($data); // 👈 ini akan memicu observer `creating()`
        }
    }
}
