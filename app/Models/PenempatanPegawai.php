<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\UnitKerja;
use App\Models\Jabatan;

class PenempatanPegawai extends Model
{
    use HasFactory;

    protected $table = 'penempatan_pegawai';

    protected $fillable = [
        'id_user',
        'id_unit_kerja',
        'id_jabatan',
        'status_jabatan'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit_kerja');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
