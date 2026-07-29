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
      bobotPoin: json['bobot_poin'] ?? 0,
    );
  }
}
