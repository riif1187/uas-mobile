import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/prestasi_provider.dart';

class PendaftaranListScreen extends StatefulWidget {
  const PendaftaranListScreen({super.key});

  @override
  State<PendaftaranListScreen> createState() => _PendaftaranListScreenState();
}

class _PendaftaranListScreenState extends State<PendaftaranListScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      context.read<PrestasiProvider>().loadPendaftaran(nim: nim);
    });
  }

  Color _statusColor(String status) {
    switch (status) {
      case 'disetujui':
        return Colors.green;
      case 'tidak_disetujui':
        return Colors.red;
      default:
        return Colors.orange;
    }
  }

  String _statusLabel(String status) {
    switch (status) {
      case 'disetujui':
        return 'Disetujui';
      case 'tidak_disetujui':
        return 'Ditolak';
      default:
        return 'Pending';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Pendaftaran Prestasi')),
      floatingActionButton: FloatingActionButton(
        onPressed: () => Navigator.of(context).pushNamed('/pendaftaran-create'),
        child: const Icon(Icons.add),
      ),
      body: Consumer<PrestasiProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.pendaftaran.isEmpty) {
            return const Center(child: Text('Belum ada pendaftaran'));
          }
          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: provider.pendaftaran.length,
            itemBuilder: (_, i) {
              final item = provider.pendaftaran[i];
              return Card(
                child: ListTile(
                  onTap: () => Navigator.of(context).pushNamed(
                    '/capaian-create',
                    arguments: {'pendaftaran_id': item.pendaftaranId},
                  ),
                  title: Text(item.namaKegiatan),
                  subtitle: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text('ID: ${item.pendaftaranId}'),
                      if (item.namaMahasiswa != null)
                        Text('Mahasiswa: ${item.namaMahasiswa}'),
                      if (item.namaKejuaraan != null)
                        Text('Kejuaraan: ${item.namaKejuaraan}'),
                      Text('Status: ${_statusLabel(item.status)}'),
                    ],
                  ),
                  isThreeLine: true,
                  trailing: Chip(
                    label: Text(
                      _statusLabel(item.status),
                      style: const TextStyle(color: Colors.white, fontSize: 12),
                    ),
                    backgroundColor: _statusColor(item.status),
                  ),
                ),
              );
            },
          );
        },
      ),
    );
  }
}

