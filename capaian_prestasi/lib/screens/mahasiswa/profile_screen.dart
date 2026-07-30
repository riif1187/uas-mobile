import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/mahasiswa/mahasiswa.dart';
import '../../providers/auth_provider.dart';
import '../../providers/mahasiswa_provider.dart';

class ProfileScreen extends StatefulWidget {
  const ProfileScreen({super.key});

  @override
  State<ProfileScreen> createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  final _formKey = GlobalKey<FormState>();
  late TextEditingController _nimController;
  late TextEditingController _namaController;
  late TextEditingController _fakultasController;
  late TextEditingController _prodiController;
  late TextEditingController _tempatLahirController;
  late TextEditingController _tanggalLahirController;
  late TextEditingController _jenisKelaminController;
  late TextEditingController _emailController;
  late TextEditingController _noTeleponController;
  late TextEditingController _alamatController;

  @override
  void initState() {
    super.initState();
    _nimController = TextEditingController();
    _namaController = TextEditingController();
    _fakultasController = TextEditingController();
    _prodiController = TextEditingController();
    _tempatLahirController = TextEditingController();
    _tanggalLahirController = TextEditingController();
    _jenisKelaminController = TextEditingController();
    _emailController = TextEditingController();
    _noTeleponController = TextEditingController();
    _alamatController = TextEditingController();

    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      if (nim != null) {
        context.read<MahasiswaProvider>().loadByNim(nim);
      }
    });
  }

  void _fillForm(Mahasiswa m) {
    _nimController.text = m.nim;
    _namaController.text = m.nama;
    _fakultasController.text = m.fakultas;
    _prodiController.text = m.prodi;
    _tempatLahirController.text = m.tempatLahir;
    _tanggalLahirController.text = m.tanggalLahir;
    _jenisKelaminController.text = m.jenisKelamin;
    _emailController.text = m.email ?? '';
    _noTeleponController.text = m.noTelepon;
    _alamatController.text = m.alamat;
  }

  @override
  void dispose() {
    _nimController.dispose();
    _namaController.dispose();
    _fakultasController.dispose();
    _prodiController.dispose();
    _tempatLahirController.dispose();
    _tanggalLahirController.dispose();
    _jenisKelaminController.dispose();
    _emailController.dispose();
    _noTeleponController.dispose();
    _alamatController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Profil Mahasiswa')),
      body: Consumer<MahasiswaProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.error != null) {
            return Center(child: Text(provider.error!, style: const TextStyle(color: Colors.red)));
          }
          if (provider.data == null) {
            return const Center(child: Text('Data tidak ditemukan. Isi profil di halaman admin.'));
          }

          if (_nimController.text.isEmpty) {
            WidgetsBinding.instance.addPostFrameCallback((_) => _fillForm(provider.data!));
          }

          return SingleChildScrollView(
            padding: const EdgeInsets.all(16),
            child: Form(
              key: _formKey,
              child: Column(
                children: [
                  _buildField('NIM', _nimController, enabled: false),
                  _buildField('Nama', _namaController),
                  _buildField('Fakultas', _fakultasController),
                  _buildField('Prodi', _prodiController),
                  _buildField('Tempat Lahir', _tempatLahirController),
                  _buildField('Tanggal Lahir', _tanggalLahirController),
                  _buildField('Jenis Kelamin', _jenisKelaminController),
                  _buildField('Email', _emailController),
                  _buildField('No Telepon', _noTeleponController),
                  _buildField('Alamat', _alamatController),
                  const SizedBox(height: 24),
                  SizedBox(
                    width: double.infinity,
                    height: 48,
                    child: ElevatedButton(
                      onPressed: () {
                        final m = Mahasiswa(
                          nim: _nimController.text,
                          nama: _namaController.text,
                          fakultas: _fakultasController.text,
                          prodi: _prodiController.text,
                          tempatLahir: _tempatLahirController.text,
                          tanggalLahir: _tanggalLahirController.text,
                          jenisKelamin: _jenisKelaminController.text,
                          email: _emailController.text,
                          noTelepon: _noTeleponController.text,
                          alamat: _alamatController.text,
                          agama: provider.data!.agama,
                          kewarganegaraan: provider.data!.kewarganegaraan,
                          statusPernikahan: provider.data!.statusPernikahan,
                        );
                        provider.update(m);
                      },
                      child: const Text('Simpan'),
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

  Widget _buildField(String label, TextEditingController controller, {bool enabled = true}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextFormField(
        controller: controller,
        enabled: enabled,
        decoration: InputDecoration(
          labelText: label,
          border: const OutlineInputBorder(),
        ),
      ),
    );
  }
}
