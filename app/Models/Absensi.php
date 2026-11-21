<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'pertemuan_id',
        'anggota_id',
        'status',
        'sumber_status',
        'waktu_absen',
        'foto_path',
        'latitude',
        'longitude',
        'akurasi_gps',
        'jarak_meter',
        'radius_saat_absen',
        'perlu_diperiksa',
        'keterangan',
        'diubah_oleh',
        'pengajuan_id',
    ];

    protected function casts(): array
    {
        return [
            'waktu_absen' => 'datetime',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'akurasi_gps' => 'decimal:2',
            'jarak_meter' => 'decimal:2',
            'radius_saat_absen' => 'integer',
            'perlu_diperiksa' => 'boolean',
        ];
    }

    public function pertemuan(): BelongsTo
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function pengubah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanIzin::class, 'pengajuan_id');
    }
}
