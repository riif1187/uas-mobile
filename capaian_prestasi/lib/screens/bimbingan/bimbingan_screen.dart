import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:provider/provider.dart';
import '../../providers/bimbingan_provider.dart';

class BimbinganScreen extends StatefulWidget {
  const BimbinganScreen({super.key});

  @override
  State<BimbinganScreen> createState() => _BimbinganScreenState();
}

class _BimbinganScreenState extends State<BimbinganScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<BimbinganProvider>().load();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Riwayat Bimbingan')),
      body: Consumer<BimbinganProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.list.isEmpty) {
            return const Center(child: Text('Belum ada bimbingan'));
          }
          return ListView.builder(
            padding: const EdgeInsets.all(16),
            itemCount: provider.list.length,
            itemBuilder: (_, i) {
              final item = provider.list[i];
              return Card(
                child: ListTile(
                  leading: const Icon(Icons.forum, color: Colors.teal),
                  title: Text('Dosen: ${item.nipDosen}'),
                  subtitle: Text('Tanggal: ${item.tanggalBimbingan}'),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
