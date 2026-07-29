import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/mahasiswa_provider.dart';

class DataLengkapScreen extends StatelessWidget {
  const DataLengkapScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Data Akademik')),
      body: Consumer<MahasiswaProvider>(
        builder: (_, provider, __) {
          if (provider.dataLengkap.isEmpty) {
            return const Center(child: Text('Belum ada data akademik'));
          }
          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: provider.dataLengkap.length,
            itemBuilder: (_, i) {
              final item = provider.dataLengkap[i];
              return Card(
                child: ListTile(
                  leading: const Icon(Icons.book),
                  title: Text('Mata Kuliah: ${item.matkul}'),
                  subtitle: Text('TA ID: ${item.tahunAkademikId}'),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
