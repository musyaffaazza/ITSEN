<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
        'is_active',
        'must_change_password',
        'privasi_disetujui_pada',
        'privasi_versi',
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
    public function anggota(): HasOne
    {
        return $this->hasOne(Anggota::class);
    }

    public function pertemuanDibuat(): HasMany
    {
        return $this->hasMany(Pertemuan::class, 'dibuat_oleh');
    }

    public function absensiDiubah(): HasMany
    {
        return $this->hasMany(Absensi::class, 'diubah_oleh');
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'must_change_password' => 'boolean',
            'privasi_disetujui_pada' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
