<?php

namespace Database\Seeders;

use App\Models\Aplikator;
use App\Models\Kapling;
use Illuminate\Database\Seeder;
use App\Models\ProjectStages;
use Illuminate\Support\Str;

class ProjectStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asumsikan aplikator_id dan kapling_id dari data dummy
        $aplikatorId = Aplikator::pluck('id')->first(); // ganti dengan real ID
        $kaplingId = Kapling::pluck('id')->first();

        $stages = [
            ['nama' => 'Pondasi', 'bobot' => 15],
            ['nama' => 'Sloof & Kolom Praktis', 'bobot' => 15],
            ['nama' => 'Dinding Bata & Plester', 'bobot' => 20],
            ['nama' => 'Rangka Atap & Penutup Atap', 'bobot' => 15],
            ['nama' => 'Kusen Pintu & Jendela', 'bobot' => 10],
            ['nama' => 'Plafond', 'bobot' => 5],
            ['nama' => 'Lantai Keramik', 'bobot' => 8],
            ['nama' => 'Pengecatan & Finishing', 'bobot' => 7],
            ['nama' => 'Instalasi Listrik & Air', 'bobot' => 3],
            ['nama' => 'Pembersihan & Serah Terima', 'bobot' => 2],
        ];

        foreach ($stages as $stage) {
            ProjectStages::create([
                'id' => Str::uuid(),
                'aplikator_id' => $aplikatorId,
                'kapling_id' => $kaplingId,
                'nama_tahap' => $stage['nama'],
                'bobot' => $stage['bobot'],
                'progres' => 0,
            ]);
        }
    }
}
