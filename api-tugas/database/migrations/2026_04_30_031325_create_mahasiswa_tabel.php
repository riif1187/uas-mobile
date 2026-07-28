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
        Schema::create('mahasiswa_tabel', function (Blueprint $table) {
            #1. Identitas
            $table->string('nama');
            $table->string('NIM', 15)->primary();               
                          

            #2. Akademik
            $table->string('fakultas');                         
            $table->string('prodi');                            

            #3. Kelahiran & Gender
            $table->string('tempat_lahir');                  
            $table->date('tanggal_lahir');                      
            $table->string('jenis_kelamin');                    

            #4. Data Kontak
            $table->string('email')->nullable();                 
            $table->string('no_telepon');                       
            $table->string('alamat');                           

            #5. Biodata Pribadi
            $table->string('agama');                            
            $table->string('kewarganegaraan');                  
            $table->string('golongan_darah', 5)->nullable();                
            $table->string('status_pernikahan');                

            #6. Status Keaktifan
            $table->string('status_aktif')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_tabel');
    }
};
