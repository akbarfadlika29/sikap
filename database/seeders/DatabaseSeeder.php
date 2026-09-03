<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\UserSeeder;
use Database\Seeders\JabatanSeeder;
use Database\Seeders\UnitKerjaSeeder;
use Database\Seeders\PenempatanPegawaiSeeder;
use Database\Seeders\JenisAktivitasLuarSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            JabatanSeeder::class,
            UnitKerjaSeeder::class,
            PenempatanPegawaiSeeder::class,
            JenisAktivitasLuarSeeder::class,
        ]);
    }
}