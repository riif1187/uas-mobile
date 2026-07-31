import 'package:flutter/material.dart';
import '../models/auth/user.dart';
import '../services/auth/api_service.dart';
import '../services/auth/auth_service.dart';

class AuthProvider extends ChangeNotifier {
  final AuthService _authService;
  User? _user;
  String? _nim;
  bool _isLoading = false;
  String? _error;

  AuthProvider(ApiService apiService) : _authService = AuthService(apiService);

  User? get user => _user;
  String? get nim => _nim;
  bool get isLoading => _isLoading;
  String? get error => _error;
  bool get isLoggedIn => _user != null;

  Future<void> login(String email, String password) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      debugPrint('LOGIN: calling _authService.login()');
      await _authService.login(email, password);
      debugPrint('LOGIN: login OK, calling loadUser()');
      await loadUser();
      debugPrint('LOGIN: loadUser OK, calling _fetchNim()');
      await _fetchNim(email);
      debugPrint('LOGIN: login flow complete');
    } catch (e, stack) {
      debugPrint('LOGIN ERROR: $e');
      debugPrint('LOGIN STACK: $stack');
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> register(
      String name, String email, String password, String passwordConfirmation) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      await _authService.register(name, email, password, passwordConfirmation);
      await loadUser();
      await _fetchNim(email);
    } catch (e) {
      _error = e.toString().replaceFirst('Exception: ', '');
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  Future<void> _fetchNim(String email) async {
    try {
      final data = await _authService.getMahasiswaByEmail(email);
      _nim = data['NIM'];
      notifyListeners();
    } catch (_) {
      _nim = null;
    }
  }

  Future<void> clearError() {
    _error = null;
    notifyListeners();
    return Future.value();
  }

  Future<void> loadUser() async {
    try {
      _user = await _authService.getMe();
      notifyListeners();
    } catch (e) {
      _user = null;
      _error = e.toString().replaceFirst('Exception: ', '');
      notifyListeners();
    }
  }

  Future<void> logout() async {
    await _authService.logout();
    _user = null;
    _nim = null;
    notifyListeners();
  }

  Future<bool> tryAutoLogin() async {
    final loggedIn = await _authService.isLoggedIn();
    if (loggedIn) {
      await loadUser();
      if (_user != null) {
        await _fetchNim(_user!.email);
      }
      return _user != null;
    }
    return false;
  }
}
