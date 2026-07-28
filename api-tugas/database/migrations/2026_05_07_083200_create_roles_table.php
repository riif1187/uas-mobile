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
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('nama_role');             // Nama peran: Admin, Dosen, Mahasiswa
        $table->string('slug')->unique();         // Versi kode: admin, dosen, mahasiswa
        $table->string('deskripsi')->nullable();  // Keterangan peran
        $table->integer('level_akses');           // Hierarki: 1=rendah, 10=tertinggi
        $table->boolean('is_active')->default(true); // Status aktif/nonaktif
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('roles');
}

};
