<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    protected $table = 'tahun_akademik_tabel';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'tahun_akademik',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    public function dataLengkapMahasiswa()
    {
        return $this->hasMany(DataLengkapMahasiswa::class, 'tahun_akademik_id', 'id');
    }
}
