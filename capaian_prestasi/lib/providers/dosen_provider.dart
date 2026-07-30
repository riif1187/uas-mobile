import 'package:flutter/material.dart';
import '../models/dosen.dart';
import '../services/auth/api_service.dart';
import '../services/mahasiswa/dosen_service.dart';

class DosenProvider extends ChangeNotifier {
  final DosenService _dosenService;

  List<Dosen> _dosen = [];
  bool _isLoading = false;
  String? _error;

  DosenProvider(ApiService apiService)
      : _dosenService = DosenService(apiService);

  List<Dosen> get dosen => _dosen;
  bool get isLoading => _isLoading;
  String? get error => _error;

  Future<void> loadDosen() async {
    if (_dosen.isNotEmpty) return;
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _dosen = await _dosenService.getAll();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
}
