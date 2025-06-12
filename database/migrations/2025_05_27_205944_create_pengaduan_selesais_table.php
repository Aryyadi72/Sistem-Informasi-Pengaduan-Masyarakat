<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan_selesais', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengaduan_selesai');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pengaduan_diproses');
            $table->foreignId('pengaduan_masuk_id')->constrained('pengaduan_masuks')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_selesais');
    }
};
