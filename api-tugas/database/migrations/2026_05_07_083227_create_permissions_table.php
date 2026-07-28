<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('nama_permission');        // Nama izin: "Lihat Nilai", "Input Nilai"
        $table->string('modul');                  // Modul: mahasiswa, nilai, jadwal
        $table->string('aksi');                   // Aksi: create, read, update, delete, export
        $table->string('deskripsi')->nullable();  // Penjelasan kapan izin ini berlaku
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('permissions');
}

};
