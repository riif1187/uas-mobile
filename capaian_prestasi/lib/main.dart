import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'providers/auth_provider.dart';
import 'providers/mahasiswa_provider.dart';
import 'providers/prestasi_provider.dart';
import 'providers/bimbingan_provider.dart';
import 'services/auth/api_service.dart';
import 'screens/splash_screen.dart';
import 'screens/login_screen.dart';
import 'screens/register_screen.dart';
import 'screens/home_screen.dart';
import 'screens/mahasiswa/profile_screen.dart';
import 'screens/mahasiswa/data_lengkap_screen.dart';
import 'screens/mahasiswa/fuzzy_klasifikasi_screen.dart';
import 'screens/prestasi/referensi_screen.dart';
import 'screens/prestasi/pendaftaran_list_screen.dart';
import 'screens/prestasi/pendaftaran_create_screen.dart';
import 'screens/prestasi/capaian_list_screen.dart';
import 'screens/prestasi/capaian_create_screen.dart';
import 'screens/bimbingan/bimbingan_screen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    final apiService = ApiService();

    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => AuthProvider(apiService)),
        ChangeNotifierProvider(create: (_) => MahasiswaProvider(apiService)),
        ChangeNotifierProvider(create: (_) => PrestasiProvider(apiService)),
        ChangeNotifierProvider(create: (_) => BimbinganProvider(apiService)),
      ],
      child: MaterialApp(
        title: 'Prestasi Mahasiswa',
        debugShowCheckedModeBanner: false,
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(seedColor: Colors.indigo),
          useMaterial3: true,
        ),
        initialRoute: '/',
        routes: {
          '/': (context) => const SplashScreen(),
          '/login': (context) => const LoginScreen(),
          '/register': (context) => const RegisterScreen(),
          '/home': (context) => const HomeScreen(),
          '/profile': (context) => const ProfileScreen(),
          '/referensi': (context) => const ReferensiScreen(),
          '/pendaftaran-list': (context) => const PendaftaranListScreen(),
          '/pendaftaran-create': (context) => const PendaftaranCreateScreen(),
          '/capaian-list': (context) => const CapaianListScreen(),
          '/capaian-create': (context) => const CapaianCreateScreen(),
          '/bimbingan': (context) => const BimbinganScreen(),
          '/fuzzy': (context) => const FuzzyKlasifikasiScreen(),
          '/data-lengkap': (context) => const DataLengkapScreen(),
        },
      ),
    );
  }
}
