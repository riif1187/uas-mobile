<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
        // Tambahkan di dalam class User

    // Relasi: satu user bisa punya banyak role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Helper: cek apakah user punya role tertentu
    public function hasRole(string $slug): bool
    {
        return $this->roles()->where('slug', $slug)->exists();
    }

    // Helper: cek apakah user punya permission tertentu
    public function hasPermission(string $modul, string $aksi): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($modul, $aksi) {
                $query->where('modul', $modul)->where('aksi', $aksi);
            })->exists();
    }
}
