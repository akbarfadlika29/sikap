<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pulang - Pegawai SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#E4F2EE] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

    <!-- SIDEBAR PEGAWAI -->
    <aside class="w-1/4 max-w-[300px] bg-gradient-to-b from-[#1C6851] to-[#124B3A] h-full flex flex-col justify-between shadow-2xl relative z-20 overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        <div>
            <div class="px-8 py-10 flex items-center gap-4">
                <div class="bg-white p-2 rounded-2xl shadow-lg">
                    <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-12 h-12 object-contain">
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
                <a href="/formulir-izin" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
                    <i class="fa-solid fa-file-pen w-6 text-xl"></i> Formulir Izin
                </a>
                <a href="/konfirmasi-pulang" class="flex items-center gap-4 bg-gradient-to-r from-[#329E80] to-[#257A63] text-white px-6 py-4 rounded-xl font-bold shadow-md transition-all">
                    <i class="fa-solid fa-door-open w-6 text-xl"></i> Konfirmasi pulang
                </a>
            </nav>
        </div>

        <div class="px-6 pb-10">
            <div class="bg-[#155441] rounded-2xl p-4 flex items-center gap-4 mb-4 border border-[#1d6b53]">
                <div class="w-12 h-12 bg-gradient-to-br from-[#1C6851] to-[#0f3d2f] rounded-xl flex items-center justify-center text-white font-black text-lg shadow-inner">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-white/60 text-xs font-medium mt-0.5">NIP: {{ auth()->user()->nip }}</p>
                </div>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full bg-gradient-to-r from-[#36A282] to-[#22775E] hover:from-[#2c876b] hover:to-[#1a5e4a] transition-all text-white px-6 py-3.5 rounded-xl font-bold shadow-lg flex items-center justify-center gap-3">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT (SUDAH DIPERBAIKI AGAR BISA DI-SCROLL KE BAWAH) -->
    <main class="flex-1 p-10 lg:p-14 overflow-y-auto relative z-10">
        
        <!-- Bungkus dengan max-width agar tetap rapi di tengah, tapi memanjang ke bawah -->
        <div class="max-w-2xl mx-auto pt-4 pb-20">
            <div class="text-center mb-10">
                <h2 class="text-[2.5rem] font-black text-[#1A634E] leading-tight mb-2">Konfirmasi Kepulangan</h2>
                <p class="text-[#268A6B] text-base font-medium">Laporkan status kehadiran Anda saat kembali ke unit kerja.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 sm:p-12 border border-white shadow-[0_20px_50px_-15px_rgba(26,99,78,0.15)] w-full text-center relative">
                
                @if($izin_aktif)
                    <div class="w-24 h-24 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-person-walking-arrow-right text-5xl text-amber-500"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-2">Anda Sedang Izin Keluar</h3>
                    <p class="text-gray-500 mb-8 font-medium">Tujuan: <span class="text-[#1A634E] font-bold">{{ $izin_aktif->alasan }} ({{ $izin_aktif->jenis_izin }})</span></p>
                    
                    <div class="bg-[#F4F7F6] p-6 rounded-2xl mb-8 border border-gray-100">
                        <p class="text-sm text-gray-600 font-medium">Klik tombol di bawah ini hanya jika Anda **benar-benar sudah kembali** berada di area kantor Kementerian Agama Tuban. Data Anda akan otomatis diperbarui di sistem publik.</p>
                    </div>

                    <form action="/proses-pulang/{{ $izin_aktif->id }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-[#1A634E] to-[#124B3A] hover:scale-[1.02] transition-transform duration-300 text-white px-8 py-5 rounded-2xl font-black shadow-xl flex items-center justify-center gap-3 text-sm sm:text-lg border-b-4 border-[#0d362a]">
                            <i class="fa-solid fa-check-double text-xl"></i> YA, SAYA SUDAH KEMBALI
                        </button>
                    </form>

                @else
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-building-user text-5xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-2">Anda Berada di Kantor</h3>
                    <p class="text-gray-500 font-medium max-w-sm mx-auto">Sistem mencatat Anda tidak sedang dalam status Izin, Cuti, atau Dinas Luar yang aktif saat ini.</p>
                    
                    <a href="/dashboard-pegawai" class="mt-8 inline-block text-[#329E80] font-bold hover:text-[#1A634E] transition-colors">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                @endif

            </div>
        </div>
    </main>

</body>
</html>