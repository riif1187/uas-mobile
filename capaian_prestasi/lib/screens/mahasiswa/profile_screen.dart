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
  final _searchNimController = TextEditingController();
  final _nimController = TextEditingController();
  final _namaController = TextEditingController();
  final _fakultasController = TextEditingController();
  final _prodiController = TextEditingController();
  final _tempatLahirController = TextEditingController();
  final _tanggalLahirController = TextEditingController();
  final _jenisKelaminController = TextEditingController();
  final _emailController = TextEditingController();
  final _noTeleponController = TextEditingController();
  final _alamatController = TextEditingController();

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final nim = context.read<AuthProvider>().nim;
      if (nim != null) {
        _searchNimController.text = nim;
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
    _searchNimController.dispose();
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
      appBar: AppBar(
        title: const Text('Profil Mahasiswa'),
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
      body: Consumer<MahasiswaProvider>(
        builder: (_, provider, __) {
          if (provider.isLoading && provider.data == null) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.data == null) {
            return _buildSearchView(provider);
          }
          if (_nimController.text.isEmpty) {
            WidgetsBinding.instance.addPostFrameCallback((_) => _fillForm(provider.data!));
          }
          return _buildProfileForm(provider);
        },
      ),
    );
  }

  Widget _buildSearchView(MahasiswaProvider provider) {
    return Padding(
      padding: const EdgeInsets.all(24),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: Colors.indigo.withOpacity(0.08),
              shape: BoxShape.circle,
            ),
            child: const Icon(Icons.search, size: 48, color: Color(0xFF3949AB)),
          ),
          const SizedBox(height: 20),
          Text(
            'Masukkan NIM untuk melihat profil',
            style: TextStyle(fontSize: 16, color: Colors.grey.shade600),
          ),
          const SizedBox(height: 24),
          TextField(
            controller: _searchNimController,
            decoration: InputDecoration(
              labelText: 'NIM',
              prefixIcon: const Icon(Icons.badge_outlined),
              border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
              filled: true,
              fillColor: Colors.grey.shade50,
            ),
          ),
          const SizedBox(height: 16),
          if (provider.error != null)
            Padding(
              padding: const EdgeInsets.only(bottom: 8),
              child: Text(provider.error!, style: const TextStyle(color: Colors.red)),
            ),
          SizedBox(
            width: double.infinity,
            height: 48,
            child: ElevatedButton.icon(
              onPressed: () {
                final nim = _searchNimController.text.trim();
                if (nim.isEmpty) return;
                provider.loadByNim(nim);
              },
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF3949AB),
                foregroundColor: Colors.white,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
              ),
              icon: const Icon(Icons.search),
              label: const Text('Cari'),
            ),
          ),
        ],
      ),
    );
  }

  Color _sectionColor(String label) {
    switch (label) {
      case 'Identitas':
        return const Color(0xFF5C6BC0);
      case 'Akademik':
        return const Color(0xFF4CAF50);
      case 'Kontak':
        return const Color(0xFFFF9800);
      case 'Alamat':
        return const Color(0xFF009688);
      default:
        return const Color(0xFF3949AB);
    }
  }

  Widget _buildSection(String title, List<Widget> fields) {
    return Container(
      margin: const EdgeInsets.only(bottom: 20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                width: 4,
                height: 20,
                decoration: BoxDecoration(
                  color: _sectionColor(title),
                  borderRadius: BorderRadius.circular(2),
                ),
              ),
              const SizedBox(width: 10),
              Text(
                title,
                style: TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: Colors.grey.shade800,
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          ...fields,
        ],
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
          border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
          filled: true,
          fillColor: Colors.grey.shade50,
          contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
        ),
      ),
    );
  }

  Widget _buildProfileForm(MahasiswaProvider provider) {
    return SingleChildScrollView(
      padding: const EdgeInsets.all(16),
      child: Form(
        key: _formKey,
        child: Column(
          children: [
            _buildSection('Identitas', [
              _buildField('NIM', _nimController, enabled: false),
              _buildField('Nama Lengkap', _namaController),
              _buildField('Tempat Lahir', _tempatLahirController),
              _buildField('Tanggal Lahir', _tanggalLahirController),
              _buildField('Jenis Kelamin', _jenisKelaminController),
            ]),
            _buildSection('Akademik', [
              _buildField('Fakultas', _fakultasController),
              _buildField('Program Studi', _prodiController),
            ]),
            _buildSection('Kontak', [
              _buildField('Email', _emailController),
              _buildField('No Telepon', _noTeleponController),
            ]),
            _buildSection('Alamat', [
              _buildField('Alamat', _alamatController),
            ]),
            const SizedBox(height: 8),
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
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF3949AB),
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  elevation: 2,
                ),
                child: const Text(
                  'Simpan',
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.w600),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
