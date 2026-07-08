<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                <!-- MENU AKTIF -->
                <a href="/dashboard-admin" class="flex items-center gap-4 px-6 py-4 bg-gradient-to-r from-[#36A282] to-[#257A63] text-white rounded-r-full -ml-4 pl-10 shadow-lg border-l-4 border-white font-bold text-[16px] transition-all">
                    <i class="fa-solid fa-house w-6 text-xl text-center"></i> Dashboard Utama
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

    <!-- KONTEN UTAMA DASHBOARD -->
    <main class="flex-1 p-10 lg:p-12 overflow-y-auto">
        <div class="mb-8">
            <h1 class="text-[2.2rem] font-black text-[#1A634E] mb-2 tracking-tight">Dashboard Admin</h1>
            <p class="text-[#329E80] font-semibold text-sm">Kelola Pegawai, Pantau Izin real-time, dan Konfigurasi WA Gateway</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="bg-white rounded-3xl p-8 flex items-center gap-6 shadow-sm border border-gray-100 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-16 h-16 bg-[#1A634E] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-[#1A634E] leading-none mb-1">
                        {{ \App\Models\User::where('role', 'pegawai')->count() }}
                    </h2>
                    <p class="text-gray-500 font-bold text-sm">Data Pegawai</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 flex items-center gap-6 shadow-sm border border-gray-100 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-16 h-16 bg-[#1A634E] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-[#1A634E] leading-none mb-1">
                        {{ \App\Models\Izin::where('status', 'Disetujui')->count() }}
                    </h2>
                    <p class="text-gray-500 font-bold text-sm">Izin Berjalan</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 flex items-center gap-6 shadow-sm border border-gray-100 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-16 h-16 bg-[#1A634E] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h2 class="text-4xl font-black text-[#1A634E] leading-none mb-1">
                        {{ \App\Models\Izin::where('status', 'Proses')->count() }}
                    </h2>
                    <p class="text-gray-500 font-bold text-sm">Menunggu Acc</p>
                </div>
            </div>
        </div>

        <div class="relative bg-gradient-to-br from-[#257A63] to-[#1A634E] rounded-3xl p-10 shadow-lg overflow-hidden">
            <i class="fa-solid fa-gear absolute -right-10 -bottom-10 text-[15rem] text-white/10 opacity-50"></i>
            <i class="fa-solid fa-gear absolute right-40 top-10 text-[8rem] text-white/10 opacity-50"></i>

            <div class="relative z-10">
                <h2 class="text-3xl font-black text-white mb-4">Siap untuk mulai bekerja?</h2>
                <p class="text-white/80 font-medium text-sm mb-8 max-w-xl leading-relaxed">
                    pilih menu disamping untuk mengelola database pegawai kemenag atau mengatur integrasi WhatsApp Gateway
                </p>
                
                <div class="flex gap-4">
                    <a href="/tambah-pegawai" class="border-2 border-white/30 hover:bg-white hover:text-[#1A634E] text-white transition-colors px-6 py-3 rounded-xl font-bold text-sm">
                        Lihat data pegawai
                    </a>
                    <a href="/konfigurasi-wa" class="border-2 border-white/30 hover:bg-white hover:text-[#1A634E] text-white transition-colors px-6 py-3 rounded-xl font-bold text-sm">
                        Pelajari Sistem
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>