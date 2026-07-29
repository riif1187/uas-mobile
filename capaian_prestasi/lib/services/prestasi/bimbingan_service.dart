import '../../config/api_config.dart';
import '../../models/prestasi/bimbingan.dart';
import '../auth/api_service.dart';

class BimbinganService {
  final ApiService _apiService;

  BimbinganService(this._apiService);

  Future<List<Bimbingan>> getAll() async {
    final response = await _apiService.dio.get(ApiConfig.bimbingan);
    final data = response.data['data'] as List;
    return data.map((e) => Bimbingan.fromJson(e)).toList();
  }
}
