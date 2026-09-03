<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Kepala Kantor',
            'Kepala Sub Bagian',
            'Kepala Seksi',
            'Penyelenggara',
            'Analis SDM Aparatur Ahli Pertama',
            'Arsiparis Ahli Pertama',
            'Pembimbing Teknis Urusan Agama',
            'Penata Kelola Jaminan Produk Halal',
            'Penata Kelola Madrasah, Pendidikan Agama dan Keagamaan',
            'Penata Kelola Sistem dan Teknologi Informasi',
            'Penata Kelola Zakat dan Wakaf',
            'Penata Layanan Operasional',
            'Penelaah Teknis Kebijakan',
            'Pengadministrasi Perkantoran',
            'Pengelola Pengadaan Barang/Jasa Ahli Muda',
            'Pengelola Pengadaan Barang/Jasa Ahli Pertama',
            'Pengolah Data dan Informasi',
            'Penyuluh Agama Ahli Pertama',
            'Perencana Ahli Madya',
            'Perencana Ahli Muda',
            'Perencana Ahli Pertama',
            'Pranata Humas Ahli Madya',
            'Pranata Keuangan APBN Penyelia',
            'Pranata Komputer Ahli Pertama',
        ];

        foreach ($data as $nama_jabatan) {
            Jabatan::updateOrCreate(
                ['nama_jabatan' => $nama_jabatan]
            );
        }
    }
}
