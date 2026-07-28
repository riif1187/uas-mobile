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
        Schema::create('capaian_prestasi', function (Blueprint $table) {
            $table->id('capaian_id');
            $table->unsignedBigInteger('pendaftaran_id');
            $table->string('peringkat');
            $table->string('file_bukti');
            $table->string('NIP');
            $table->timestamps();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran_prestasi')->onDelete('cascade');
            $table->foreign('NIP')->references('NIP')->on('dosen_tabel')->onDelete('cascade');
        });
    }

    /** l
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_prestasi');
    }
};