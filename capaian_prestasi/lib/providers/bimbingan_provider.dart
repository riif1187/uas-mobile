import 'package:flutter/material.dart';
import '../models/prestasi/bimbingan.dart';
import '../services/auth/api_service.dart';
import '../services/prestasi/bimbingan_service.dart';

class BimbinganProvider extends ChangeNotifier {
  final BimbinganService _bimbinganService;

  List<Bimbingan> _list = [];
  bool _isLoading = false;
  String? _error;

  BimbinganProvider(ApiService apiService)
      : _bimbinganService = BimbinganService(apiService);

  List<Bimbingan> get list => _list;
  bool get isLoading => _isLoading;
  String? get error => _error;

  Future<void> load() async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _list = await _bimbinganService.getAll();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
}
