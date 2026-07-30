import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/mahasiswa_provider.dart';

class FuzzyKlasifikasiScreen extends StatefulWidget {
  const FuzzyKlasifikasiScreen({super.key});

  @override
  State<FuzzyKlasifikasiScreen> createState() => _FuzzyKlasifikasiScreenState();
}

class _FuzzyKlasifikasiScreenState extends State<FuzzyKlasifikasiScreen> {
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

  Color _labelColor(String label) {
    if (label.toLowerCase().contains('tinggi')) return const Color(0xFF4CAF50);
    if (label.toLowerCase().contains('sedang')) return const Color(0xFFFF9800);
    return const Color(0xFFE53935);
  }

  IconData _labelIcon(String label) {
    if (label.toLowerCase().contains('tinggi')) return Icons.arrow_upward;
    if (label.toLowerCase().contains('sedang')) return Icons.remove;
    return Icons.arrow_downward;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Klasifikasi Fuzzy'),
        flexibleSpace: Container(
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [Color(0xFF1A237E), Color(0xFF3949AB)],
            ),
          ),
        ),
      ),
      body: Consumer<MahasiswaProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          final fuzzy = provider.fuzzy;
          if (fuzzy == null) {
            return const Center(child: Text('Belum ada data klasifikasi'));
          }
          return Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              children: [
                Container(
                  width: double.infinity,
                  padding: const EdgeInsets.all(24),
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [
                        _labelColor(fuzzy.labelFuzzy).withOpacity(0.15),
                        _labelColor(fuzzy.labelFuzzy).withOpacity(0.05),
                      ],
                    ),
                    borderRadius: BorderRadius.circular(20),
                    border: Border.all(
                      color: _labelColor(fuzzy.labelFuzzy).withOpacity(0.3),
                    ),
                  ),
                  child: Column(
                    children: [
                      Container(
                        padding: const EdgeInsets.all(16),
                        decoration: BoxDecoration(
                          color: _labelColor(fuzzy.labelFuzzy).withOpacity(0.15),
                          shape: BoxShape.circle,
                        ),
                        child: Icon(
                          _labelIcon(fuzzy.labelFuzzy),
                          size: 40,
                          color: _labelColor(fuzzy.labelFuzzy),
                        ),
                      ),
                      const SizedBox(height: 16),
                      Text(
                        fuzzy.labelFuzzy,
                        style: TextStyle(
                          fontSize: 24,
                          fontWeight: FontWeight.bold,
                          color: _labelColor(fuzzy.labelFuzzy),
                        ),
                      ),
                      const SizedBox(height: 8),
                      Text(
                        'Skor: ${fuzzy.skorFuzzy.toStringAsFixed(2)}',
                        style: TextStyle(
                          fontSize: 16,
                          color: Colors.grey.shade600,
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 20),
                _DataRow(
                  icon: Icons.emoji_events_outlined,
                  label: 'Jumlah Prestasi',
                  value: fuzzy.jumlahPrestasi.toString(),
                  color: const Color(0xFFFF9800),
                ),
                _DataRow(
                  icon: Icons.score_outlined,
                  label: 'Total Poin',
                  value: fuzzy.totalPoin.toString(),
                  color: const Color(0xFF9C27B0),
                ),
                _DataRow(
                  icon: Icons.stars_outlined,
                  label: 'Peringkat Terbaik',
                  value: fuzzy.peringkatTerbaik.toString(),
                  color: const Color(0xFF4CAF50),
                ),
              ],
            ),
          );
        },
      ),
    );
  }
}

class _DataRow extends StatelessWidget {
  final IconData icon;
  final String label;
  final String value;
  final Color color;

  const _DataRow({
    required this.icon,
    required this.label,
    required this.value,
    required this.color,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      width: double.infinity,
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: color.withOpacity(0.06),
        borderRadius: BorderRadius.circular(14),
        border: Border.all(color: color.withOpacity(0.15)),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: color.withOpacity(0.12),
              borderRadius: BorderRadius.circular(12),
            ),
            child: Icon(icon, color: color, size: 24),
          ),
          const SizedBox(width: 14),
          Expanded(
            child: Text(
              label,
              style: TextStyle(fontSize: 14, color: Colors.grey.shade600),
            ),
          ),
          Text(
            value,
            style: TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.bold,
              color: Colors.grey.shade800,
            ),
          ),
        ],
      ),
    );
  }
}
