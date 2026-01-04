<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi; // Import model Anda
use Faker\Factory as Faker;

class TransaksiDummySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {
            $jenis = $faker->randomElement(['masuk', 'keluar']);
            
            Transaksi::create([ // Menggunakan Model Transaksi
                'tanggal'    => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'jenis'      => $jenis,
                'kategori'   => ($jenis == 'masuk') ? 
                                $faker->randomElement(['Iuran', 'Sponsorship', 'Hibah']) : 
                                $faker->randomElement(['Konsumsi', 'Sewa', 'ATK']),
                'jumlah'     => $faker->numberBetween(50000, 2000000),
                'keterangan' => 'Dummy transaksi UKM',
            ]);
        }
    }
}