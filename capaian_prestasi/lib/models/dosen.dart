class Dosen {
  final String nip;
  final String nama;
  final String? fakultas;
  final String? prodi;
  final String? jabatanAkademik;
  final String? email;
  final String? noTelepon;

  Dosen({
    required this.nip,
    required this.nama,
    this.fakultas,
    this.prodi,
    this.jabatanAkademik,
    this.email,
    this.noTelepon,
  });

  factory Dosen.fromJson(Map<String, dynamic> json) {
    return Dosen(
      nip: json['NIP'] ?? '',
      nama: json['nama'] ?? '',
      fakultas: json['fakultas'],
      prodi: json['prodi'],
      jabatanAkademik: json['jabatan_akademik'],
      email: json['email'],
      noTelepon: json['no_telepon'],
    );
  }
}
