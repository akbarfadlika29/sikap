<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
                    colors: { 'kemenag-dark': '#1A634E', 'kemenag-mint': '#7DD3BA', 'kemenag-text': '#1D6751', }
                }
            }
        }
    </script>
</head>
<body class="bg-[#E4F2EE] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

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
                <a href="/dashboard-pegawai" class="flex items-center gap-4 bg-gradient-to-r from-[#329E80] to-[#257A63] text-white px-6 py-4 rounded-xl font-bold shadow-md transition-all">
                    <i class="fa-solid fa-house w-6 text-xl"></i> Dashboard
                </a>
                <a href="/formulir-izin" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
                    <i class="fa-solid fa-file-pen w-6 text-xl"></i> Formulir Izin
                </a>
                <a href="/konfirmasi-pulang" class="flex items-center gap-4 hover:bg-white/10 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all">
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

    <main class="flex-1 p-10 lg:p-14 overflow-y-auto relative z-10">
        
        <div class="mb-10">
            <h2 class="text-[2.5rem] font-black text-[#1A634E] leading-tight mb-1">Dashboard Personal</h2>
            <p class="text-[#268A6B] text-lg font-bold tracking-[0.15em] uppercase">SELAMAT DATANG {{ auth()->user()->name }}</p>
        </div>

        <div class="bg-white rounded-[2.5rem] p-10 border border-white shadow-[0_20px_50px_-15px_rgba(26,99,78,0.15)]">
            <h3 class="text-2xl font-black text-[#479D85] tracking-widest uppercase mb-8">RIWAYAT IZIN PERSONAL</h3>

            <div class="flex px-6 mb-3 text-[#1C6851] font-semibold text-sm">
                <div class="w-2/12">Jenis Izin</div>
                <div class="w-4/12">Tanggal/Durasi</div>
                <div class="w-4/12">Alasan</div>
                <div class="w-2/12 text-center">Status</div>
            </div>

            <div class="space-y-4">
                @forelse ($riwayat_izin as $izin)
                <div class="bg-white rounded-full p-4 px-6 flex items-center justify-between shadow-[0_8px_25px_-3px_rgba(0,0,0,0.08)] border border-gray-100/50 hover:bg-gray-50 transition-colors">
                    <div class="w-2/12 flex items-center gap-3">
                        <div class="w-3 h-3 rounded-sm @if($izin->jenis_izin == 'Sakit') bg-[#51A88E] @elseif($izin->jenis_izin == 'Cuti') bg-[#F59E0B] @else bg-[#D32F2F] @endif"></div>
                        <span class="font-semibold text-[#1A634E]">{{ $izin->jenis_izin }}</span>
                    </div>
                    <div class="w-4/12 font-semibold text-[#1A634E]">
                        {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y') }}
                    </div>
                    <div class="w-4/12 font-medium text-[#1A634E] truncate pr-4">{{ $izin->alasan }}</div>
                    
                    <div class="w-2/12 flex items-center justify-center gap-2 font-bold @if($izin->status == 'Proses') text-[#D32F2F] @elseif($izin->status == 'Disetujui') text-[#51A88E] @elseif($izin->status == 'Selesai') text-gray-400 @else text-gray-500 @endif">
                        <div class="w-2.5 h-2.5 rounded-sm @if($izin->status == 'Proses') bg-[#D32F2F] @elseif($izin->status == 'Disetujui') bg-[#51A88E] @elseif($izin->status == 'Selesai') bg-gray-400 @else bg-gray-500 @endif"></div> 
                        {{ $izin->status }}
                    </div>
                </div>
                @empty
                <div class="text-center py-6 text-gray-400 font-semibold italic">Belum ada riwayat izin yang diajukan.</div>
                @endforelse
            </div>
        </div>
    </main>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Oke',
            confirmButtonColor: '#329E80',
            background: '#F4F7F6',
            customClass: { title: 'text-[#1A634E] font-bold font-sans', popup: 'rounded-3xl', confirmButton: 'rounded-xl px-8 font-bold' }
        });
    </script>
    @endif
</body>
</html>