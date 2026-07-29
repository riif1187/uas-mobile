import 'package:flutter/material.dart';
import '../models/prestasi/referensi_kejuaraan.dart';
import '../models/prestasi/pendaftaran_prestasi.dart';
import '../models/prestasi/capaian_prestasi.dart';
import '../services/auth/api_service.dart';
import '../services/prestasi/referensi_service.dart';
import '../services/prestasi/pendaftaran_service.dart';
import '../services/prestasi/capaian_service.dart';

class PrestasiProvider extends ChangeNotifier {
  final ReferensiService _referensiService;
  final PendaftaranService _pendaftaranService;
  final CapaianService _capaianService;

  List<ReferensiKejuaraan> _referensi = [];
  List<PendaftaranPrestasi> _pendaftaran = [];
  List<CapaianPrestasi> _capaian = [];
  bool _isLoading = false;
  String? _error;

  PrestasiProvider(ApiService apiService)
      : _referensiService = ReferensiService(apiService),
        _pendaftaranService = PendaftaranService(apiService),
        _capaianService = CapaianService(apiService);

  List<ReferensiKejuaraan> get referensi => _referensi;
  List<PendaftaranPrestasi> get pendaftaran => _pendaftaran;
  List<CapaianPrestasi> get capaian => _capaian;
  bool get isLoading => _isLoading;
  String? get error => _error;

  Future<void> loadReferensi() async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _referensi = await _referensiService.getAll();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> loadPendaftaran() async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _pendaftaran = await _pendaftaranService.getAll();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> createPendaftaran(Map<String, dynamic> data) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      await _pendaftaranService.create(data);
      await loadPendaftaran();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> loadCapaian() async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _capaian = await _capaianService.getAll();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> createCapaian({
    required String pendaftaranId,
    required String peringkat,
    required String nip,
    String? filePath,
  }) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      await _capaianService.create(
        pendaftaranId: pendaftaranId,
        peringkat: peringkat,
        nip: nip,
        filePath: filePath,
      );
      await loadCapaian();
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }
}
