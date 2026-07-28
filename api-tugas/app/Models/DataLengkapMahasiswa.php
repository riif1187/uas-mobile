<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLengkapMahasiswa extends Model
{
    protected $table = 'data_lengkap_mahasiswa';
    protected $fillable = [
        'nim_mahasiswa',
        'matkul',
        'tahun_akademik_id'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'NIM');
    }

    // Relasi ke mata kuliah (FK: matkul → mata_kuliah.kode_matkul)
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'matkul', 'kode_matkul');
    }

    // Relasi ke tahun akademik (FK: tahun_akademik_id → tahun_akademik.id)
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id', 'id');
    }
}
