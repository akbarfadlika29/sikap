<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisAktivitasLuar;
use App\Models\User;

class AktivitasLuar extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_luar';

    protected $fillable = [
        'id_user',
        'id_jenis_aktivitas_luar',
        'deskripsi_aktivitas_luar',
        'tanggal_keluar',
        'waktu_keluar',
        'tanggal_estimasi_kembali',
        'waktu_estimasi_kembali',
        'tanggal_kembali',
        'waktu_kembali',
        'posisi_di_kantor',
        'dokumen_pendukung',
        'status_verifikasi',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenisAktivitasLuar()
    {
        return $this->belongsTo(JenisAktivitasLuar::class, 'id_jenis_aktivitas_luar');
    }
}
