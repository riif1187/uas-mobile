class PendaftaranPrestasi {
  final String pendaftaranId;
  final String nim;
  final String refId;
  final String namaKegiatan;
  final String status;

  PendaftaranPrestasi({
    required this.pendaftaranId,
    required this.nim,
    required this.refId,
    required this.namaKegiatan,
    required this.status,
  });

  factory PendaftaranPrestasi.fromJson(Map<String, dynamic> json) {
    return PendaftaranPrestasi(
      pendaftaranId: json['pendaftaran_id'] ?? '',
      nim: json['NIM'] ?? '',
      refId: json['ref_id'] ?? '',
      namaKegiatan: json['nama_kegiatan'] ?? '',
      status: json['status'] ?? 'pending',
    );
  }
}
