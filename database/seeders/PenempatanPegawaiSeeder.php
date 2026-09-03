<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PenempatanPegawai;

class PenempatanPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_user' => '1',
                'id_unit_kerja' => '2',
                'id_jabatan' => '24',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '2',
                'id_unit_kerja' => '2',
                'id_jabatan' => '5',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '3',
                'id_unit_kerja' => '2',
                'id_jabatan' => '12',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '4',
                'id_unit_kerja' => '1',
                'id_jabatan' => '1',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '5',
                'id_unit_kerja' => '2',
                'id_jabatan' => '2',
                'status_jabatan' => 'pelaksana tugas/harian',
            ],
            [
                'id_user' => '5',
                'id_unit_kerja' => '4',
                'id_jabatan' => '3',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '6',
                'id_unit_kerja' => '3',
                'id_jabatan' => '3',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '7',
                'id_unit_kerja' => '5',
                'id_jabatan' => '3',
                'status_jabatan' => 'definitif',
            ],
            [
                'id_user' => '8',
                'id_unit_kerja' => '6',
                'id_jabatan' => '3',
                'status_jabatan' => 'pelaksana tugas/harian',
            ],
            [
                'id_user' => '8',
                'id_unit_kerja' => '7',
                'id_jabatan' => '4',
                'status_jabatan' => 'definitif',
            ],
        ];

        foreach ($data as $penempatan) {
            PenempatanPegawai::create($penempatan);
        }
    }
}
