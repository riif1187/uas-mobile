<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah_tabel';

    protected $primaryKey = 'kode_matkul';
    
    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'sks',
        'semester',
        'prodi',
        'jenis',
        'status_aktif'
    ];

    public function dataLengkapMahasiswa()
    {
        return $this->hasMany(DataLengkapMahasiswa::class, 'matkul', 'kode_matkul');
    }
}