<?php

namespace Database\Seeders;

use App\Models\Aplikator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class AplikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
        $statusList = ['Belum Menikah', 'Menikah', 'Cerai'];
        $genderList = ['Laki-laki', 'Perempuan'];

        for ($i = 1; $i <= 20; $i++) {
            Aplikator::create([
                'id' => Str::uuid(),
                'nama_lengkap' => "Aplikator {$i}",
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => now()->subYears(rand(25, 45))->subDays(rand(0, 365)),
                'jenis_kelamin' => $genderList[rand(0, 1)],
                'agama' => $agamaList[rand(0, count($agamaList) - 1)],
                'status_perkawinan' => $statusList[rand(0, count($statusList) - 1)],
                'alamat_lengkap' => "Jl. Contoh No. {$i}, Bandung",
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'email' => "aplikator{$i}@example.com",
                'password' => bcrypt('password'),
            ]);
        }
    }
}
