<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Pegawai - SIKAP</title>
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
                
                <!-- MENU AKTIF -->
                <a href="/tambah-pegawai" class="flex items-center gap-4 px-6 py-4 bg-gradient-to-r from-[#36A282] to-[#257A63] text-white rounded-r-full -ml-4 pl-10 shadow-lg border-l-4 border-white font-bold text-[16px] transition-all">
                    <i class="fa-solid fa-user-plus w-6 text-xl text-center"></i> Tambah Pegawai
                </a>
                
                <!-- FITUR MANAJEMEN USER SUDAH DIHAPUS DARI SINI -->
                
                <a href="/manajemen-jabatan" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-user-tie w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Manajemen Jabatan
                </a>
                
                <a href="/konfigurasi-wa" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-brands fa-whatsapp w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Konfigurasi WA API
                </a>
                
                <a href="/rekapitulasi-izin" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-file-signature w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Rekapitulasi Izin
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
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-[2rem] font-black text-[#1A634E] mb-1">Manajemen Akun Pegawai</h1>
                <p class="text-gray-500 font-semibold text-[14px]">Daftar seluruh pengguna sistem dengan akses Pegawai.</p>
            </div>
            <a href="/tambah-pegawai/tambah" class="bg-gradient-to-r from-[#329E80] to-[#257A63] hover:scale-105 transition-transform text-white px-6 py-3 rounded-xl font-bold shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Akun Baru
            </a>
        </div>

        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#1A634E] border-b-2 border-gray-100">
                        <th class="py-4 px-4 font-bold">Nama Lengkap</th>
                        <th class="py-4 px-4 font-bold">Nomor Induk Pegawai (NIP)</th>
                        <th class="py-4 px-4 font-bold">Hak Akses</th>
                        <th class="py-4 px-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-bold text-[#1A634E]">{{ $user->name }}</td>
                        <td class="py-4 px-4 font-semibold text-gray-500">{{ $user->nip }}</td>
                        <td class="py-4 px-4">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $user->role }}</span>
                        </td>
                        <td class="py-4 px-4 flex justify-center gap-2">
                            <a href="/tambah-pegawai/edit/{{ $user->id }}" class="bg-amber-500 hover:bg-amber-600 text-white w-8 h-8 rounded-lg flex items-center justify-center shadow-sm" title="Edit Akun">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <form action="/tambah-pegawai/hapus/{{ $user->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun pegawai ini secara permanen?');">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-lg flex items-center justify-center shadow-sm" title="Hapus Akun">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-8 text-gray-400 italic">Belum ada akun pegawai yang terdaftar.</td></tr>
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