<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen_tabel';

    protected $primaryKey = 'NIP';

    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'NIP',
        'nama',
        'fakultas',
        'prodi',
        'jabatan_akademik',
        'email',
        'no_telepon',
        'status_aktif'
    ];

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'nip_dosen', 'NIP');
    }

    public function capaianPrestasi()
    {
        return $this->hasMany(CapaianPrestasi::class, 'NIP', 'NIP');
    }
}
