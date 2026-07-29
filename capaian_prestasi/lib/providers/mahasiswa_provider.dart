import 'package:flutter/material.dart';
import '../models/mahasiswa/mahasiswa.dart';
import '../models/mahasiswa/data_lengkap_mahasiswa.dart';
import '../models/mahasiswa/fuzzy_klasifikasi.dart';
import '../services/auth/api_service.dart';
import '../services/mahasiswa/mahasiswa_service.dart';
import '../services/mahasiswa/fuzzy_service.dart';

class MahasiswaProvider extends ChangeNotifier {
  final MahasiswaService _mahasiswaService;
  final FuzzyService _fuzzyService;

  Mahasiswa? _data;
  List<DataLengkapMahasiswa> _dataLengkap = [];
  FuzzyKlasifikasi? _fuzzy;
  bool _isLoading = false;
  String? _error;

  MahasiswaProvider(ApiService apiService)
      : _mahasiswaService = MahasiswaService(apiService),
        _fuzzyService = FuzzyService(apiService);

  Mahasiswa? get data => _data;
  List<DataLengkapMahasiswa> get dataLengkap => _dataLengkap;
  FuzzyKlasifikasi? get fuzzy => _fuzzy;
  bool get isLoading => _isLoading;
  String? get error => _error;

  Future<void> loadByNim(String nim) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _data = await _mahasiswaService.getByNim(nim);
      _fuzzy = await _fuzzyService.getByNim(nim);
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> update(Mahasiswa mahasiswa) async {
    if (_data == null) return;
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _data = await _mahasiswaService.update(_data!.nim, mahasiswa);
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  void setDataLengkap(List<DataLengkapMahasiswa> data) {
    _dataLengkap = data;
    notifyListeners();
  }
}
