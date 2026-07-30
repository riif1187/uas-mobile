import 'package:dio/dio.dart';
import 'package:image_picker/image_picker.dart';
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
    XFile? file,
  }) async {
    final formData = FormData.fromMap({
      'pendaftaran_id': pendaftaranId,
      'peringkat': peringkat,
      'NIP': nip,
      if (file != null)
        'file_bukti': MultipartFile.fromBytes(
          await file.readAsBytes(),
          filename: file.name.isNotEmpty ? file.name : 'bukti-prestasi.jpg',
        ),
    });

    try {
      final response = await _apiService.dio.post(
        ApiConfig.capaianPrestasi,
        data: formData,
        options: Options(contentType: 'multipart/form-data'),
      );
      return CapaianPrestasi.fromJson(response.data['data']);
    } on DioException catch (e) {
      throw Exception(
        _errorMessage(e.response?.data, 'Capaian gagal disimpan'),
      );
    }
  }

  String _errorMessage(dynamic data, String fallbackMessage) {
    if (data is Map) {
      final message = data['message'];
      if (message is String && message.trim().isNotEmpty) return message;

      final errors = data['errors'];
      if (errors is Map) {
        final messages = errors.values
            .map((error) {
              if (error is List && error.isNotEmpty)
                return error.first.toString();
              if (error != null) return error.toString();
              return '';
            })
            .where((message) => message.isNotEmpty)
            .toList();
        if (messages.isNotEmpty) return messages.join('\n');
      }
    }

    return fallbackMessage;
  }
}
