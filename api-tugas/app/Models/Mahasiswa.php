<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa_tabel';

    protected $primaryKey = 'NIM';
    
    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'nama',
        'NIM',
        'fakultas',
        'prodi',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'email',
        'no_telepon',
        'alamat',
        'agama',
        'kewarganegaraan',
        'golongan_darah',
        'status_pernikahan',
        'status_aktif'
    ];

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'nim_mahasiswa', 'NIM');
    }

    public function dataLengkapMahasiswa()
    {
        return $this->hasMany(DataLengkapMahasiswa::class, 'nim_mahasiswa', 'NIM');
    }

    public function pendaftaranPrestasi()
    {
        return $this->hasMany(PendaftaranPrestasi::class, 'NIM', 'NIM');
    }
}