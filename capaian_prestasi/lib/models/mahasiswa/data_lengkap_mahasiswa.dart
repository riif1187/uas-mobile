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
      id: json['id'],
      nimMahasiswa: json['nim_mahasiswa'] ?? '',
      matkul: json['matkul'] ?? '',
      tahunAkademikId: json['tahun_akademik_id'] ?? 0,
    );
  }
}
