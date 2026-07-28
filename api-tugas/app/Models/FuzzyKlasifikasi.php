<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyKlasifikasi extends Model
{
    protected $table = 'fuzzy_klasifikasi';

    protected $fillable = [
        'NIM', 'jumlah_prestasi', 'total_poin',
        'peringkat_terbaik', 'skor_fuzzy', 'label_fuzzy',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }
}
