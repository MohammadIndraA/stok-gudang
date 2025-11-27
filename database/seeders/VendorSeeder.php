<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'nama' => 'CV Sinar Pasir Jaya',
                'kontak_person' => 'Budi Santoso',
                'telepon' => '081234567890',
                'email' => 'sinar.pasirjaya@gmail.com',
                'alamat' => 'Jl. Raya Pasir No. 123, Bogor, Jawa Barat',
            ],
            [
                'nama' => 'PT Batu Mulia Abadi',
                'kontak_person' => 'Dewi Lestari',
                'telepon' => '082198765432',
                'email' => 'info@batumulia.co.id',
                'alamat' => 'Jl. Industri Batu No. 45, Cirebon, Jawa Barat',
            ],
            [
                'nama' => 'Toko Bangunan Maju Jaya',
                'kontak_person' => 'Ahmad Fauzi',
                'telepon' => '085612345678',
                'email' => 'majujaya.bangunan@yahoo.com',
                'alamat' => 'Jl. Merdeka No. 78, Bandung, Jawa Barat',
            ],
            [
                'nama' => 'Distributor Semen Gresik Wilayah Jabodetabek',
                'kontak_person' => 'Rina Wijaya',
                'telepon' => '081398765432',
                'email' => 'sales.gresik@semenindonesia.com',
                'alamat' => 'Kawasan Industri Pulogadung, Jakarta Timur',
            ],
            [
                'nama' => 'Steel Indo Perkasa',
                'kontak_person' => 'Hendra Gunawan',
                'telepon' => '087812345678',
                'email' => 'hendra@steelindoperkasa.com',
                'alamat' => 'Jl. Raya Bekasi Km. 22, Bekasi, Jawa Barat',
            ],
            [
                'nama' => 'Hebelindo Prima',
                'kontak_person' => 'Siti Nurhaliza',
                'telepon' => '089654321098',
                'email' => 'marketing@hebelindo.id',
                'alamat' => 'Jl. Mitra Industri No. 8, Karawang, Jawa Barat',
            ],
            [
                'nama' => 'CV Keramik Indah Sentosa',
                'kontak_person' => 'Andi Prasetyo',
                'telepon' => '081567890123',
                'email' => 'keramik.indahsentosa@gmail.com',
                'alamat' => 'Jl. Porselen No. 15, Tangerang, Banten',
            ],
            [
                'nama' => 'Alumunium Jaya Kusen',
                'kontak_person' => 'Fajar Ramadhan',
                'telepon' => '082234567890',
                'email' => 'fajar@alumuniumjayakusen.com',
                'alamat' => 'Jl. Kusen Raya No. 34, Depok, Jawa Barat',
            ],
            [
                'nama' => 'PT Baja Ringan Pratama',
                'kontak_person' => 'Lina Marlina',
                'telepon' => '085789012345',
                'email' => 'info@bajaringanpratama.id',
                'alamat' => 'Jl. Logam No. 56, Surabaya, Jawa Timur',
            ],
            [
                'nama' => 'CV AC Sejuk Prima',
                'kontak_person' => 'Rudi Hartono',
                'telepon' => '081987654321',
                'email' => 'acsejukprima@gmail.com',
                'alamat' => 'Jl. Elektronik No. 22, Jakarta Barat',
            ],
        ];

        foreach ($vendors as $vendor) {
            DB::table('vendors')->insert([
                'id' => Str::uuid(),
                'nama' => $vendor['nama'],
                'kontak_person' => $vendor['kontak_person'],
                'telepon' => $vendor['telepon'],
                'email' => $vendor['email'],
                'alamat' => $vendor['alamat'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
