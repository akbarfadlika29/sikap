<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Izin - SIKAP</title>
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
                <a href="/dashboard-pimpinan" class="flex items-center gap-4 px-6 py-4 text-white/70 hover:bg-white/5 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-chart-pie w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Dashboard Utama
                </a>
                
                <a href="/verifikasi-izin" class="flex items-center gap-4 px-6 py-4 bg-white/10 text-white rounded-xl border-l-4 border-amber-400 font-bold text-[16px] transition-all">
                    <i class="fa-solid fa-clipboard-check w-6 text-xl text-center"></i> Verifikasi Izin
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
            <h1 class="text-[2.2rem] font-black text-gray-800 mb-1">Verifikasi Permohonan Izin</h1>
            <p class="text-gray-500 font-medium text-sm">Tinjau dan berikan otorisasi persetujuan pada pengajuan yang masuk.</p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-500 text-sm border-b-2 border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 font-bold">Identitas Pegawai</th>
                        <th class="py-3 px-4 font-bold">Jenis Izin</th>
                        <th class="py-3 px-4 font-bold w-1/4">Alasan & Waktu</th>
                        <th class="py-3 px-4 font-bold text-center">Lampiran PDF</th>
                        <th class="py-3 px-4 font-bold text-center">Tindakan Otorisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($izin_proses as $izin)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                        <td class="py-4 px-4">
                            <p class="font-bold text-gray-800 text-lg">{{ $izin->user->name }}</p>
                            <p class="text-sm font-semibold text-gray-500">{{ $izin->user->jabatan ?? 'Pegawai' }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border border-gray-200">{{ $izin->jenis_izin }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm font-semibold text-gray-700 italic mb-1">"{{ $izin->alasan }}"</p>
                            <p class="text-xs font-bold text-amber-600"><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }}</p>
                            <p class="text-xs font-medium text-gray-500"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($izin->jam_keluar)->format('H:i') }} - {{ \Carbon\Carbon::parse($izin->jam_kembali)->format('H:i') }}</p>
                        </td>
                        <td class="py-4 px-4 text-center">
                            @if($izin->surat_izin)
                                <a href="{{ asset('uploads/surat_izin/' . $izin->surat_izin) }}" target="_blank" class="text-red-600 hover:text-red-800 text-2xl transition-colors" title="Lihat Lampiran PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                            @else
                                <span class="text-gray-400 text-xs italic font-medium">Tidak ada file</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <form action="/proses-izin/{{ $izin->id }}" method="POST" class="flex justify-center gap-2">
                                @csrf
                                <button type="submit" name="action" value="Disetujui" class="bg-emerald-600 hover:bg-emerald-700 transition-colors text-white px-4 py-2 rounded-lg font-bold shadow-sm flex items-center gap-2 text-sm" onclick="return confirm('Setujui izin ini?');">
                                    <i class="fa-solid fa-check"></i> Setujui
                                </button>
                                <button type="submit" name="action" value="Ditolak" class="bg-red-500 hover:bg-red-600 transition-colors text-white px-4 py-2 rounded-lg font-bold shadow-sm flex items-center gap-2 text-sm" onclick="return confirm('Tolak izin ini?');">
                                    <i class="fa-solid fa-xmark"></i> Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <i class="fa-solid fa-mug-hot text-5xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500 font-bold text-lg">Tidak Ada Antrean Izin</p>
                            <p class="text-gray-400 text-sm">Semua permohonan telah selesai diproses.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>