<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Izin - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#E8F5F2] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

    <!-- SIDEBAR ADMIN -->
    <aside class="w-[300px] bg-gradient-to-b from-[#1C6851] to-[#114032] flex flex-col justify-between shadow-2xl relative z-20 overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        <div>
            <div class="flex items-center gap-4 px-8 py-8 mb-4">
                <div class="bg-white p-1.5 rounded-2xl shadow-md w-14 h-14 flex items-center justify-center">
                    <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                </div>
                <div>
                    <h2 class="text-[1.7rem] font-black text-white leading-none tracking-wide">SIKAP</h2>
                    <p class="text-[11px] text-white/90 font-bold mt-1 tracking-wider uppercase">Kemenag Tuban</p>
                </div>
            </div>

            <nav class="flex flex-col gap-2 px-4 pb-4">
                <a href="/dashboard-admin" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-house w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Dashboard Utama
                </a>
                
                <a href="/tambah-pegawai" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-user-plus w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Tambah Pegawai
                </a>
                
                <!-- FITUR MANAJEMEN USER SUDAH DIHAPUS DARI SINI -->
                
                <a href="/manajemen-jabatan" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-user-tie w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Manajemen Jabatan
                </a>
                
                <a href="/konfigurasi-wa" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-brands fa-whatsapp w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Konfigurasi WA API
                </a>
                
                <!-- MENU AKTIF -->
                <a href="/rekapitulasi-izin" class="flex items-center gap-4 px-6 py-4 bg-gradient-to-r from-[#36A282] to-[#257A63] text-white rounded-r-full -ml-4 pl-10 shadow-lg border-l-4 border-white font-bold text-[16px] transition-all">
                    <i class="fa-solid fa-file-signature w-6 text-xl text-center"></i> Rekapitulasi Izin
                </a>
            </nav>
        </div>
        
        <!-- BAGIAN BAWAH SIDEBAR -->
        <div class="p-6 flex flex-col gap-3">
            <div class="flex items-center gap-4 bg-white/10 p-3.5 rounded-2xl border border-white/20 backdrop-blur-sm">
                <div class="w-11 h-11 bg-gradient-to-br from-[#114032] to-[#0A261E] rounded-xl flex items-center justify-center text-white font-black text-lg shadow-inner border border-white/10">AM</div>
                <span class="text-white font-bold text-[15px]">Adilia Meylani</span>
            </div>
            <form action="/logout" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-[#44B594] to-[#2B876C] hover:scale-[1.02] text-white p-3.5 rounded-2xl font-bold shadow-md transition-transform duration-300">
                    <i class="fa-solid fa-right-from-bracket text-lg"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN -->
    <main class="flex-1 p-10 lg:p-12 overflow-y-auto">
        <div class="mb-8">
            <h1 class="text-[2rem] font-black text-[#1A634E] mb-1">Rekapitulasi Izin Pegawai</h1>
            <p class="text-gray-500 font-semibold text-[14px]">Pantau, filter, dan kelola seluruh catatan cuti atau izin dinas luar.</p>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8 flex flex-col lg:flex-row items-center justify-between gap-4">
            <form action="/rekapitulasi-izin" method="GET" class="flex items-center gap-3 w-full lg:w-auto">
                <select name="bulan" class="px-4 py-2.5 bg-[#F4F7F6] border border-gray-200 rounded-xl font-semibold text-sm focus:ring-2 focus:ring-[#329E80] outline-none">
                    <option value="">Semua Bulan</option>
                    <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                </select>

                <input type="number" name="tahun" value="{{ request('tahun') }}" placeholder="Tahun (cth: 2026)" class="w-36 px-4 py-2.5 bg-[#F4F7F6] border border-gray-200 rounded-xl font-semibold text-sm focus:ring-2 focus:ring-[#329E80] outline-none">
                
                <button type="submit" class="bg-[#1A634E] hover:bg-[#114032] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-md transition-colors">
                    <i class="fa-solid fa-filter"></i> Tampilkan
                </button>
            </form>

            <div class="flex items-center gap-3 w-full lg:w-auto">
                <a href="/rekapitulasi-izin/cetak-pdf?bulan={{ request('bulan') }}&tahun={{ request('tahun') }}" class="bg-gradient-to-r from-red-500 to-red-600 hover:scale-105 text-white px-4 py-2.5 rounded-xl font-bold text-sm shadow-md transition-transform flex items-center gap-2">
                    <i class="fa-solid fa-file-pdf"></i> Cetak PDF
                </a>
                <a href="/rekapitulasi-izin/cetak-excel?bulan={{ request('bulan') }}&tahun={{ request('tahun') }}" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:scale-105 text-white px-4 py-2.5 rounded-xl font-bold text-sm shadow-md transition-transform flex items-center gap-2">
                    <i class="fa-solid fa-file-excel"></i> Cetak Excel
                </a>
                
                <div class="w-px h-8 bg-gray-200 mx-1"></div>

                <form action="/rekapitulasi-izin/hapus-semua" method="POST" onsubmit="return confirm('PERINGATAN! Yakin ingin membersihkan/menghapus SEMUA data izin yang sedang ditampilkan ini?');">
                    @csrf
                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                    <button type="submit" class="bg-gray-800 hover:bg-black text-white px-4 py-2.5 rounded-xl font-bold text-sm shadow-md transition-colors flex items-center gap-2">
                        <i class="fa-solid fa-trash-can-arrow-up"></i> Bersihkan Data
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-sm border-b-2 border-gray-50">
                        <th class="py-3 px-4 font-bold">Identitas Pegawai</th>
                        <th class="py-3 px-4 font-bold">Jabatan</th>
                        <th class="py-3 px-4 font-bold">Jenis / Alasan</th>
                        <th class="py-3 px-4 font-bold">Waktu</th>
                        <th class="py-3 px-4 font-bold">Status</th>
                        <th class="py-3 px-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($izins as $izin)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4">
                            <p class="font-bold text-[#1A634E]">{{ $izin->user->name }}</p>
                            <p class="text-xs font-semibold text-gray-400">NIP: {{ $izin->user->nip }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm font-bold text-gray-700">{{ $izin->user->jabatan ?? '-' }}</p>
                            <p class="text-xs font-medium text-gray-400">{{ $izin->user->unit_kerja ?? '-' }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm font-bold text-[#329E80]">{{ $izin->jenis_izin }}</p>
                            <p class="text-xs font-medium text-gray-500 truncate max-w-[150px]">{{ $izin->alasan }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }}</p>
                            <p class="text-xs font-medium text-gray-400">{{ \Carbon\Carbon::parse($izin->jam_keluar)->format('H:i') }} - {{ \Carbon\Carbon::parse($izin->jam_kembali)->format('H:i') }}</p>
                        </td>
                        <td class="py-4 px-4">
                            @if($izin->status == 'Proses')
                                <span class="bg-amber-100 text-amber-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Proses</span>
                            @elseif($izin->status == 'Disetujui')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Disetujui</span>
                            @elseif($izin->status == 'Selesai')
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 flex justify-center gap-2">
                            <a href="/rekapitulasi-izin/edit/{{ $izin->id }}" class="bg-amber-500 hover:bg-amber-600 text-white w-8 h-8 rounded-lg flex items-center justify-center shadow-sm" title="Edit Data">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <form action="/rekapitulasi-izin/hapus/{{ $izin->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data catatan izin ini?');">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center shadow-sm" title="Hapus Data">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-10 text-gray-400 italic font-semibold">Data izin tidak ditemukan pada rentang waktu tersebut.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    @if(session('success'))
    <script>Swal.fire({ title: 'Berhasil!', text: '{{ session('success') }}', icon: 'success', confirmButtonColor: '#329E80' });</script>
    @endif
</body>
</html>