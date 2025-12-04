<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialRakitan;
use App\Models\MaterialRakitanItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaterialRakitanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Material Biasa & Rakitan dari Excel
        $materialsData = [
            // 1. BAHAN BAKU UTAMA (Biasa)
            ['kode' => 'PS01', 'nama' => 'Pasir Pasang', 'satuan' => 'truk', 'harga' => 1200000, 'berat' => 20000, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'BB01', 'nama' => 'Batu Belah', 'satuan' => 'truk', 'harga' => 1200000, 'berat' => 20000, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'PC01', 'nama' => 'Pasir cor', 'satuan' => 'm3', 'harga' => 360000, 'berat' => 1400, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'BS12', 'nama' => 'Batu Split 1-2', 'satuan' => 'm3', 'harga' => 450000, 'berat' => 1500, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'SM01', 'nama' => 'Semen PC @ 50 kg', 'satuan' => 'zak', 'harga' => 65000, 'berat' => 50, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KT01', 'nama' => 'kawat tali beton', 'satuan' => 'kg', 'harga' => 19000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'BR01', 'nama' => 'Bata Ringan Hebel 8 cm', 'satuan' => 'm3', 'harga' => 625000, 'berat' => 600, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'MT01', 'nama' => 'Mortar (Perekat Hebel)', 'satuan' => 'zak', 'harga' => 85000, 'berat' => 40, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KR01', 'nama' => 'Keramik 40 x 40 Putih Polos', 'satuan' => 'duz', 'harga' => 60000, 'berat' => 20, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KD01', 'nama' => 'Keramik Dinding KM 40 x 40 polos', 'satuan' => 'duz', 'harga' => 75000, 'berat' => 20, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KL01', 'nama' => 'Keramik Lanatai KM 40 x 40 Corak Kasar', 'satuan' => 'duz', 'harga' => 75000, 'berat' => 20, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KM01', 'nama' => 'Keramik Meja Kompor 40 x 40 polos', 'satuan' => 'dz', 'harga' => 60000, 'berat' => 20, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KS01', 'nama' => 'Kalsium', 'satuan' => 'zak', 'harga' => 15000, 'berat' => 25, 'is_rakitan' => false, 'kategori' => 'BAHAN BAKU UTAMA'],

            // 2. BAHAN FINISHING (Sebagian Rakitan)
            ['kode' => 'CK01', 'nama' => 'Cat Kayu (woood eco)', 'satuan' => 'klg', 'harga' => 85000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'CT01', 'nama' => 'Cat Tembok dalam setara Avitex', 'satuan' => 'fail', 'harga' => 650000, 'berat' => 20, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'CT02', 'nama' => 'Cat Tembok dalam setara Cendana', 'satuan' => 'gln', 'harga' => 350000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'EP01', 'nama' => 'Engsel pintu', 'satuan' => 'stel', 'harga' => 25000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'EJ01', 'nama' => 'Engsel Jendela', 'satuan' => 'stel', 'harga' => 15000, 'berat' => 0.3, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'KC01', 'nama' => 'Kunci', 'satuan' => 'bh', 'harga' => 125000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'HA01', 'nama' => 'Hak Angin', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'SJ01', 'nama' => 'Selot Jendela', 'satuan' => 'bh', 'harga' => 3500, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'PF01', 'nama' => 'Pintu Fibber', 'satuan' => 'bh', 'harga' => 225000, 'berat' => 20, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'CJ01', 'nama' => 'Closet Jongkok', 'satuan' => 'bh', 'harga' => 225000, 'berat' => 15, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'SW01', 'nama' => 'Saringan WC', 'satuan' => 'bh', 'harga' => 7500, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'RB01', 'nama' => 'Rooster Beton 15 x 30', 'satuan' => 'bh', 'harga' => 20000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'KP01', 'nama' => 'Kaca Polos 3 mm', 'satuan' => 'm2', 'harga' => 125000, 'berat' => 10, 'is_rakitan' => false, 'kategori' => 'BAHAN FINISHING'],

            // 3. BAHAN BAJA RINGAN dan Plafond (Biasa)
            ['kode' => 'BJ01', 'nama' => 'BAJA 065 C 75', 'satuan' => 'btg', 'harga' => 95000, 'berat' => 10, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'RB02', 'nama' => 'Reng Baja Ringan 05', 'satuan' => 'btg', 'harga' => 45000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'RF01', 'nama' => 'Roofing 10', 'satuan' => 'bh', 'harga' => 200, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'DB01', 'nama' => 'Dina Bold', 'satuan' => 'bh', 'harga' => 2500, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'RH01', 'nama' => 'Rangka Hollow 2 x 4', 'satuan' => 'btg', 'harga' => 27000, 'berat' => 8, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'GB01', 'nama' => 'Gypsum Board', 'satuan' => 'lbr', 'harga' => 65000, 'berat' => 10, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'AL01', 'nama' => 'Alderon 1 play', 'satuan' => 'm2', 'harga' => 75000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'PA01', 'nama' => 'Paku Alderon', 'satuan' => 'bh', 'harga' => 2500, 'berat' => 0.01, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'PL01', 'nama' => 'Papan Lisplang', 'satuan' => 'lbr', 'harga' => 60000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'AD01', 'nama' => 'Adesive/Kumpon', 'satuan' => 'Zak', 'harga' => 85000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'LP01', 'nama' => 'Lakban Plafond', 'satuan' => 'rol', 'harga' => 7000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],
            ['kode' => 'SG01', 'nama' => 'Skrup Gypsum', 'satuan' => 'dz', 'harga' => 35000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'BAJA RINGAN'],

            // 4. PEMASANGAN AC (Biasa)
            ['kode' => 'AC01', 'nama' => 'Air Conditioner 0,5 PK setara (AC 0,5 PK) AQUA', 'satuan' => 'unit', 'harga' => 2700000, 'berat' => 30, 'is_rakitan' => false, 'kategori' => 'AC'],
            ['kode' => 'PT01', 'nama' => 'Pipa Tembaga AC Standar', 'satuan' => 'm', 'harga' => 65000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'AC'],
            ['kode' => 'BA01', 'nama' => 'Braket Autdor', 'satuan' => 'paket', 'harga' => 43000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'AC'],
            ['kode' => 'KB01', 'nama' => 'Kabel 2 x 1,5', 'satuan' => 'm', 'harga' => 12500, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'AC'],
            ['kode' => 'DS01', 'nama' => 'Daktipe (Solasi)', 'satuan' => 'rol', 'harga' => 15000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'AC'],
            ['kode' => 'SD01', 'nama' => 'Selang Draine', 'satuan' => 'm', 'harga' => 5000, 'berat' => 0.3, 'is_rakitan' => false, 'kategori' => 'AC'],

            // 5. PLUMBING (Biasa)
            ['kode' => 'PR01', 'nama' => 'Paralon 3" Hitam', 'satuan' => 'lt', 'harga' => 35000, 'berat' => 2, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'LP02', 'nama' => 'Lem Paralon', 'satuan' => 'klg', 'harga' => 45000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'PR02', 'nama' => 'Paralon 1/2"', 'satuan' => 'lt', 'harga' => 25000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'PH01', 'nama' => 'Pipa HDFE 1/2"', 'satuan' => 'm1', 'harga' => 8000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'PR03', 'nama' => 'Paralon 5/8" (pipa listrik)', 'satuan' => 'lt', 'harga' => 12000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'AD02', 'nama' => 'Aptak dus', 'satuan' => 'bh', 'harga' => 2000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'KA01', 'nama' => 'Kran Air 1/2" Plastik', 'satuan' => 'bh', 'harga' => 10000, 'berat' => 0.3, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'TE01', 'nama' => 'Tee 3"', 'satuan' => 'bh', 'harga' => 10000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'KN01', 'nama' => 'Knee 3"', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'KN02', 'nama' => 'Knee 1/2"', 'satuan' => 'bh', 'harga' => 3000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'KD02', 'nama' => 'Knee drat 1/2"', 'satuan' => 'bh', 'harga' => 3500, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'TE02', 'nama' => 'Tee 1/2"', 'satuan' => 'bh', 'harga' => 3500, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'SB01', 'nama' => 'seltape besar', 'satuan' => 'bh', 'harga' => 10000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'MA01', 'nama' => 'Metaran Air Standar', 'satuan' => 'bh', 'harga' => 100000, 'berat' => 2, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'SK01', 'nama' => 'Strop Kran 1/2"', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.3, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'SL01', 'nama' => 'Sokdrat luar 1/2" untuk meteran', 'satuan' => 'bh', 'harga' => 5000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'DPK01', 'nama' => 'Dop PVC 3"', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],
            ['kode' => 'DP02', 'nama' => 'Dop PVC 1/2"', 'satuan' => 'bh', 'harga' => 1500, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'PLUMBING'],

            // 6. INSTALASI LISTRIK (Biasa)
            ['kode' => 'KN03', 'nama' => 'Kabel NYM 3 x 1,5', 'satuan' => 'rol', 'harga' => 250000, 'berat' => 10, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'KN04', 'nama' => 'Kabel NYM 2 x 1,5', 'satuan' => 'rol', 'harga' => 310000, 'berat' => 10, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'KN05', 'nama' => 'Kabel NYM 3 x 2,5 (buntut)', 'satuan' => 'm', 'harga' => 15000, 'berat' => 0.3, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'FP01', 'nama' => 'Fiting Plafond', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'SK02', 'nama' => 'Stok Kontak', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.2, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'ST01', 'nama' => 'Sakelar Tunggal', 'satuan' => 'bh', 'harga' => 20000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'SS01', 'nama' => 'Sakelar Seri', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'NC01', 'nama' => 'NCB 10 A', 'satuan' => 'bh', 'harga' => 25000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'BN01', 'nama' => 'Box NCB', 'satuan' => 'bh', 'harga' => 7500, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'BS01', 'nama' => 'Box Sekering', 'satuan' => 'bh', 'harga' => 25000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'LPK02', 'nama' => 'Lampu Plafond Setaraf Inlet 12 watt', 'satuan' => 'bh', 'harga' => 75000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'LP03', 'nama' => 'Lampu Plafond Setaraf Inlet 6 watt (depan)', 'satuan' => 'bh', 'harga' => 55000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'SL02', 'nama' => 'Solasiban', 'satuan' => 'bh', 'harga' => 7500, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'RP01', 'nama' => 'Ripet 20 cm', 'satuan' => 'bks', 'harga' => 10000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],
            ['kode' => 'CK02', 'nama' => 'Clem Kabel 9 mm', 'satuan' => 'bks', 'harga' => 3500, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'LISTRIK'],

            // 7. BAHAN ALAT BANTU (Biasa)
            ['kode' => 'PC02', 'nama' => 'Papan Cor', 'satuan' => 'm3', 'harga' => 1500000, 'berat' => 600, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'KK01', 'nama' => 'Kaso Kaso (Kayu Usuk)', 'satuan' => 'm3', 'harga' => 2000000, 'berat' => 500, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'BM01', 'nama' => 'Bambu', 'satuan' => 'btg', 'harga' => 15000, 'berat' => 5, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'PK02', 'nama' => 'Paku 5, 7, 10, 12', 'satuan' => 'kg', 'harga' => 17000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'EA01', 'nama' => 'Ember Aduk', 'satuan' => 'bh', 'harga' => 10000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'SK03', 'nama' => 'Sekop', 'satuan' => 'bh', 'harga' => 45000, 'berat' => 2, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'CG01', 'nama' => 'Cangkul', 'satuan' => 'bh', 'harga' => 50000, 'berat' => 3, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'RA01', 'nama' => 'Ram ayakan', 'satuan' => 'm2', 'harga' => 17500, 'berat' => 2, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'BN02', 'nama' => 'Benang', 'satuan' => 'bh', 'harga' => 3000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'AS01', 'nama' => 'Arco Sorong', 'satuan' => 'bh', 'harga' => 500000, 'berat' => 10, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'KS02', 'nama' => 'Koas 4', 'satuan' => 'bh', 'harga' => 15000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'RC01', 'nama' => 'Rolan Cat', 'satuan' => 'bh', 'harga' => 25000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'BRB01', 'nama' => 'Bak Rol', 'satuan' => 'bh', 'harga' => 10000, 'berat' => 1, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'AM01', 'nama' => 'Ampelas', 'satuan' => 'm', 'harga' => 15000, 'berat' => 0.1, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],
            ['kode' => 'KPB02', 'nama' => 'Kape', 'satuan' => 'bh', 'harga' => 5000, 'berat' => 0.5, 'is_rakitan' => false, 'kategori' => 'ALAT BANTU'],

            // Rakitan (dari Excel, contoh kusen, besi, daun)
            ['kode' => 'BS10', 'nama' => 'Besi 10 mm', 'satuan' => 'lt', 'harga' => 56000, 'berat' => 7.4, 'is_rakitan' => true, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'BS08', 'nama' => 'Besi 8 mm', 'satuan' => 'lt', 'harga' => 47000, 'berat' => 4.7, 'is_rakitan' => true, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'BB06', 'nama' => 'Besi Beton 6 mm', 'satuan' => 'lt', 'harga' => 27000, 'berat' => 2.2, 'is_rakitan' => true, 'kategori' => 'BAHAN BAKU UTAMA'],
            ['kode' => 'KP02', 'nama' => 'Kusen Pintu dan Jendela Alumunium', 'satuan' => 'm1', 'harga' => 98000, 'berat' => 5, 'is_rakitan' => true, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'DP01', 'nama' => 'Daun Pintu Panil', 'satuan' => 'bh', 'harga' => 450000, 'berat' => 15, 'is_rakitan' => true, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'DJ01', 'nama' => 'Daun Jendela 40 x 120', 'satuan' => 'bh', 'harga' => 225000, 'berat' => 10, 'is_rakitan' => true, 'kategori' => 'BAHAN FINISHING'],
            ['kode' => 'DJ02', 'nama' => 'Daun Jendela 40 x 150', 'satuan' => 'b', 'harga' => 250000, 'berat' => 12, 'is_rakitan' => true, 'kategori' => 'BAHAN FINISHING'],
        ];

        $komponenRakitan = [
            'BS10' => [ // Besi 10 mm
                ['kode' => 'KT01', 'jumlah' => 1], // kawat tali
                ['kode' => 'SM01', 'jumlah' => 0.5], // semen
            ],
            'BS08' => [
                ['kode' => 'KT01', 'jumlah' => 0.8],
                ['kode' => 'SM01', 'jumlah' => 0.4],
            ],
            'BB06' => [
                ['kode' => 'KT01', 'jumlah' => 0.6],
                ['kode' => 'SM01', 'jumlah' => 0.3],
            ],
            'KP02' => [ // Kusen
                ['kode' => 'EP01', 'jumlah' => 2], // engsel
                ['kode' => 'KC01', 'jumlah' => 1], // kunci
            ],
            'DP01' => [
                ['kode' => 'EP01', 'jumlah' => 3],
                ['kode' => 'CK01', 'jumlah' => 0.5], // cat kayu
            ],
            'DJ01' => [
                ['kode' => 'EJ01', 'jumlah' => 2],
                ['kode' => 'KP01', 'jumlah' => 1.2], // kaca
            ],
            'DJ02' => [
                ['kode' => 'EJ01', 'jumlah' => 2],
                ['kode' => 'KP01', 'jumlah' => 1.5],
            ],
        ];

        foreach ($materialsData as $data) {
            $material = Material::create([
                'id' => Str::uuid(),
                'kode_material' => $data['kode'],
                'nama_material' => $data['nama'],
                'satuan' => $data['satuan'],
                'kategori' => $data['kategori'],
                'harga_satuan' => $data['harga'],
                'berat_per_satuan' => $data['berat'],
                'is_rakitan' => $data['is_rakitan'],
                'stok_minimum' => 10,
                'current_stock' => 100, // asumsikan awal stok
            ]);

            if ($data['is_rakitan']) {
                $rakitan = MaterialRakitan::create([
                    'id' => Str::uuid(),
                    'material_id' => $material->id,
                    'keterangan' => 'Rakitan untuk ' . $data['nama'],
                ]);

                if (isset($komponenRakitan[$data['kode']])) {
                    foreach ($komponenRakitan[$data['kode']] as $komp) {
                        $komponenMaterial = Material::where('kode_material', $komp['kode'])->first();
                        if ($komponenMaterial) {
                            MaterialRakitanItem::create([
                                'id' => Str::uuid(),
                                'rakitan_id' => $rakitan->id,
                                'material_id' => $komponenMaterial->id,
                                'jumlah' => $komp['jumlah'],
                                'satuan' => $komponenMaterial->satuan,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
