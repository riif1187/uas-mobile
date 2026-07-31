---
sidebar_position: 1
title: API Reference
---

# API Reference

Semua endpoint API berada di bawah prefix **`/api`** dan melayani aplikasi Flutter. Respons dalam format **JSON**. Semua endpoint (kecuali `login` & `register`) memerlukan header `Authorization: Bearer <token>`.

**Base URL (lokal):** `http://127.0.0.1:8000/api`  
**Base URL (ngrok):** `https://carpentry-deserve-shining.ngrok-free.dev/api`

## Autentikasi

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/api/register` | Registrasi akun baru (publik) |
| POST | `/api/login` | Login, mengembalikan token (publik) |
| POST | `/api/logout` | Logout, menghapus token aktif |
| GET | `/api/me` | Data user yang sedang login |

### Contoh Login

```http
POST /api/login
Content-Type: application/json

{ "email": "mahasiswa@admin.com", "password": "password" }
```

```json
{
  "message": "Login berhasil",
  "user": { "id": 4, "name": "Mahasiswa User", "email": "mahasiswa@admin.com" },
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

## Mahasiswa

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/mahasiswa` | List mahasiswa (paginate 25) |
| POST | `/api/mahasiswa` | Tambah mahasiswa |
| GET | `/api/mahasiswa/{NIM}` | Detail mahasiswa |
| PUT/PATCH | `/api/mahasiswa/{NIM}` | Perbarui mahasiswa |
| DELETE | `/api/mahasiswa/{NIM}` | Hapus mahasiswa |
| GET | `/api/mahasiswa/by-email/{email}` | Cari mahasiswa by email (untuk dapat NIM) |
| GET | `/api/mahasiswa/{nim}/fuzzy` | Klasifikasi fuzzy satu mahasiswa |
| POST | `/api/mahasiswa/{nim}/fuzzy/refresh` | Hitung ulang & simpan klasifikasi |
| GET | `/api/fuzzy` | **Leaderboard** klasifikasi semua mahasiswa |

### Respons `/api/fuzzy`

```json
{
  "data": [
    {
      "NIM": "2155201110011",
      "nama": "DICKI PRASTIA PAUZI",
      "fakultas": "Teknik",
      "prodi": "Informatika",
      "jumlah_prestasi": 1,
      "total_poin": 40,
      "peringkat_terbaik": 1,
      "skor_fuzzy": "40.00",
      "label_fuzzy": "Cukup Berprestasi"
    }
  ]
}
```

## Referensi Kejuaraan

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/referensi-kejuaraan` | List referensi kejuaraan |
| POST | `/api/referensi-kejuaraan` | Tambah referensi |
| GET | `/api/referensi-kejuaraan/{ref_id}` | Detail |
| PUT/PATCH | `/api/referensi-kejuaraan/{ref_id}` | Perbarui |
| DELETE | `/api/referensi-kejuaraan/{ref_id}` | Hapus |

## Pendaftaran Prestasi

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/pendaftaran-prestasi?nim=` | List pendaftaran (bisa filter nim) |
| POST | `/api/pendaftaran-prestasi` | Tambah pendaftaran (status default `disetujui`) |
| GET | `/api/pendaftaran-prestasi/{id}` | Detail |
| PUT/PATCH | `/api/pendaftaran-prestasi/{id}` | Perbarui |
| DELETE | `/api/pendaftaran-prestasi/{id}` | Hapus |

Body tambah pendaftaran:

```json
{
  "NIM": "2155201110011",
  "ref_id": "REF-1A2B3",
  "nama_kegiatan": "Lomba Karya Tulis Ilmiah"
}
```

## Capaian Prestasi

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/capaian-prestasi` | List capaian |
| POST | `/api/capaian-prestasi` | Tambah capaian (multipart, opsi file) |
| GET | `/api/capaian-prestasi/{id}` | Detail |
| PUT/PATCH | `/api/capaian-prestasi/{id}` | Perbarui |
| DELETE | `/api/capaian-prestasi/{id}` | Hapus |

Body tambah capaian:

```json
{
  "pendaftaran_id": "REG-073CE",
  "peringkat": "Juara 1",
  "NIP": "20100120044",
  "file_bukti": "<file opsional>"
}
```

## Dosen, Mata Kuliah, Tahun Akademik

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET/POST | `/api/dosen`, `/api/dosen/{NIP}` | CRUD dosen |
| GET/POST | `/api/mata-kuliah`, `/api/mata-kuliah/{kode_matkul}` | CRUD mata kuliah |
| GET/POST | `/api/tahun-akademik`, `/api/tahun-akademik/{id}` | CRUD tahun akademik |

## Bimbingan & Data Lengkap

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET/POST | `/api/bimbingan` | CRUD bimbingan (filter `?nim=`) |
| GET/POST | `/api/data-lengkap-mahasiswa` | CRUD data lengkap (filter `?nim=`) |

## Hak Akses & User

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET/POST | `/api/roles`, `/api/roles/{id}` | CRUD roles |
| GET/POST | `/api/permissions`, `/api/permissions/{id}` | CRUD permissions |
| GET/POST | `/api/users`, `/api/users/{id}` | CRUD users |

## Format Respons Standar

- **Resource tunggal**: `{ "data": { ... } }`
- **Collection**: `{ "data": [ ... ] }`
- **Resource + pesan**: `{ "data": { ... }, "message": "..." }`
- **Error**: `{ "message": "...", "errors": { "field": ["..."] } }` (status 4xx/5xx)

## Kode Status Umum

| Status | Arti |
|--------|------|
| 200 | Sukses |
| 201 | Berhasil dibuat |
| 401 | Token tidak valid / belum login |
| 404 | Data tidak ditemukan |
| 422 | Validasi gagal |
| 500 | Error server |
