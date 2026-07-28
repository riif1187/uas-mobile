<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranPrestasi extends Model
{
    protected $table = 'pendaftaran_prestasi';

    protected $primaryKey = 'pendaftaran_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIM',
        'ref_id',
        'nama_kegiatan',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->pendaftaran_id)) {
                $model->pendaftaran_id = 'REG-' . strtoupper(substr(uniqid(), -5));
            }
        });
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }

    public function referensiKejuaraan()
    {
        return $this->belongsTo(ReferensiKejuaraan::class, 'ref_id', 'ref_id');
    }

    public function capaianPrestasi()
    {
        return $this->hasOne(CapaianPrestasi::class, 'pendaftaran_id', 'pendaftaran_id');
    }
}
