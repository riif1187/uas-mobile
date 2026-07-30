class PendaftaranPrestasi {
  final String pendaftaranId;
  final String nim;
  final String refId;
  final String namaKegiatan;
  final String status;
  final String? namaMahasiswa;
  final String? namaKejuaraan;

  PendaftaranPrestasi({
    required this.pendaftaranId,
    required this.nim,
    required this.refId,
    required this.namaKegiatan,
    required this.status,
    this.namaMahasiswa,
    this.namaKejuaraan,
  });

  factory PendaftaranPrestasi.fromJson(Map<String, dynamic> json) {
    String? namaMhs;
    String? namaKej;

    final mhs = json['mahasiswa'];
    if (mhs != null && mhs is Map<String, dynamic>) {
      namaMhs = mhs['nama'] as String?;
    }

    final ref = json['referensi_kejuaraan'];
    if (ref != null && ref is Map<String, dynamic>) {
      namaKej = ref['nama_kejuaraan'] as String?;
    }

    return PendaftaranPrestasi(
      pendaftaranId: json['pendaftaran_id'] ?? '',
      nim: json['NIM'] ?? '',
      refId: json['ref_id'] ?? '',
      namaKegiatan: json['nama_kegiatan'] ?? '',
      status: json['status'] ?? 'pending',
      namaMahasiswa: namaMhs,
      namaKejuaraan: namaKej,
    );
  }
}
