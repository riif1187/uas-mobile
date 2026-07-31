---
sidebar_position: 1
title: Overview
---

# Web Laravel — Sistem Pencatatan Prestasi Mahasiswa

## Deskripsi

**Web Laravel** adalah aplikasi web admin (berbasis server-side rendering Blade) untuk mengelola seluruh data sistem pencatatan prestasi mahasiswa. Digunakan oleh **admin, operator, dan dosen** untuk:

- Mengelola data master (mahasiswa, dosen, mata kuliah, tahun akademik, referensi kejuaraan)
- Mencatat & **memverifikasi** pendaftaran prestasi
- Mengelola capaian prestasi beserta file bukti
- Mengelola bimbingan dan data lengkap mahasiswa
- Mengelola **hak akses** (role & permission)
- Menampilkan **landing page** dengan statistik, klasifikasi fuzzy, dan grafik
- Menampilkan grafik fungsi keanggotaan fuzzy

Aplikasi ini sekaligus menjadi **backend API** (`/api/*`) yang dikonsumsi oleh aplikasi Flutter.

## Tech Stack

| Teknologi | Kegunaan |
|-----------|----------|
| **Laravel 13** | Framework PHP |
| **Blade** | Template engine (server-side) |
| **Bootstrap 5** | UI/UX web admin |
| **MySQL** | Database (`db_tugas`) |
| **Laravel Sanctum** | Autentikasi token API |
| **Eloquent ORM** | Akses database |
| **Mermaid/SVG** | Grafik pada landing page (inline SVG) |

## Lokasi Proyek

```
C:\projectflutter\prestasi-mahasiswa\api-tugas\
```

## Struktur Server

| Bagian | Lokasi |
|--------|--------|
| Routes web (Blade) | `routes/web.php` |
| Routes API | `routes/api.php` |
| Controller | `app/Http/Controllers/` |
| Model | `app/Models/` |
| Service (Fuzzy) | `app/Services/FuzzyPrestasiService.php` |
| Resource (JSON) | `app/Http/Resources/` |
| View (Blade) | `resources/views/` |
| Migration | `database/migrations/` |
| Front controller | `public/index.php` |

## Dua Peran Penting

1. **Web Admin (Blade)** — antarmuka pengelolaan data untuk pengguna dengan sesi (session-based auth).
2. **API (JSON)** — service stateless untuk aplikasi Flutter dengan autentikasi token Sanctum.
