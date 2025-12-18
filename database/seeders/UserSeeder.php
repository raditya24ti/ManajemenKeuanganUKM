<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ketua UKM',
                'email' => 'ketua@ukm.com',
                'password' => Hash::make('password'),
                'role' => 'ketua',
                'phone' => '081234567890',
                'is_active' => true,
            ],
            [
                'name' => 'Bendahara UKM',
                'email' => 'bendahara@ukm.com',
                'password' => Hash::make('password'),
                'role' => 'bendahara',
                'phone' => '081234567891',
                'is_active' => true,
            ],
            [
                'name' => 'Pengurus UKM',
                'email' => 'pengurus@ukm.com',
                'password' => Hash::make('password'),
                'role' => 'pengurus',
                'phone' => '081234567892',
                'is_active' => true,
            ],
            [
                'name' => 'Anggota 1',
                'email' => 'anggota1@ukm.com',
                'password' => Hash::make('password'),
                'role' => 'anggota',
                'phone' => '081234567893',
                'is_active' => true,
            ],
            [
                'name' => 'Anggota 2',
                'email' => 'anggota2@ukm.com',
                'password' => Hash::make('password'),
                'role' => 'anggota',
                'phone' => '081234567894',
                'is_active' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
