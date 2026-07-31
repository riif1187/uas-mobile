---
sidebar_position: 2
title: Akun Bawaan (Seed)
---

# Akun Bawaan (Seed)

Seeder `database/seeders/DatabaseSeeder.php` membuat akun default dengan password `password`.

## Akun Login (tabel `users`)

| Nama | Email | Role | Level |
|------|-------|------|-------|
| Admin User | `admin@admin.com` | administrator | Tertinggi |
| Operator User | `operator@admin.com` | operator | Sedang |
| Dosen User | `dosen@admin.com` | dosen | Sedang |
| Mahasiswa User | `mahasiswa@admin.com` | mahasiswa | Rendah |

**Password semua akun:** `password`

## Data Mahasiswa (tabel `mahasiswa_tabel`)

Seeder menyediakan data mahasiswa dengan email `@gmail.com` (mis. `dicki.prastia@gmail.com` → NIM `2155201110011`).

> **Penting**: Akun login (`users`) dan data mahasiswa (`mahasiswa_tabel`) adalah **dua entitas terpisah**. NIM pengguna diambil dari pencocokan email antara keduanya (`GET /api/mahasiswa/by-email/{email}`). Jika email akun tidak cocok dengan data mahasiswa, NIM tidak ditemukan.

## Cara Menambahkan Akun Login untuk Mahasiswa

Jika ingin akun mahasiswa bisa login dengan NIM terdeteksi, buat user dengan email yang sama dengan `mahasiswa_tabel.email`:

```bash
php artisan tinker --execute="
  \App\Models\User::updateOrCreate(
    ['email' => 'dicki.prastia@gmail.com'],
    ['name' => 'DICKI PRASTIA PAUZI', 'password' => bcrypt('password')]
  );
"
```

## Reset Database

```bash
php artisan migrate:fresh --seed
```
