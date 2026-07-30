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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Klasifikasi Fuzzy')),
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
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _InfoCard(label: 'Jumlah Prestasi', value: fuzzy.jumlahPrestasi.toString()),
                _InfoCard(label: 'Total Poin', value: fuzzy.totalPoin.toString()),
                _InfoCard(label: 'Peringkat Terbaik', value: fuzzy.peringkatTerbaik.toString()),
                _InfoCard(label: 'Skor Fuzzy', value: fuzzy.skorFuzzy.toStringAsFixed(2)),
                _InfoCard(label: 'Label', value: fuzzy.labelFuzzy, isLabel: true),
              ],
            ),
          );
        },
      ),
    );
  }
}

class _InfoCard extends StatelessWidget {
  final String label;
  final String value;
  final bool isLabel;

  const _InfoCard({required this.label, required this.value, this.isLabel = false});

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(label, style: const TextStyle(fontSize: 16)),
            Text(
              value,
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
                color: isLabel ? Theme.of(context).primaryColor : null,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
