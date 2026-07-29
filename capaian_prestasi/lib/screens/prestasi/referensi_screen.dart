import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/prestasi_provider.dart';

class ReferensiScreen extends StatefulWidget {
  const ReferensiScreen({super.key});

  @override
  State<ReferensiScreen> createState() => _ReferensiScreenState();
}

class _ReferensiScreenState extends State<ReferensiScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<PrestasiProvider>().loadReferensi();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Referensi Kejuaraan')),
      body: Consumer<PrestasiProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.referensi.isEmpty) {
            return const Center(child: Text('Belum ada data referensi'));
          }
          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: provider.referensi.length,
            itemBuilder: (_, i) {
              final item = provider.referensi[i];
              return Card(
                child: ListTile(
                  leading: const Icon(Icons.emoji_events, color: Colors.amber),
                  title: Text(item.namaKejuaraan),
                  subtitle: Text('Bobot Poin: ${item.bobotPoin}'),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
