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
        Schema::create('data_lengkap_mahasiswa', function (Blueprint $table) {
            $table->id();
    
            $table->string('nim_mahasiswa');
            $table->string('matkul');
            
            $table->foreignId('tahun_akademik_id')
                ->constrained('tahun_akademik_tabel')
                ->onDelete('cascade');
            
            $table->timestamps();

            $table->foreign('nim_mahasiswa')
                ->references('NIM')
                ->on('mahasiswa_tabel')
                ->onDelete('cascade');

            $table->foreign('matkul')
                ->references('kode_matkul')
                ->on('mata_kuliah_tabel')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_lengkap_mahasiswa');
    }
};
