<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran_prestasi', function (Blueprint $table) {
            $table->id('pendaftaran_id');
            $table->string('NIM');
            $table->unsignedBigInteger('ref_id');
            $table->string('nama_kegiatan');
            $table->timestamps();

            $table->foreign('NIM')->references('NIM')->on('mahasiswa_tabel')->onDelete('cascade');
            $table->foreign('ref_id')->references('ref_id')->on('referensi_kejuaraan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_prestasi');
    }
};
