<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now('Asia/Jakarta');

        $hari = $now->dayOfWeekIso;
        $waktuSekarang = $now->format('H:i');

        $jamKerjaSeninKamis =
            $hari >= 1 &&
            $hari <= 4 &&
            $waktuSekarang >= '07:30' &&
            $waktuSekarang <= '16:00';

        $jamKerjaJumat =
            $hari === 5 &&
            $waktuSekarang >= '07:30' &&
            $waktuSekarang <= '16:30';

        $dalamJamKerja = $jamKerjaSeninKamis || $jamKerjaJumat;

        $pegawai = collect();

        if ($dalamJamKerja) {
            $pegawai = User::query()
                ->where('is_active', true)
                ->whereIn('role', [
                    'kepala_kantor',
                    'kepala_seksi',
                    'staff',
                ])
                ->with([
                    'penempatanDefinitif.jabatan',
                    'penempatanDefinitif.unitKerja',
                    'latestPermit.jenisAktivitasLuar',
                ])
                ->orderByRaw("
                    CASE
                        WHEN role = 'kepala_kantor' THEN 1
                        WHEN role = 'kepala_seksi' THEN 2
                        WHEN role = 'staff' THEN 3
                        ELSE 4
                    END
                ")
                ->orderBy('nama')
                ->get();

            $pegawai = $pegawai->filter(function ($user) {
                if (in_array($user->role, [
                    'kepala_kantor',
                    'kepala_seksi'
                ])) {
                    return true;
                }

                if ($user->role === 'staff') {
                    return $user->latestPermit &&
                        $user->latestPermit->status_permit === 'disetujui' &&
                        !$user->latestPermit->posisi_di_kantor;
                }

                return false;
            })->values();
        }

        return view('welcome', compact('pegawai', 'dalamJamKerja'));
    }
}
