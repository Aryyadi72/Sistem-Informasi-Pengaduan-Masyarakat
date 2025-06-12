<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengaduanSelesai extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanggal_pengaduan_selesai',
        'users_id',
        'tanggal_pengaduan_diproses',
        'pengaduan_masuk_id',
    ];

    public function pengaduanMasuk(): BelongsTo
    {
        return $this->belongsTo(PengaduanMasuk::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
