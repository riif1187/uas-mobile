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
      appBar: AppBar(title: const Text('Tambah Capaian')),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              TextFormField(
                controller: _nimController,
                decoration: const InputDecoration(
                  labelText: 'NIM',
                  prefixIcon: Icon(Icons.badge),
                  border: OutlineInputBorder(),
                ),
                validator: (v) =>
                    v == null || v.isEmpty ? 'NIM wajib diisi' : null,
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _pendaftaranIdController,
                decoration: const InputDecoration(
                  labelText: 'ID Pendaftaran',
                  helperText: 'Pilih dari daftar pendaftaran atau isi manual',
                  border: OutlineInputBorder(),
                ),
                validator: (v) => v == null || v.isEmpty
                    ? 'ID Pendaftaran wajib diisi'
                    : null,
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _peringkatController,
                decoration: const InputDecoration(
                  labelText: 'Peringkat',
                  border: OutlineInputBorder(),
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
                      decoration: const InputDecoration(
                        labelText: 'NIP Dosen',
                        border: OutlineInputBorder(),
                      ),
                      onChanged: (v) => _selectedNip = v,
                      validator: (v) => v == null || v.isEmpty
                          ? 'NIP Dosen wajib diisi'
                          : null,
                    );
                  }
                  return DropdownButtonFormField<String>(
                    decoration: const InputDecoration(
                      labelText: 'Pilih Dosen',
                      border: OutlineInputBorder(),
                    ),
                    items: dosenProvider.dosen.map((d) {
                      return DropdownMenuItem(
                        value: d.nip,
                        child: Text('${d.nama} (${d.nip})'),
                      );
                    }).toList(),
                    onChanged: (v) => _selectedNip = v,
                    validator: (v) =>
                        v == null ? 'Pilih dosen pembimbing' : null,
                  );
                },
              ),
              const SizedBox(height: 16),
              Row(
                children: [
                  Expanded(
                    child: OutlinedButton.icon(
                      onPressed: _pickFile,
                      icon: const Icon(Icons.upload_file),
                      label: Text(
                        _file != null ? 'File dipilih' : 'Upload Bukti',
                      ),
                    ),
                  ),
                  if (_file != null)
                    IconButton(
                      icon: const Icon(Icons.check_circle, color: Colors.green),
                      onPressed: null,
                    ),
                ],
              ),
              const SizedBox(height: 24),
              Consumer<PrestasiProvider>(
                builder: (_, provider, __) => SizedBox(
                  width: double.infinity,
                  height: 48,
                  child: ElevatedButton(
                    onPressed: provider.isLoading ? null : _submit,
                    child: provider.isLoading
                        ? const CircularProgressIndicator()
                        : const Text('Simpan Capaian'),
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
