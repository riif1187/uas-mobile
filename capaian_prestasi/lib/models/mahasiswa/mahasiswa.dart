class Mahasiswa {
  final String nim;
  final String nama;
  final String fakultas;
  final String prodi;
  final String tempatLahir;
  final String tanggalLahir;
  final String jenisKelamin;
  final String? email;
  final String noTelepon;
  final String alamat;
  final String agama;
  final String kewarganegaraan;
  final String? golonganDarah;
  final String statusPernikahan;
  final String? statusAktif;

  Mahasiswa({
    required this.nim,
    required this.nama,
    required this.fakultas,
    required this.prodi,
    required this.tempatLahir,
    required this.tanggalLahir,
    required this.jenisKelamin,
    this.email,
    required this.noTelepon,
    required this.alamat,
    required this.agama,
    required this.kewarganegaraan,
    this.golonganDarah,
    required this.statusPernikahan,
    this.statusAktif,
  });

  factory Mahasiswa.fromJson(Map<String, dynamic> json) {
    return Mahasiswa(
      nim: json['NIM'] ?? '',
      nama: json['nama'] ?? '',
      fakultas: json['fakultas'] ?? '',
      prodi: json['prodi'] ?? '',
      tempatLahir: json['tempat_lahir'] ?? '',
      tanggalLahir: json['tanggal_lahir'] ?? '',
      jenisKelamin: json['jenis_kelamin'] ?? '',
      email: json['email'],
      noTelepon: json['no_telepon'] ?? '',
      alamat: json['alamat'] ?? '',
      agama: json['agama'] ?? '',
      kewarganegaraan: json['kewarganegaraan'] ?? '',
      golonganDarah: json['golongan_darah'],
      statusPernikahan: json['status_pernikahan'] ?? '',
      statusAktif: json['status_aktif'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'NIM': nim,
      'nama': nama,
      'fakultas': fakultas,
      'prodi': prodi,
      'tempat_lahir': tempatLahir,
      'tanggal_lahir': tanggalLahir,
      'jenis_kelamin': jenisKelamin,
      'email': email,
      'no_telepon': noTelepon,
      'alamat': alamat,
      'agama': agama,
      'kewarganegaraan': kewarganegaraan,
      'golongan_darah': golonganDarah,
      'status_pernikahan': statusPernikahan,
      'status_aktif': statusAktif,
    };
  }
}
