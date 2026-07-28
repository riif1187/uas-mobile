<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nama'              => 'Ahmad Rizki Pratama',
            'NIM'               => '2024001',
            'fakultas'          => 'Fakultas Teknik',
            'prodi'             => 'Teknik Informatika',
            'tempat_lahir'      => 'Jakarta',
            'tanggal_lahir'     => '2003-05-15',
            'jenis_kelamin'     => 'L',
            'email'             => 'ahmad.rizki@email.com',
            'no_telepon'        => '081234567890',
            'alamat'            => 'Jl. Merdeka No. 123, Jakarta Pusat',
            'agama'             => 'Islam',
            'kewarganegaraan'   => 'WNI',
            'golongan_darah'    => 'O+',
            'status_pernikahan' => 'Belum Menikah',
            'status_aktif'      => 'Aktif'
        ]);

        Mahasiswa::create([
            'nama'              => 'Siti Nurhaliza',
            'NIM'               => '2024002',
            'fakultas'          => 'Fakultas Sains',
            'prodi'             => 'Sistem Informasi',
            'tempat_lahir'      => 'Bandung',
            'tanggal_lahir'     => '2004-03-20',
            'jenis_kelamin'     => 'P',
            'email'             => 'siti.nurhaliza@email.com',
            'no_telepon'        => '082345678901',
            'alamat'            => 'Jl. Diponegoro No. 456, Bandung',
            'agama'             => 'Islam',
            'kewarganegaraan'   => 'WNI',
            'golongan_darah'    => 'A-',
            'status_pernikahan' => 'Belum Menikah',
            'status_aktif'      => 'Aktif'
        ]);

        Mahasiswa::create([
            'nama'              => 'Budi Santoso',
            'NIM'               => '2024003',
            'fakultas'          => 'Fakultas Teknik',
            'prodi'             => 'Teknik Elektro',
            'tempat_lahir'      => 'Surabaya',
            'tanggal_lahir'     => '2003-08-10',
            'jenis_kelamin'     => 'L',
            'email'             => 'budi.santoso@email.com',
            'no_telepon'        => '083456789012',
            'alamat'            => 'Jl. Ahmad Yani No. 789, Surabaya',
            'agama'             => 'Kristen',
            'kewarganegaraan'   => 'WNI',
            'golongan_darah'    => 'B+',
            'status_pernikahan' => 'Belum Menikah',
            'status_aktif'      => 'Aktif'
        ]);

        Mahasiswa::create([
            'nama'              => 'Rina Wijaya',
            'NIM'               => '2024004',
            'fakultas'          => 'Fakultas Ekonomi',
            'prodi'             => 'Manajemen',
            'tempat_lahir'      => 'Yogyakarta',
            'tanggal_lahir'     => '2003-12-05',
            'jenis_kelamin'     => 'P',
            'email'             => 'rina.wijaya@email.com',
            'no_telepon'        => '084567890123',
            'alamat'            => 'Jl. Malioboro No. 321, Yogyakarta',
            'agama'             => 'Islam',
            'kewarganegaraan'   => 'WNI',
            'golongan_darah'    => 'AB+',
            'status_pernikahan' => 'Belum Menikah',
            'status_aktif'      => 'Tidak Aktif'
        ]);
    }
}
