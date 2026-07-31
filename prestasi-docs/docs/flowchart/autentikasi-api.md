---
sidebar_position: 4
title: Alur Autentikasi API
---

# Alur Autentikasi API (Sanctum)

Aplikasi Flutter mengonsumsi API dengan autentikasi **Bearer Token** (Laravel Sanctum).

## Flowchart

```mermaid
flowchart TD
    Start([Aplikasi dibuka]) --> Tok{Token tersimpan?}
    Tok -- Ya --> Me[GET /api/me]
    Me --> Ok1{Valid?}
    Ok1 -- Ya --> Home[Menuju Dashboard]
    Ok1 -- Tidak --> Login
    Tok -- Tidak --> Login[Halaman Login]
    Login --> Sub[POST /api/login<br/>email + password]
    Sub --> Ok2{Status 200?}
    Ok2 -- Ya --> Save[Simpan token & user]
    Save --> Nim[GET /api/mahasiswa/by-email]
    Nim --> Home
    Ok2 -- Tidak --> Err[Tampilkan error] --> Login
    Home --> Req[Request API ber-token]
    Req --> Middleware[Middleware auth:sanctum]
    Middleware --> Auth{Token valid?}
    Auth -- Ya --> Proc[Eksekusi controller]
    Auth -- Tidak --> U401[401 Unauthorized]
```

## Format Request

Setiap request API (selain login/register) menyertakan header:

```http
Authorization: Bearer <token>
Accept: application/json
```

## Sequence Login

```mermaid
sequenceDiagram
    participant F as Flutter (ApiService)
    participant API as Laravel API
    participant DB as Database
    F->>API: POST /api/login {email, password}
    API->>DB: User::where(email)->first + Hash::check
    API-->>F: 200 { token, user }
    F->>F: simpan token (shared prefs)
    F->>API: GET /api/me (Bearer)
    API-->>F: 200 { user }
    F->>API: GET /api/mahasiswa/by-email/{email}
    API-->>F: 200 { data: { NIM, ... } }
```

## Logout

```mermaid
flowchart LR
    A[Flutter panggil POST /api/logout] --> B[Token aktif dihapus]
    B --> C[Response 200]
    C --> D[Flutter bersihkan token lokal]
    D --> E[Kembali ke halaman login]
```
