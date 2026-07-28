<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'nama_permission',
        'modul',
        'aksi',
        'deskripsi'
    ];

    // Relasi: satu permission bisa dimiliki banyak role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}