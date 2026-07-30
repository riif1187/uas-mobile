import '../../config/api_config.dart';
import '../../models/mahasiswa/mahasiswa.dart';
import '../auth/api_service.dart';

class MahasiswaService {
  final ApiService _apiService;

  MahasiswaService(this._apiService);

  Future<List<Mahasiswa>> getAll() async {
    final response = await _apiService.dio.get(ApiConfig.mahasiswa);
    final data = response.data['data'] as List;
    return data.map((e) => Mahasiswa.fromJson(e)).toList();
  }

  Future<Mahasiswa> getByNim(String nim) async {
    final response = await _apiService.dio.get('${ApiConfig.mahasiswa}/$nim');
    return Mahasiswa.fromJson(response.data['data']);
  }

  Future<Mahasiswa> create(Mahasiswa mahasiswa) async {
    final response = await _apiService.dio.post(
      ApiConfig.mahasiswa,
      data: mahasiswa.toJson(),
    );
    return Mahasiswa.fromJson(response.data['data']);
  }

  Future<Mahasiswa> update(String nim, Mahasiswa mahasiswa) async {
    final response = await _apiService.dio.put(
      '${ApiConfig.mahasiswa}/$nim',
      data: mahasiswa.toJson(),
    );
    return Mahasiswa.fromJson(response.data['data']);
  }

  Future<void> delete(String nim) async {
    await _apiService.dio.delete('${ApiConfig.mahasiswa}/$nim');
  }
}
