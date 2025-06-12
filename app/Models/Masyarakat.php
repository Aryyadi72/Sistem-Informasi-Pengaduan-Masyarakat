<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Masyarakat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pekerjaan',
        'jenis_kelamin',
        'foto',
        'no_telp'
    ];

    public function kritikSaran(): HasMany
    {
        return $this->hasMany(KritikSaran::class);
    }

    public function pengaduanMasuk(): HasMany
    {
        return $this->hasMany(PengaduanMasuk::class);
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
