<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Export Excel</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan="7" style="font-size: 16px; font-weight: bold; text-align: center;">
                    REKAPITULASI IZIN PEGAWAI KEMENAG TUBAN
                </th>
            </tr>
            <tr>
                <th colspan="7" style="text-align: center;">
                    Periode: {{ $request->bulan ? date('F', mktime(0, 0, 0, $request->bulan, 10)) : 'Semua Bulan' }} {{ $request->tahun ?? 'Semua Tahun' }}
                </th>
            </tr>
            <tr>
                <th colspan="7"></th> </tr>
            <tr>
                <th style="background-color: #d9ead3; font-weight: bold;">No</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Nama Pegawai</th>
                <th style="background-color: #d9ead3; font-weight: bold;">NIP</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Jabatan</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Unit Kerja</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Jenis Izin</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Alasan</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Tanggal Keluar</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Tanggal Selesai</th>
                <th style="background-color: #d9ead3; font-weight: bold;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($izins as $index => $izin)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $izin->user->name }}</td>
                <td>'{{ $izin->user->nip }}</td> 
                <td>{{ $izin->user->jabatan ?? '-' }}</td>
                <td>{{ $izin->user->unit_kerja ?? '-' }}</td>
                <td>{{ $izin->jenis_izin }}</td>
                <td>{{ $izin->alasan }}</td>
                <td>{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($izin->jam_keluar)->format('H:i') }})</td>
                <td>{{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($izin->jam_kembali)->format('H:i') }})</td>
                <td>{{ $izin->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>