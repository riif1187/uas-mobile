import 'package:dio/dio.dart';
import '../../config/api_config.dart';
import '../../models/prestasi/capaian_prestasi.dart';
import '../auth/api_service.dart';

class CapaianService {
  final ApiService _apiService;

  CapaianService(this._apiService);

  Future<List<CapaianPrestasi>> getAll({String? nim}) async {
    final queryParams = <String, dynamic>{};
    if (nim != null) queryParams['nim'] = nim;
    final response = await _apiService.dio.get(
      ApiConfig.capaianPrestasi,
      queryParameters: queryParams.isNotEmpty ? queryParams : null,
    );
    final data = response.data['data'] as List;
    return data.map((e) => CapaianPrestasi.fromJson(e)).toList();
  }

  Future<CapaianPrestasi> create({
    required String pendaftaranId,
    required String peringkat,
    required String nip,
    String? filePath,
  }) async {
    final formData = FormData.fromMap({
      'pendaftaran_id': pendaftaranId,
      'peringkat': peringkat,
      'NIP': nip,
      if (filePath != null)
        'file_bukti': await MultipartFile.fromFile(filePath),
    });

    final response = await _apiService.dio.post(
      ApiConfig.capaianPrestasi,
      data: formData,
    );
    return CapaianPrestasi.fromJson(response.data['data']);
  }
}
