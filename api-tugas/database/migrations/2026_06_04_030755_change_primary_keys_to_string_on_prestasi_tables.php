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
        // 1. Drop foreign keys first
        Schema::table('pendaftaran_prestasi', function (Blueprint $table) {
            $table->dropForeign(['ref_id']);
        });

        Schema::table('capaian_prestasi', function (Blueprint $table) {
            $table->dropForeign(['pendaftaran_id']);
        });

        // 2. Change primary keys to string
        Schema::table('referensi_kejuaraan', function (Blueprint $table) {
            $table->string('ref_id')->change();
        });

        Schema::table('pendaftaran_prestasi', function (Blueprint $table) {
            $table->string('pendaftaran_id')->change();
            $table->string('ref_id')->change();
        });

        Schema::table('capaian_prestasi', function (Blueprint $table) {
            $table->string('capaian_id')->change();
            $table->string('pendaftaran_id')->change();
        });

        // 3. Re-add foreign keys
        Schema::table('pendaftaran_prestasi', function (Blueprint $table) {
            $table->foreign('ref_id')->references('ref_id')->on('referensi_kejuaraan')->onDelete('cascade');
        });

        Schema::table('capaian_prestasi', function (Blueprint $table) {
            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran_prestasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // To reverse, we'd need to go back to BigInteger, but this is destructive if data exists
        // For simplicity in this dev environment, we just drop foreign keys before potential rollback
        Schema::table('capaian_prestasi', function (Blueprint $table) {
            $table->dropForeign(['pendaftaran_id']);
        });

        Schema::table('pendaftaran_prestasi', function (Blueprint $table) {
            $table->dropForeign(['ref_id']);
        });
    }
};
