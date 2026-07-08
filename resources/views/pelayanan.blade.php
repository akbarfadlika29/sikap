
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pelayanan - SIKAP Kemenag Tuban</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'kemenag-dark': '#1A634E',
                        'kemenag-mint': '#7DD3BA',
                        'kemenag-text': '#1D6751',
                    },
                    boxShadow: {
                        'figma-card': '0 15px 40px -10px rgba(0, 0, 0, 0.12)',
                        'figma-box': '0 20px 50px -15px rgba(26, 99, 78, 0.15)',
                    }
                }
            }
        }
    </script>
    <style>
        /* Background body hijau sangat muda dengan gradasi */
        body { 
            background: linear-gradient(180deg, #E8F5F2 0%, #D8EFEB 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 pb-20">

    <!-- Bagian Atas: Navbar Putih -->
    <nav class="bg-white w-full px-6 py-3 flex justify-between items-center shadow-sm relative z-20">
        <div class="container mx-auto max-w-6xl flex justify-between items-center">
            
            <!-- Kiri: Logo & Title -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-12 h-12 object-contain">
                <div class="flex flex-col justify-center mt-1">
                    <h1 class="text-[1.4rem] font-extrabold text-kemenag-dark leading-none tracking-wide">SIKAP</h1>
                    <p class="text-[9px] font-bold text-kemenag-dark mt-0.5 tracking-wider">KEMENTRIAN AGAMA TUBAN</p>
                </div>
            </div>

            <!-- Tengah: Menu Navigasi -->
            <div class="hidden md:flex items-center gap-8 text-[13px] font-semibold text-kemenag-dark">
                <a href="/" class="hover:text-[#329E80] transition-colors">Beranda</a>
                <a href="/statistik-kehadiran" class="hover:text-[#329E80] transition-colors">Statistik Kehadiran</a>
                <!-- Menu Aktif Berpindah ke Informasi Pelayanan -->
                <a href="/informasi-pelayanan" class="border-b-2 border-[#329E80] pb-1 text-[#329E80]">Informasi Pelayanan</a>
            </div>
            
            <!-- Kanan: Tombol Pusat Bantuan -->
            <button class="bg-gradient-to-r from-[#3FB394] to-[#2B8A70] hover:scale-105 transition-transform duration-300 text-white px-8 py-2.5 rounded-full shadow-md font-semibold text-sm">
                Pusat Bantuan
            </button>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="w-full text-center pt-16 pb-12 relative z-10">
        <div class="container mx-auto px-6 max-w-4xl">
            <!-- Badge Support Center (Gradasi Teal) -->
            <div class="inline-block bg-gradient-to-r from-[#A4DECD] to-[#8BCFBA] text-[#134D3D] px-8 py-2 rounded-full text-[15px] font-bold mb-6 shadow-sm border border-[#85CDb5]">
                Support Center
            </div>
            
            <!-- Judul Utama -->
            <h2 class="text-4xl md:text-[2.75rem] font-black text-kemenag-dark leading-tight mb-3">Ada Yang Bisa Kami Bantu?</h2>
            
            <!-- Deskripsi -->
            <p class="text-[#1D6751] text-[15px] font-semibold max-w-2xl mx-auto">
                Temukan panduan lengkap penggunaan sistem SIKAP di bawah ini.
            </p>
        </div>
    </header>

    <!-- Layout Grid Kiri dan Kanan -->
    <main class="container mx-auto max-w-6xl px-6">
        <div class="flex flex-col md:flex-row gap-8 items-start">
            
            <!-- Kiri: Sidebar Kategori Panduan -->
            <aside class="w-full md:w-[32%] bg-gradient-to-b from-[#1C6851] to-[#124B3A] rounded-[2rem] shadow-figma-card overflow-hidden border border-[#23785D]">
                <div class="py-8 px-6">
                    <h3 class="text-white text-center font-black text-lg mb-6 tracking-wide">KATEGORI PANDUAN</h3>
                    
                    <ul class="space-y-2">
                        <!-- Menu Aktif (Untuk Pegawai) -->
                        <li>
                            <a href="#" class="flex items-center gap-4 bg-gradient-to-r from-[#329E80] to-[#257A63] text-white px-6 py-4 rounded-xl font-bold shadow-md transition-all">
                                <i class="fa-solid fa-user text-lg w-5 text-center"></i>
                                Untuk Pegawai
                            </a>
                        </li>
                        <!-- Menu Non-aktif -->
                        <li>
                            <a href="#" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
                                <i class="fa-solid fa-crown text-lg w-5 text-center"></i>
                                Untuk Pimpinan
                            </a>
                        </li>
                        <!-- Menu Non-aktif -->
                        <li>
                            <a href="#" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
                                <i class="fa-solid fa-globe text-lg w-5 text-center"></i>
                                Informasi Publik
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Kanan: Area Konten Panduan -->
            <section class="w-full md:w-[68%] bg-white rounded-[2rem] shadow-figma-box p-10 relative">
                
                <!-- Header Konten (Nomor & Judul) -->
                <div class="flex items-start gap-6 mb-8">
                    <!-- Kotak Nomor 01 dengan Gradasi Halus -->
                    <div class="w-[4.5rem] h-[4.5rem] bg-gradient-to-br from-[#D4F0E8] to-[#B2DFD0] rounded-2xl flex items-center justify-center text-[2rem] font-black text-[#134D3D] shadow-inner flex-shrink-0 border border-[#bce8da]">
                        01
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-[#1A634E] mb-3 leading-tight">Cara Melakukan Presensi (Absensi)</h2>
                        <p class="text-[#1D6751] font-semibold text-[15px]">Untuk melakukan absensi , silahkan ikut langkah berikut :</p>
                    </div>
                </div>

                <!-- List Langkah-langkah -->
                <div class="space-y-5 pl-2 mb-12">
                    <div class="flex items-center gap-4">
                        <div class="w-7 h-7 bg-[#1A634E] rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0">1</div>
                        <p class="text-[#1D6751] font-medium">Masuk ke halaman pegawai menggunakan NIP & Password</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-7 h-7 bg-[#1A634E] rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0">2</div>
                        <p class="text-[#1D6751] font-medium">Pada Dashboard utama klik tombol <span class="font-bold">" Tap Presence"</span></p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-7 h-7 bg-[#1A634E] rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0 mt-0.5">3</div>
                        <p class="text-[#1D6751] font-medium leading-relaxed">Pastikan lokasi GPS aktif dan sistem akan mencatat waktu kehadiran anda</p>
                    </div>
                </div>

                <!-- Banner Bantuan Tambahan Bawah -->
                <div class="bg-gradient-to-r from-[#1C6851] to-[#124B3A] rounded-2xl p-8 flex flex-col items-center text-center shadow-lg border border-[#23785D]">
                    <h3 class="text-2xl font-black text-white mb-2">Masih Butuh Bantuan?</h3>
                    <p class="text-white/90 text-sm font-medium mb-6">Tim IT Kemenag siap membantu kendala teknis anda</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-gradient-to-b from-[#F9FBFB] to-[#E9F2F0] hover:scale-105 transition-transform text-[#1A634E] px-6 py-2.5 rounded-full font-bold text-sm shadow flex items-center gap-2 border border-[#d2e8e2]">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Hubungi Admin
                        </button>
                        <button class="bg-gradient-to-b from-[#F9FBFB] to-[#E9F2F0] hover:scale-105 transition-transform text-[#1A634E] px-8 py-2.5 rounded-full font-bold text-sm shadow flex items-center gap-2 border border-[#d2e8e2]">
                            <i class="fa-regular fa-envelope text-lg"></i> Kirim Email
                        </button>
                    </div>
                </div>

            </section>

        </div>
    </main>

</body>
</html>