<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'mahasiswa' => ['read', 'create', 'update', 'delete', 'export'],
            'dosen' => ['read', 'create', 'update', 'delete'],
            'mata-kuliah' => ['read', 'create', 'update', 'delete'],
            'tahun-akademik' => ['read', 'create', 'update', 'delete'],
            'bimbingan' => ['read', 'create', 'update', 'delete'],
            'referensi-kejuaraan' => ['read', 'create', 'update', 'delete'],
            'pendaftaran-prestasi' => ['read', 'create', 'update', 'delete', 'verify'],
            'capaian-prestasi' => ['read', 'create', 'update', 'delete'],
            'data-lengkap-mahasiswa' => ['read', 'create', 'update', 'delete'],
            'hak-akses' => ['read', 'create', 'update', 'delete'],
        ];

        foreach ($modules as $modul => $actions) {
            foreach ($actions as $aksi) {
                Permission::updateOrCreate(
                    ['modul' => $modul, 'aksi' => $aksi],
                    ['nama_permission' => ucfirst($aksi) . ' ' . str_replace('-', ' ', ucfirst($modul))]
                );
            }
        }
    }
}