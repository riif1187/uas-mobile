import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/prestasi_provider.dart';

class PendaftaranCreateScreen extends StatefulWidget {
  const PendaftaranCreateScreen({super.key});

  @override
  State<PendaftaranCreateScreen> createState() => _PendaftaranCreateScreenState();
}

class _PendaftaranCreateScreenState extends State<PendaftaranCreateScreen> {
  final _formKey = GlobalKey<FormState>();
  final _kegiatanController = TextEditingController();
  String? _selectedRefId;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<PrestasiProvider>().loadReferensi();
    });
  }

  @override
  void dispose() {
    _kegiatanController.dispose();
    super.dispose();
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;

    final auth = context.read<AuthProvider>();
    final nim = auth.user?.email ?? '';

    await context.read<PrestasiProvider>().createPendaftaran({
      'NIM': nim,
      'ref_id': _selectedRefId,
      'nama_kegiatan': _kegiatanController.text.trim(),
    });

    if (!mounted) return;
    Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Daftar Prestasi')),
      body: Consumer<PrestasiProvider>(
        builder: (_, provider, __) {
          return SingleChildScrollView(
            padding: const EdgeInsets.all(16),
            child: Form(
              key: _formKey,
              child: Column(
                children: [
                  DropdownButtonFormField<String>(
                    decoration: const InputDecoration(
                      labelText: 'Pilih Kejuaraan',
                      border: OutlineInputBorder(),
                    ),
                    items: provider.referensi.map((r) {
                      return DropdownMenuItem(
                        value: r.refId,
                        child: Text('${r.namaKejuaraan} (${r.bobotPoin} poin)'),
                      );
                    }).toList(),
                    onChanged: (v) => _selectedRefId = v,
                    validator: (v) => v == null ? 'Pilih kejuaraan' : null,
                  ),
                  const SizedBox(height: 16),
                  TextFormField(
                    controller: _kegiatanController,
                    decoration: const InputDecoration(
                      labelText: 'Nama Kegiatan',
                      border: OutlineInputBorder(),
                    ),
                    validator: (v) => v == null || v.isEmpty ? 'Nama kegiatan wajib diisi' : null,
                  ),
                  const SizedBox(height: 24),
                  Consumer<PrestasiProvider>(
                    builder: (_, p, __) => SizedBox(
                      width: double.infinity,
                      height: 48,
                      child: ElevatedButton(
                        onPressed: p.isLoading ? null : _submit,
                        child: p.isLoading
                            ? const CircularProgressIndicator()
                            : const Text('Daftarkan'),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}
