<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';

    protected $fillable = [
        'periode_id',
        'judul',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'toleransi_menit',
        'status',
        'dibuka_pada',
        'ditutup_pada',
        'cara_tutup',
        'catatan',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'dibuka_pada' => 'datetime',
            'ditutup_pada' => 'datetime',
            'toleransi_menit' => 'integer',
        ];
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function pengajuanIzin(): HasMany
    {
        return $this->hasMany(PengajuanIzin::class);
    }

    public function logPenolakan(): HasMany
    {
        return $this->hasMany(LogPenolakan::class);
    }
}
