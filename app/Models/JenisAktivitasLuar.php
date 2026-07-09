<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AktivitasLuar;

class JenisAktivitasLuar extends Model
{
    use HasFactory;

    protected $table = 'jenis_aktivitas_luar';

    protected $fillable = [
        'nama_jenis_aktivitas_luar',
    ];

    public function aktivitasLuar()
    {
        return $this->hasMany(AktivitasLuar::class, 'id_jenis_aktivitas_luar');
    }
}
