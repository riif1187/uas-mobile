class FuzzyKlasifikasi {
  final int id;
  final String nim;
  final int jumlahPrestasi;
  final int totalPoin;
  final int peringkatTerbaik;
  final double skorFuzzy;
  final String labelFuzzy;

  FuzzyKlasifikasi({
    required this.id,
    required this.nim,
    required this.jumlahPrestasi,
    required this.totalPoin,
    required this.peringkatTerbaik,
    required this.skorFuzzy,
    required this.labelFuzzy,
  });

  factory FuzzyKlasifikasi.fromJson(Map<String, dynamic> json) {
    return FuzzyKlasifikasi(
      id: json['id'],
      nim: json['NIM'] ?? '',
      jumlahPrestasi: json['jumlah_prestasi'] ?? 0,
      totalPoin: json['total_poin'] ?? 0,
      peringkatTerbaik: json['peringkat_terbaik'] ?? 0,
      skorFuzzy: (json['skor_fuzzy'] ?? 0).toDouble(),
      labelFuzzy: json['label_fuzzy'] ?? '',
    );
  }
}
