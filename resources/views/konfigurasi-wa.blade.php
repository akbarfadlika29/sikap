<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurasi WA API - SIKAP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                
                <a href="/konfigurasi-wa" class="flex items-center gap-4 px-6 py-4 bg-gradient-to-r from-[#36A282] to-[#257A63] text-white rounded-r-full -ml-4 pl-10 shadow-lg border-l-4 border-white font-bold text-[16px] transition-all">
                    <i class="fa-brands fa-whatsapp w-6 text-xl text-center"></i> Konfigurasi WA API
                </a>
                
                <a href="/rekapitulasi-izin" class="flex items-center gap-4 px-6 py-4 text-white/80 hover:bg-white/10 hover:text-white rounded-xl transition-all font-semibold text-[16px] group">
                    <i class="fa-solid fa-file-signature w-6 text-xl text-center group-hover:scale-110 transition-transform"></i> Rekapitulasi Izin
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
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-[2.2rem] font-black text-[#1A634E] mb-1">Alur Notifikasi WA</h1>
                <p class="text-gray-500 font-semibold text-sm">Pengaturan / WA API Gateway</p>
            </div>
            <div class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-xs font-bold flex items-center gap-2 border border-emerald-200">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> WhatsApp Connected
            </div>
        </div>

        <form action="/konfigurasi-wa/simpan" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="fa-solid fa-key text-[#1A634E] text-xl"></i>
                            <h2 class="text-lg font-bold text-[#1A634E]">Koneksi Gateway</h2>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">API Token</label>
                                <input type="password" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxx" readonly class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl focus:outline-none font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nomor Pengirim</label>
                                <input type="text" value="+62 8123456789" readonly class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl focus:outline-none font-semibold text-gray-700">
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl p-8 text-white shadow-md relative overflow-hidden">
                        <i class="fa-solid fa-circle-info absolute -right-6 -bottom-6 text-[8rem] text-white/10"></i>
                        <h3 class="text-lg font-bold mb-3">Variabel Dinamis</h3>
                        <p class="text-sm text-blue-100 mb-4 leading-relaxed">Gunakan kode ini agar sistem otomatis mengambil data dari database:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-mono font-bold">{nama_pegawai}</span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-mono font-bold">{jenis_izin}</span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-mono font-bold">{alasan}</span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-mono font-bold">{status}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-sm font-bold text-[#1D6751] flex items-center gap-2"><i class="fa-solid fa-message"></i> Template Ke Pimpinan</label>
                                <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase">Urgent</span>
                            </div>
                            <textarea rows="3" class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl focus:outline-none text-sm font-medium text-gray-600 leading-relaxed">Hala Bapak/Ibu Pimpinan, Ada pengajuan izin baru dari Nama: {nama_pegawai} Jenis: {jenis_izin} Mohon segera di cek pada sistem SIKAP.</textarea>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-sm font-bold text-[#1D6751] flex items-center gap-2"><i class="fa-solid fa-message"></i> Template Ke Pegawai</label>
                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase">Update</span>
                            </div>
                            <textarea rows="3" class="w-full px-4 py-3 bg-[#F4F7F6] border border-gray-200 rounded-xl focus:outline-none text-sm font-medium text-gray-600 leading-relaxed">Halo {nama_pegawai}, Sistem mencatat Anda belum kembali ke kantor dari kegiatan {jenis_izin}. Mohon segera konfirmasi kepulangan Anda di sistem SIKAP.</textarea>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#1A634E] hover:bg-[#114032] transition-colors text-white py-4 rounded-xl font-bold shadow-md flex justify-center items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Update Konfigurasi Otomatis
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-6">
                <i class="fa-solid fa-paper-plane text-[#1A634E] text-xl"></i>
                <h2 class="text-xl font-bold text-[#1A634E]">Antrean Eksekusi Notifikasi</h2>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-sm border-b-2 border-gray-50">
                        <th class="py-3 px-4 font-bold">Pegawai</th>
                        <th class="py-3 px-4 font-bold">Jenis Izin</th>
                        <th class="py-3 px-4 font-bold">Status Izin</th>
                        <th class="py-3 px-4 font-bold text-center">Aksi Notifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($izin_masuk as $izin)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4">
                            <p class="font-bold text-[#1A634E]">{{ $izin->user->name }}</p>
                            <p class="text-xs font-semibold text-gray-400">NIP: {{ $izin->user->nip }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-sm font-bold text-gray-700">{{ $izin->jenis_izin }}</p>
                            <p class="text-xs text-gray-400 truncate max-w-[150px]">{{ $izin->alasan }}</p>
                        </td>
                        <td class="py-4 px-4">
                            @if($izin->status == 'Proses')
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Proses</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Disetujui</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 flex justify-center gap-2">
                            @if($izin->status == 'Proses')
                            <form action="/kirim-wa-pimpinan/{{ $izin->id }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-[#1A634E] hover:bg-[#114032] text-white px-4 py-2 rounded-xl font-bold text-xs shadow-sm flex items-center gap-1.5 transition-colors">
                                    <i class="fa-brands fa-whatsapp"></i> Hubungi Pimpinan
                                </button>
                            </form>
                            @else
                            <form action="/kirim-wa-pegawai/{{ $izin->id }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-xl font-bold text-xs shadow-sm flex items-center gap-1.5 transition-colors">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Kirim Teguran
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-400 italic font-semibold">Belum ada antrean pesan yang perlu dieksekusi.</td>
                    </tr>
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