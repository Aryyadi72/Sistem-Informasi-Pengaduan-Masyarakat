<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengaduanMasukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tanggal_pengaduan_masuk' => $this->tanggal_pengaduan_masuk,
            'isi_laporan' => $this->isi_laporan,
            'foto' => $this->foto,
            'status' => $this->status,
            'kategori' => new KategoriResource($this->whenLoaded('kategori')),
            'masyarakat' => new MasyarakatResource($this->whenLoaded('masyarakat')),
        ];
    }
}
