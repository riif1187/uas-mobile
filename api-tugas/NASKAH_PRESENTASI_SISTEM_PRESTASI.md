# Naskah Presentasi Sistem Prestasi Mahasiswa

## 1. Pembukaan

Assalamu'alaikum warahmatullahi wabarakatuh.

Pada kesempatan ini saya akan mempresentasikan bagian utama dari sistem prestasi mahasiswa yang dibangun menggunakan Laravel. Fokus pembahasan saya adalah modul mahasiswa, dosen, referensi kejuaraan, pendaftaran prestasi, capaian prestasi, hak akses, dan halaman login.

Saya akan menjelaskan dari sisi migration, model, controller, view, dan route. Setelah itu saya juga menjelaskan relasi antar tabel serta fungsi setiap atribut penting pada tabel yang digunakan.

## 2. Gambaran Umum Arsitektur

Sistem ini menggunakan pola MVC, yaitu Model, View, dan Controller.

Migration digunakan untuk membentuk struktur tabel di database. Model digunakan untuk menghubungkan tabel database dengan kode Laravel melalui Eloquent. Controller digunakan untuk mengatur alur proses, seperti mengambil data, menyimpan data, memperbarui data, menghapus data, dan mengirim data ke view. View digunakan untuk menampilkan halaman kepada pengguna. Route digunakan untuk menghubungkan URL dengan controller atau proses tertentu.

Dengan pola ini, sistem menjadi lebih rapi karena bagian database, logika, tampilan, dan alamat URL memiliki tanggung jawab masing-masing.

## 3. Pemetaan File Teknis

Berikut pemetaan file yang digunakan pada modul yang dipresentasikan.

| Modul | Migration | Model | Controller | View | Route |
| --- | --- | --- | --- | --- | --- |
| Mahasiswa | `2026_04_30_031325_create_mahasiswa_tabel.php` | `Mahasiswa.php` | `MahasiswaController.php` | `resources/views/mahasiswa` | `create-mahasiswa`, `data-mahasiswa`, `edit-mahasiswa/{NIM}`, `update-mahasiswa/{NIM}`, dan lainnya |
| Dosen | `2026_05_11_065151_create_dosen_tabel.php` | `Dosen.php` | `DosenController.php` | `resources/views/dosen` | `create-dosen`, `data-dosen`, `edit-dosen/{NIP}`, `update-dosen/{NIP}`, dan lainnya |
| Referensi Kejuaraan | `2026_05_23_053201_create_referensi_kejuaraans_table.php` | `ReferensiKejuaraan.php` | `ReferensiKejuaraanController.php` | `resources/views/referensi-kejuaraan` | `create-referensi-kejuaraan`, `data-referensi-kejuaraan`, `edit-referensi-kejuaraan/{ref_id}`, dan lainnya |
| Pendaftaran Prestasi | `2026_05_23_053238_create_pendaftaran_prestasis_table.php` | `PendaftaranPrestasi.php` | `PendaftaranPrestasiController.php` | `resources/views/pendaftaran-prestasi` | `create-pendaftaran-prestasi`, `data-pendaftaran-prestasi`, `edit-pendaftaran-prestasi/{id}`, dan lainnya |
| Capaian Prestasi | `2026_05_23_053311_create_capaian_prestasis_table.php` | `CapaianPrestasi.php` | `CapaianPrestasiController.php` | `resources/views/capaian-prestasi` | `create-capaian-prestasi`, `data-capaian-prestasi`, `file-capaian-prestasi/{id}`, dan lainnya |
| Hak Akses | `create_roles_table`, `create_permissions_table`, `create_role_user_table`, `create_role_permissions_table` | `User.php`, `Role.php`, `Permission.php` | `RoleController.php` | `resources/views/hak-akses/roles` | `roles`, `roles/create`, `roles/{id}/edit`, dan lainnya |
| Login | `0001_01_01_000000_create_users_table.php` | `User.php` | Route closure di `routes/web.php` | `resources/views/auth/login.php` | `/login`, `/register`, `/logout` |

Route seluruh modul utama berada di `routes/web.php`. Modul data diletakkan dalam group middleware `auth`, sehingga pengguna wajib login sebelum masuk ke halaman sistem.

## 4. Modul Mahasiswa

Pada modul mahasiswa, migration membuat tabel `mahasiswa_tabel`. Tabel ini memakai `NIM` sebagai primary key, bukan `id` default Laravel. Hal ini karena NIM sudah menjadi identitas unik setiap mahasiswa.

Model yang digunakan adalah `Mahasiswa`. Di model ini, nama tabel diatur ke `mahasiswa_tabel`, primary key diatur ke `NIM`, tipe primary key adalah string, dan incrementing dibuat false karena NIM bukan angka auto increment.

Controller yang digunakan adalah `MahasiswaController`. Controller ini memiliki fungsi CRUD. Fungsi `index` menampilkan seluruh data mahasiswa, `create` membuka form tambah data, `store` menyimpan data baru, `show` menampilkan detail mahasiswa, `edit` membuka form edit, `update` memperbarui data, dan `destroy` menghapus data mahasiswa.

View mahasiswa terdiri dari halaman index, create, edit, dan show. Halaman index menampilkan daftar mahasiswa. Halaman create dan edit berisi form input data mahasiswa. Halaman show menampilkan detail data seperti identitas, akademik, kelahiran, kontak, biodata pribadi, dan status keaktifan.

Route mahasiswa berada di dalam middleware `auth`, sehingga hanya user yang sudah login yang dapat mengaksesnya. Untuk operasi tertentu seperti tambah, edit, dan hapus, route juga memakai middleware `can`, misalnya `can:mahasiswa.create`, `can:mahasiswa.update`, dan `can:mahasiswa.delete`.

## 5. Modul Dosen

Pada modul dosen, migration membuat tabel `dosen_tabel`. Tabel ini memakai `NIP` sebagai primary key karena NIP menjadi identitas unik setiap dosen.

Model yang digunakan adalah `Dosen`. Model ini mengarah ke tabel `dosen_tabel`, primary key-nya `NIP`, incrementing false, dan key type string. Artinya Laravel tidak mencari kolom `id`, tetapi memakai NIP saat mengambil, mengedit, atau menghapus data dosen.

Controller yang digunakan adalah `DosenController`. Fungsi-fungsinya sama seperti CRUD standar, yaitu `index`, `create`, `store`, `show`, `edit`, `update`, dan `destroy`. Pada proses simpan dan update, data yang diproses meliputi NIP, nama, fakultas, prodi, jabatan akademik, email, nomor telepon, dan status aktif.

View dosen terdiri dari halaman daftar, tambah, edit, dan detail. Pada form dosen, pengguna mengisi data identitas dosen dan status keaktifannya.

Route dosen juga berada di dalam middleware `auth`. Beberapa aksi dibatasi dengan permission seperti `can:dosen.create`, `can:dosen.update`, dan `can:dosen.delete`.

## 6. Modul Referensi Kejuaraan

Modul referensi kejuaraan berfungsi sebagai master data jenis atau kategori kejuaraan. Migration membuat tabel `referensi_kejuaraan` dengan primary key `ref_id`.

Model yang digunakan adalah `ReferensiKejuaraan`. Model ini memiliki relasi `hasMany` ke `PendaftaranPrestasi`, artinya satu referensi kejuaraan dapat digunakan oleh banyak data pendaftaran prestasi.

Controller yang digunakan adalah `ReferensiKejuaraanController`. Pada controller ini terdapat validasi bahwa `nama_kejuaraan` wajib diisi sebagai teks, dan `bobot_poin` wajib diisi sebagai angka. Bobot poin digunakan untuk menentukan nilai atau skor dari jenis kejuaraan tertentu.

View referensi kejuaraan terdiri dari halaman index, create, edit, dan show. Halaman index menampilkan daftar referensi, sedangkan form create dan edit digunakan untuk mengelola nama kejuaraan dan bobot poin.

Route referensi kejuaraan juga dilindungi oleh login. Aksi tambah, edit, dan hapus dibatasi dengan permission seperti `can:referensi-kejuaraan.create`, `can:referensi-kejuaraan.update`, dan `can:referensi-kejuaraan.delete`.

## 7. Modul Pendaftaran Prestasi

Modul pendaftaran prestasi digunakan untuk mencatat mahasiswa yang mengikuti suatu kegiatan atau kejuaraan.

Migration membuat tabel `pendaftaran_prestasi`. Tabel ini memiliki primary key `pendaftaran_id`, lalu memiliki foreign key `NIM` yang terhubung ke tabel mahasiswa, dan foreign key `ref_id` yang terhubung ke tabel referensi kejuaraan.

Model yang digunakan adalah `PendaftaranPrestasi`. Model ini memiliki tiga relasi utama. Pertama, `belongsTo Mahasiswa`, karena satu pendaftaran dimiliki oleh satu mahasiswa. Kedua, `belongsTo ReferensiKejuaraan`, karena satu pendaftaran memilih satu jenis referensi kejuaraan. Ketiga, `hasOne CapaianPrestasi`, karena satu pendaftaran dapat memiliki satu hasil capaian.

Controller yang digunakan adalah `PendaftaranPrestasiController`. Pada fungsi `index`, data pendaftaran diambil dengan relasi mahasiswa dan referensi kejuaraan menggunakan `with`. Pada fungsi `create`, controller mengambil daftar mahasiswa dan daftar referensi kejuaraan untuk ditampilkan sebagai pilihan pada form. Pada fungsi `store` dan `update`, terdapat validasi bahwa NIM harus ada di tabel mahasiswa, ref_id harus ada di tabel referensi kejuaraan, dan nama kegiatan wajib diisi.

View pendaftaran prestasi memiliki halaman daftar, tambah, edit, dan detail. Form pendaftaran menyediakan pilihan mahasiswa, pilihan referensi kejuaraan, dan input nama kegiatan.

Route pendaftaran prestasi memakai middleware `auth` dan permission seperti `can:pendaftaran-prestasi.create`, `can:pendaftaran-prestasi.update`, dan `can:pendaftaran-prestasi.delete`.

## 8. Modul Capaian Prestasi

Modul capaian prestasi digunakan untuk mencatat hasil akhir dari pendaftaran prestasi, misalnya peringkat yang diperoleh dan file bukti prestasi.

Migration membuat tabel `capaian_prestasi`. Tabel ini memiliki primary key `capaian_id`, foreign key `pendaftaran_id` ke tabel pendaftaran prestasi, dan foreign key `NIP` ke tabel dosen. Relasi ini menunjukkan bahwa capaian berasal dari satu pendaftaran, dan capaian tersebut divalidasi atau ditangani oleh dosen tertentu.

Model yang digunakan adalah `CapaianPrestasi`. Model ini memiliki relasi `belongsTo PendaftaranPrestasi` dan `belongsTo Dosen`. Dengan relasi ini, saat menampilkan capaian, sistem bisa mengambil informasi mahasiswa melalui pendaftaran dan informasi dosen melalui NIP.

Controller yang digunakan adalah `CapaianPrestasiController`. Fungsi `index` menampilkan data capaian dengan relasi pendaftaran dan dosen. Fungsi `create` mengambil daftar pendaftaran dan dosen aktif. Fungsi `store` memvalidasi pendaftaran, peringkat, file bukti, dan NIP dosen. File bukti hanya menerima format pdf, jpg, jpeg, dan png dengan ukuran maksimal 2 MB. File disimpan ke storage public pada folder `bukti`. Fungsi `file` digunakan untuk membuka atau mengunduh file bukti jika file tersedia.

View capaian prestasi memiliki halaman daftar, tambah, edit, detail, dan tombol untuk melihat file bukti. Form capaian memilih pendaftaran, dosen, mengisi peringkat, dan mengunggah file bukti.

Route capaian prestasi dilindungi oleh login dan permission seperti `can:capaian-prestasi.create`, `can:capaian-prestasi.update`, dan `can:capaian-prestasi.delete`. Selain itu ada route khusus `file-capaian-prestasi/{id}` untuk menampilkan file bukti.

## 9. Modul Hak Akses

Modul hak akses digunakan untuk mengatur role dan permission pengguna. Dalam sistem ini, hak akses memakai beberapa tabel, yaitu `users`, `roles`, `permissions`, `role_user`, dan `role_permission`.

Tabel `users` menyimpan akun login. Tabel `roles` menyimpan jenis peran seperti admin atau user. Tabel `permissions` menyimpan izin berdasarkan modul dan aksi, misalnya mahasiswa create, mahasiswa update, atau hak akses read. Tabel `role_user` menjadi tabel penghubung antara user dan role. Tabel `role_permission` menjadi tabel penghubung antara role dan permission.

Model `User` memiliki relasi `belongsToMany` ke `Role`. Model ini juga memiliki helper `hasRole` untuk mengecek role user dan `hasPermission` untuk mengecek apakah user memiliki izin pada modul dan aksi tertentu.

Model `Role` memiliki relasi `belongsToMany` ke `User` dan `belongsToMany` ke `Permission`. Model `Permission` memiliki relasi `belongsToMany` ke `Role`.

Controller yang digunakan untuk hak akses adalah `RoleController`. Fungsi `index` menampilkan daftar role beserta permission-nya. Fungsi `create` menampilkan form tambah role dan daftar permission. Fungsi `store` menyimpan role baru, membuat slug secara otomatis, menentukan level akses, dan menyimpan permission yang dipilih. Fungsi `edit` dan `update` digunakan untuk mengubah role serta menyinkronkan permission. Fungsi `destroy` menghapus role setelah melepas relasi permission.

View hak akses berada pada folder `hak-akses/roles`. Halaman index menampilkan manajemen role dan permission. Halaman create dan edit menyediakan pilihan role dan checkbox permission.

Pada sisi keamanan, route hak akses memakai middleware `can:hak-akses.read`, `can:hak-akses.create`, `can:hak-akses.update`, dan `can:hak-akses.delete`. Selain itu, pada `AppServiceProvider`, terdapat `Gate::before` yang memberi akses penuh kepada user dengan role admin. Permission juga dibuat dinamis dari tabel `permissions`, sehingga permission database dapat langsung menjadi gate seperti `mahasiswa.create` atau `capaian-prestasi.update`.

## 10. Halaman Login

Halaman login digunakan sebagai pintu masuk sebelum user dapat mengakses data utama. Pada sistem ini, login tidak memakai controller khusus, tetapi menggunakan route closure di `routes/web.php`.

Route `GET /login` menampilkan view login. Jika user sudah login, maka user langsung diarahkan ke halaman data mahasiswa. Route `POST /login` menerima email dan password, lalu melakukan validasi. Setelah itu sistem menjalankan `Auth::attempt`. Jika email dan password benar, session dibuat ulang dengan `session()->regenerate()` untuk keamanan, lalu user diarahkan ke halaman data mahasiswa. Jika gagal, sistem menampilkan pesan bahwa email atau password tidak sesuai.

View login berada di `resources/views/auth/login.php`. Halaman ini berisi input email, input password, checkbox ingat saya, tombol login, pesan error, pesan sukses, link register, dan link kembali ke beranda.

Selain login, sistem juga menyediakan route register dan logout. Register membuat user baru, menghubungkan user ke role, lalu langsung login. Logout menghapus session login, menghapus token session lama, dan mengarahkan user kembali ke halaman login.

## 11. Relasi Antar Tabel

Relasi pertama adalah mahasiswa dengan pendaftaran prestasi. Satu mahasiswa dapat memiliki banyak pendaftaran prestasi. Relasi ini dihubungkan melalui kolom `NIM` pada tabel `pendaftaran_prestasi` yang mengarah ke `NIM` pada tabel `mahasiswa_tabel`.

Relasi kedua adalah referensi kejuaraan dengan pendaftaran prestasi. Satu referensi kejuaraan dapat dipakai oleh banyak pendaftaran prestasi. Relasi ini dihubungkan melalui `ref_id`.

Relasi ketiga adalah pendaftaran prestasi dengan capaian prestasi. Satu pendaftaran dapat memiliki satu capaian prestasi. Relasi ini dihubungkan melalui `pendaftaran_id`.

Relasi keempat adalah dosen dengan capaian prestasi. Satu dosen dapat menjadi penanggung jawab atau validator untuk banyak capaian prestasi. Relasi ini dihubungkan melalui `NIP`.

Relasi kelima adalah user dengan role. Satu user dapat memiliki banyak role, dan satu role dapat dimiliki banyak user. Karena relasinya many-to-many, digunakan tabel pivot `role_user`.

Relasi keenam adalah role dengan permission. Satu role dapat memiliki banyak permission, dan satu permission dapat dimiliki banyak role. Karena relasinya many-to-many, digunakan tabel pivot `role_permission`.

Catatan penting: tabel `users` untuk login belum terhubung langsung dengan tabel `mahasiswa_tabel` atau `dosen_tabel`. Jadi akun login dan data akademik mahasiswa/dosen masih dipisahkan.

## 12. Fungsi Atribut Pada Tabel

### Tabel `mahasiswa_tabel`

| Atribut | Fungsi |
| --- | --- |
| `NIM` | Primary key dan identitas unik mahasiswa. |
| `nama` | Menyimpan nama lengkap mahasiswa. |
| `fakultas` | Menyimpan fakultas mahasiswa. |
| `prodi` | Menyimpan program studi mahasiswa. |
| `tempat_lahir` | Menyimpan tempat lahir mahasiswa. |
| `tanggal_lahir` | Menyimpan tanggal lahir mahasiswa. |
| `jenis_kelamin` | Menyimpan jenis kelamin mahasiswa. |
| `email` | Menyimpan email mahasiswa, boleh kosong. |
| `no_telepon` | Menyimpan nomor telepon mahasiswa. |
| `alamat` | Menyimpan alamat mahasiswa. |
| `agama` | Menyimpan agama mahasiswa. |
| `kewarganegaraan` | Menyimpan status kewarganegaraan mahasiswa. |
| `golongan_darah` | Menyimpan golongan darah, boleh kosong. |
| `status_pernikahan` | Menyimpan status pernikahan mahasiswa. |
| `status_aktif` | Menandai status keaktifan mahasiswa. |
| `created_at` | Waktu data dibuat. |
| `updated_at` | Waktu data terakhir diperbarui. |

### Tabel `dosen_tabel`

| Atribut | Fungsi |
| --- | --- |
| `NIP` | Primary key dan identitas unik dosen. |
| `nama` | Menyimpan nama dosen. |
| `fakultas` | Menyimpan fakultas dosen. |
| `prodi` | Menyimpan program studi dosen. |
| `jabatan_akademik` | Menyimpan jabatan akademik dosen. |
| `email` | Menyimpan email dosen dan harus unik. |
| `no_telepon` | Menyimpan nomor telepon dosen. |
| `status_aktif` | Menandai apakah dosen aktif atau tidak. |
| `created_at` | Waktu data dibuat. |
| `updated_at` | Waktu data terakhir diperbarui. |

### Tabel `referensi_kejuaraan`

| Atribut | Fungsi |
| --- | --- |
| `ref_id` | Primary key referensi kejuaraan. |
| `nama_kejuaraan` | Menyimpan nama atau kategori kejuaraan. |
| `bobot_poin` | Menyimpan nilai poin dari kejuaraan. |
| `created_at` | Waktu data dibuat. |
| `updated_at` | Waktu data terakhir diperbarui. |

### Tabel `pendaftaran_prestasi`

| Atribut | Fungsi |
| --- | --- |
| `pendaftaran_id` | Primary key pendaftaran prestasi. |
| `NIM` | Foreign key ke tabel mahasiswa. |
| `ref_id` | Foreign key ke tabel referensi kejuaraan. |
| `nama_kegiatan` | Menyimpan nama kegiatan atau lomba yang diikuti. |
| `created_at` | Waktu data dibuat. |
| `updated_at` | Waktu data terakhir diperbarui. |

### Tabel `capaian_prestasi`

| Atribut | Fungsi |
| --- | --- |
| `capaian_id` | Primary key capaian prestasi. |
| `pendaftaran_id` | Foreign key ke tabel pendaftaran prestasi. |
| `peringkat` | Menyimpan hasil atau peringkat yang diperoleh. |
| `file_bukti` | Menyimpan path file bukti prestasi. |
| `NIP` | Foreign key ke tabel dosen. |
| `created_at` | Waktu data dibuat. |
| `updated_at` | Waktu data terakhir diperbarui. |

### Tabel `users`

| Atribut | Fungsi |
| --- | --- |
| `id` | Primary key user. |
| `name` | Menyimpan nama user. |
| `email` | Menyimpan email login dan harus unik. |
| `email_verified_at` | Menandai waktu verifikasi email, boleh kosong. |
| `password` | Menyimpan password yang sudah di-hash. |
| `remember_token` | Token untuk fitur ingat saya. |
| `created_at` | Waktu akun dibuat. |
| `updated_at` | Waktu akun terakhir diperbarui. |

### Tabel `roles`

| Atribut | Fungsi |
| --- | --- |
| `id` | Primary key role. |
| `nama_role` | Menyimpan nama role, misalnya admin atau user. |
| `slug` | Kode unik role yang dipakai sistem, misalnya admin. |
| `deskripsi` | Keterangan role, boleh kosong. |
| `level_akses` | Menentukan tingkatan akses role. |
| `is_active` | Menandai apakah role aktif. |
| `created_at` | Waktu role dibuat. |
| `updated_at` | Waktu role terakhir diperbarui. |

### Tabel `permissions`

| Atribut | Fungsi |
| --- | --- |
| `id` | Primary key permission. |
| `nama_permission` | Nama izin akses. |
| `modul` | Nama modul yang dilindungi, misalnya mahasiswa. |
| `aksi` | Jenis aksi, misalnya create, read, update, atau delete. |
| `deskripsi` | Penjelasan permission, boleh kosong. |
| `created_at` | Waktu permission dibuat. |
| `updated_at` | Waktu permission terakhir diperbarui. |

### Tabel `role_user`

| Atribut | Fungsi |
| --- | --- |
| `id` | Primary key data pivot. |
| `user_id` | Foreign key ke tabel users. |
| `role_id` | Foreign key ke tabel roles. |
| `unique(user_id, role_id)` | Mencegah satu user mendapat role yang sama dua kali. |
| `created_at` | Waktu relasi dibuat. |
| `updated_at` | Waktu relasi terakhir diperbarui. |

### Tabel `role_permission`

| Atribut | Fungsi |
| --- | --- |
| `id` | Primary key data pivot. |
| `role_id` | Foreign key ke tabel roles. |
| `permission_id` | Foreign key ke tabel permissions. |
| `unique(role_id, permission_id)` | Mencegah satu role mendapat permission yang sama dua kali. |
| `created_at` | Waktu relasi dibuat. |
| `updated_at` | Waktu relasi terakhir diperbarui. |

### Tabel `sessions`

| Atribut | Fungsi |
| --- | --- |
| `id` | Primary key session. |
| `user_id` | ID user yang sedang login, boleh kosong. |
| `ip_address` | Alamat IP pengguna. |
| `user_agent` | Informasi browser atau perangkat pengguna. |
| `payload` | Isi data session. |
| `last_activity` | Waktu aktivitas terakhir session. |

### Tabel `password_reset_tokens`

| Atribut | Fungsi |
| --- | --- |
| `email` | Primary key untuk email yang meminta reset password. |
| `token` | Token reset password. |
| `created_at` | Waktu token dibuat. |

## 13. Penutup

Jadi, sistem ini memiliki alur yang jelas. Mahasiswa dan dosen menjadi data utama. Referensi kejuaraan menjadi master data prestasi. Pendaftaran prestasi menghubungkan mahasiswa dengan jenis kejuaraan yang diikuti. Capaian prestasi mencatat hasil akhir, bukti prestasi, dan dosen yang terkait. Hak akses mengatur siapa yang boleh melakukan aksi tertentu. Halaman login memastikan hanya user terdaftar yang dapat masuk ke sistem.

Dengan penggunaan migration, model, controller, view, dan route, sistem ini menjadi lebih terstruktur, mudah dikembangkan, dan lebih aman karena sudah memakai autentikasi serta permission.

Sekian presentasi dari saya. Terima kasih.
