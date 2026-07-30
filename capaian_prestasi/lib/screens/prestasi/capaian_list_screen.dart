import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/prestasi_provider.dart';

class CapaianListScreen extends StatefulWidget {
  const CapaianListScreen({super.key});

  @override
  State<CapaianListScreen> createState() => _CapaianListScreenState();
}

class _CapaianListScreenState extends State<CapaianListScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      context.read<PrestasiProvider>().loadCapaian(nim: nim);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Capaian Prestasi')),
      floatingActionButton: FloatingActionButton(
        onPressed: () => Navigator.of(context).pushNamed('/capaian-create'),
        child: const Icon(Icons.add),
      ),
      body: Consumer<PrestasiProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.capaian.isEmpty) {
            return const Center(child: Text('Belum ada capaian'));
          }
          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: provider.capaian.length,
            itemBuilder: (_, i) {
              final item = provider.capaian[i];
              return Card(
                child: ListTile(
                  leading: const Icon(Icons.verified, color: Colors.green),
                  title: Text('Peringkat: ${item.peringkat}'),
                  subtitle: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      if (item.namaMahasiswa != null)
                        Text('Mahasiswa: ${item.namaMahasiswa}'),
                      if (item.namaKegiatan != null)
                        Text('Kegiatan: ${item.namaKegiatan}'),
                      if (item.namaKejuaraan != null)
                        Text('Kejuaraan: ${item.namaKejuaraan}'),
                      if (item.namaDosen != null)
                        Text('Dosen: ${item.namaDosen}'),
                    ],
                  ),
                  isThreeLine: true,
                ),
              );
            },
          );
        },
      ),
    );
  }
}
