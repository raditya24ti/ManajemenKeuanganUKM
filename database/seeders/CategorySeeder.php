<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Pemasukan
            ['name' => 'Iuran Anggota', 'type' => 'pemasukan', 'description' => 'Pembayaran iuran bulanan anggota'],
            ['name' => 'Donasi', 'type' => 'pemasukan', 'description' => 'Sumbangan dari donatur'],
            ['name' => 'Penjualan', 'type' => 'pemasukan', 'description' => 'Hasil penjualan produk/jasa'],
            ['name' => 'Bantuan', 'type' => 'pemasukan', 'description' => 'Bantuan dari pihak lain'],
            
            // Pengeluaran
            ['name' => 'Operasional', 'type' => 'pengeluaran', 'description' => 'Biaya operasional harian'],
            ['name' => 'Kegiatan', 'type' => 'pengeluaran', 'description' => 'Biaya kegiatan organisasi'],
            ['name' => 'Gaji & Honor', 'type' => 'pengeluaran', 'description' => 'Gaji dan honorarium'],
            ['name' => 'Peralatan', 'type' => 'pengeluaran', 'description' => 'Pembelian peralatan'],
            ['name' => 'Transportasi', 'type' => 'pengeluaran', 'description' => 'Biaya transportasi'],
            ['name' => 'Konsumsi', 'type' => 'pengeluaran', 'description' => 'Biaya konsumsi'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
