import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/auth_provider.dart';
import '../providers/mahasiswa_provider.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      if (nim != null) {
        context.read<MahasiswaProvider>().refreshFuzzy(nim);
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthProvider>();
    final user = auth.user;
    final fuzzy = context.watch<MahasiswaProvider>().fuzzy;

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
            const SizedBox(height: 8),
            if (fuzzy != null)
              Card(
                color: Theme.of(context).colorScheme.primaryContainer,
                child: Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                  child: Row(
                    children: [
                      Icon(Icons.auto_graph, color: Theme.of(context).colorScheme.primary),
                      const SizedBox(width: 12),
                      Expanded(
                        child: Text(
                          'Skor Fuzzy: ${fuzzy.skorFuzzy.toStringAsFixed(1)} — ${fuzzy.labelFuzzy}',
                          style: const TextStyle(fontWeight: FontWeight.w600),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            const SizedBox(height: 16),
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
