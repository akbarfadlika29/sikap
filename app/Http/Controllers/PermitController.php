<?php

namespace App\Http\Controllers;

use App\Models\AktivitasLuar;
use App\Models\User;
use App\Models\JenisAktivitasLuar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PermitController extends Controller
{
    public function index()
    {
        $aktivitasLuar = AktivitasLuar::with([
            'user',
            'jenisAktivitasLuar',
            'creator',
            'processor',
        ])
        ->latest()
        ->get();

        return view('permit.index', compact('aktivitasLuar'));
    }

    public function create()
    {
        $users = User::query()
            ->where('is_active', true)
            ->with('latestPermit')
            ->orderBy('nama')
            ->get([
                'id',
                'nama',
                'nip',
                'no_wa',
            ]);
        
        $jenisAktivitasLuar = JenisAktivitasLuar::query()
            ->orderBy('nama_jenis_aktivitas_luar')
            ->get([
                'id',
                'nama_jenis_aktivitas_luar',
            ]);
        
        return view('permit.create', compact(
            'users',
            'jenisAktivitasLuar'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => [
                'required',
                'exists:users,id',
            ],

            'id_jenis_aktivitas_luar' => [
                'required',
                'exists:jenis_aktivitas_luar,id',
            ],
            
            'deskripsi_aktivitas_luar' => [
                'required',
                'string',
                'max:5000',
            ],

            'tanggal_keluar' => [
                'required',
                'date',
            ],

            'waktu_keluar' => [
                'required',
                'date_format:H:i',
            ],

            'tanggal_estimasi_kembali' => [
                'required',
                'date',
                'after_or_equal:tanggal_keluar',
            ],

            'waktu_estimasi_kembali' => [
                'required',
                'date_format:H:i',
            ],

            'dokumen_pendukung' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048',
            ],
        ], [
            'id_user.required' => 'Pegawai wajib dipilih.',
            'id_user.exists' => 'Data pegawai tidak ditemukan.',
            'id_jenis_aktivitas_luar.required' => 'Jenis aktivitas wajib dipilih.',
            'id_jenis_aktivitas_luar.exists' => 'Jenis aktivitas tidak ditemukan.',
            'deskripsi_aktivitas_luar.required' => 'Deskripsi aktivitas wajib diisi.',
            'tanggal_keluar.required' => 'Tanggal keluar wajib diisi.',
            'waktu_keluar.required' => 'Waktu keluar wajib diisi.',
            'tanggal_estimasi_kembali.required' => 'Tanggal estimasi kembali wajib diisi.',
            'tanggal_estimasi_kembali.after_or_equal' => 'Tanggal estimasi kembali tidak boleh sebelum tanggal keluar.',
            'waktu_estimasi_kembali.required' => 'Waktu estimasi kembali wajib diisi.',
            'dokumen_pendukung.mimes' => 'Dokumen harus berupa PDF, JPG, JPEG, atau PNG.',
            'dokumen_pendukung.max' => 'Ukuran dokumen maksimal 2 MB.',
        ]);

        $user = User::with('latestPermit')->findOrFail($validated['id_user']);

        $latestPermit = $user->latestPermit;

        if ($latestPermit && $latestPermit->status_permit === 'disetujui' && !$latestPermit->posisi_di_kantor) {
            return back()
                ->withInput()
                ->with(
                    'permit_error',
                    'Pegawai tersebut masih berada di luar kantor berdasarkan permit terakhir.'
                );
        }

        try {
            DB::beginTransaction();

            $lastPermit = AktivitasLuar::lockForUpdate()->orderByDesc('id')->first();
            
            $nextNumber = $lastPermit ? $lastPermit->id + 1 : 1;

            $nomorPermit = 'PRM-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
            
            $path = null;

            if ($request->hasFile('dokumen_pendukung')) {
                $file = $request->file('dokumen_pendukung');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $path = "uploads/dokumen_pendukung/" . $filename;
                $file->move(public_path("uploads/dokumen_pendukung/"), $filename);
            }
            
            AktivitasLuar::create([
                'nomor_permit' => $nomorPermit,
                'id_user' => $validated['id_user'],
                'id_jenis_aktivitas_luar' => $validated['id_jenis_aktivitas_luar'],
                'deskripsi_aktivitas_luar' => $validated['deskripsi_aktivitas_luar'],
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'waktu_keluar' => $validated['waktu_keluar'],
                'tanggal_estimasi_kembali' => $validated['tanggal_estimasi_kembali'],
                'waktu_estimasi_kembali' => $validated['waktu_estimasi_kembali'],
                'posisi_di_kantor' => 0,
                'dokumen_pendukung' => $path,
                'status_permit' => 'draft',
                'created_by' => Auth::id(),
                'processed_by' => null,
                'processed_at' => null,
            ]);

            DB::commit();

            return redirect()->route('permit.index')->with('permit_success', ' Data permit berhasil disimpan sebagai draft.');
        
        } catch (\Throwable $th) {
            DB::rollBack();

            if (!empty($dokumenPath)) {
                Storage::disk('public')->delete($dokumenPath);
            }

            return back()->withInput()->with('permit_error', 'Data permit gagal disimpan. Silahkan coba lagi.');
        }
    }

    public function show(AktivitasLuar $permit) 
    {
        $permit->load([
            'user.penempatanDefinitif.jabatan',
            'user.penempatanDefinitif.unitKerja',
            'jenisAktivitasLuar',
            'creator',
            'processor',
        ]);

        return view('permit.show', compact('permit'));
    }

    public function edit(AktivitasLuar $permit) 
    {
        if ($permit->status_permit !== 'draft') {
            return redirect()->route('permit.inde')->with('permit_error', 'Permit yang sudah diajukan atau diproses tidak dapat diedit.');
        }

        $users = User::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get([
                'id',
                'nama',
                'nip',
                'no_wa',
            ]);

        $jenisAktivitasLuar = JenisAktivitasLuar::query()
            ->orderBy('nama_jenis_aktivitas_luar')
            ->get([
                'id',
                'nama_jenis_aktivitas_luar',
            ]);

        return view('permit.edit', compact('permit', 'users', 'jenisAktivitasLuar'));
    }

    public function update(Request $request, AktivitasLuar $permit)
    {
        if ($permit->status_permit !== 'draft') {
            return redirect()
                ->route('permit.index')
                ->with(
                    'permit_error',
                    'Permit yang sudah diajukan atau diproses tidak dapat diedit.'
                );
        }

        $validated = $request->validate([
            'id_user' => [
                'required',
                'exists:users,id',
            ],
            'id_jenis_aktivitas_luar' => [
                'required',
                'exists:jenis_aktivitas_luar,id',
            ],
            'deskripsi_aktivitas_luar' => [
                'required',
                'string',
                'max:5000',
            ],
            'tanggal_keluar' => [
                'required',
                'date',
            ],
            'waktu_keluar' => [
                'required',
                'date_format:H:i',
            ],
            'tanggal_estimasi_kembali' => [
                'required',
                'date',
                'after_or_equal:tanggal_keluar',
            ],
            'waktu_estimasi_kembali' => [
                'required',
                'date_format:H:i',
            ],
            'dokumen_pendukung' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048',
            ],
        ], [
            'id_user.required' =>
            'Pegawai wajib dipilih.',

            'id_user.exists' =>
                'Data pegawai tidak ditemukan.',

            'id_jenis_aktivitas_luar.required' =>
                'Jenis aktivitas wajib dipilih.',

            'id_jenis_aktivitas_luar.exists' =>
                'Jenis aktivitas tidak ditemukan.',

            'deskripsi_aktivitas_luar.required' =>
                'Deskripsi aktivitas wajib diisi.',

            'tanggal_keluar.required' =>
                'Tanggal keluar wajib diisi.',

            'waktu_keluar.required' =>
                'Waktu keluar wajib diisi.',

            'tanggal_estimasi_kembali.required' =>
                'Tanggal estimasi kembali wajib diisi.',

            'tanggal_estimasi_kembali.after_or_equal' =>
                'Tanggal estimasi kembali tidak boleh sebelum tanggal keluar.',

            'waktu_estimasi_kembali.required' =>
                'Waktu estimasi kembali wajib diisi.',

            'dokumen_pendukung.mimes' =>
                'Dokumen harus berupa PDF, JPG, JPEG, atau PNG.',

            'dokumen_pendukung.max' =>
                'Ukuran dokumen maksimal 2 MB.',
        ]);

        $oldDokumenPath = $permit->dokumen_pendukung;

        $newDokumenPath = null;

        try {

            DB::beginTransaction();


            /*
            |--------------------------------------------------------------------------
            | UPLOAD DOKUMEN BARU JIKA ADA
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('dokumen_pendukung')) {
                $file = $request->file('dokumen_pendukung');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $newDokumenPath = "uploads/dokumen_pendukung/" . $filename;
                $file->move(public_path("uploads/dokumen_pendukung/"), $filename);
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA PERMIT
            |--------------------------------------------------------------------------
            |
            | Nomor permit, created_by, created_at, processed_by,
            | processed_at, status_permit, dan alasan_penolakan
            | TIDAK diubah.
            |
            */

            $permit->update([
                'id_user' =>
                    $validated['id_user'],

                'id_jenis_aktivitas_luar' =>
                    $validated['id_jenis_aktivitas_luar'],

                'deskripsi_aktivitas_luar' =>
                    $validated['deskripsi_aktivitas_luar'],

                'tanggal_keluar' =>
                    $validated['tanggal_keluar'],

                'waktu_keluar' =>
                    $validated['waktu_keluar'],

                'tanggal_estimasi_kembali' =>
                    $validated['tanggal_estimasi_kembali'],

                'waktu_estimasi_kembali' =>
                    $validated['waktu_estimasi_kembali'],

                'dokumen_pendukung' =>
                    $newDokumenPath ?? $oldDokumenPath,
            ]);


            DB::commit();


            /*
            |--------------------------------------------------------------------------
            | HAPUS DOKUMEN LAMA SETELAH UPDATE BERHASIL
            |--------------------------------------------------------------------------
            */

            if ($newDokumenPath && $oldDokumenPath) {
                unlink(public_path($oldDokumenPath));
            }


            return redirect()
                ->route('permit.index')
                ->with(
                    'update_permit_success',
                    'Data draft permit berhasil diperbarui.'
                );

        } catch (\Throwable $th) {

            DB::rollBack();


            /*
            |--------------------------------------------------------------------------
            | HAPUS FILE BARU JIKA DATABASE GAGAL DIUPDATE
            |--------------------------------------------------------------------------
            */

            if ($newDokumenPath) {

                Storage::disk('public')
                    ->delete($newDokumenPath);
            }


            return back()
                ->withInput()
                ->with(
                    'update_permit_error',
                    'Data draft permit gagal diperbarui. Silakan coba lagi.'
                );
        }
    }

    public function destroy(AktivitasLuar $permit)
    {
        try {
            if ($permit->status_permit !== 'draft') {
                return redirect()
                    ->route('permit.index')
                    ->with(
                        'permit_error',
                        'Permit hanya dapat dihapus jika masih berstatus draft.'
                    );
            }

            $filePath = public_path($permit->dokumen_pendukung);
            if ($permit->dokumen_pendukung && file_exists($filePath)) {
                unlink($filePath);
            }

            $permit->delete();

            return redirect()->route('permit.index')->with('delete_permit_success', 'Permit berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('permit.index')->with('delete_permit_error', 'Permit gagal dihapus. Silakan coba lagi.');
        }
    }

    public function submit(AktivitasLuar $permit)
    {
        try {
            if ($permit->status_permit !== 'draft') {
                return redirect()
                    ->route('permit.show', $permit->id)
                    ->with(
                        'submit_permit_error',
                        'Permit hanya dapat diajukan jika masih berstatus draft.'
                    );
            }

            $permit->update([
                'status_permit' => 'diajukan',
            ]);

            return redirect()
                ->route('permit.show', $permit->id)
                ->with(
                    'submit_permit_success',
                    'Permit berhasil diajukan dan menunggu proses persetujuan.'
                );
        } catch (\Throwable $th) {
            return redirect()
                ->route('permit.show', $permit->id)
                ->with(
                    'submit_permit_error',
                    'Permit gagal diajukan. Silakan coba lagi.'
                );
        }
    }
}
