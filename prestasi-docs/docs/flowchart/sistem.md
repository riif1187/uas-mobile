---
sidebar_position: 1
title: Flowchart Sistem
---

# Flowchart Sistem

## Arsitektur Keseluruhan

```mermaid
flowchart TB
    subgraph Pengguna
        M[Mahasiswa] -->|Flutter App| F[Flutter Web<br/>Mobile & Web]
        O[Operator / Dosen] -->|Web Admin| L[Web Laravel Blade]
    end
    F -->|HTTP /api| API[API Laravel<br/>routes/api.php]
    L -->|Sesi / Blaze| WEB[Web Laravel<br/>routes/web.php]
    API --> DB[(MySQL db_tugas)]
    WEB --> DB
    DB --> FUZZY[FuzzyPrestasiService]
    FUZZY --> DB
    FUZZY --> HASIL[fuzzy_klasifikasi<br/>skor & label]
    HASIL --> F
    HASIL --> L
```

## Alur Data Prestasi

```mermaid
flowchart LR
    R[Referensi Kejuaraan<br/>bobot poin] --> P[Pendaftaran<br/>status disetujui]
    P --> C[Capaian<br/>peringkat + bukti]
    C --> FZ[Perhitungan Fuzzy]
    FZ --> K[Klasifikasi<br/>skor + label]
    K --> LB[Leaderboard]
```

## Diagram Use-Case Ringkas

```mermaid
flowchart TD
    A[Mahasiswa] -->|Login / Register| Auth[Autentikasi]
    A -->|Daftarkan prestasi| PF[Pendaftaran Prestasi]
    A -->|Input capaian| CF[Capaian Prestasi]
    A -->|Lihat klasifikasi| FU[Fuzzy Leaderboard]
    B[Dosen] -->|Verifikasi pendaftaran| PF
    B -->|Input bimbingan| BM[Bimbingan]
    C[Admin/Operator] -->|CRUD master| DS[Data Mahasiswa/Dosen/Matkul]
    C -->|Kelola hak akses| RBAC[Roles & Permissions]
```

## Peta Halaman

| Aplikasi | Alur Halaman |
|----------|--------------|
| Flutter | Splash → Login → MainShell (8 menu) |
| Web Laravel | Landing → Login → Dashboard/Data Mahasiswa → modul CRUD |
