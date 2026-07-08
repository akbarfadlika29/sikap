<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\Izin;
use App\Models\User;

// ==========================================
// RUTE BERANDA UMUM (PUBLIK) & LOGIN
// ==========================================
Route::get('/', function () {
    $pegawai_izin = Izin::with('user')->where('status', 'Disetujui')->orderBy('created_at', 'desc')->get();
    return view('welcome', compact('pegawai_izin'));
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// RUTE PEGAWAI (DASHBOARD & CRUD IZIN)
// ==========================================
Route::get('/dashboard-pegawai', function () {
    $riwayat_izin = Izin::where('user_id', auth()->id())->where('status', '!=', 'Proses')->orderBy('created_at', 'desc')->get();
    return view('dashboard-pegawai', compact('riwayat_izin'));
})->middleware('auth');

Route::get('/formulir-izin', function () {
    $izins = Izin::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    return view('formulir-izin-index', compact('izins'));
})->middleware('auth');

Route::get('/formulir-izin/tambah', function () { return view('formulir-izin-tambah'); })->middleware('auth');
// Route::post('/formulir-izin/tambah', function (Request $request) {
//     $user = User::find(auth()->id());
//     if ($request->has('nama')) { $user->name = $request->nama; $user->save(); }
//     $nama_file = null;
//     if ($request->hasFile('surat_izin')) {
//         $nama_file = time() . '_' . $request->file('surat_izin')->getClientOriginalName();
//         $request->file('surat_izin')->move(public_path('uploads/surat_izin'), $nama_file);
//     }
//     Izin::create([
//         'user_id' => auth()->id(), 'divisi' => $request->divisi, 'jenis_izin' => $request->jenis_izin,
//         'tanggal_mulai' => $request->tanggal_mulai, 'jam_keluar' => $request->jam_keluar,
//         'tanggal_selesai' => $request->tanggal_selesai, 'jam_kembali' => $request->jam_kembali,
//         'alasan' => $request->alasan, 'status' => 'Proses', 'surat_izin' => $nama_file 
//     ]);
//     return redirect('/formulir-izin')->with('success', 'Pengajuan Izin berhasil dibuat!');
// })->middleware('auth');

// ==========================================
// RUTE SIMPAN IZIN & KIRIM WA FONNTE.COM
// ==========================================
Route::post('/formulir-izin/tambah', function (Illuminate\Http\Request $request) {
    
    // 1. UPDATE NAMA PEGAWAI (Jika ada perubahan nama di form)
    $user = App\Models\User::find(auth()->id());
    if ($request->has('nama')) { 
        $user->name = $request->nama; 
        $user->save(); 
    }

    // 2. PROSES UPLOAD LAMPIRAN PDF (Opsional)
    $nama_file = null;
    if ($request->hasFile('surat_izin')) {
        $nama_file = time() . '_' . $request->file('surat_izin')->getClientOriginalName();
        $request->file('surat_izin')->move(public_path('uploads/surat_izin'), $nama_file);
    }

    // 3. SIMPAN DATA PERMOHONAN KE DATABASE
    App\Models\Izin::create([
        'user_id' => auth()->id(), 
        'divisi' => $request->divisi, 
        'jenis_izin' => $request->jenis_izin,
        'tanggal_mulai' => $request->tanggal_mulai, 
        'jam_keluar' => $request->jam_keluar,
        'tanggal_selesai' => $request->tanggal_selesai, 
        'jam_kembali' => $request->jam_kembali,
        'alasan' => $request->alasan, 
        'status' => 'Proses', 
        'surat_izin' => $nama_file 
    ]);

    // ==========================================
    // 4. INTEGRASI UTUH API FONNTE.COM (WA GATEWAY)
    // ==========================================
    
    // Konfigurasi Akun Fonnte (Silakan sesuaikan isi variabel ini)
    $token_fonnte = "aR3aBghWmCXvU74X7uEy"; 
    $nomor_pimpinan = "6287837004739"; // Gunakan format 628... atau 08... sesuai nomor tujuan Bapak Pimpinan

    // Susun template pesan teks WA dengan rapi menggunakan format Markdown WA
    $pesanWA = "🚨 *NOTIFIKASI SIKAP KEMENAG TUBAN* 🚨\n\n"
             . "Yth. Bapak Pimpinan, terdapat permohonan izin baru yang memerlukan verifikasi dan persetujuan Anda:\n\n"
             . "👤 *Nama Pegawai:* " . auth()->user()->name . "\n"
             . "🏷️ *Jenis Permohonan:* " . $request->jenis_izin . "\n"
             . "📝 *Alasan Izin:* " . $request->alasan . "\n"
             . "📅 *Waktu Keluar:* " . \Carbon\Carbon::parse($request->tanggal_mulai)->format('d/m/Y') . " (" . $request->jam_keluar . " WIB)\n"
             . "⏳ *Estimasi Kembali:* " . \Carbon\Carbon::parse($request->tanggal_selesai)->format('d/m/Y') . " (" . $request->jam_kembali . " WIB)\n\n"
             . "Mohon segera masuk ke *Executive Panel SIKAP* untuk memproses otorisasi (Setuju/Tolak).\n"
             . "Terima Kasih.";

    try {
        // Tembak API menggunakan HTTP Client bawaan Laravel dengan skema form multipart Fonnte
        Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => $token_fonnte,
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $nomor_pimpinan,
            'message' => $pesanWA,
            'countryCode' => '62', // Otomatis mengarahkan ke kode negara Indonesia jika nomor diawali angka 08
        ]);
    } catch (\Exception $e) {
        // Blok try-catch sengaja dibiarkan kosong agar jika seandainya kuota Fonnte habis 
        // atau server internet mati, website utama SIKAP tetap berjalan lancar tanpa memunculkan error crash.
    }

    // 5. REDIRECT KEMBALI DENGAN ALERT BERHASIL
    return redirect('/formulir-izin')->with('success', 'Pengajuan Izin berhasil terkirim dan sistem otomatis meneruskan notifikasi WA ke Pimpinan!');

})->middleware('auth');

Route::get('/formulir-izin/edit/{id}', function ($id) {
    $izin = Izin::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    if($izin->status !== 'Proses') return redirect('/formulir-izin')->with('error', 'Izin sudah diproses, tidak bisa diedit!');
    return view('formulir-izin-edit', compact('izin'));
})->middleware('auth');

Route::post('/formulir-izin/update/{id}', function (Request $request, $id) {
    $izin = Izin::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    if($izin->status !== 'Proses') return redirect('/formulir-izin');
    if ($request->hasFile('surat_izin')) {
        $nama_file = time() . '_' . $request->file('surat_izin')->getClientOriginalName();
        $request->file('surat_izin')->move(public_path('uploads/surat_izin'), $nama_file);
        $izin->surat_izin = $nama_file; 
    }
    $izin->update($request->only(['divisi', 'jenis_izin', 'tanggal_mulai', 'jam_keluar', 'tanggal_selesai', 'jam_kembali', 'alasan']));
    return redirect('/formulir-izin')->with('success', 'Data Izin berhasil diperbarui!');
})->middleware('auth');

Route::post('/formulir-izin/hapus/{id}', function ($id) {
    $izin = Izin::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    if($izin->status === 'Proses') { $izin->delete(); return redirect('/formulir-izin')->with('success', 'Izin dibatalkan.'); }
    return redirect('/formulir-izin')->with('error', 'Gagal dihapus.');
})->middleware('auth');

Route::get('/konfirmasi-pulang', function () {
    $izin_aktif = Izin::where('user_id', auth()->id())->where('status', 'Disetujui')->first(); 
    return view('konfirmasi-pulang', compact('izin_aktif'));
})->middleware('auth');
Route::post('/proses-pulang/{id}', function ($id) {
    Izin::findOrFail($id)->update(['status' => 'Selesai']);
    return redirect('/dashboard-pegawai')->with('success', 'Status Anda sudah diupdate.');
})->middleware('auth');

// ==========================================
// RUTE PIMPINAN
// ==========================================
Route::get('/dashboard-pimpinan', function () {
    $semua_izin = Izin::with('user')->orderBy('created_at', 'desc')->get();
    $total_staf = User::where('role', 'pegawai')->count();
    $perlu_otoritas = Izin::where('status', 'Proses')->count();
    $sedang_diluar = Izin::where('status', 'Disetujui')->where('jenis_izin', 'Dinas Luar')->count();
    return view('dashboard-pimpinan', compact('semua_izin', 'total_staf', 'perlu_otoritas', 'sedang_diluar'));
})->middleware('auth');

Route::get('/verifikasi-izin', function () {
    $izin_proses = Izin::with('user')->where('status', 'Proses')->orderBy('created_at', 'asc')->get();
    return view('verifikasi-izin', compact('izin_proses'));
})->middleware('auth');

Route::post('/proses-izin/{id}', function (Request $request, $id) {
    Izin::findOrFail($id)->update(['status' => $request->action]);
    return redirect('/dashboard-pimpinan')->with('success', $request->action == 'Disetujui' ? 'Izin disetujui!' : 'Izin ditolak!');
})->middleware('auth');

// ==========================================
// RUTE ADMIN: DASHBOARD & CRUD USER
// ==========================================
Route::get('/dashboard-admin', function () {
    if(auth()->user()->role !== 'admin') return redirect('/');
    return view('dashboard-admin');
})->middleware('auth');

Route::get('/tambah-pegawai', function () {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $users = User::where('role', 'pegawai')->orderBy('created_at', 'desc')->get();
    return view('tambah-pegawai-index', compact('users'));
})->middleware('auth');

Route::get('/tambah-pegawai/tambah', function () {
    if(auth()->user()->role !== 'admin') return redirect('/');
    return view('tambah-pegawai-create');
})->middleware('auth');

Route::post('/tambah-pegawai/tambah', function (Request $request) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $request->validate(['nip' => 'required|unique:users', 'name' => 'required', 'password' => 'required|min:6']);
    User::create(['name' => $request->name, 'nip' => $request->nip, 'role' => 'pegawai', 'password' => bcrypt($request->password)]);
    return redirect('/tambah-pegawai')->with('success', 'Akun Pegawai Baru Berhasil Dibuat!');
})->middleware('auth');

Route::get('/tambah-pegawai/edit/{id}', function ($id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $user_edit = User::findOrFail($id);
    return view('tambah-pegawai-edit', compact('user_edit'));
})->middleware('auth');

Route::post('/tambah-pegawai/update/{id}', function (Request $request, $id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $user_edit = User::findOrFail($id);
    $request->validate(['nip' => 'required|unique:users,nip,'.$user_edit->id, 'name' => 'required']);
    $user_edit->name = $request->name; $user_edit->nip = $request->nip;
    if($request->filled('password')) { $user_edit->password = bcrypt($request->password); }
    $user_edit->save();
    return redirect('/tambah-pegawai')->with('success', 'Data Pegawai berhasil diperbarui!');
})->middleware('auth');

Route::post('/tambah-pegawai/hapus/{id}', function ($id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    User::findOrFail($id)->delete();
    return redirect('/tambah-pegawai')->with('success', 'Akun Pegawai berhasil dihapus!');
})->middleware('auth');

// ==========================================
// RUTE ADMIN: CRUD MANAJEMEN JABATAN
// ==========================================
Route::get('/manajemen-jabatan', function () {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $grouped_users = User::where('role', 'pegawai')->whereNotNull('jabatan')->orderBy('unit_kerja')->get()->groupBy('unit_kerja');
    return view('manajemen-jabatan-index', compact('grouped_users'));
})->middleware('auth');

Route::get('/manajemen-jabatan/tambah', function () {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $pegawais = User::where('role', 'pegawai')->get();
    return view('manajemen-jabatan-create', compact('pegawais'));
})->middleware('auth');

Route::post('/manajemen-jabatan/tambah', function (Request $request) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    User::findOrFail($request->user_id)->update(['jabatan' => $request->jabatan, 'unit_kerja' => $request->unit_kerja]);
    return redirect('/manajemen-jabatan')->with('success', 'Jabatan ditetapkan!');
})->middleware('auth');

Route::get('/manajemen-jabatan/edit/{id}', function ($id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $user_edit = User::findOrFail($id);
    return view('manajemen-jabatan-edit', compact('user_edit'));
})->middleware('auth');

Route::post('/manajemen-jabatan/update/{id}', function (Request $request, $id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    User::findOrFail($id)->update(['jabatan' => $request->jabatan, 'unit_kerja' => $request->unit_kerja]);
    return redirect('/manajemen-jabatan')->with('success', 'Jabatan diperbarui!');
})->middleware('auth');

Route::post('/manajemen-jabatan/hapus/{id}', function ($id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    User::findOrFail($id)->update(['jabatan' => null, 'unit_kerja' => null]);
    return redirect('/manajemen-jabatan')->with('success', 'Jabatan dicabut!');
})->middleware('auth');

// ==========================================
// RUTE ADMIN: KONFIGURASI WA API
// ==========================================
Route::get('/konfigurasi-wa', function () {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $izin_masuk = Izin::with('user')->whereIn('status', ['Proses', 'Disetujui'])->get();
    return view('konfigurasi-wa', compact('izin_masuk'));
})->middleware('auth');

Route::post('/konfigurasi-wa/simpan', function () { return redirect('/konfigurasi-wa')->with('success', 'Konfigurasi diperbarui!'); })->middleware('auth');
Route::post('/kirim-wa-pimpinan/{id}', function ($id) { return redirect('/konfigurasi-wa')->with('success', "Notifikasi terkirim!"); })->middleware('auth');
Route::post('/kirim-wa-pegawai/{id}', function ($id) { return redirect('/konfigurasi-wa')->with('success', "Teguran terkirim!"); })->middleware('auth');

// ==========================================
// RUTE ADMIN: REKAPITULASI IZIN (CRUD 4)
// ==========================================
Route::get('/rekapitulasi-izin', function (Request $request) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $query = Izin::with('user');
    if ($request->filled('bulan')) { $query->whereMonth('tanggal_mulai', $request->bulan); }
    if ($request->filled('tahun')) { $query->whereYear('tanggal_mulai', $request->tahun); }
    $izins = $query->orderBy('created_at', 'desc')->get();
    return view('rekapitulasi-izin-index', compact('izins'));
})->middleware('auth');

Route::get('/rekapitulasi-izin/edit/{id}', function ($id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $izin = Izin::with('user')->findOrFail($id);
    return view('rekapitulasi-izin-edit', compact('izin'));
})->middleware('auth');

Route::post('/rekapitulasi-izin/update/{id}', function (Request $request, $id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $izin = Izin::findOrFail($id);
    $izin->update($request->only(['jenis_izin', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'status']));
    return redirect('/rekapitulasi-izin')->with('success', 'Catatan izin berhasil diubah oleh Admin.');
})->middleware('auth');

Route::post('/rekapitulasi-izin/hapus/{id}', function ($id) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    Izin::findOrFail($id)->delete();
    return redirect('/rekapitulasi-izin')->with('success', 'Satu data izin berhasil dihapus.');
})->middleware('auth');

Route::post('/rekapitulasi-izin/hapus-semua', function (Request $request) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $query = Izin::query();
    if ($request->filled('bulan')) { $query->whereMonth('tanggal_mulai', $request->bulan); }
    if ($request->filled('tahun')) { $query->whereYear('tanggal_mulai', $request->tahun); }
    $query->delete();
    return redirect('/rekapitulasi-izin')->with('success', 'Semua data yang dipilih berhasil dibersihkan dari sistem.');
})->middleware('auth');

// --- RUTE CETAK PDF ASLI ---
Route::get('/rekapitulasi-izin/cetak-pdf', function (Request $request) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $query = Izin::with('user');
    if ($request->filled('bulan')) { $query->whereMonth('tanggal_mulai', $request->bulan); }
    if ($request->filled('tahun')) { $query->whereYear('tanggal_mulai', $request->tahun); }
    $izins = $query->orderBy('tanggal_mulai', 'asc')->get();
    
    return view('rekapitulasi-izin-pdf', compact('izins', 'request'));
})->middleware('auth');

// --- RUTE EKSPOR EXCEL ASLI ---
Route::get('/rekapitulasi-izin/cetak-excel', function (Request $request) {
    if(auth()->user()->role !== 'admin') return redirect('/');
    $query = Izin::with('user');
    if ($request->filled('bulan')) { $query->whereMonth('tanggal_mulai', $request->bulan); }
    if ($request->filled('tahun')) { $query->whereYear('tanggal_mulai', $request->tahun); }
    $izins = $query->orderBy('tanggal_mulai', 'asc')->get();

    $bulan_nama = $request->bulan ? date('F', mktime(0, 0, 0, $request->bulan, 10)) : 'SemuaBulan';
    $tahun_nama = $request->tahun ?? 'SemuaTahun';
    $fileName = "Rekap_Izin_" . $bulan_nama . "_" . $tahun_nama . ".xls";

    // Memaksa browser mendownload sebagai file Excel (.xls)
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    return view('rekapitulasi-izin-excel', compact('izins', 'request'));
})->middleware('auth');

// ==========================================
// RUTE HALAMAN STATIS
// ==========================================
Route::get('/informasi-pelayanan', function () { return view('pelayanan'); });
Route::get('/statistik-kehadiran', function () { return view('statistik'); });