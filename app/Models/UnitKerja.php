<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';

    protected $fillable = [
        'nama_unit_kerja',
    ];

    public function penempatan()
    {
        return $this->hasMany(PenempatanPegawai::class, 'id_unit_kerja');
    }
}
