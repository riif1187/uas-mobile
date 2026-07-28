<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferensiKejuaraan extends Model
{
    protected $table = 'referensi_kejuaraan';

    protected $primaryKey = 'ref_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_kejuaraan',
        'bobot_poin',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->ref_id)) {
                $model->ref_id = 'REF-' . strtoupper(substr(uniqid(), -5));
            }
        });
    }

    public function pendaftaranPrestasi()
    {
        return $this->hasMany(PendaftaranPrestasi::class, 'ref_id', 'ref_id');
    }
}
