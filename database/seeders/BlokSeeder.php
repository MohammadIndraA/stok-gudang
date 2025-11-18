<?php

namespace Database\Seeders;

use App\Models\Blok;
use App\Models\Kapling;
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
        // Buat beberapa blok
        $blokA = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok A',
            'deskripsi' => 'Blok A untuk perumahan premium',
            'slug' => 'blok-a',
        ]);

        $blokB = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok B',
            'deskripsi' => 'Blok B untuk perumahan reguler',
            'slug' => 'blok-b',
        ]);

        $blokC = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok C',
            'deskripsi' => 'Blok C dekat taman',
            'slug' => 'blok-c',
        ]);

        $blokD = Blok::create([
            'id' => (string) Str::uuid(),
            'nama' => 'Blok D',
            'deskripsi' => 'Blok D dekat masjid',
            'slug' => 'blok-d',
        ]);

        // Kapling untuk Blok A
        foreach (range(1, 5) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "Kapling A{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok A",
                'slug' => "kapling-a{$i}",
                'blok_id' => $blokA->id,
            ]);
        }

        // Kapling untuk Blok B
        foreach (range(1, 5) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "Kapling B{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok B",
                'slug' => "kapling-b{$i}",
                'blok_id' => $blokB->id,
            ]);
        }

        // Kapling untuk Blok C
        foreach (range(1, 3) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "Kapling C{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok C",
                'slug' => "kapling-c{$i}",
                'blok_id' => $blokC->id,
            ]);
        }

        // Kapling untuk Blok D
        foreach (range(1, 4) as $i) {
            Kapling::create([
                'id' => (string) Str::uuid(),
                'nama' => "Kapling D{$i}",
                'deskripsi' => "Kapling nomor {$i} di Blok D",
                'slug' => "kapling-d{$i}",
                'blok_id' => $blokD->id,
            ]);
        }
    }
}
