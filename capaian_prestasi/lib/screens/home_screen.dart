import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/auth_provider.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthProvider>();
    final user = auth.user;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Dashboard'),
        actions: [
          IconButton(
            icon: const Icon(Icons.logout),
            onPressed: () async {
              await auth.logout();
              if (context.mounted) {
                Navigator.of(context).pushReplacementNamed('/login');
              }
            },
          ),
        ],
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Selamat datang, ${user?.name ?? "Mahasiswa"}',
                style: Theme.of(context).textTheme.headlineSmall),
            const SizedBox(height: 24),
            Expanded(
              child: GridView.count(
                crossAxisCount: 2,
                mainAxisSpacing: 12,
                crossAxisSpacing: 12,
                children: [
                  _MenuCard(
                    icon: Icons.person,
                    title: 'Profil',
                    color: Colors.blue,
                    onTap: () => Navigator.of(context).pushNamed('/profile'),
                  ),
                  _MenuCard(
                    icon: Icons.emoji_events,
                    title: 'Referensi Lomba',
                    color: Colors.orange,
                    onTap: () => Navigator.of(context).pushNamed('/referensi'),
                  ),
                  _MenuCard(
                    icon: Icons.assignment,
                    title: 'Pendaftaran',
                    color: Colors.green,
                    onTap: () => Navigator.of(context).pushNamed('/pendaftaran-list'),
                  ),
                  _MenuCard(
                    icon: Icons.verified,
                    title: 'Capaian',
                    color: Colors.purple,
                    onTap: () => Navigator.of(context).pushNamed('/capaian-list'),
                  ),
                  _MenuCard(
                    icon: Icons.forum,
                    title: 'Bimbingan',
                    color: Colors.teal,
                    onTap: () => Navigator.of(context).pushNamed('/bimbingan'),
                  ),
                  _MenuCard(
                    icon: Icons.auto_graph,
                    title: 'Klasifikasi Fuzzy',
                    color: Colors.red,
                    onTap: () => Navigator.of(context).pushNamed('/fuzzy'),
                  ),
                  _MenuCard(
                    icon: Icons.book,
                    title: 'Data Akademik',
                    color: Colors.indigo,
                    onTap: () => Navigator.of(context).pushNamed('/data-lengkap'),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _MenuCard extends StatelessWidget {
  final IconData icon;
  final String title;
  final Color color;
  final VoidCallback onTap;

  const _MenuCard({
    required this.icon,
    required this.title,
    required this.color,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 2,
      child: InkWell(
        onTap: onTap,
        borderRadius: BorderRadius.circular(12),
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Icon(icon, size: 48, color: color),
              const SizedBox(height: 8),
              Text(title, textAlign: TextAlign.center, style: const TextStyle(fontWeight: FontWeight.w500)),
            ],
          ),
        ),
      ),
    );
  }
}
