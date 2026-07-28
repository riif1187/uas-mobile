<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('dosen_tabel', function (Blueprint $table) {
            $table->string('NIP')->primary();
            $table->string('nama');
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('jabatan_akademik');
            $table->string('email')->unique();
            $table->string('no_telepon');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('dosen_tabel');
    }
};
