import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:provider/provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/dosen_provider.dart';
import '../../providers/mahasiswa_provider.dart';
import '../../providers/prestasi_provider.dart';

class CapaianCreateScreen extends StatefulWidget {
  const CapaianCreateScreen({super.key});

  @override
  State<CapaianCreateScreen> createState() => _CapaianCreateScreenState();
}

class _CapaianCreateScreenState extends State<CapaianCreateScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nimController = TextEditingController();
  final _pendaftaranIdController = TextEditingController();
  final _peringkatController = TextEditingController();
  String? _selectedNip;
  XFile? _file;
  final _picker = ImagePicker();

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      if (nim != null) {
        _nimController.text = nim;
      }
      context.read<DosenProvider>().loadDosen();
      final args = ModalRoute.of(context)?.settings.arguments;
      if (args is Map<String, dynamic>) {
        final pendaftaranId = args['pendaftaran_id'] as String?;
        if (pendaftaranId != null) {
          _pendaftaranIdController.text = pendaftaranId;
        }
      }
    });
  }

  @override
  void dispose() {
    _nimController.dispose();
    _pendaftaranIdController.dispose();
    _peringkatController.dispose();
    super.dispose();
  }

  Future<void> _pickFile() async {
    final picked = await _picker.pickImage(source: ImageSource.gallery);
    if (picked != null) {
      setState(() => _file = picked);
    }
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;

    final nim = _nimController.text.trim();

    final provider = context.read<PrestasiProvider>();
    final success = await provider.createCapaian(
      pendaftaranId: _pendaftaranIdController.text.trim(),
      peringkat: _peringkatController.text.trim(),
      nip: _selectedNip ?? '',
      file: _file,
      nim: nim,
    );

    if (!mounted) return;

    if (!success) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text(provider.error ?? 'Capaian gagal disimpan')),
      );
      return;
    }

    if (nim.isNotEmpty) {
      await context.read<MahasiswaProvider>().refreshFuzzy(nim);
    }

    if (!mounted) return;
    Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Tambah Capaian'),
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
      body: SingleChildScrollView(
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
                    TextFormField(
                      controller: _pendaftaranIdController,
                      decoration: InputDecoration(
                        labelText: 'ID Pendaftaran',
                        helperText: 'Pilih dari daftar pendaftaran atau isi manual',
                        prefixIcon: const Icon(Icons.assignment_outlined),
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                        filled: true,
                        fillColor: Colors.grey.shade50,
                      ),
                      validator: (v) =>
                          v == null || v.isEmpty ? 'ID Pendaftaran wajib diisi' : null,
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _peringkatController,
                      decoration: InputDecoration(
                        labelText: 'Peringkat',
                        prefixIcon: const Icon(Icons.stars_outlined),
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                        filled: true,
                        fillColor: Colors.grey.shade50,
                      ),
                      validator: (v) =>
                          v == null || v.isEmpty ? 'Peringkat wajib diisi' : null,
                    ),
                    const SizedBox(height: 16),
                    Consumer<DosenProvider>(
                      builder: (_, dosenProvider, __) {
                        if (dosenProvider.isLoading) {
                          return const Center(child: CircularProgressIndicator());
                        }
                        if (dosenProvider.dosen.isEmpty) {
                          return TextFormField(
                            controller: TextEditingController(text: _selectedNip),
                            decoration: InputDecoration(
                              labelText: 'NIP Dosen',
                              prefixIcon: const Icon(Icons.school_outlined),
                              border: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(12),
                              ),
                              filled: true,
                              fillColor: Colors.grey.shade50,
                            ),
                            onChanged: (v) => _selectedNip = v,
                            validator: (v) =>
                                v == null || v.isEmpty ? 'NIP Dosen wajib diisi' : null,
                          );
                        }
                        return DropdownButtonFormField<String>(
                          decoration: InputDecoration(
                            labelText: 'Pilih Dosen',
                            prefixIcon: const Icon(Icons.school_outlined),
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                            filled: true,
                            fillColor: Colors.grey.shade50,
                          ),
                          items: dosenProvider.dosen.map((d) {
                            return DropdownMenuItem(
                              value: d.nip,
                              child: Text('${d.nama} (${d.nip})'),
                            );
                          }).toList(),
                          onChanged: (v) => _selectedNip = v,
                          validator: (v) => v == null ? 'Pilih dosen pembimbing' : null,
                        );
                      },
                    ),
                    const SizedBox(height: 16),
                    InkWell(
                      onTap: _pickFile,
                      borderRadius: BorderRadius.circular(12),
                      child: Container(
                        width: double.infinity,
                        padding: const EdgeInsets.symmetric(vertical: 20),
                        decoration: BoxDecoration(
                          color: _file != null
                              ? const Color(0xFFE8F5E9)
                              : Colors.grey.shade50,
                          borderRadius: BorderRadius.circular(12),
                          border: Border.all(
                            color: _file != null
                                ? const Color(0xFF4CAF50)
                                : Colors.grey.shade200,
                            style: _file != null ? BorderStyle.solid : BorderStyle.solid,
                          ),
                        ),
                        child: Column(
                          children: [
                            Icon(
                              _file != null
                                  ? Icons.check_circle_outline
                                  : Icons.upload_file,
                              size: 36,
                              color: _file != null
                                  ? const Color(0xFF4CAF50)
                                  : Colors.grey.shade400,
                            ),
                            const SizedBox(height: 8),
                            Text(
                              _file != null ? 'File bukti dipilih' : 'Upload Bukti',
                              style: TextStyle(
                                color: _file != null
                                    ? const Color(0xFF4CAF50)
                                    : Colors.grey.shade500,
                                fontWeight: FontWeight.w500,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),
              Consumer<PrestasiProvider>(
                builder: (_, provider, __) => SizedBox(
                  width: double.infinity,
                  height: 50,
                  child: ElevatedButton(
                    onPressed: provider.isLoading ? null : _submit,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF3949AB),
                      foregroundColor: Colors.white,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                      elevation: 2,
                    ),
                    child: provider.isLoading
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
                            'Simpan Capaian',
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
      ),
    );
  }
}
