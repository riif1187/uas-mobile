import '../../config/api_config.dart';
import '../../models/prestasi/pendaftaran_prestasi.dart';
import '../auth/api_service.dart';

class PendaftaranService {
  final ApiService _apiService;

  PendaftaranService(this._apiService);

  Future<List<PendaftaranPrestasi>> getAll() async {
    final response = await _apiService.dio.get(ApiConfig.pendaftaranPrestasi);
    final data = response.data['data'] as List;
    return data.map((e) => PendaftaranPrestasi.fromJson(e)).toList();
  }

  Future<PendaftaranPrestasi> create(Map<String, dynamic> data) async {
    final response = await _apiService.dio.post(
      ApiConfig.pendaftaranPrestasi,
      data: data,
    );
    return PendaftaranPrestasi.fromJson(response.data['data']);
  }

  Future<PendaftaranPrestasi> getById(String id) async {
    final response = await _apiService.dio.get(
      '${ApiConfig.pendaftaranPrestasi}/$id',
    );
    return PendaftaranPrestasi.fromJson(response.data['data']);
  }
}
