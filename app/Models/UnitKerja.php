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

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_unit_kerja', 'id_unit_kerja', 'id_user')->withTimestamps();
    }
}
