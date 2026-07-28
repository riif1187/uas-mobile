<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'nama_role',
        'slug',
        'deskripsi',
        'level_akses',
        'is_active'
    ];

    // Relasi: satu role dimiliki banyak user (melalui tabel role_user)
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    // Relasi: satu role punya banyak permission (melalui tabel role_permission)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}