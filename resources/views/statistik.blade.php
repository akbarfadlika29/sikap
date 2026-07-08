<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Kehadiran - SIKAP Kemenag Tuban</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js Library untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
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
        body { 
            background: linear-gradient(180deg, #E8F5F2 0%, #D8EFEB 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 pb-24">

    <nav class="bg-white w-full px-6 py-3 flex justify-between items-center shadow-sm relative z-20">
        <div class="container mx-auto max-w-6xl flex justify-between items-center">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-12 h-12 object-contain">
                <div class="flex flex-col justify-center mt-1">
                    <h1 class="text-[1.4rem] font-extrabold text-kemenag-dark leading-none tracking-wide">SIKAP</h1>
                    <p class="text-[9px] font-bold text-kemenag-dark mt-0.5 tracking-wider">KEMENTRIAN AGAMA TUBAN</p>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-8 text-[13px] font-semibold text-kemenag-dark">
                <a href="/" class="hover:text-[#329E80] transition-colors">Beranda</a>
                <!-- Menu Aktif Berpindah ke Statistik -->
                <a href="/statistik-kehadiran" class="border-b-2 border-[#329E80] pb-1 text-[#329E80]">Statistik Kehadiran</a>
                <a href="/informasi-pelayanan" class="hover:text-[#329E80] transition-colors">Informasi Pelayanan</a>
            </div>
            
            <a href="/login" class="bg-gradient-to-r from-[#329E80] to-[#20725A] hover:scale-105 transition-transform duration-300 text-white px-6 py-2 rounded-full flex items-center gap-3 shadow-md font-semibold text-sm">
                Login Pegawai <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </nav>

    <header class="w-full text-center pt-12 pb-10 relative z-10">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="inline-block bg-gradient-to-r from-[#A4DECD] to-[#8BCFBA] text-[#134D3D] px-8 py-2 rounded-full text-[13px] font-bold mb-4 shadow-sm border border-[#85CDb5] tracking-widest uppercase">
                Rekapitulasi Data
            </div>
            <h2 class="text-3xl md:text-[2.5rem] font-black text-kemenag-dark leading-tight mb-3">Statistik Kehadiran Pegawai</h2>
            <p class="text-[#1D6751] text-[15px] font-medium max-w-2xl mx-auto">
                Laporan visual data kehadiran, ketepatan waktu, dan status dinas pegawai Kementrian Agama Kabupaten Tuban bulan ini.
            </p>
        </div>
    </header>

    <main class="container mx-auto max-w-6xl px-6">
        
        <!-- 4 Kotak Ringkasan Atas -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <!-- Rata-rata Kehadiran -->
            <div class="bg-white rounded-[1.5rem] shadow-figma-card p-6 flex flex-col items-start border-l-4 border-[#329E80]">
                <div class="w-12 h-12 bg-[#E8F5F2] rounded-full flex items-center justify-center text-[#329E80] mb-4 text-xl">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="text-3xl font-black text-kemenag-dark mb-1">94.5%</h3>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Rata-rata Kehadiran</p>
                <p class="text-[10px] text-green-500 font-semibold mt-2"><i class="fa-solid fa-arrow-up mr-1"></i>2.1% dari bulan lalu</p>
            </div>
            
            <!-- Tepat Waktu -->
            <div class="bg-white rounded-[1.5rem] shadow-figma-card p-6 flex flex-col items-start border-l-4 border-[#3B82F6]">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-500 mb-4 text-xl">
                    <i class="fa-solid fa-stopwatch"></i>
                </div>
                <h3 class="text-3xl font-black text-kemenag-dark mb-1">88%</h3>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Tingkat Tepat Waktu</p>
                <p class="text-[10px] text-gray-400 font-medium mt-2">Data bulan berjalan</p>
            </div>

            <!-- Dinas Luar -->
            <div class="bg-white rounded-[1.5rem] shadow-figma-card p-6 flex flex-col items-start border-l-4 border-[#F59E0B]">
                <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-500 mb-4 text-xl">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <h3 class="text-3xl font-black text-kemenag-dark mb-1">42</h3>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Total Dinas Luar</p>
                <p class="text-[10px] text-gray-400 font-medium mt-2">Akumulasi hari dinas</p>
            </div>

            <!-- Izin/Sakit -->
            <div class="bg-white rounded-[1.5rem] shadow-figma-card p-6 flex flex-col items-start border-l-4 border-[#EF4444]">
                <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center text-red-500 mb-4 text-xl">
                    <i class="fa-solid fa-file-medical"></i>
                </div>
                <h3 class="text-3xl font-black text-kemenag-dark mb-1">18</h3>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Total Cuti / Sakit</p>
                <p class="text-[10px] text-red-400 font-semibold mt-2"><i class="fa-solid fa-arrow-down mr-1"></i>Menurun dari bulan lalu</p>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Kiri: Grafik Bar (Tren Harian) -->
            <div class="w-full lg:w-2/3 bg-white rounded-[2rem] shadow-figma-box p-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-black text-[#1A634E]">Tren Kehadiran Harian</h3>
                        <p class="text-sm text-gray-500 font-medium">Data 7 hari kerja terakhir</p>
                    </div>
                    <button class="bg-[#F4F7F6] text-[#1D6751] px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-gray-100 transition">
                        <i class="fa-solid fa-download mr-2"></i> Unduh
                    </button>
                </div>
                <!-- Container Canvas untuk Chart.js -->
                <div class="relative h-72 w-full">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <!-- Kanan: Grafik Donut (Persentase Status) -->
            <div class="w-full lg:w-1/3 bg-gradient-to-b from-[#1C6851] to-[#124B3A] rounded-[2rem] shadow-figma-card p-8 border border-[#23785D] text-white">
                <h3 class="text-xl font-black mb-1">Distribusi Status</h3>
                <p class="text-xs text-white/80 font-medium mb-8">Persentase status bulan ini</p>
                
                <!-- Container Canvas untuk Chart.js -->
                <div class="relative h-56 w-full flex justify-center">
                    <canvas id="donutChart"></canvas>
                </div>

                <!-- Legend / Keterangan Manual -->
                <div class="mt-8 space-y-3">
                    <div class="flex justify-between items-center text-sm font-semibold">
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#7DD3BA]"></div> Hadir</div>
                        <span>75%</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-semibold">
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#FBBF24]"></div> Dinas Luar</div>
                        <span>15%</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-semibold">
                        <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#F87171]"></div> Cuti / Sakit</div>
                        <span>10%</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Data dan Konfigurasi untuk Bar Chart (Tren Harian)
        const ctxBar = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Senin', 'Selasa'],
                datasets: [{
                    label: 'Jumlah Pegawai Hadir',
                    data: [135, 140, 138, 142, 130, 139, 141],
                    backgroundColor: '#329E80',
                    borderRadius: 8, // Membuat ujung bar melengkung
                    barThickness: 35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Sembunyikan legend bawaan
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#E5E7EB' },
                        ticks: { color: '#6B7280', font: { family: 'Poppins' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6B7280', font: { family: 'Poppins', weight: '500' } }
                    }
                }
            }
        });

        // Data dan Konfigurasi untuk Donut Chart (Distribusi)
        const ctxDonut = document.getElementById('donutChart').getContext('2d');
        const donutChart = new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Dinas Luar', 'Cuti/Sakit'],
                datasets: [{
                    data: [75, 15, 10],
                    backgroundColor: [
                        '#7DD3BA', // Mint (Hadir)
                        '#FBBF24', // Kuning (Dinas Luar)
                        '#F87171'  // Merah (Sakit/Cuti)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%', // Ketebalan donut
                plugins: {
                    legend: { display: false }, // Disembunyikan karena sudah buat legend HTML custom
                    tooltip: {
                        bodyFont: { family: 'Poppins' }
                    }
                }
            }
        });
    </script>

</body>
</html>