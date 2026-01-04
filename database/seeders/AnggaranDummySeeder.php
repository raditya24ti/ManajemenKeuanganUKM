<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggaranDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar kategori rencana anggaran UKM
        $rencanaAnggaran = [
            ['nama' => 'Dana Operasional Sekretariat', 'kat' => 'Rutin'],
            ['nama' => 'Program Kerja Unggulan', 'kat' => 'Kegiatan'],
            ['nama' => 'Pelatihan Kepemimpinan Anggota', 'kat' => 'Pengembangan'],
            ['nama' => 'Penyelenggaraan Lomba Nasional', 'kat' => 'Prestasi'],
            ['nama' => 'Pengadaan Inventaris Alat UKM', 'kat' => 'Sarana'],
            ['nama' => 'Dana Darurat & Sosial', 'kat' => 'Lainnya'],
        ];

        // Membuat data anggaran untuk 12 bulan di tahun 2025
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jumlahItem = rand(3, 4);
            $items = $faker->randomElements($rencanaAnggaran, $jumlahItem);

            foreach ($items as $item) {
                /** * PERHATIAN: 
                 * Jika error "Table 'db_project.anggaran' doesn't exist" muncul lagi, 
                 * ubah 'anggaran' di bawah ini menjadi 'anggarans' (pakai 's').
                 */
                DB::table('anggarans')->insert([
                    'nama_anggaran'   => $item['nama'],
                    'kategori'        => $item['kat'],
                    'jumlah_anggaran' => $faker->numberBetween(1000000, 10000000),
                    'periode'         => "2025-" . str_pad($bulan, 2, '0', STR_PAD_LEFT),
                    'keterangan'      => 'Rencana alokasi dana untuk ' . $item['nama'],
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }
        }
    }
}
