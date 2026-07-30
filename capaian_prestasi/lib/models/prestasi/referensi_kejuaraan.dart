class ReferensiKejuaraan {
  final String refId;
  final String namaKejuaraan;
  final int bobotPoin;

  ReferensiKejuaraan({
    required this.refId,
    required this.namaKejuaraan,
    required this.bobotPoin,
  });

  factory ReferensiKejuaraan.fromJson(Map<String, dynamic> json) {
    return ReferensiKejuaraan(
      refId: json['ref_id'] ?? '',
      namaKejuaraan: json['nama_kejuaraan'] ?? '',
      bobotPoin: _toInt(json['bobot_poin']),
    );
  }

  static int _toInt(dynamic value) {
    if (value is int) return value;
    if (value is double) return value.toInt();
    if (value is String) return int.tryParse(value) ?? 0;
    return 0;
  }
}
