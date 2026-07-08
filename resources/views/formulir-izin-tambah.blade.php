<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Izin Pegawai - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#E4F2EE] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

    <aside class="w-1/4 max-w-[300px] bg-gradient-to-b from-[#1C6851] to-[#124B3A] h-full flex flex-col justify-between shadow-2xl relative z-20">
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
                
                <a href="/formulir-izin" class="flex items-center gap-4 bg-gradient-to-r from-[#329E80] to-[#257A63] text-white px-6 py-4 rounded-xl font-bold shadow-md transition-all">
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
                <button type="submit" class="w-full bg-[#1A634E] hover:bg-[#114032] transition-all text-white px-6 py-3.5 rounded-xl font-bold shadow-lg flex items-center justify-center gap-3">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-10 lg:p-14 overflow-y-auto relative z-10">
        
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-[2.5rem] font-black text-[#1A634E] leading-tight mb-1">Pengajuan Izin</h2>
                <p class="text-[#268A6B] text-base font-medium">Silakan lengkapi formulir permohonan izin di bawah ini.</p>
            </div>
            <a href="/formulir-izin" class="text-[#329E80] font-bold hover:underline flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] p-10 border border-white shadow-[0_20px_50px_-15px_rgba(26,99,78,0.15)] max-w-4xl">
            
            <form action="/formulir-izin/tambah" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ auth()->user()->name }}" class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" value="{{ auth()->user()->nip }}" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-500 font-medium cursor-not-allowed">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Jabatan & Unit Kerja</label>
                        <input type="text" name="divisi" value="{{ auth()->user()->jabatan ? auth()->user()->jabatan . ' - ' . auth()->user()->unit_kerja : 'Belum Ditugaskan oleh Admin' }}" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-500 font-bold cursor-not-allowed">
                        <p class="text-xs text-amber-600 mt-2 font-medium"><i class="fa-solid fa-lock"></i> Kolom ini terisi otomatis berdasarkan penugasan dari Admin.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Jenis Permohonan</label>
                        <select name="jenis_izin" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all">
                            <option value="" disabled selected>Pilih Jenis Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Dinas Luar">Dinas Luar</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Kegiatan Luar">Kegiatan Luar</option>
                        </select>
                    </div>
                    
                    <div></div> <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Tanggal Mulai / Keluar</label>
                        <input type="date" name="tanggal_mulai" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Jam Keluar</label>
                        <input type="time" name="jam_keluar" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Jam Estimasi Kembali</label>
                        <input type="time" name="jam_kembali" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1D6751] mb-2">Alasan Izin Lengkap</label>
                    <textarea name="alasan" rows="4" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl text-gray-800 font-medium focus:ring-2 focus:ring-[#329E80] focus:outline-none transition-all" placeholder="Tuliskan alasan pengajuan izin secara detail..."></textarea>
                </div>

                <div class="bg-[#E4F2EE]/50 p-6 rounded-2xl border border-[#329E80]/30 border-dashed mt-6">
                    <label class="block text-sm font-bold text-[#1D6751] mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf text-red-500 text-lg"></i> Unggah Surat Permohonan (Opsional)
                    </label>
                    <p class="text-xs text-gray-500 mb-3 font-medium">Maksimal ukuran file 2MB. Hanya format .PDF</p>
                    <input type="file" name="surat_izin" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#329E80] file:text-white transition-all cursor-pointer">
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-[#36A282] to-[#22775E] hover:scale-[1.02] transition-transform duration-300 text-white px-10 py-4 rounded-xl font-bold shadow-lg flex items-center gap-3 text-lg">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>