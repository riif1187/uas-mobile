class Bimbingan {
  final int id;
  final String nimMahasiswa;
  final String nipDosen;
  final String tanggalBimbingan;

  Bimbingan({
    required this.id,
    required this.nimMahasiswa,
    required this.nipDosen,
    required this.tanggalBimbingan,
  });

  factory Bimbingan.fromJson(Map<String, dynamic> json) {
    return Bimbingan(
      id: _toInt(json['id']),
      nimMahasiswa: json['nim_mahasiswa'] ?? '',
      nipDosen: json['nip_dosen'] ?? '',
      tanggalBimbingan: json['tanggal_bimbingan'] ?? '',
    );
  }

  static int _toInt(dynamic value) {
    if (value is int) return value;
    if (value is double) return value.toInt();
    if (value is String) return int.tryParse(value) ?? 0;
    return 0;
  }
}
