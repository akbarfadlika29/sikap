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
        'nomor_permit',
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
        'status_permit',
        'alasan_penolakan',
        'created_by',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'tanggal_keluar' => 'date',
        'tanggal_estimasi_kembali' => 'date',
        'tanggal_kembali' => 'date',
        'posisi_di_kantor' => 'boolean',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenisAktivitasLuar()
    {
        return $this->belongsTo(JenisAktivitasLuar::class, 'id_jenis_aktivitas_luar');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
