<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = 'bimbingan';

    protected $guarded = ['id'];

    protected $fillable = [
        'nim_mahasiswa',
        'nip_dosen',
        'tanggal_bimbingan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'NIM');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip_dosen', 'NIP');
    }
}
