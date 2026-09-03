<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnitKerja;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Kantor Kementerian Agama Kabupaten Tuban',
            'Sub Bagian Tata Usaha',
            'Seksi Bimbingan Masyarakat Islam',
            'Seksi Pendidikan Agama Islam',
            'Seksi Pendidikan Diniyah dan Pondok Pesantren',
            'Seksi Pendidikan Madrasah',
            'Penyelenggara Zakat dan Wakaf'
        ];

        foreach ($data as $nama_unit_kerja) {
            UnitKerja::updateOrCreate(
                ['nama_unit_kerja' => $nama_unit_kerja]
            );
        }
    }
}
