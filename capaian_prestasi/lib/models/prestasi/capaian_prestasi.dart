class CapaianPrestasi {
  final String capaianId;
  final String pendaftaranId;
  final String peringkat;
  final String? fileBukti;
  final String nip;
  final String? namaMahasiswa;
  final String? namaKegiatan;
  final String? namaKejuaraan;
  final String? namaDosen;

  CapaianPrestasi({
    required this.capaianId,
    required this.pendaftaranId,
    required this.peringkat,
    this.fileBukti,
    required this.nip,
    this.namaMahasiswa,
    this.namaKegiatan,
    this.namaKejuaraan,
    this.namaDosen,
  });

  factory CapaianPrestasi.fromJson(Map<String, dynamic> json) {
    String? namaMhs;
    String? namaKeg;
    String? namaKej;
    String? namaDsn;

    final pendaftaran = json['pendaftaran_prestasi'];
    if (pendaftaran != null && pendaftaran is Map<String, dynamic>) {
      namaKeg = pendaftaran['nama_kegiatan'] as String?;
      final mhs = pendaftaran['mahasiswa'];
      if (mhs != null && mhs is Map<String, dynamic>) {
        namaMhs = mhs['nama'] as String?;
      }
      final ref = pendaftaran['referensi_kejuaraan'];
      if (ref != null && ref is Map<String, dynamic>) {
        namaKej = ref['nama_kejuaraan'] as String?;
      }
    }

    final dosen = json['dosen'];
    if (dosen != null && dosen is Map<String, dynamic>) {
      namaDsn = dosen['nama'] as String?;
    }

    return CapaianPrestasi(
      capaianId: json['capaian_id'] ?? '',
      pendaftaranId: json['pendaftaran_id'] ?? '',
      peringkat: json['peringkat'] ?? '',
      fileBukti: json['file_bukti'],
      nip: json['NIP'] ?? '',
      namaMahasiswa: namaMhs,
      namaKegiatan: namaKeg,
      namaKejuaraan: namaKej,
      namaDosen: namaDsn,
    );
  }
}
