<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SIKPA Kemenag Tuban</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .particles-container {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            overflow: hidden; z-index: 1; pointer-events: none;
        }
        @keyframes floatUp {
            0% { transform: translateY(150px) rotate(0deg) scale(0.8); opacity: 0; }
            20% { opacity: 0.15; } /* Transparansi disesuaikan agar ukuran besar tidak menutupi teks */
            80% { opacity: 0.15; }
            100% { transform: translateY(-1000px) rotate(360deg) scale(1.2); opacity: 0; }
        }
        .particle {
            position: absolute;
            color: rgba(255, 255, 255, 0.1); 
            bottom: -100px;
            animation: floatUp linear infinite;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white px-10 py-5 flex justify-between items-center shadow-sm fixed w-full top-0 z-50">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-10 h-10 object-contain">
            <div>
                <h1 class="text-xl font-black text-[#1C6851] leading-none tracking-wide">
                    SIKPA
                </h1>

                <p class="text-[9px] font-bold text-gray-500 mt-0.5 tracking-widest uppercase">
                    Kementerian Agama Kabupaten Tuban
                </p>
            </div>
        </div>

        <a href="/login" class="bg-gradient-to-r from-[#329E80] to-[#257A63] hover:scale-105 transition-transform text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-md flex items-center gap-2">
            Login Pegawai <i class="fa-solid fa-arrow-right"></i>
        </a>
    </nav>

    <header class="bg-[#1C6851] pt-40 pb-32 px-10 text-center relative overflow-hidden">
        
        <div class="absolute top-10 left-10 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

        <div class="particles-container">
            <i class="fa-solid fa-star particle" style="left: 10%; font-size: 60px; animation-duration: 15s; animation-delay: 0s;"></i>
            <i class="fa-solid fa-circle particle" style="left: 20%; font-size: 40px; animation-duration: 12s; animation-delay: 2s;"></i>
            <i class="fa-regular fa-star particle" style="left: 35%; font-size: 90px; animation-duration: 18s; animation-delay: 4s;"></i>
            <i class="fa-solid fa-play particle" style="left: 50%; font-size: 55px; animation-duration: 14s; animation-delay: 1s;"></i>
            <i class="fa-solid fa-star particle" style="left: 65%; font-size: 75px; animation-duration: 16s; animation-delay: 5s;"></i>
            <i class="fa-regular fa-circle particle" style="left: 80%; font-size: 50px; animation-duration: 13s; animation-delay: 3s;"></i>
            <i class="fa-regular fa-star particle" style="left: 90%; font-size: 110px; animation-duration: 20s; animation-delay: 0s;"></i>
            <i class="fa-solid fa-circle particle" style="left: 15%; font-size: 35px; animation-duration: 10s; animation-delay: 6s;"></i>
            <i class="fa-solid fa-star particle" style="left: 45%; font-size: 65px; animation-duration: 17s; animation-delay: 3s;"></i>
            <i class="fa-regular fa-circle particle" style="left: 75%; font-size: 85px; animation-duration: 15s; animation-delay: 7s;"></i>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest backdrop-blur-sm border border-white/30 shadow-sm">
                Informasi Kepegawaian
            </span>

            <h2 class="text-4xl md:text-5xl font-black text-white mt-6 mb-4 leading-tight uppercase drop-shadow-md">
                Informasi Keberadaan & <br> Aktivitas Pegawai
            </h2>

            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl mx-auto leading-relaxed drop-shadow-sm">
                Informasi status keberadaan dan aktivitas pegawai
                Kementerian Agama Kabupaten Tuban sebagai bagian dari
                keterbukaan informasi dan peningkatan kualitas pelayanan publik.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 lg:px-10 -mt-20 relative z-20 mb-20">
        <div class="bg-white rounded-t-[2.5rem] rounded-b-[2.5rem] p-8 md:p-12 shadow-2xl border border-gray-100 min-h-[400px]">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 border-b border-gray-100 pb-6">

                <div class="text-center md:text-left">

                    <h3 class="text-2xl font-black text-[#1C6851] uppercase mb-1">
                        Status Keberadaan Pegawai
                    </h3>

                    <p class="text-sm text-gray-500 font-medium mb-3">
                        Informasi keberadaan dan aktivitas pegawai Kementerian Agama Kabupaten Tuban.
                    </p>

                    <div id="realtime-clock"
                        class="inline-flex items-center gap-2 bg-[#F4F7F6] text-[#1C6851] px-4 py-1.5 rounded-full text-sm font-bold border border-gray-200 shadow-inner">

                        <i class="fa-solid fa-spinner fa-spin"></i>
                        Memuat waktu real-time...

                    </div>

                </div>

                @if($dalamJamKerja)

                    <div class="relative w-full md:w-80">

                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            type="text"
                            id="searchPegawai"
                            placeholder="Cari nama, NIP, jabatan, atau unit kerja..."
                            autocomplete="off"
                            class="w-full bg-[#F4F7F6] border border-gray-200 text-gray-700 text-sm font-medium rounded-full px-10 py-3 focus:outline-none focus:ring-2 focus:ring-[#329E80] focus:border-[#329E80]"
                        >

                    </div>

                @endif

            </div>

            @if($dalamJamKerja)
            <div class="overflow-x-auto">
                <table
                    class="w-full text-left border-collapse min-w-[1150px]"
                    id="pegawaiTable"
                >
                    <thead>
                        <tr class="text-[#1C6851] text-sm border-b-2 border-gray-100">

                            <th class="py-4 px-4 font-bold">
                                Pegawai
                            </th>

                            <th class="py-4 px-4 font-bold">
                                Jabatan & Unit Kerja
                            </th>

                            <th class="py-4 px-4 font-bold text-center">
                                Posisi
                            </th>

                            <th class="py-4 px-4 font-bold">
                                Aktivitas
                            </th>

                            <th class="py-4 px-4 font-bold">
                                Keluar
                            </th>

                            <th class="py-4 px-4 font-bold">
                                Estimasi Kembali
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pegawai as $user)

                            @php
                                $permit = $user->latestPermit;

                                $sedangDiLuar =
                                    $permit &&
                                    $permit->status_permit === 'disetujui' &&
                                    !$permit->posisi_di_kantor;
                            @endphp

                            <tr
                                class="pegawai-row border-b border-gray-50 hover:bg-gray-50/70 transition-colors"
                                data-search="{{ strtolower(
                                    $user->nama . ' ' .
                                    $user->nip . ' ' .
                                    ($user->penempatanDefinitif->jabatan->nama_jabatan ?? '') . ' ' .
                                    ($user->penempatanDefinitif->unitKerja->nama_unit_kerja ?? '')
                                ) }}"
                            >

                                {{-- PEGAWAI --}}
                                <td class="py-5 px-4">

                                    <p class="font-black text-gray-800 text-base">
                                        {{ $user->nama }}
                                    </p>

                                    <p class="text-xs font-semibold text-gray-500 mt-1">
                                        NIP: {{ $user->nip }}
                                    </p>

                                </td>


                                {{-- JABATAN & UNIT KERJA --}}
                                <td class="py-5 px-4">

                                    <p class="text-sm font-bold text-gray-700">
                                        {{ $user->penempatanDefinitif->jabatan->nama_jabatan ?? '-' }}
                                    </p>

                                    <p class="text-xs font-medium text-gray-400 mt-1">
                                        {{ $user->penempatanDefinitif->unitKerja->nama_unit_kerja ?? '-' }}
                                    </p>

                                </td>


                                {{-- POSISI --}}
                                <td class="py-5 px-4 text-center">

                                    @if($sedangDiLuar)

                                        <span class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 border border-amber-100 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide whitespace-nowrap">

                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                            Di Luar Kantor

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-100 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide whitespace-nowrap">

                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                            Di Kantor

                                        </span>

                                    @endif

                                </td>


                                {{-- AKTIVITAS --}}
                                <td class="py-5 px-4 max-w-[280px]">

                                    @if($sedangDiLuar)

                                        <p class="text-sm font-semibold text-gray-700 leading-relaxed">
                                            {{ $permit->deskripsi_aktivitas_luar }}
                                        </p>

                                        @if($permit->jenisAktivitasLuar)

                                            <p class="text-xs font-medium text-gray-400 mt-1">
                                                {{ $permit->jenisAktivitasLuar->nama_jenis_aktivitas_luar }}
                                            </p>

                                        @endif

                                    @else

                                        <span class="text-sm text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- KELUAR --}}
                                <td class="py-5 px-4">

                                    @if($sedangDiLuar)

                                        <p class="text-sm font-bold text-gray-700 whitespace-nowrap">
                                            {{ $permit->tanggal_keluar->translatedFormat('d F Y') }}
                                        </p>

                                        <p class="inline-flex items-center gap-1 text-xs text-amber-600 font-bold mt-1 bg-amber-50 px-2 py-1 rounded-md border border-amber-100 whitespace-nowrap">

                                            <i class="fa-regular fa-clock"></i>

                                            {{ substr($permit->waktu_keluar, 0, 5) }} WIB

                                        </p>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- ESTIMASI KEMBALI --}}
                                <td class="py-5 px-4">

                                    @if($sedangDiLuar)

                                        <p class="text-sm font-bold text-gray-700 whitespace-nowrap">
                                            {{ $permit->tanggal_estimasi_kembali->translatedFormat('d F Y') }}
                                        </p>

                                        <p class="inline-flex items-center gap-1 text-xs text-emerald-600 font-bold mt-1 bg-emerald-50 px-2 py-1 rounded-md border border-emerald-100 whitespace-nowrap">

                                            <i class="fa-regular fa-clock"></i>

                                            {{ substr($permit->waktu_estimasi_kembali, 0, 5) }} WIB

                                        </p>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-20">

                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-2xl mb-4">

                                        <i class="fa-solid fa-users text-2xl text-gray-400"></i>

                                    </div>

                                    <h4 class="text-lg font-bold text-gray-500">
                                        Belum ada data pegawai.
                                    </h4>

                                    <p class="text-gray-400 font-medium text-sm mt-1">
                                        Informasi keberadaan pegawai belum tersedia.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
                <div id="emptySearchResult" class="hidden text-center py-16">

                    <div class="inline-flex items-center justify-center w-14 h-14 bg-gray-100 rounded-2xl mb-4">

                        <i class="fa-solid fa-magnifying-glass text-xl text-gray-400"></i>

                    </div>

                    <h4 class="text-lg font-bold text-gray-500">
                        Data tidak ditemukan.
                    </h4>

                    <p class="text-gray-400 text-sm mt-1">
                        Coba gunakan kata kunci pencarian yang berbeda.
                    </p>

                </div>
            </div>
            @else
            <div class="py-10 md:py-14">

                <div class="max-w-2xl mx-auto text-center">

                    <div
                        class="w-20 h-20 mx-auto mb-6 rounded-3xl bg-[#E4F2EE] flex items-center justify-center"
                    >
                        <i class="fa-regular fa-clock text-3xl text-[#329E80]"></i>
                    </div>

                    <span
                        class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 border border-amber-100 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-5"
                    >
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                        Di Luar Jam Pelayanan
                    </span>

                    <h4 class="text-2xl md:text-3xl font-black text-[#1C6851] mb-3">
                        Informasi Status Pegawai Belum Tersedia
                    </h4>

                    <p class="text-sm md:text-base text-gray-500 font-medium leading-relaxed max-w-xl mx-auto">
                        Informasi keberadaan dan aktivitas pegawai ditampilkan selama
                        jam kerja Kantor Kementerian Agama Kabupaten Tuban.
                        Silakan kembali mengakses halaman ini pada jam kerja berikutnya.
                    </p>


                    <div
                        class="mt-8 bg-[#F4F7F6] border border-gray-100 rounded-2xl p-5 max-w-md mx-auto"
                    >

                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">
                            Jam Kerja
                        </p>

                        <div class="flex items-center justify-between gap-4 py-2 border-b border-gray-200">

                            <span class="text-sm font-semibold text-gray-600">
                                Senin – Kamis
                            </span>

                            <span class="text-sm font-black text-[#1C6851] whitespace-nowrap">
                                07.30 – 16.00 WIB
                            </span>

                        </div>

                        <div class="flex items-center justify-between gap-4 py-2">

                            <span class="text-sm font-semibold text-gray-600">
                                Jumat
                            </span>

                            <span class="text-sm font-black text-[#1C6851] whitespace-nowrap">
                                07.30 – 16.30 WIB
                            </span>

                        </div>

                    </div>

                </div>

            </div>
            @endif
            
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center">
        <p class="text-sm font-semibold text-gray-400">
            &copy; {{ date('Y') }} SIKPA Kementerian Agama Kabupaten Tuban.
            Hak Cipta Dilindungi.
        </p>
    </footer>

    <script>
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const clockHTML = `
                <i class="fa-regular fa-calendar-days text-[#329E80]"></i> 
                ${day}, ${date} ${month} ${year} 
                <span class="mx-1 text-gray-300">|</span> 
                <i class="fa-regular fa-clock text-[#329E80]"></i> 
                <span class="text-red-500">${hours}:${minutes}:${seconds}</span> WIB
            `;

            document.getElementById('realtime-clock').innerHTML = clockHTML;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
    <script>
        const searchInput = document.getElementById('searchPegawai');
        const rows = document.querySelectorAll('.pegawai-row');
        const emptySearchResult = document.getElementById('emptySearchResult');

        if (searchInput) {

            searchInput.addEventListener('input', function () {

                const keyword = this.value
                    .toLowerCase()
                    .trim();

                let visibleRows = 0;

                rows.forEach(row => {

                    const searchData = row.dataset.search || '';

                    const matched = searchData.includes(keyword);

                    row.style.display = matched ? '' : 'none';

                    if (matched) {
                        visibleRows++;
                    }

                });

                if (visibleRows === 0 && keyword !== '') {
                    emptySearchResult.classList.remove('hidden');
                } else {
                    emptySearchResult.classList.add('hidden');
                }

            });

        }
    </script>
    @if(session('logout_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            Swal.fire({
                icon: 'success',
                title: 'Berhasil Keluar',
                text: @json(session('logout_success')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                timer: 3000,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            });

        });
    </script>
    @endif
</body>
</html>