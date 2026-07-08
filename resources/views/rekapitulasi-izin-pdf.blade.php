<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak PDF - Rekapitulasi Izin Kemenag Tuban</title>
    <style>
        body { 
            font-family: 'Times New Roman', Times, serif; 
            color: #000; 
            padding: 20px; 
        }
        
        /* Pengaturan Kop Surat */
        .kop-surat-table {
            width: 100%;
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat-table td {
            border: none;
            padding: 0;
        }
        .logo-kemenag {
            width: 90px;
            height: auto;
        }
        .teks-kop {
            text-align: center;
        }
        .teks-kop h2 { 
            font-size: 22px; 
            text-transform: uppercase; 
            margin: 0; 
            letter-spacing: 1px;
        }
        .teks-kop h3 { 
            font-size: 24px; 
            font-weight: bold; 
            text-transform: uppercase; 
            margin: 5px 0; 
        }
        .teks-kop p { 
            font-size: 13px; 
            margin: 2px 0; 
        }

        /* Pengaturan Judul & Tabel Data */
        .judul-laporan { 
            text-align: center; 
            margin-bottom: 25px; 
        }
        .judul-laporan h4 { 
            font-size: 16px; 
            margin: 0; 
            text-transform: uppercase; 
            text-decoration: underline; 
            font-weight: bold;
        }
        .judul-laporan p { 
            margin: 5px 0 0 0; 
            font-size: 13px; 
        }
        
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            font-size: 12px; 
        }
        .data-table th, .data-table td { 
            border: 1px solid #000; 
            padding: 8px 10px; 
            text-align: left; 
            vertical-align: top;
        }
        .data-table th { 
            background-color: #f2f2f2; 
            text-align: center; 
            font-weight: bold;
        }

        /* Pengaturan Tanda Tangan */
        .ttd-container {
            width: 100%;
            margin-top: 40px;
        }
        .ttd { 
            width: 300px; 
            float: right; 
            text-align: center; 
            font-size: 14px; 
        }
        .ttd p { margin: 0; line-height: 1.5; }
        .ttd .nama { 
            margin-top: 80px; 
            font-weight: bold; 
            text-decoration: underline; 
        }

        /* Pengaturan Kertas Print */
        @media print {
            @page { size: A4 portrait; margin: 15mm; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <table class="kop-surat-table">
        <tr>
            <td width="15%" style="text-align: center; vertical-align: middle;">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="logo-kemenag">
            </td>
            <td width="85%" class="teks-kop">
                <h2>Kementerian Agama Republik Indonesia</h2>
                <h3>Kantor Kementerian Agama Kabupaten Tuban</h3>
                <p>Jl. Dr. Wahidin Sudirohusodo No. 45, Latsari, Kec. Tuban, Kabupaten Tuban, Jawa Timur 62314</p>
                <p>Telepon: (0356) 321111 | Website: tuban.kemenag.go.id</p>
            </td>
        </tr>
    </table>

    <div class="judul-laporan">
        <h4>Laporan Rekapitulasi Izin Pegawai</h4>
        <p>
            Periode: 
            {{ $request->bulan ? date('F', mktime(0, 0, 0, $request->bulan, 10)) : 'Semua Bulan' }} 
            {{ $request->tahun ?? 'Semua Tahun' }}
        </p>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Pegawai</th>
                <th width="15%">NIP</th>
                <th width="20%">Jabatan & Unit Kerja</th>
                <th width="15%">Jenis Izin</th>
                <th width="15%">Tgl & Waktu</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($izins as $index => $izin)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td><strong>{{ $izin->user->name }}</strong></td>
                <td>{{ $izin->user->nip }}</td>
                <td>{{ $izin->user->jabatan ?? '-' }} <br> <em>{{ $izin->user->unit_kerja ?? '' }}</em></td>
                <td>{{ $izin->jenis_izin }}<br><span style="font-size: 10px; color: #333;">({{ $izin->alasan }})</span></td>
                <td>
                    {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d/m/Y') }}<br>
                    {{ \Carbon\Carbon::parse($izin->jam_keluar)->format('H:i') }} - {{ \Carbon\Carbon::parse($izin->jam_kembali)->format('H:i') }}
                </td>
                <td style="text-align: center; font-weight: bold;">
                    {{ strtoupper($izin->status) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 25px;">Tidak ada data izin pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd">
            <p>Tuban, {{ date('d F Y') }}</p>
            <p>Kepala Kantor</p>
            <p class="nama">UMI KULSUM S. Ag. M.Pd.I</p>
            <p>NIP. 197107082000032002</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Memberi jeda sedikit (500ms) agar logo sempat ter-load sebelum dialog print muncul
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>