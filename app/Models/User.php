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
        'id_jabatan',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function unitKerja()
    {
        return $this->belongsToMany(UnitKerja::class, 'user_unit_kerja', 'id_user', 'id_unit_kerja')->withTimestamps();
    }

    public function aktivitasLuar()
    {
        return $this->hasMany(User::class, 'id_user');
    }
}
