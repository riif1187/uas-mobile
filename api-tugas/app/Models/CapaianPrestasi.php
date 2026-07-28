<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianPrestasi extends Model
{
    protected $table = 'capaian_prestasi';

    protected $primaryKey = 'capaian_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pendaftaran_id',
        'peringkat',
        'file_bukti',
        'NIP',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->capaian_id)) {
                $model->capaian_id = 'CAP-' . strtoupper(substr(uniqid(), -5));
            }
        });
    }

    public function pendaftaranPrestasi()
    {
        return $this->belongsTo(PendaftaranPrestasi::class, 'pendaftaran_id', 'pendaftaran_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'NIP', 'NIP');
    }
}
