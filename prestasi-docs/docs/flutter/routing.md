---
sidebar_position: 4
title: Routing & Navigasi
---

# Routing & Navigasi

## Route Aplikasi

Semua route didefinisikan di `lib/main.dart`:

| Route | Halaman |
|-------|---------|
| `/` | SplashScreen |
| `/login` | LoginScreen |
| `/register` | RegisterScreen |
| `/home` | MainShellScreen (shell utama) |
| `/profile` | ProfileScreen |
| `/referensi` | ReferensiScreen |
| `/pendaftaran-list` | PendaftaranListScreen |
| `/pendaftaran-create` | PendaftaranCreateScreen |
| `/capaian-list` | CapaianListScreen |
| `/capaian-create` | CapaianCreateScreen |
| `/bimbingan` | BimbinganScreen |
| `/fuzzy` | FuzzyKlasifikasiScreen |
| `/data-lengkap` | DataLengkapScreen |

## Alur Navigasi Awal

```mermaid
flowchart TD
    A[SplashScreen] --> B{Auto-login?}
    B -- Ya --> C[/home - MainShell/]
    B -- Tidak --> D[/login/]
    D --> E{Berhasil?}
    E -- Ya --> C
    E -- Tidak --> D
    C --> F[Pilih menu]
    F --> G[Profil / Referensi / Pendaftaran / Capaian / Bimbingan / Fuzzy / Data Akademik]
    C --> H[Logout] --> D
```

## MainShellScreen — Shell Responsive

`MainShellScreen` menampung 8 halaman utama dalam `IndexedStack` (state tiap halaman tetap terjaga saat berpindah menu). Navigasi menyesuaikan lebar layar:

```mermaid
flowchart LR
    A[LayoutBuilder] --> B{maxWidth >= 850?}
    B -- Ya --> C[Sidebar kiri 240px<br/>+ IndexedStack]
    B -- Tidak --> D[Bottom Navigation<br/>Dashboard - Profil - Pendaftaran - Fuzzy - Lainnya]
    D --> E[Sheet Lainnya:<br/>Referensi, Capaian, Bimbingan,<br/>Data Akademik, Logout]
```

### Daftar Menu

| # | Menu | Ikon | Indeks |
|---|------|------|--------|
| 1 | Dashboard | dashboard | 0 |
| 2 | Profil | person | 1 |
| 3 | Referensi | emoji_events | 2 |
| 4 | Pendaftaran | assignment | 3 |
| 5 | Capaian | verified | 4 |
| 6 | Bimbingan | forum | 5 |
| 7 | Fuzzy | auto_graph | 6 |
| 8 | Data Akademik | book | 7 |

## Penentuan NIM Pengguna

Setelah login, aplikasi mengambil NIM melalui `GET /api/mahasiswa/by-email/{email}`. NIM inilah yang dipakai untuk:

- Memuat klasifikasi fuzzy pribadi
- Mengisi otomatis NIM pada form pendaftaran prestasi

Jika akun tidak terhubung ke data mahasiswa (NIM tidak ditemukan), aplikasi tetap bisa digunakan untuk melihat **leaderboard fuzzy** semua mahasiswa.
