import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/mahasiswa_provider.dart';
import '../../providers/prestasi_provider.dart';

class PendaftaranCreateScreen extends StatefulWidget {
  const PendaftaranCreateScreen({super.key});

  @override
  State<PendaftaranCreateScreen> createState() => _PendaftaranCreateScreenState();
}

class _PendaftaranCreateScreenState extends State<PendaftaranCreateScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nimController = TextEditingController();
  final _kegiatanController = TextEditingController();
  String? _selectedRefId;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      if (nim != null) {
        _nimController.text = nim;
      }
      context.read<PrestasiProvider>().loadReferensi();
    });
  }

  @override
  void dispose() {
    _nimController.dispose();
    _kegiatanController.dispose();
    super.dispose();
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;

    final nim = _nimController.text.trim();

    await context.read<PrestasiProvider>().createPendaftaran({
      'NIM': nim,
      'ref_id': _selectedRefId,
      'nama_kegiatan': _kegiatanController.text.trim(),
    });

    if (!mounted) return;
    context.read<MahasiswaProvider>().refreshFuzzy(nim);
    Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Daftar Prestasi'),
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
      body: Consumer<PrestasiProvider>(
        builder: (_, provider, __) {
          return SingleChildScrollView(
            padding: const EdgeInsets.all(20),
            child: Form(
              key: _formKey,
              child: Column(
                children: [
                  Container(
                    padding: const EdgeInsets.all(24),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(16),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.indigo.withOpacity(0.06),
                          blurRadius: 12,
                          offset: const Offset(0, 4),
                        ),
                      ],
                    ),
                    child: Column(
                      children: [
                        TextFormField(
                          controller: _nimController,
                          decoration: InputDecoration(
                            labelText: 'NIM',
                            prefixIcon: const Icon(Icons.badge_outlined),
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                            filled: true,
                            fillColor: Colors.grey.shade50,
                          ),
                          validator: (v) =>
                              v == null || v.isEmpty ? 'NIM wajib diisi' : null,
                        ),
                        const SizedBox(height: 16),
                        DropdownButtonFormField<String>(
                          decoration: InputDecoration(
                            labelText: 'Pilih Kejuaraan',
                            prefixIcon: const Icon(Icons.emoji_events_outlined),
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                            filled: true,
                            fillColor: Colors.grey.shade50,
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
                          decoration: InputDecoration(
                            labelText: 'Nama Kegiatan',
                            prefixIcon: const Icon(Icons.event_outlined),
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                            filled: true,
                            fillColor: Colors.grey.shade50,
                          ),
                          validator: (v) =>
                              v == null || v.isEmpty ? 'Nama kegiatan wajib diisi' : null,
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 24),
                  Consumer<PrestasiProvider>(
                    builder: (_, p, __) => SizedBox(
                      width: double.infinity,
                      height: 50,
                      child: ElevatedButton(
                        onPressed: p.isLoading ? null : _submit,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF3949AB),
                          foregroundColor: Colors.white,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                          elevation: 2,
                        ),
                        child: p.isLoading
                            ? const SizedBox(
                                width: 20,
                                height: 20,
                                child: CircularProgressIndicator(
                                  strokeWidth: 2,
                                  valueColor:
                                      AlwaysStoppedAnimation<Color>(Colors.white),
                                ),
                              )
                            : const Text(
                                'Daftarkan',
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
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
