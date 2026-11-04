<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AktivitasLuar;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    public function index()
    {
        $aktivitasLuar = AktivitasLuar::with([
            'user',
            'jenisAktivitasLuar',
        ])
        ->where('status_permit', '!=', 'draft')
        ->latest('created_at')
        ->get();

        return view('approval.index', compact('aktivitasLuar'));
    }

    public function show(AktivitasLuar $approval)
    {
        $approval->load([
            'user.penempatanDefinitif.jabatan',
            'user.penempatanDefinitif.unitKerja',
            'jenisAktivitasLuar',
            'creator',
            'processor',
        ]);

        $waktuKeluar = Carbon::parse($approval->tanggal_keluar)
            ->setTimeFromTimeString($approval->waktu_keluar);

        $bolehApprove = now()->greaterThanOrEqualTo($waktuKeluar);

        return view('approval.show', compact('approval', 'waktuKeluar', 'bolehApprove'));
    }

    public function approve(AktivitasLuar $approval)
    {
        try {

            if ($approval->status_permit !== 'diajukan') {
                return redirect()
                    ->route('approval.show', $approval->id)
                    ->with(
                        'approve_error',
                        'Permit hanya dapat disetujui jika berstatus diajukan.'
                    );
            }

            $waktuKeluar = Carbon::parse($approval->tanggal_keluar)
                ->setTimeFromTimeString($approval->waktu_keluar);

            if (now()->lt($waktuKeluar)) {
                return redirect()
                    ->route('approval.show', $approval->id)
                    ->with(
                        'approve_error',
                        'Permit belum dapat disetujui. Approval hanya dapat dilakukan mulai tanggal dan waktu keluar yang telah ditentukan.'
                    );
            }

            $approval->update([
                'status_permit' => 'disetujui',
                'processed_by' => auth()->id(),
                'processed_at' => now(),
                'alasan_penolakan' => null,
            ]);

            return redirect()
                ->route('approval.show', $approval->id)
                ->with(
                    'approve_success',
                    'Permit berhasil disetujui.'
                );

        } catch (\Throwable $th) {

            return redirect()
                ->route('approval.show', $approval->id)
                ->with(
                    'approve_error',
                    'Permit gagal disetujui. Silakan coba lagi.'
                );
        }
    }

    public function reject(Request $request, AktivitasLuar $approval)
    {
        $request->validate([
            'alasan_penolakan' => [
                'required',
                'string',
                'max:1000',
            ],
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi.',
            'alasan_penolakan.max' => 'Alasan penolakan maksimal 1000 karakter.',
        ]);

        try {

            if ($approval->status_permit !== 'diajukan') {
                return redirect()
                    ->route('approval.show', $approval->id)
                    ->with(
                        'reject_error',
                        'Permit hanya dapat ditolak jika berstatus diajukan.'
                    );
            }

            $approval->update([
                'status_permit' => 'ditolak',
                'processed_by' => auth()->id(),
                'processed_at' => now(),
                'alasan_penolakan' => $request->alasan_penolakan,
            ]);

            return redirect()
                ->route('approval.show', $approval->id)
                ->with(
                    'reject_success',
                    'Permit berhasil ditolak.'
                );

        } catch (\Throwable $th) {

            return redirect()
                ->route('approval.show', $approval->id)
                ->with(
                    'reject_error',
                    'Permit gagal ditolak. Silakan coba lagi.'
                );
        }
    }

    public function confirmReturn(AktivitasLuar $approval)
    {
        try {

            if ($approval->status_permit !== 'disetujui') {
                return redirect()
                    ->route('approval.show', $approval->id)
                    ->with(
                        'return_error',
                        'Konfirmasi kembali hanya dapat dilakukan pada permit yang sudah disetujui.'
                    );
            }

            if ($approval->posisi_di_kantor) {
                return redirect()
                    ->route('approval.show', $approval->id)
                    ->with(
                        'return_error',
                        'Pegawai sudah dikonfirmasi kembali ke kantor.'
                    );
            }

            $approval->update([
                'posisi_di_kantor' => 1,
                'tanggal_kembali' => now()->toDateString(),
                'waktu_kembali' => now()->format('H:i:s'),
            ]);

            return redirect()
                ->route('approval.show', $approval->id)
                ->with(
                    'return_success',
                    'Pegawai berhasil dikonfirmasi telah kembali ke kantor.'
                );

        } catch (\Throwable $th) {

            return redirect()
                ->route('approval.show', $approval->id)
                ->with(
                    'return_error',
                    'Konfirmasi kembali gagal. Silakan coba lagi.'
                );
        }
    }
}
