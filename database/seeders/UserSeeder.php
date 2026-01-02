<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ROLE YANG DIPAKAI (TANPA ADMIN)
        $roles = ['staff', 'user'];

        // DAFTAR NAMA DEPAN
        $firstNames = [
            'Ahmad','Aisyah','Bagus','Bima','Cahya','Dinda','Dewi','Eka','Fajar','Fikri',
            'Galang','Gita','Hadi','Hana','Ilham','Indah','Irfan','Jihan','Joko','Karin',
            'Lutfi','Laila','Mira','Nabila','Nanda','Putra','Putri','Rafi','Rina','Rizki',
            'Salsa','Sinta','Taufik','Tia','Umar','Vina','Wahyu','Yani','Yusuf','Zahra'
        ];

        // DAFTAR NAMA BELAKANG
        $lastNames = [
            'Aditya','Andriani','Ardiansyah','Fauzi','Firmansyah','Hidayat','Kurniawan',
            'Maulana','Nugroho','Prasetyo','Ramadhan','Saputra','Setiawan',
            'Siregar','Sukmawati','Wijaya','Wibowo','Yuliana'
        ];

        // 2️⃣ 99 USER RANDOM
        for ($i = 1; $i <= 99; $i++) {
            $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];

            User::create([
                'name' => $name,
                'email' => Str::slug($name) . rand(100, 9999) . '@gmail.com',
                'password' => Hash::make('password'),
                'role' => $roles[array_rand($roles)],
                'phone' => '08' . rand(1000000000, 9999999999),
                'is_active' => true,
            ]);
        }
    }
}
