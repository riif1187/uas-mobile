---
sidebar_position: 3
title: Proses Klasifikasi Fuzzy
---

# Proses Klasifikasi Fuzzy (Mamdani)

Klasifikasi menggunakan **Fuzzy Logic metode Mamdani** dengan tiga variabel input dan satu output.

## Variabel

| Variabel | Himpunan | Domain |
|----------|----------|--------|
| **Input 1: Jumlah Prestasi** | Sedikit, Sedang, Banyak | [0 – 10] |
| **Input 2: Total Poin** | Rendah, Sedang, Tinggi | [0 – 120] |
| **Input 3: Kualitas Peringkat** | Jauh, Mendekati, Terbaik | [1 – 50] |
| **Output: Skor Prestasi** | Kurang, Cukup, Berprestasi, Sangat | [0 – 100] |

## Flowchart Proses

```mermaid
flowchart TD
    Start([Data mahasiswa + prestasi disetujui]) --> Agg[Aggregasi input]
    Agg --> Jumlah[Jumlah prestasi<br/>count pendaftaran disetujui]
    Agg --> Poin[Total poin<br/>sum bobot_poin]
    Agg --> Rank[Peringkat terbaik<br/>min peringkat capaian]
    Jumlah --> Fuzz1[Fuzzifikasi<br/>fungsi trapezoid]
    Poin --> Fuzz2[Fuzzifikasi<br/>fungsi trapezoid]
    Rank --> Fuzz3[Fuzzifikasi<br/>fungsi trapezoid]
    Fuzz1 --> Rule[Inferensi 27 rule<br/>min-derajat & max-agregasi]
    Fuzz2 --> Rule
    Fuzz3 --> Rule
    Rule --> Defuzz[Defuzzifikasi centroid<br/>skor 0-100]
    Defuzz --> Label{Penentuan label}
    Label -- skor < 26 --> K1[Kurang Berprestasi]
    Label -- skor 26-50 --> K2[Cukup Berprestasi]
    Label -- skor 51-75 --> K3[Berprestasi]
    Label -- skor > 75 --> K4[Sangat Berprestasi]
    K1 --> Save[Simpan ke fuzzy_klasifikasi]
    K2 --> Save
    K3 --> Save
    K4 --> Save
```

## Fuzzifikasi — Fungsi Trapezoid

Derajat keanggotaan dihitung dengan fungsi trapezoid:

```mermaid
flowchart LR
    A[Nilai input x] --> B{trapezoid x, a, b, c, d}
    B -- x < a atau x > d --> C[0.0]
    B -- b <= x <= c --> D[1.0]
    B -- a <= x < b --> E[(x - a) / (b - a)]
    B -- c < x <= d --> F[(d - x) / (d - c)]
```

## Contoh Rule (3 dari 27)

| Jumlah Prestasi | Total Poin | Peringkat | Output |
|-----------------|------------|-----------|--------|
| Sedikit | Rendah | Terbaik | Cukup Berprestasi |
| Sedang | Sedang | Terbaik | Berprestasi |
| Banyak | Tinggi | Terbaik | Sangat Berprestasi |

## Defuzzifikasi

Skor akhir dihitung dengan **metode centroid** (titik berat) pada seluruh area output hasil agregasi:

```
skor = Σ (x * µ(x)) / Σ µ(x),  untuk x = 0..100
```

Hasil dibulatkan 2 desimal lalu dipetakan ke label.

## Kode Sumber

Implementasi berada di `app/Services/FuzzyPrestasiService.php`:

| Method | Fungsi |
|--------|--------|
| `trapezoid()` | Fungsi keanggotaan trapezoid |
| `fuzzifyJumlahPrestasi()` | Fuzzifikasi variabel 1 |
| `fuzzifyTotalPoin()` | Fuzzifikasi variabel 2 |
| `fuzzifyKualitasPeringkat()` | Fuzzifikasi variabel 3 |
| `defuzzify()` | Defuzzifikasi centroid |
| `classify($nim)` | Proses lengkap untuk satu mahasiswa |
| `classifyAll()` | Proses untuk semua mahasiswa (ranking) |
