<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisAktivitasLuar;

class JenisAktivitasLuarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Dinas Luar',
            'Urusan Penting Lainnya',
        ];

        foreach ($data as $nama_jenis_aktivitas_luar) {
            JenisAktivitasLuar::updateOrCreate(
                ['nama_jenis_aktivitas_luar' => $nama_jenis_aktivitas_luar]
            );
        }
    }
}
