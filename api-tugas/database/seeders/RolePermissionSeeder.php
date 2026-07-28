<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Definisikan Modul
        $moduls = [
            'mahasiswa',
            'dosen',
            'mata-kuliah',
            'tahun-akademik',
            'bimbingan',
            'data-lengkap-mahasiswa',
            'referensi-kejuaraan',
            'pendaftaran-prestasi',
            'capaian-prestasi',
            'hak-akses'
        ];

        // 2. Definisikan Aksi
        $aksis = [
            'read'   => 'Lihat',
            'create' => 'Tambah',
            'update' => 'Edit',
            'delete' => 'Hapus',
            'export' => 'Export',
            'verify' => 'Verifikasi'
        ];

        // 3. Buat Permissions
        $allPermissions = [];
        foreach ($moduls as $modul) {
            $actions = ['read', 'create', 'update', 'delete'];
            if ($modul == 'mahasiswa') $actions[] = 'export';
            if ($modul == 'pendaftaran-prestasi') $actions[] = 'verify';

            foreach ($actions as $aksi) {
                $label = $aksis[$aksi];
                $permission = Permission::updateOrCreate(
                    ['modul' => $modul, 'aksi' => $aksi],
                    [
                        'nama_permission' => $label . ' ' . Str::title(str_replace('-', ' ', $modul)),
                        'deskripsi' => $label . ' data pada modul ' . $modul
                    ]
                );
                $allPermissions[] = $permission->id;
            }
        }

        // 4. Buat Roles
        $roleConfigs = [
            'administrator' => [
                'name' => 'Administrator',
                'level' => 10,
                'description' => 'Akses penuh ke seluruh sistem',
                'perms' => $allPermissions
            ],
            'operator' => [
                'name' => 'Operator',
                'level' => 8,
                'description' => 'Mengelola data master mahasiswa, dosen, dan akademik',
                'perms' => Permission::whereIn('modul', [
                    'mahasiswa', 'dosen', 'mata-kuliah', 'tahun-akademik', 'referensi-kejuaraan', 'data-lengkap-mahasiswa'
                ])->pluck('id')->toArray()
            ],
            'dosen' => [
                'name' => 'Dosen',
                'level' => 5,
                'description' => 'Mengelola bimbingan dan verifikasi prestasi mahasiswa',
                'perms' => Permission::where(function($q) {
                    $q->where('modul', 'bimbingan')
                      ->orWhere(function($sq) {
                          $sq->where('modul', 'pendaftaran-prestasi')->whereIn('aksi', ['read', 'verify']);
                      })
                      ->orWhere(function($sq) {
                          $sq->whereIn('modul', ['mahasiswa', 'mata-kuliah', 'capaian-prestasi', 'referensi-kejuaraan'])->where('aksi', 'read');
                      });
                })->pluck('id')->toArray()
            ],
            'mahasiswa' => [
                'name' => 'Mahasiswa',
                'level' => 1,
                'description' => 'Mengajukan prestasi dan melihat bimbingan',
                'perms' => Permission::where(function($q) {
                    $q->whereIn('modul', ['pendaftaran-prestasi', 'data-lengkap-mahasiswa'])
                      ->orWhere(function($sq) {
                          $sq->whereIn('modul', ['bimbingan', 'referensi-kejuaraan'])->where('aksi', 'read');
                      });
                })->pluck('id')->toArray()
            ],
        ];

        foreach ($roleConfigs as $slug => $data) {
            $role = Role::updateOrCreate(
                ['slug' => $slug],
                [
                    'nama_role' => $data['name'],
                    'deskripsi' => $data['description'],
                    'level_akses' => $data['level'],
                    'is_active' => true
                ]
            );
            $role->permissions()->sync($data['perms']);
        }

        // 5. Buat Akun Contoh
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@admin.com', 'role' => 'administrator'],
            ['name' => 'Operator User', 'email' => 'operator@admin.com', 'role' => 'operator'],
            ['name' => 'Dosen User', 'email' => 'dosen@admin.com', 'role' => 'dosen'],
            ['name' => 'Mahasiswa User', 'email' => 'mahasiswa@admin.com', 'role' => 'mahasiswa'],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                ]
            );
            $user->roles()->sync([Role::where('slug', $userData['role'])->first()->id]);
        }
    }
}
