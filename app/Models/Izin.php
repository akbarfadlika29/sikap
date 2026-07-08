<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    // Mengizinkan data ini diisi dari form
    protected $fillable = ['user_id', 'divisi', 'jenis_izin', 'tanggal_mulai', 'jam_keluar', 'tanggal_selesai','jam_kembali', 'alasan', 'status','surat_izin'];

    // Relasi: 1 Izin ini milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}