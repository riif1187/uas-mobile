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
        Schema::create('fuzzy_klasifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('NIM', 20);
            $table->tinyInteger('jumlah_prestasi')->unsigned();
            $table->smallInteger('total_poin')->unsigned();
            $table->tinyInteger('peringkat_terbaik')->unsigned();
            $table->decimal('skor_fuzzy', 5, 2);
            $table->string('label_fuzzy', 50);
            $table->timestamps();

            $table->foreign('NIM')->references('NIM')->on('mahasiswa_tabel')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->unique('NIM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_klasifikasi');
    }
};
