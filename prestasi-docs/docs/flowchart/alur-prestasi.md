---
sidebar_position: 2
title: Alur Pendaftaran → Capaian → Klasifikasi
---

# Alur Pendaftaran → Capaian → Klasifikasi

## Flowchart Lengkap

```mermaid
flowchart TD
    Start([Mahasiswa membuka menu Pendaftaran]) --> Form[Isi NIM, pilih kejuaraan, nama kegiatan]
    Form --> Save[POST /api/pendaftaran-prestasi]
    Save --> Status[status otomatis: disetujui]
    Status --> List[Daftar pendaftaran ter-update]
    List --> InCap{Input capaian?}
    InCap -- Ya --> CapForm[Isi peringkat, NIP dosen, upload bukti]
    CapForm --> CapSave[POST /api/capaian-prestasi]
    CapSave --> Fuzz[Klasifikasi fuzzy dihitung ulang]
    InCap -- Tidak --> List
    Fuzz --> Leader[Leaderboard fuzzy menampilkan hasil baru]
```

## Alur Verifikasi (Web Admin)

```mermaid
flowchart TD
    A[Pendaftaran status pending] --> B{Admin/Dosen verifikasi}
    B -- Setujui --> C[disetujui]
    B -- Tolak --> D[tidak_disetujui]
    C --> E[Diperhitungkan fuzzy: +prestasi +poin +peringkat]
    D --> F[Diabaikan fuzzy]
```

## Ringkasan Status

| Status | Dihitung Fuzzy | Keterangan |
|--------|----------------|------------|
| `disetujui` | ✅ Ya | Masuk agregasi jumlah prestasi, poin, peringkat |
| `pending` | ❌ Tidak | Menunggu verifikasi |
| `tidak_disetujui` | ❌ Tidak | Ditolak |

> **Catatan**: Pada aplikasi Flutter, pendaftaran baru otomatis berstatus `disetujui` sehingga langsung memengaruhi klasifikasi fuzzy.
