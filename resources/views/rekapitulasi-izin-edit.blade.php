<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rekap Izin - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#E8F5F2] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

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
                <a href="/manajemen-jabatan" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-user-tie w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Manajemen Jabatan
                </a>
                <a href="/konfigurasi-wa" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-brands fa-whatsapp w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Konfigurasi WA API
                </a>
                <a href="/rekapitulasi-izin" class="flex items-center gap-4 px-6 py-4 bg-gradient-to-r from-[#36A282] to-[#257A63] text-white rounded-r-full -ml-4 pl-10 shadow-lg border-l-4 border-white font-bold text-[16px] transition-all">
                    <i class="fa-solid fa-file-signature w-6 text-xl text-center"></i> Rekapitulasi Izin
                </a>
            </nav>
        </div>
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

    <main class="flex-1 p-10 lg:p-12 overflow-y-auto">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-[2rem] font-black text-[#1A634E] mb-1">Edit Catatan Rekap</h1>
                <p class="text-gray-500 font-semibold text-[14px]">Intervensi Admin untuk mengubah arsip izin milik {{ $izin->user->name }}.</p>
            </div>
            <a href="/rekapitulasi-izin" class="text-[#329E80] font-bold hover:underline flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-gray-100 max-w-4xl">
            <form action="/rekapitulasi-izin/update/{{ $izin->id }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2">Nama Pegawai (NIP)</label>
                        <input type="text" value="{{ $izin->user->name }} (NIP: {{ $izin->user->nip }})" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl font-bold text-gray-400 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2">Jabatan & Unit Kerja</label>
                        <input type="text" value="{{ $izin->user->jabatan ?? '-' }} - {{ $izin->user->unit_kerja ?? '-' }}" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl font-bold text-gray-400 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Jenis Izin</label>
                        <select name="jenis_izin" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl font-medium focus:ring-2 focus:ring-[#329E80] outline-none">
                            <option value="Sakit" {{ $izin->jenis_izin == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Dinas Luar" {{ $izin->jenis_izin == 'Dinas Luar' ? 'selected' : '' }}>Dinas Luar</option>
                            <option value="Cuti" {{ $izin->jenis_izin == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-red-600 mb-2">Status Penanganan (Intervensi)</label>
                        <select name="status" required class="w-full px-4 py-3 bg-[#FFF5F5] border border-red-200 rounded-xl font-bold text-red-600 focus:ring-2 focus:ring-red-400 outline-none">
                            <option value="Proses" {{ $izin->status == 'Proses' ? 'selected' : '' }}>Proses (Menunggu)</option>
                            <option value="Disetujui" {{ $izin->status == 'Disetujui' ? 'selected' : '' }}>Disetujui (Dinas Aktif)</option>
                            <option value="Selesai" {{ $izin->status == 'Selesai' ? 'selected' : '' }}>Selesai (Sudah Pulang)</option>
                            <option value="Ditolak" {{ $izin->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Tanggal Keluar</label>
                        <input type="date" name="tanggal_mulai" value="{{ $izin->tanggal_mulai }}" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl font-medium focus:ring-2 focus:ring-[#329E80] outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1D6751] mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ $izin->tanggal_selesai }}" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl font-medium focus:ring-2 focus:ring-[#329E80] outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1D6751] mb-2">Alasan Izin</label>
                    <textarea name="alasan" rows="3" required class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl font-medium focus:ring-2 focus:ring-[#329E80] outline-none">{{ $izin->alasan }}</textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#1A634E] hover:bg-[#114032] transition-colors text-white px-6 py-4 rounded-xl font-bold shadow-lg flex justify-center items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Intervensi Data
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>