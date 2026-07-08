<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Izin - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#E4F2EE] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

    <!-- SIDEBAR -->
    <aside class="w-1/4 max-w-[300px] bg-gradient-to-b from-[#1C6851] to-[#124B3A] h-full flex flex-col justify-between shadow-2xl relative z-20">
        <div>
            <div class="px-8 py-10 flex items-center gap-4">
                <div class="bg-white p-2 rounded-2xl shadow-lg">
                    <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-white leading-none tracking-wide">SIKAP</h1>
                    <p class="text-[10px] font-bold text-white/80 mt-1 tracking-widest">KEMENAG TUBAN</p>
                </div>
            </div>

            <nav class="mt-4 flex flex-col gap-2 px-6 pb-4">
                <a href="/dashboard-pegawai" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
                    <i class="fa-solid fa-house w-6 text-xl"></i> Dashboard
                </a>
                <a href="/formulir-izin" class="flex items-center gap-4 bg-gradient-to-r from-[#329E80] to-[#257A63] text-white px-6 py-4 rounded-xl font-bold shadow-md transition-all">
                    <i class="fa-solid fa-file-pen w-6 text-xl"></i> Formulir Izin
                </a>
                <a href="/konfirmasi-pulang" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
                    <i class="fa-solid fa-door-open w-6 text-xl"></i> Konfirmasi pulang
                </a>
            </nav>
        </div>
        <div class="px-6 pb-10">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full bg-[#155441] border border-[#1d6b53] hover:bg-[#124a39] text-white px-6 py-3.5 rounded-xl font-bold shadow-lg transition-all">
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN -->
    <main class="flex-1 p-10 lg:p-14 overflow-y-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-[2.5rem] font-black text-[#1A634E] leading-tight mb-1">Manajemen Pengajuan Izin</h2>
                <p class="text-[#268A6B] text-base font-medium">Daftar seluruh riwayat pengajuan izin Anda.</p>
            </div>
            <a href="/formulir-izin/tambah" class="bg-gradient-to-r from-[#329E80] to-[#257A63] hover:scale-105 transition-transform text-white px-6 py-3 rounded-xl font-bold shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Buat Pengajuan Izin
            </a>
        </div>

        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#1A634E] border-b-2 border-gray-100">
                        <th class="py-4 px-4 font-bold">Jenis Izin</th>
                        <th class="py-4 px-4 font-bold">Tanggal</th>
                        <th class="py-4 px-4 font-bold">Alasan</th>
                        <th class="py-4 px-4 font-bold">Status</th>
                        <th class="py-4 px-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($izins as $izin)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-semibold text-gray-700">{{ $izin->jenis_izin }}</td>
                        <td class="py-4 px-4 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }}<br>
                            <span class="text-xs">{{ $izin->jam_keluar }} - {{ $izin->jam_kembali }}</span>
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-600 truncate max-w-[200px]">{{ $izin->alasan }}</td>
                        <td class="py-4 px-4">
                            @if($izin->status == 'Proses')
                                <span class="bg-amber-100 text-amber-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Proses</span>
                            @elseif($izin->status == 'Disetujui')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Disetujui</span>
                            @elseif($izin->status == 'Selesai')
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 flex justify-center gap-2">
                            <!-- Kondisi Aksi (Edit & Hapus hanya jika status masih PROSES) -->
                            @if($izin->status == 'Proses')
                                <a href="/formulir-izin/edit/{{ $izin->id }}" class="bg-amber-500 hover:bg-amber-600 text-white w-8 h-8 rounded-lg flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="/formulir-izin/hapus/{{ $izin->id }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan izin ini?');">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center shadow-sm">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs italic">- Terkunci -</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-8 text-gray-400 italic">Belum ada riwayat pengajuan izin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    @if(session('success'))
    <script>
        Swal.fire({ title: 'Berhasil!', text: '{{ session('success') }}', icon: 'success', confirmButtonColor: '#329E80' });
    </script>
    @endif
</body>
</html>