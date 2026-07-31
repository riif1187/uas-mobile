---
sidebar_position: 1
title: Overview
---

# Aplikasi Flutter — Prestasi Mahasiswa

## Deskripsi

Aplikasi **Prestasi Mahasiswa** adalah frontend lintas platform yang dibangun dengan Flutter. Aplikasi ini digunakan oleh **mahasiswa** untuk:

- Melihat klasifikasi prestasi mereka (Fuzzy Logic)
- Mendaftarkan prestasi / kejuaraan
- Menginput capaian beserta peringkat dan bukti
- Melihat daftar referensi kejuaraan dan bobot poin
- Mencatat bimbingan dengan dosen
- Melihat data akademik (mata kuliah & tahun akademik)
- Melihat **leaderboard klasifikasi fuzzy** seluruh mahasiswa

Aplikasi dikompilasi menjadi **Flutter Web** dan disajikan dari satu origin bersama API Laravel (lihat [Deployment](/deployment/arsitektur)).

## Tech Stack

| Teknologi | Kegunaan |
|-----------|----------|
| **Flutter** (Dart 3.11) | Framework UI lintas platform |
| **Provider** | State management (ChangeNotifier) |
| **Dio** | HTTP client untuk konsumsi API |
| **Material 3** | Design system (tema indigo) |
| **Sanctum Bearer Token** | Autentikasi ke API |

## Lokasi Proyek

```
C:\projectflutter\prestasi-mahasiswa\capaian_prestasi\
```

## Sumber Daya Utama

| File | Fungsi |
|------|--------|
| `lib/main.dart` | Entry point & definisi route |
| `lib/config/api_config.dart` | Konfigurasi base URL API |
| `lib/providers/` | State management |
| `lib/services/` | Lapisan komunikasi API |
| `lib/screens/` | Halaman aplikasi |
| `lib/models/` | Model data |
| `lib/widgets/` | Widget reusable |

## Fitur Utama

1. **Autentikasi** — login, registrasi, auto-login, logout
2. **Dashboard** — sapaan pengguna + kartu klasifikasi fuzzy
3. **Klasifikasi Fuzzy** — leaderboard seluruh mahasiswa, ranking & label berwarna
4. **Manajemen Prestasi** — pendaftaran prestasi & capaian (peringkat + file bukti)
5. **Referensi Kejuaraan** — daftar lomba beserta bobot poin
6. **Bimbingan** — catatan bimbingan dosen
7. **Data Akademik** — mata kuliah yang ditempuh per tahun akademik
8. **Responsive UI** — sidebar (desktop) / bottom navigation (mobile)
