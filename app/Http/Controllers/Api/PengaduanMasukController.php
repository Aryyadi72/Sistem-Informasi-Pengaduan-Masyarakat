<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengaduanMasukRequest;
use App\Http\Resources\Api\PengaduanMasukResource;
use App\Models\PengaduanMasuk;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PengaduanMasukController extends Controller
{
    public function index()
    {
        $pengaduanMasuks = PengaduanMasuk::with(['kategori', 'masyarakat'])->get();
        return PengaduanMasukResource::collection($pengaduanMasuks);
    }

    public function show(PengaduanMasuk $pengaduanMasuk)
    {
        $pengaduanMasuk->load(['kategori', 'masyarakat']);
        return new PengaduanMasukResource($pengaduanMasuk);
    }

    public function store(PengaduanMasukRequest $request)
    {
        $pengaduanMasuk = PengaduanMasuk::create($request->validated());

        return response()->json([
            'message' => 'Pengaduan berhasil ditambahkan.',
            'data' => $pengaduanMasuk,
        ], 201);
    }
}
