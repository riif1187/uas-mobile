import 'package:dio/dio.dart';
import '../../config/api_config.dart';
import '../../models/mahasiswa/fuzzy_klasifikasi.dart';
import '../auth/api_service.dart';

class FuzzyService {
  final ApiService _apiService;

  FuzzyService(this._apiService);

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
}
