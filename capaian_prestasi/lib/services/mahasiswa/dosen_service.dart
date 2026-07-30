import '../../config/api_config.dart';
import '../../models/dosen.dart';
import '../auth/api_service.dart';

class DosenService {
  final ApiService _apiService;

  DosenService(this._apiService);

  Future<List<Dosen>> getAll() async {
    final response = await _apiService.dio.get(ApiConfig.dosen);
    final data = response.data['data'] as List;
    return data.map((e) => Dosen.fromJson(e)).toList();
  }
}
