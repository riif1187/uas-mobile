import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/mahasiswa/fuzzy_klasifikasi.dart';
import '../../providers/mahasiswa_provider.dart';

class FuzzyKlasifikasiScreen extends StatefulWidget {
  const FuzzyKlasifikasiScreen({super.key});

  @override
  State<FuzzyKlasifikasiScreen> createState() => _FuzzyKlasifikasiScreenState();
}

class _FuzzyKlasifikasiScreenState extends State<FuzzyKlasifikasiScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<MahasiswaProvider>().loadFuzzyAll();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Klasifikasi Fuzzy'),
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
        builder: (_, provider, _) {
          if (provider.isLoading && provider.fuzzyList.isEmpty) {
            return const Center(child: CircularProgressIndicator());
          }
          if (provider.fuzzyList.isEmpty) {
            return _EmptyState(error: provider.error);
          }
          return RefreshIndicator(
            onRefresh: () => provider.loadFuzzyAll(),
            child: ListView.separated(
              physics: const AlwaysScrollableScrollPhysics(),
              padding: const EdgeInsets.all(16),
              itemCount: provider.fuzzyList.length + 1,
              separatorBuilder: (_, _) => const SizedBox(height: 10),
              itemBuilder: (context, index) {
                if (index == 0) {
                  return _HeaderCard(total: provider.fuzzyList.length);
                }
                final item = provider.fuzzyList[index - 1];
                return _FuzzyListItem(rank: index, item: item);
              },
            ),
          );
        },
      ),
    );
  }
}

class _HeaderCard extends StatelessWidget {
  final int total;

  const _HeaderCard({required this.total});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        gradient: const LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [Color(0xFF1A237E), Color(0xFF3949AB)],
        ),
        borderRadius: BorderRadius.circular(18),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(12),
            decoration: BoxDecoration(
              color: Colors.white.withValues(alpha: 0.15),
              borderRadius: BorderRadius.circular(14),
            ),
            child: const Icon(Icons.emoji_events, color: Colors.white, size: 32),
          ),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Text(
                  'Leaderboard Prestasi',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 4),
                Text(
                  '$total mahasiswa terklasifikasi',
                  style: TextStyle(
                    color: Colors.white.withValues(alpha: 0.8),
                    fontSize: 13,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _FuzzyListItem extends StatelessWidget {
  final int rank;
  final FuzzyKlasifikasi item;

  const _FuzzyListItem({required this.rank, required this.item});

  Color _labelColor(String label) {
    if (label.toLowerCase().contains('sangat')) return const Color(0xFF1A237E);
    if (label.toLowerCase().contains('berprestasi') && !label.toLowerCase().contains('cukup') && !label.toLowerCase().contains('kurang')) {
      return const Color(0xFF4CAF50);
    }
    if (label.toLowerCase().contains('cukup')) return const Color(0xFFFF9800);
    return const Color(0xFF9E9E9E);
  }

  @override
  Widget build(BuildContext context) {
    final labelColor = _labelColor(item.labelFuzzy);
    return Container(
      padding: const EdgeInsets.all(14),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.grey.shade200),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withValues(alpha: 0.04),
            blurRadius: 8,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      child: Row(
        children: [
          _RankBadge(rank: rank),
          const SizedBox(width: 14),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  item.nama.isNotEmpty ? item.nama : item.nim,
                  style: const TextStyle(
                    fontSize: 15,
                    fontWeight: FontWeight.bold,
                  ),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
                const SizedBox(height: 4),
                Row(
                  children: [
                    Icon(Icons.badge_outlined, size: 13, color: Colors.grey.shade500),
                    const SizedBox(width: 4),
                    Text(
                      item.nim,
                      style: TextStyle(fontSize: 12, color: Colors.grey.shade600),
                    ),
                    if (item.prodi.isNotEmpty) ...[
                      const SizedBox(width: 8),
                      Container(width: 3, height: 3, decoration: BoxDecoration(color: Colors.grey.shade400, shape: BoxShape.circle)),
                      const SizedBox(width: 8),
                      Icon(Icons.school_outlined, size: 13, color: Colors.grey.shade500),
                      const SizedBox(width: 4),
                      Text(
                        item.prodi,
                        style: TextStyle(fontSize: 12, color: Colors.grey.shade600),
                      ),
                    ],
                  ],
                ),
              ],
            ),
          ),
          const SizedBox(width: 8),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
            decoration: BoxDecoration(
              color: labelColor.withValues(alpha: 0.12),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Text(
                  item.skorFuzzy.toStringAsFixed(2),
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                    color: labelColor,
                  ),
                ),
                Text(
                  item.labelFuzzy,
                  style: TextStyle(
                    fontSize: 11,
                    color: labelColor.withValues(alpha: 0.9),
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _RankBadge extends StatelessWidget {
  final int rank;

  const _RankBadge({required this.rank});

  @override
  Widget build(BuildContext context) {
    final Color bg;
    final Color fg;
    final IconData icon;
    if (rank == 1) {
      bg = const Color(0xFFFFD700);
      fg = const Color(0xFF7A5C00);
      icon = Icons.emoji_events;
    } else if (rank == 2) {
      bg = const Color(0xFFC0C0C0);
      fg = const Color(0xFF4A4A4A);
      icon = Icons.workspace_premium;
    } else if (rank == 3) {
      bg = const Color(0xFFCD7F32);
      fg = Colors.white;
      icon = Icons.workspace_premium;
    } else {
      bg = Colors.grey.shade100;
      fg = Colors.grey.shade600;
      icon = Icons.military_tech;
    }
    return Container(
      width: 40,
      height: 40,
      alignment: Alignment.center,
      decoration: BoxDecoration(color: bg, borderRadius: BorderRadius.circular(12)),
      child: icon == Icons.emoji_events
          ? Icon(icon, color: fg, size: 20)
          : Text(
              '$rank',
              style: TextStyle(fontWeight: FontWeight.bold, color: fg, fontSize: 16),
            ),
    );
  }
}

class _EmptyState extends StatelessWidget {
  final String? error;

  const _EmptyState({this.error});

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.fact_check_outlined, size: 56, color: Colors.grey.shade400),
          const SizedBox(height: 16),
          Text(
            error ?? 'Belum ada data klasifikasi',
            style: TextStyle(fontSize: 14, color: Colors.grey.shade600),
          ),
          const SizedBox(height: 16),
          ElevatedButton.icon(
            onPressed: () => context.read<MahasiswaProvider>().loadFuzzyAll(),
            icon: const Icon(Icons.refresh),
            label: const Text('Muat Ulang'),
          ),
        ],
      ),
    );
  }
}
