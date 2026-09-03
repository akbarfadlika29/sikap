<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PenempatanPegawai;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $fillable = [
        'nama_jabatan',
    ];

    public function penempatan()
    {
        return $this->hasMany(PenempatanPegawai::class, 'id_jabatan');
    }
}
