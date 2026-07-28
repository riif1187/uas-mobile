1. Administrator
  Memiliki otoritas mutlak di semua tabel:
   * Mahasiswa & Dosen: Akses penuh (Tambah, Lihat, Edit, Hapus) serta hak melakukan Export data.
   * Prestasi: 
       * Mengelola daftar Referensi Kejuaraan.
       * Melakukan Verifikasi (Setuju/Tolak) pada pendaftaran prestasi mahasiswa.
       * Mengelola data Capaian Prestasi (hasil akhir).

  2. Operator
  Fokus pada manajemen data master akademik:
   * Tabel Mahasiswa: Akses penuh (CRUD) dan bisa melakukan Export data.
   * Tabel Dosen: Akses penuh (CRUD) untuk mengelola biodata dosen.
   * Bagian Prestasi:
       * Hanya mengelola Referensi Kejuaraan (menambah/mengedit daftar lomba yang tersedia).
       * Tidak memiliki akses untuk memverifikasi pendaftaran prestasi.

  3. Dosen
  Fokus pada pengawasan dan validasi:
   * Tabel Mahasiswa: Hanya memiliki akses Lihat (Read) untuk memantau data mahasiswa.
   * Tabel Dosen: Tidak memiliki otoritas untuk mengedit data dosen lain (hanya admin/operator).
   * Bagian Prestasi:
       * Verifikasi: Memiliki otoritas khusus untuk mengecek dan Memverifikasi pendaftaran prestasi yang masuk.
       * Akses Baca: Dapat melihat daftar Referensi Kejuaraan dan Capaian Prestasi yang sudah ada.

  4. Mahasiswa
  Fokus pada pengajuan mandiri:
   * Tabel Mahasiswa: Tidak mengelola tabel utama, tetapi mengelola Data Lengkap Mahasiswa (profil detail miliknya sendiri).
   * Tabel Dosen: Tidak memiliki akses ke tabel data dosen.
   * Bagian Prestasi:
       * Pendaftaran Prestasi: Akses penuh (CRUD) untuk mendaftarkan prestasi baru, mengedit, atau membatalkan pengajuannya.
       * Referensi Kejuaraan: Hanya bisa Melihat daftar kejuaraan yang tersedia untuk dipilih saat mendaftar.
       * Tidak bisa memverifikasi prestasinya sendiri.