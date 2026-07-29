import 'package:dio/dio.dart';
import '../../config/api_config.dart';
import '../../models/auth/user.dart';
import 'api_service.dart';

class AuthService {
  final ApiService _apiService;

  AuthService(this._apiService);

  Future<Map<String, dynamic>> login(String email, String password) async {
    try {
      final response = await _apiService.dio.post(
        ApiConfig.login,
        data: {'email': email, 'password': password},
      );
      await _apiService.saveToken(response.data['token']);
      return response.data;
    } on DioException catch (e) {
      if (e.response != null) {
        throw Exception(e.response?.data['message'] ?? 'Login gagal');
      }
      throw Exception('Tidak dapat terhubung ke server');
    }
  }

  Future<Map<String, dynamic>> register(
      String name, String email, String password, String passwordConfirmation) async {
    try {
      final response = await _apiService.dio.post(
        ApiConfig.register,
        data: {
          'name': name,
          'email': email,
          'password': password,
          'password_confirmation': passwordConfirmation,
        },
      );
      await _apiService.saveToken(response.data['token']);
      return response.data;
    } on DioException catch (e) {
      if (e.response != null) {
        throw Exception(e.response?.data['message'] ?? 'Registrasi gagal');
      }
      throw Exception('Tidak dapat terhubung ke server');
    }
  }

  Future<void> logout() async {
    try {
      await _apiService.dio.post(ApiConfig.logout);
    } catch (_) {}
    await _apiService.removeToken();
  }

  Future<User> getMe() async {
    final response = await _apiService.dio.get(ApiConfig.me);
    return User.fromJson(response.data['user']);
  }

  Future<bool> isLoggedIn() async {
    final token = await _apiService.getToken();
    return token != null;
  }
}
