class CapaianPrestasi {
  final String capaianId;
  final String pendaftaranId;
  final String peringkat;
  final String? fileBukti;
  final String nip;

  CapaianPrestasi({
    required this.capaianId,
    required this.pendaftaranId,
    required this.peringkat,
    this.fileBukti,
    required this.nip,
  });

  factory CapaianPrestasi.fromJson(Map<String, dynamic> json) {
    return CapaianPrestasi(
      capaianId: json['capaian_id'] ?? '',
      pendaftaranId: json['pendaftaran_id'] ?? '',
      peringkat: json['peringkat'] ?? '',
      fileBukti: json['file_bukti'],
      nip: json['NIP'] ?? '',
    );
  }
}
