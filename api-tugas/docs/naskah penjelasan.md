# Naskah Penjelasan Video — Sistem Fuzzy Prestasi Mahasiswa

---

## Pembukaan

Halo, perkenalkan saya [nama]. Pada video ini saya akan menjelaskan dua hal: pertama, mengapa saya memilih metode Mamdani dalam sistem fuzzy prestasi mahasiswa ini. Kedua, apa manfaat logika fuzzy dibandingkan sistem penilaian konvensional atau if-else biasa.

---

## Bagian 1: Mengapa Metode Mamdani Cocok untuk Kasus Ini

Saya memilih **Mamdani**, bukan Tsukamoto, karena output yang saya butuhkan adalah **label klasifikasi**: Kurang Berprestasi, Cukup Berprestasi, Berprestasi, dan Sangat Berprestasi. Mamdani bekerja dengan aturan IF-THEN yang sangat mudah dibaca. Contoh:

*"IF jumlah prestasi sedikit AND poin rendah AND peringkat jauh THEN Kurang Berprestasi"*

Aturan seperti ini bisa langsung dipahami oleh dosen atau operator tanpa perlu latar belakang matematika. Kalau pakai Tsukamoto, setiap aturan harus punya persamaan linier sendiri-sendiri. Bayangkan, ada 27 aturan berarti 27 persamaan — sangat rumit dan tidak praktis. Karena output akhirnya tetap label, Mamdani adalah pilihan yang tepat dan efisien.

Selain itu, sistem ini dirancang sebagai **sistem berbasis pengetahuan** (knowledge-based system). Artinya, aturan penilaian bisa didiskusikan langsung dengan pakar — misalnya dosen atau wakil dekan — lalu langsung dituangkan ke dalam bentuk aturan IF-THEN. Dengan Tsukamoto, kita harus mendefinisikan persamaan matematis untuk setiap aturan, yang sulit dijelaskan kepada pihak non-teknis.

---

## Bagian 2: Manfaat Logika Fuzzy vs Sistem Konvensional (If-Else Biasa)

Sekarang, kenapa tidak pakai if-else biasa saja?

### Masalah If-Else Biasa

**Pertama, batas tegas atau crisp boundary.** Misal saya buat aturan: jika poin lebih dari 80 maka tinggi. Mahasiswa dengan poin 79 dianggap tidak tinggi — padahal selisih 1 poin sangat kecil dan tidak signifikan. Ini tidak adil.

**Kedua, tidak ada kompromi antar kriteria.** Jika ada mahasiswa dengan prestasi sedikit tapi poin tinggi, sistem if-else mungkin tidak punya aturan yang cocok, sehingga mahasiswa tersebut tidak terklasifikasi sama sekali.

**Ketiga, rentan ada lubang atau gap.** Jika aturan tidak mencakup semua kombinasi, ada mahasiswa yang tidak terdeteksi oleh sistem manapun.

### Solusi Logika Fuzzy

Logika fuzzy menyelesaikan semua masalah ini dengan tiga cara:

**Pertama, derajat keanggotaan.** Dengan fungsi trapezium, poin 79 tetap masuk himpunan Tinggi dengan derajat 0,95 — tidak langsung jatuh ke nol. Transisinya halus, bukan lompatan tiba-tiba.

**Kedua, semua aturan aktif secara simultan.** Seorang mahasiswa bisa sebagian masuk kategori Cukup Berprestasi dan sebagian masuk Berprestasi. Hasil akhirnya adalah kompromi melalui perhitungan centroid, sehingga penilaian lebih adil dan transparan.

**Ketiga, transisi gradual.** Skor berubah secara halus — tidak ada lonjakan drastis seperti pada if-else. Misalnya perbedaan skor 49 ke 51 terasa wajar, bukan lompatan dari satu kategori ke kategori lain secara tiba-tiba.

### Contoh Kasus Nyata

Saya ambil contoh data **HALIS ANNISA** dengan NIM 2455201110003. Mahasiswa ini memiliki 3 prestasi, 28 poin, dan peringkat 1.

Dalam sistem if-else biasa, tidak ada aturan yang cocok — karena poinnya 28 yang tergolong rendah, tapi peringkatnya 1 yang merupakan terbaik. Sistem bingung dan mungkin tidak menghasilkan output apapun.

Dengan logika fuzzy, dua aturan aktif bersamaan:
- Aturan **sedang-rendah-terbaik** menghasilkan Cukup Berprestasi dengan kekuatan 0,6
- Aturan **sedang-sedang-terbaik** menghasilkan Berprestasi dengan kekuatan 0,4

Keduanya dikompromikan lewat defuzzifikasi centroid, menghasilkan skor akhir **40** — yang masuk kategori **Cukup Berprestasi**. Ini jauh lebih adil daripada if-else yang tidak bisa menangani kasus kompromi seperti ini.

---

## Penutup

Kesimpulannya:
1. **Mamdani** dipilih karena outputnya berupa label klasifikasi dan aturannya mudah dipahami oleh semua pihak.
2. **Logika fuzzy** unggul dibanding if-else biasa karena memberikan transisi yang halus, menangani kompromi antar kriteria secara simultan, dan menghasilkan penilaian yang lebih adil dan transparan.

Terima kasih.
