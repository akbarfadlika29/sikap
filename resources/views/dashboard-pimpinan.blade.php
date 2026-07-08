<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#FDFBF5] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

    <aside class="w-[300px] bg-[#1C6851] flex flex-col justify-between shadow-2xl relative z-20">
        <div>
            <div class="flex items-center gap-4 px-8 py-10 mb-2 border-b border-white/10">
                <div class="bg-white p-1.5 rounded-xl shadow-md w-14 h-14 flex items-center justify-center">
                    <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-11 h-11 object-contain">
                </div>
                <div>
                    <h2 class="text-[1.8rem] font-black text-white leading-none tracking-widest">SIKAP</h2>
                    <p class="text-[11px] text-amber-400 font-bold mt-1 tracking-[0.15em] uppercase">Executive Panel</p>
                </div>
            </div>

            <nav class="flex flex-col gap-2 px-4 mt-6">
                <a href="/dashboard-pimpinan" class="flex items-center gap-4 px-6 py-4 bg-white/10 text-white rounded-xl border-l-4 border-amber-400 font-bold text-[16px] transition-all">
                    <i class="fa-solid fa-chart-pie w-6 text-xl text-center"></i> Dashboard Utama
                </a>
                
                <a href="/verifikasi-izin" class="flex items-center gap-4 px-6 py-4 text-white/70 hover:bg-white/5 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-clipboard-check w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Verifikasi Izin
                </a>
                </nav>
        </div>

        <div class="p-6">
            <div class="bg-black/20 rounded-2xl p-4 mb-4 border border-white/10 flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#1C6851] text-xl shadow-inner">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="overflow-hidden">
                    <span class="block text-white font-bold text-sm truncate w-full">{{ auth()->user()->name ?? 'Bapak Pimpinan' }}</span>
                    <span class="block text-amber-400 text-xs font-medium mt-0.5">Kepala Kantor Kemenag</span>
                </div>
            </div>

            <form action="/logout" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-3 bg-red-600/90 hover:bg-red-600 text-white p-3.5 rounded-xl font-bold shadow-md transition-colors">
                    <i class="fa-solid fa-right-from-bracket text-lg"></i> Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-10 lg:p-12 overflow-y-auto">
        <div class="mb-8 border-b border-gray-200 pb-6">
            <h1 class="text-[2.2rem] font-black text-gray-800 mb-2 tracking-tight">Dashboard Pimpinan</h1>
            <p class="text-gray-500 font-medium text-sm">Pusat kendali eksekutif pengawasan mobilitas dan perizinan pegawai.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="bg-white rounded-2xl p-8 flex items-center gap-6 shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-[#1C6851] rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-gray-800 leading-none mb-1">{{ $total_staf }}</h2>
                    <p class="text-gray-500 font-bold text-sm">Total Pegawai</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 flex items-center gap-6 shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-amber-500 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-gray-800 leading-none mb-1">{{ $perlu_otoritas }}</h2>
                    <p class="text-gray-500 font-bold text-sm">Menunggu Persetujuan</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 flex items-center gap-6 shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-gray-800 leading-none mb-1">{{ $sedang_diluar }}</h2>
                    <p class="text-gray-500 font-bold text-sm">Dinas Luar Aktif</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Global Perizinan</h2>
                <a href="/verifikasi-izin" class="text-sm font-bold text-[#1C6851] hover:underline">Lihat Antrean Verifikasi &rarr;</a>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-500 text-sm border-b-2 border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 font-bold">Pegawai</th>
                        <th class="py-3 px-4 font-bold">Jenis Izin</th>
                        <th class="py-3 px-4 font-bold">Waktu</th>
                        <th class="py-3 px-4 font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_izin->take(10) as $izin)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-4 px-4">
                            <p class="font-bold text-gray-800">{{ $izin->user->name }}</p>
                            <p class="text-xs font-semibold text-gray-400">{{ $izin->user->jabatan ?? 'Pegawai' }}</p>
                        </td>
                        <td class="py-4 px-4 font-bold text-gray-600">{{ $izin->jenis_izin }}</td>
                        <td class="py-4 px-4">
                            <p class="text-sm font-bold text-gray-600">{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }}</p>
                            <p class="text-xs font-medium text-gray-400">{{ \Carbon\Carbon::parse($izin->jam_keluar)->format('H:i') }} - {{ \Carbon\Carbon::parse($izin->jam_kembali)->format('H:i') }}</p>
                        </td>
                        <td class="py-4 px-4">
                            @if($izin->status == 'Proses')
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border border-amber-200">Proses</span>
                            @elseif($izin->status == 'Disetujui')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border border-green-200">Disetujui</span>
                            @elseif($izin->status == 'Selesai')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border border-blue-200">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border border-red-200">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-gray-400 italic font-medium">Belum ada riwayat perizinan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    @if(session('success'))
    <script>Swal.fire({ title: 'Berhasil!', text: '{{ session('success') }}', icon: 'success', confirmButtonColor: '#1C6851' });</script>
    @endif
</body>
</html>