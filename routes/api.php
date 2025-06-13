<?php

use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\MasyarakatController;
use App\Http\Controllers\Api\PengaduanMasukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Kategori (Test)
Route::apiResource('/kategori', KategoriController::class);

// Pengaduan Masuk
Route::middleware('apikey')->group(function () {
    Route::apiResource('/pengaduan-masuk', PengaduanMasukController::class);
    Route::post('/check-nik', [MasyarakatController::class, 'cekNik']);
});
