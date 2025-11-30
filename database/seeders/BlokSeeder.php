<?php

namespace Database\Seeders;

use App\Models\Blok;
use App\Models\Kapling;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project_id = Project::first();
        // Buat beberapa blok
        $blokA = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok A',
            'deskripsi' => 'Blok A untuk perumahan premium',
            'project_id' => $project_id->id,
            'slug' => 'blok-a',
        ]);

        $blokB = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok B',
            'deskripsi' => 'Blok B untuk perumahan reguler',
            'project_id' => $project_id->id,
            'slug' => 'blok-b',
        ]);

        $blokC = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok C',
            'deskripsi' => 'Blok C dekat taman',
            'project_id' => $project_id->id,
            'slug' => 'blok-c',
        ]);

        // Kapling untuk Blok A
        foreach (range(1, 89) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "A{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok A",
                'slug' => "kapling-a{$i}",
                'blok_id' => $blokA->id,
            ]);
        }

        // Kapling untuk Blok B
        foreach (range(1, 59) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "B{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok B",
                'slug' => "kapling-b{$i}",
                'blok_id' => $blokB->id,
            ]);
        }

        // Kapling untuk Blok C
        foreach (range(1, 50) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "C{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok C",
                'slug' => "kapling-c{$i}",
                'blok_id' => $blokC->id,
            ]);
        }
    }
}
