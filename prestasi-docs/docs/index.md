---
sidebar_position: 1
title: Beranda
slug: /
hide_title: true
hide_table_of_contents: true
---

<div class="lp-hero">
  <div class="lp-badge">Dokumentasi Sistem Pencatatan Prestasi Mahasiswa</div>
  <h1 class="lp-title">Satu sistem, <em>dua aplikasi</em>,<br />klasifikasi prestasi berbasis fuzzy</h1>
  <p class="lp-subtitle">Dokumentasi lengkap untuk aplikasi Flutter (mobile & web) dan web admin Laravel — berbagi satu basis data dan satu API dengan perankingan prestasi menggunakan Fuzzy Logic (Mamdani).</p>
  <div class="lp-cta">
    <a class="lp-btn lp-btn-primary" href="/flutter/overview">Mulai dari Aplikasi Flutter</a>
    <a class="lp-btn lp-btn-secondary" href="/database/erd">Lihat ERD Database</a>
  </div>
  <div class="lp-pills">
    <span>Flutter</span><span>Dart 3</span><span>Provider</span><span>Dio</span><span>Material 3</span><span>Laravel 13</span><span>Blade</span><span>Bootstrap 5</span><span>MySQL</span><span>Sanctum</span><span>Fuzzy Mamdani</span>
  </div>
</div>

## Dua Aplikasi, Satu Sistem

<div class="lp-grid">

<a class="lp-card" href="/flutter/overview">
  <div class="lp-card-top"><span class="lp-card-tag">Mobile &amp; Web</span></div>
  <h3>Aplikasi Flutter — Prestasi Mahasiswa</h3>
  <p>Aplikasi lintas platform untuk mahasiswa: dashboard klasifikasi, pendaftaran prestasi, input capaian, leaderboard fuzzy, bimbingan, dan data akademik.</p>
  <span class="lp-card-more">Baca dokumentasi →</span>
</a>

<a class="lp-card" href="/laravel/overview">
  <div class="lp-card-top"><span class="lp-card-tag">Web Admin</span></div>
  <h3>Web Laravel — Sistem Pencatatan Prestasi</h3>
  <p>Web admin berbasis Blade untuk operator & dosen: landing page berstatistik, CRUD lengkap, verifikasi pendaftaran, serta manajemen role & permission.</p>
  <span class="lp-card-more">Baca dokumentasi →</span>
</a>

</div>

## Jelajahi Dokumentasi

<div class="lp-grid">

<a class="lp-card" href="/database/erd">
  <div class="lp-card-top"><span class="lp-card-tag">Data</span></div>
  <h3>Database</h3>
  <p>ERD 17 tabel dan penjelasan relasi antar tabel — mahasiswa, dosen, pendaftaran, capaian, klasifikasi fuzzy, hingga RBAC.</p>
  <span class="lp-card-more">Buka ERD →</span>
</a>

<a class="lp-card" href="/flowchart/sistem">
  <div class="lp-card-top"><span class="lp-card-tag">Alur</span></div>
  <h3>Flowchart Sistem</h3>
  <p>Alur pendaftaran → capaian → klasifikasi, proses fuzzy Mamdani, dan alur autentikasi API.</p>
  <span class="lp-card-more">Lihat flowchart →</span>
</a>

<a class="lp-card" href="/api/reference">
  <div class="lp-card-top"><span class="lp-card-tag">Backend</span></div>
  <h3>API Reference</h3>
  <p>Daftar lengkap endpoint API, format respons, dan contoh body request untuk integrasi aplikasi.</p>
  <span class="lp-card-more">Buka reference →</span>
</a>

<a class="lp-card" href="/deployment/arsitektur">
  <div class="lp-card-top"><span class="lp-card-tag">Penyebaran</span></div>
  <h3>Deployment</h3>
  <p>Arsitektur satu-origin — Flutter dan Laravel dalam satu URL — beserta script otomatisasi deploy.</p>
  <span class="lp-card-more">Baca deployment →</span>
</a>

<a class="lp-card" href="/panduan/menjalankan">
  <div class="lp-card-top"><span class="lp-card-tag">Mulai</span></div>
  <h3>Panduan</h3>
  <p>Cara menjalankan backend, aplikasi, dan situs ini, plus daftar akun bawaan dari seeder.</p>
  <span class="lp-card-more">Baca panduan →</span>
</a>

<a class="lp-card" href="/laravel/modul">
  <div class="lp-card-top"><span class="lp-card-tag">Fitur</span></div>
  <h3>Modul & Fitur</h3>
  <p>Rincian modul kedua aplikasi, skema RBAC, dan fitur unggulan sistem pencatatan prestasi mahasiswa.</p>
  <span class="lp-card-more">Lihat modul →</span>
</a>

</div>

## Diagram Ringkas Sistem

```mermaid
flowchart LR
    subgraph Apps
        F[Flutter App<br/>Mobile & Web] --> API
        L[Web Laravel<br/>Admin] --> API
    end
    API[API Laravel<br/>/api] --> DB[(MySQL<br/>db_tugas)]
    DB --> FZ[(fuzzy_klasifikasi)]
    API --> FZ
```
