<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pimpinan
        User::create([
            'name' => 'Bapak Kepala Kemenag',
            'nip' => '11111',
            'password' => Hash::make('password123'),
            'role' => 'pimpinan',
        ]);

        // Akun Pejabat
        User::create([
            'name' => 'Bapak Kasubag',
            'nip' => '22222',
            'password' => Hash::make('password123'),
            'role' => 'pejabat',
        ]);

        // Akun Pegawai
        User::create([
            'name' => 'Staf IT',
            'nip' => '33333',
            'password' => Hash::make('password123'),
            'role' => 'pegawai',
        ]);

        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'nip' => '99999', // NIP khusus admin
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}