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
      final data = _asMap(response.data, 'Login gagal');
      await _saveToken(data, 'Login gagal');
      return data;
    } on DioException catch (e) {
      if (e.response != null) {
        throw Exception(_errorMessage(e.response?.data, 'Login gagal'));
      }
      throw Exception('Tidak dapat terhubung ke server');
    }
  }

  Future<Map<String, dynamic>> register(
    String name,
    String email,
    String password,
    String passwordConfirmation,
  ) async {
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
      final data = _asMap(response.data, 'Registrasi gagal');
      await _saveToken(data, 'Registrasi gagal');
      return data;
    } on DioException catch (e) {
      if (e.response != null) {
        throw Exception(_errorMessage(e.response?.data, 'Registrasi gagal'));
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

  Future<Map<String, dynamic>> getMahasiswaByEmail(String email) async {
    final response = await _apiService.dio.get(
      '${ApiConfig.mahasiswa}/by-email/$email',
    );
    return response.data['data'];
  }

  Future<bool> isLoggedIn() async {
    final token = await _apiService.getToken();
    return token != null;
  }

  Map<String, dynamic> _asMap(dynamic data, String fallbackMessage) {
    if (data is Map<String, dynamic>) return data;
    if (data is Map) return Map<String, dynamic>.from(data);

    throw Exception('$fallbackMessage. Response server tidak valid.');
  }

  Future<void> _saveToken(
    Map<String, dynamic> data,
    String fallbackMessage,
  ) async {
    final token = data['token'];
    if (token is String && token.isNotEmpty) {
      await _apiService.saveToken(token);
      return;
    }

    throw Exception('$fallbackMessage. Token tidak ditemukan.');
  }

  String _errorMessage(dynamic data, String fallbackMessage) {
    if (data is Map) {
      final message = data['message'];
      if (message is String && message.trim().isNotEmpty) {
        return message;
      }

      final errors = data['errors'];
      if (errors is Map) {
        final messages = errors.values
            .map(_firstErrorMessage)
            .where((message) => message.isNotEmpty)
            .toList();
        if (messages.isNotEmpty) return messages.join('\n');
      }

      if (message != null) return message.toString();
      return fallbackMessage;
    }

    if (data is List) {
      final messages = data
          .map((item) => _errorMessage(item, ''))
          .where((message) => message.isNotEmpty)
          .toList();
      if (messages.isNotEmpty) return messages.join('\n');
      return fallbackMessage;
    }

    if (data is String && data.trim().isNotEmpty) {
      return data.trim().startsWith('<') ? fallbackMessage : data.trim();
    }

    return fallbackMessage;
  }

  String _firstErrorMessage(dynamic error) {
    if (error is List && error.isNotEmpty) return error.first.toString();
    if (error is String) return error;
    if (error != null) return error.toString();
    return '';
  }
}
