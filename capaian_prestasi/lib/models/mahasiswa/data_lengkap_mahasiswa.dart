class DataLengkapMahasiswa {
  final int id;
  final String nimMahasiswa;
  final String matkul;
  final int tahunAkademikId;

  DataLengkapMahasiswa({
    required this.id,
    required this.nimMahasiswa,
    required this.matkul,
    required this.tahunAkademikId,
  });

  factory DataLengkapMahasiswa.fromJson(Map<String, dynamic> json) {
    return DataLengkapMahasiswa(
      id: _toInt(json['id']),
      nimMahasiswa: json['nim_mahasiswa'] ?? '',
      matkul: json['matkul'] ?? '',
      tahunAkademikId: _toInt(json['tahun_akademik_id']),
    );
  }

  static int _toInt(dynamic value) {
    if (value is int) return value;
    if (value is double) return value.toInt();
    if (value is String) return int.tryParse(value) ?? 0;
    return 0;
  }
}
