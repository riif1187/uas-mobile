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
        Schema::create('bimbingan', function (Blueprint $table) {
        $table->id();
        $table->string('nim_mahasiswa');
        $table->string('nip_dosen');
        $table->date('tanggal_bimbingan');
        $table->timestamps();

            $table->foreign('nim_mahasiswa')
                ->references('NIM')
                ->on('mahasiswa_tabel')
                ->onDelete('cascade');

            $table->foreign('nip_dosen')
                ->references('NIP')
                ->on('dosen_tabel')
                ->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan');
    }
};
