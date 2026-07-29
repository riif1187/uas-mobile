import '../../config/api_config.dart';
import '../../models/prestasi/referensi_kejuaraan.dart';
import '../auth/api_service.dart';

class ReferensiService {
  final ApiService _apiService;

  ReferensiService(this._apiService);

  Future<List<ReferensiKejuaraan>> getAll() async {
    final response = await _apiService.dio.get(ApiConfig.referensiKejuaraan);
    final data = response.data['data'] as List;
    return data.map((e) => ReferensiKejuaraan.fromJson(e)).toList();
  }
}
