<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'MOHAMAD AKBAR FADLIKA WIBOWO S.Tr.Kom',
                'nip' => '200001292025051006',
                'no_wa' => '085748153070',
                'password' => Hash::make('pecelCeplok_kareAyam_2608'),
                'role' => 'superadmin',
                'is_active' => true,
            ],
            [
                'nama' => 'MUHAMMAD ALI SHOBIRIN S.Sos',
                'nip' => '199709142024211017',
                'no_wa' => '081357682944',
                'password' => Hash::make('shobirinAli-M#184'),
                'role' => 'admin',
                'is_active' => true,
            ],
            [
                'nama' => 'NURIL `IRNINA S.H',
                'nip' => '199601162025212006',
                'no_wa' => '081556660630',
                'password' => Hash::make('irninaNuril-#103'),
                'role' => 'admin',
                'is_active' => true,
            ],
            [
                'nama' => 'UMI KULSUM S. Ag. M.Pd.I',
                'nip' => '197107082000032002',
                'no_wa' => '081331532130',
                'password' => Hash::make('kulsumUmi-#701'),
                'role' => 'kepala_kantor',
                'is_active' => true,
            ],
            [
                'nama' => 'IMAM SYAFII S.Ag., MA.',
                'nip' => '197808122005011002',
                'no_wa' => '082332595267',
                'password' => Hash::make('syafiiImam-#548'),
                'role' => 'kepala_seksi',
                'is_active' => true,
            ],
            [
                'nama' => 'MASHARI M.Ag',
                'nip' => '196902101998031001',
                'no_wa' => '081332357196',
                'password' => Hash::make('mashari-#170'),
                'role' => 'kepala_seksi',
                'is_active' => true,
            ],
            [
                'nama' => 'IMAM BUKORI SH,MM',
                'nip' => '197508012003121005',
                'no_wa' => '085257966425',
                'password' => Hash::make('bukoriImam-#526'),
                'role' => 'kepala_seksi',
                'is_active' => true,
            ],
            [
                'nama' => 'LUKMAN HAKIM S.Ag',
                'nip' => '197511232005011004',
                'no_wa' => '082330438788',
                'password' => Hash::make('hakimLukman-#337'),
                'role' => 'kepala_seksi',
                'is_active' => true,
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
