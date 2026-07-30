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
        return const Color(0xFF4CAF50);
      case 'tidak_disetujui':
        return const Color(0xFFE53935);
      default:
        return const Color(0xFFFF9800);
    }
  }

  Color _statusBgColor(String status) {
    switch (status) {
      case 'disetujui':
        return const Color(0xFFE8F5E9);
      case 'tidak_disetujui':
        return const Color(0xFFFFEBEE);
      default:
        return const Color(0xFFFFF8E1);
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

  IconData _statusIcon(String status) {
    switch (status) {
      case 'disetujui':
        return Icons.check_circle;
      case 'tidak_disetujui':
        return Icons.cancel;
      default:
        return Icons.schedule;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Pendaftaran Prestasi'),
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
      floatingActionButton: FloatingActionButton(
        onPressed: () => Navigator.of(context).pushNamed('/pendaftaran-create'),
        backgroundColor: const Color(0xFF3949AB),
        child: const Icon(Icons.add),
      ),
      body: Consumer<PrestasiProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.pendaftaran.isEmpty) {
            return Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Icon(Icons.assignment_outlined, size: 64, color: Colors.grey.shade300),
                  const SizedBox(height: 16),
                  Text(
                    'Belum ada pendaftaran',
                    style: TextStyle(fontSize: 16, color: Colors.grey.shade500),
                  ),
                ],
              ),
            );
          }
          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: provider.pendaftaran.length,
            itemBuilder: (_, i) {
              final item = provider.pendaftaran[i];
              return Container(
                margin: const EdgeInsets.only(bottom: 12),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(14),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.indigo.withOpacity(0.06),
                      blurRadius: 10,
                      offset: const Offset(0, 4),
                    ),
                  ],
                  border: Border.all(color: Colors.grey.shade100),
                ),
                child: Material(
                  color: Colors.transparent,
                  child: InkWell(
                    onTap: () => Navigator.of(context).pushNamed(
                      '/capaian-create',
                      arguments: {'pendaftaran_id': item.pendaftaranId},
                    ),
                    borderRadius: BorderRadius.circular(14),
                    child: Padding(
                      padding: const EdgeInsets.all(16),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(
                            children: [
                              Container(
                                padding: const EdgeInsets.all(10),
                                decoration: BoxDecoration(
                                  color: const Color(0xFFE8EAF6),
                                  borderRadius: BorderRadius.circular(10),
                                ),
                                child: const Icon(
                                  Icons.assignment_outlined,
                                  color: Color(0xFF3949AB),
                                  size: 22,
                                ),
                              ),
                              const SizedBox(width: 12),
                              Expanded(
                                child: Text(
                                  item.namaKegiatan,
                                  style: const TextStyle(
                                    fontWeight: FontWeight.w600,
                                    fontSize: 15,
                                  ),
                                ),
                              ),
                              Container(
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 10,
                                  vertical: 5,
                                ),
                                decoration: BoxDecoration(
                                  color: _statusBgColor(item.status),
                                  borderRadius: BorderRadius.circular(8),
                                ),
                                child: Row(
                                  mainAxisSize: MainAxisSize.min,
                                  children: [
                                    Icon(
                                      _statusIcon(item.status),
                                      size: 14,
                                      color: _statusColor(item.status),
                                    ),
                                    const SizedBox(width: 4),
                                    Text(
                                      _statusLabel(item.status),
                                      style: TextStyle(
                                        fontSize: 11,
                                        fontWeight: FontWeight.w600,
                                        color: _statusColor(item.status),
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ],
                          ),
                          const SizedBox(height: 12),
                          if (item.namaMahasiswa != null)
                            _DetailRow(
                              icon: Icons.person_outline,
                              text: 'Mahasiswa: ${item.namaMahasiswa}',
                            ),
                          if (item.namaKejuaraan != null)
                            _DetailRow(
                              icon: Icons.emoji_events_outlined,
                              text: 'Kejuaraan: ${item.namaKejuaraan}',
                            ),
                          _DetailRow(
                            icon: Icons.tag,
                            text: 'ID: ${item.pendaftaranId}',
                          ),
                        ],
                      ),
                    ),
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

class _DetailRow extends StatelessWidget {
  final IconData icon;
  final String text;

  const _DetailRow({required this.icon, required this.text});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 4),
      child: Row(
        children: [
          Icon(icon, size: 14, color: Colors.grey.shade400),
          const SizedBox(width: 6),
          Text(text, style: TextStyle(fontSize: 13, color: Colors.grey.shade600)),
        ],
      ),
    );
  }
}
