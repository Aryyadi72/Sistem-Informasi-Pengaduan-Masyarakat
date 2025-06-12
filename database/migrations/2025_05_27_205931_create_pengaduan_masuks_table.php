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
        Schema::create('pengaduan_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengaduan_masuk');
            $table->text('isi_laporan');
            $table->string('foto');
            $table->enum('status', ['Diproses', 'Selesai', 'Ditolak']);
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('masyarakat_id')->constrained('masyarakats')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_masuks');
    }
};
