import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/auth_provider.dart';
import 'home_screen.dart';
import 'mahasiswa/profile_screen.dart';
import 'mahasiswa/data_lengkap_screen.dart';
import 'mahasiswa/fuzzy_klasifikasi_screen.dart';
import 'prestasi/referensi_screen.dart';
import 'prestasi/pendaftaran_list_screen.dart';
import 'prestasi/capaian_list_screen.dart';
import 'bimbingan/bimbingan_screen.dart';

class MainShellScreen extends StatefulWidget {
  const MainShellScreen({super.key});

  @override
  State<MainShellScreen> createState() => _MainShellScreenState();
}

class _MainShellScreenState extends State<MainShellScreen> {
  int _selectedIndex = 0;

  static const _menuItems = <_MenuItem>[
    _MenuItem(Icons.dashboard_outlined, Icons.dashboard, 'Dashboard'),
    _MenuItem(Icons.person_outline, Icons.person, 'Profil'),
    _MenuItem(Icons.emoji_events_outlined, Icons.emoji_events, 'Referensi'),
    _MenuItem(Icons.assignment_outlined, Icons.assignment, 'Pendaftaran'),
    _MenuItem(Icons.verified_outlined, Icons.verified, 'Capaian'),
    _MenuItem(Icons.forum_outlined, Icons.forum, 'Bimbingan'),
    _MenuItem(Icons.auto_graph, Icons.auto_graph, 'Fuzzy'),
    _MenuItem(Icons.book_outlined, Icons.book, 'Data Akademik'),
  ];

  late final List<Widget> _pages = const [
    HomeScreen(),
    ProfileScreen(),
    ReferensiScreen(),
    PendaftaranListScreen(),
    CapaianListScreen(),
    BimbinganScreen(),
    FuzzyKlasifikasiScreen(),
    DataLengkapScreen(),
  ];

  void _onLogout() async {
    final auth = context.read<AuthProvider>();
    await auth.logout();
    if (context.mounted) {
      Navigator.of(context).pushReplacementNamed('/login');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [Color(0xFF1A237E), Color(0xFF3949AB)],
          ),
        ),
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            _buildSidebar(),
            Expanded(
              child: Container(
                color: Colors.grey.shade100,
                child: IndexedStack(
                  index: _selectedIndex,
                  children: _pages,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSidebar() {
    return Container(
      width: 240,
      decoration: const BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topCenter,
          end: Alignment.bottomCenter,
          colors: [Color(0xFF1A237E), Color(0xFF283593)],
        ),
      ),
      child: SafeArea(
        child: Column(
          children: [
            Padding(
              padding: const EdgeInsets.fromLTRB(20, 20, 20, 16),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(10),
                    decoration: BoxDecoration(
                      color: Colors.white.withValues(alpha: 0.15),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: const Icon(Icons.school, color: Colors.white),
                  ),
                  const SizedBox(width: 12),
                  const Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Prestasi',
                          style: TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                          ),
                        ),
                        Text(
                          'Mahasiswa',
                          style: TextStyle(
                            color: Colors.white70,
                            fontSize: 12,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
            const Divider(color: Colors.white24, height: 1),
            Expanded(
              child: ListView(
                padding: const EdgeInsets.symmetric(vertical: 12),
                children: List.generate(_menuItems.length, (i) {
                  final item = _menuItems[i];
                  final selected = i == _selectedIndex;
                  return Padding(
                    padding: const EdgeInsets.symmetric(
                        horizontal: 12, vertical: 3),
                    child: Material(
                      color: selected
                          ? Colors.white.withValues(alpha: 0.18)
                          : Colors.transparent,
                      borderRadius: BorderRadius.circular(12),
                      child: InkWell(
                        onTap: () => setState(() => _selectedIndex = i),
                        borderRadius: BorderRadius.circular(12),
                        child: Padding(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 14, vertical: 11),
                          child: Row(
                            children: [
                              Icon(
                                selected
                                    ? item.selectedIcon
                                    : item.icon,
                                color: Colors.white,
                                size: 22,
                              ),
                              const SizedBox(width: 14),
                              Expanded(
                                child: Text(
                                  item.title,
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontSize: 14,
                                    fontWeight: selected
                                        ? FontWeight.w600
                                        : FontWeight.w400,
                                  ),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                  );
                }),
              ),
            ),
            const Divider(color: Colors.white24, height: 1),
            Padding(
              padding: const EdgeInsets.all(12),
              child: Material(
                color: Colors.white.withValues(alpha: 0.1),
                borderRadius: BorderRadius.circular(12),
                child: InkWell(
                  onTap: _onLogout,
                  borderRadius: BorderRadius.circular(12),
                  child: const Padding(
                    padding: EdgeInsets.symmetric(horizontal: 14, vertical: 11),
                    child: Row(
                      children: [
                        Icon(Icons.logout, color: Colors.white, size: 22),
                        SizedBox(width: 14),
                        Text(
                          'Logout',
                          style: TextStyle(color: Colors.white, fontSize: 14),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _MenuItem {
  final IconData icon;
  final IconData selectedIcon;
  final String title;

  const _MenuItem(this.icon, this.selectedIcon, this.title);
}
