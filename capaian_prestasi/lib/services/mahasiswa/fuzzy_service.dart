import 'package:dio/dio.dart';
import '../../config/api_config.dart';
import '../../models/mahasiswa/fuzzy_klasifikasi.dart';
import '../auth/api_service.dart';

class FuzzyService {
  final ApiService _apiService;

  FuzzyService(this._apiService);

  Future<List<FuzzyKlasifikasi>> getAll() async {
    final response = await _apiService.dio.get(ApiConfig.fuzzy);
    final data = response.data['data'] as List<dynamic>? ?? [];
    return data
        .map((e) => FuzzyKlasifikasi.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<FuzzyKlasifikasi?> getByNim(String nim) async {
    try {
      final response = await _apiService.dio.get(
        '${ApiConfig.mahasiswa}/$nim/fuzzy',
      );
      return FuzzyKlasifikasi.fromJson(response.data['data']);
    } on DioException catch (e) {
      if (e.response?.statusCode == 404) return null;
      rethrow;
    }
  }

  Future<FuzzyKlasifikasi?> refreshByNim(String nim) async {
    try {
      final response = await _apiService.dio.post(
        '${ApiConfig.mahasiswa}/$nim/fuzzy/refresh',
      );
      return FuzzyKlasifikasi.fromJson(response.data['data']);
    } on DioException catch (e) {
      if (e.response?.statusCode == 404) return null;
      rethrow;
    }
  }
}
