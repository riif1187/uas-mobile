class FuzzyKlasifikasi {
  final int id;
  final String nim;
  final String nama;
  final String prodi;
  final String fakultas;
  final int jumlahPrestasi;
  final int totalPoin;
  final int peringkatTerbaik;
  final double skorFuzzy;
  final String labelFuzzy;

  FuzzyKlasifikasi({
    required this.id,
    required this.nim,
    this.nama = '',
    this.prodi = '',
    this.fakultas = '',
    required this.jumlahPrestasi,
    required this.totalPoin,
    required this.peringkatTerbaik,
    required this.skorFuzzy,
    required this.labelFuzzy,
  });

  factory FuzzyKlasifikasi.fromJson(Map<String, dynamic> json) {
    return FuzzyKlasifikasi(
      id: _toInt(json['id']),
      nim: json['NIM'] ?? '',
      nama: json['nama'] ?? '',
      prodi: json['prodi'] ?? '',
      fakultas: json['fakultas'] ?? '',
      jumlahPrestasi: _toInt(json['jumlah_prestasi']),
      totalPoin: _toInt(json['total_poin']),
      peringkatTerbaik: _toInt(json['peringkat_terbaik']),
      skorFuzzy: _toDouble(json['skor_fuzzy']),
      labelFuzzy: json['label_fuzzy'] ?? '',
    );
  }

  static int _toInt(dynamic value) {
    if (value is int) return value;
    if (value is double) return value.toInt();
    if (value is String) return int.tryParse(value) ?? 0;
    return 0;
  }

  static double _toDouble(dynamic value) {
    if (value is double) return value;
    if (value is int) return value.toDouble();
    if (value is String) return double.tryParse(value) ?? 0.0;
    return 0.0;
  }
}
