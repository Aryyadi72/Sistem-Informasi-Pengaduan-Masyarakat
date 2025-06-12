<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengaduanMasuk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanggal_pengaduan_masuk',
        'isi_laporan',
        'foto',
        'status',
        'kategori_id',
        'masyarakat_id',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class);
    }

    public function pengaduanDiproses(): HasMany
    {
        return $this->hasMany(PengaduanDiproses::class);
    }

    public function pengaduanSelesai(): HasMany
    {
        return $this->hasMany(PengaduanSelesai::class);
    }

    public function pengaduanDitolak(): HasMany
    {
        return $this->hasMany(PengaduanDitolak::class);
    }
}
