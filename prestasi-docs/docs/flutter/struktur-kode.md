---
sidebar_position: 3
title: Struktur Kode
---

# Struktur Kode Aplikasi Flutter

```
capaian_prestasi/
└── lib/
    ├── main.dart                       # Entry point & route
    ├── config/
    │   └── api_config.dart             # baseUrl & konstanta endpoint
    ├── models/
    │   ├── auth/
    │   │   └── user.dart
    │   ├── mahasiswa/
    │   │   ├── mahasiswa.dart
    │   │   ├── data_lengkap_mahasiswa.dart
    │   │   └── fuzzy_klasifikasi.dart
    │   └── prestasi/
    │       ├── bimbingan.dart
    │       ├── capaian_prestasi.dart
    │       ├── pendaftaran_prestasi.dart
    │       └── referensi_kejuaraan.dart
    ├── providers/
    │   ├── auth_provider.dart
    │   ├── mahasiswa_provider.dart
    │   ├── prestasi_provider.dart
    │   ├── bimbingan_provider.dart
    │   └── dosen_provider.dart
    ├── services/
    │   ├── auth/
    │   │   ├── api_service.dart        # Konfigurasi Dio + token
    │   │   └── auth_service.dart
    │   ├── mahasiswa/
    │   │   ├── mahasiswa_service.dart
    │   │   ├── fuzzy_service.dart
    │   │   └── dosen_service.dart
    │   └── prestasi/
    │       ├── bimbingan_service.dart
    │       ├── capaian_service.dart
    │       ├── pendaftaran_service.dart
    │       └── referensi_service.dart
    ├── screens/
    │   ├── splash_screen.dart
    │   ├── login_screen.dart
    │   ├── register_screen.dart
    │   ├── main_shell_screen.dart      # Sidebar / bottom-nav shell
    │   ├── home_screen.dart            # Dashboard
    │   ├── mahasiswa/
    │   │   ├── profile_screen.dart
    │   │   ├── data_lengkap_screen.dart
    │   │   └── fuzzy_klasifikasi_screen.dart
    │   ├── prestasi/
    │   │   ├── referensi_screen.dart
    │   │   ├── pendaftaran_list_screen.dart
    │   │   ├── pendaftaran_create_screen.dart
    │   │   ├── capaian_list_screen.dart
    │   │   └── capaian_create_screen.dart
    │   └── bimbingan/
    │       └── bimbingan_screen.dart
    └── widgets/
        └── fuzzy_card.dart             # Widget klasifikasi reusable
```

## Penjelasan Lapisan

| Folder | Peran |
|--------|-------|
| `config` | Konstanta endpoint API agar mudah diganti |
| `models` | Representasi data dari respons API |
| `providers` | State management dengan `ChangeNotifier` |
| `services` | Panggilan HTTP Dio; satu service per entitas |
| `screens` | Halaman UI; dikelompokkan per modul |
| `widgets` | Komponen reusable lintas halaman |

## Konfigurasi API (`api_config.dart`)

```dart
class ApiConfig {
  static const String baseUrl = 'https://carpentry-deserve-shining.ngrok-free.dev';
  static const String login = '/api/login';
  static const String register = '/api/register';
  static const String logout = '/api/logout';
  static const String me = '/api/me';
  static const String mahasiswa = '/api/mahasiswa';
  static const String fuzzy = '/api/fuzzy';
  static const String dosen = '/api/dosen';
  static const String bimbingan = '/api/bimbingan';
  static const String referensiKejuaraan = '/api/referensi-kejuaraan';
  static const String pendaftaranPrestasi = '/api/pendaftaran-prestasi';
  static const String capaianPrestasi = '/api/capaian-prestasi';
  static const String dataLengkapMahasiswa = '/api/data-lengkap-mahasiswa';
  static const String roles = '/api/roles';
  static const String permissions = '/api/permissions';
  static const String users = '/api/users';
}
```
