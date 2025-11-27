<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama_lengkap' => fake()->name(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => '2000-08-15',
            'jenis_kelamin' => "Laki-laki",
            'agama' => "Islam",
            'status_perkawinan' => "Belum Menikah",
            'alamat_lengkap' => fake()->address(),
            'no_hp' => fake()->phoneNumber(),
            'email' => 'adminlokal@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole('Super Admin');

        $this->call([
            // PermissionSeeder::class,
            // RoleSeeder::class,
            // AplikatorSeeder::class,
            // BlokSeeder::class,
            // MaterialSeeder::class,
            // VendorSeeder::class
        ]);
    }
}
