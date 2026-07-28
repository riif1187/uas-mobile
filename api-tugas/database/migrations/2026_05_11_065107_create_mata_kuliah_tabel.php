<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void {
        Schema::create('mata_kuliah_tabel', function (Blueprint $table) {
            $table->string('kode_matkul')->primary();
            $table->string('nama_matkul');
            $table->integer('sks');
            $table->integer('semester');
            $table->string('prodi');
            $table->enum('jenis', ['wajib', 'pilihan']);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mata_kuliah_tabel');
    }
};
