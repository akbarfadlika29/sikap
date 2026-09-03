<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use App\Models\AktivitasLuar;
use App\Models\PenempatanPegawai;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'nip',
        'no_wa',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function penempatan()
    {
        return $this->hasMany(PenempatanPegawai::class, 'id_user');
    }

    public function penempatanDefinitif()
    {
        return $this->hasOne(PenempatanPegawai::class, 'id_user')->where('status_jabatan', 'definitif');
    }

    public function aktivitasLuar()
    {
        return $this->hasMany(AktivitasLuar::class, 'id_user');
    }

    public function permitDibuat()
    {
        return $this->hasMany(AktivitasLuar::class, 'created_by');
    }

    public function permitDiproses()
    {
        return $this->hasMany(AktivitasLuar::class, 'processed_by');
    }

    public function latestPermit()
    {
        return $this->hasOne(AktivitasLuar::class, 'id_user')->latestOfMany();
    }
}
