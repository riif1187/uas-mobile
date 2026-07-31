import 'package:flutter/material.dart';
import '../models/mahasiswa/fuzzy_klasifikasi.dart';

class FuzzyCard extends StatelessWidget {
  final FuzzyKlasifikasi? fuzzy;
  final bool isLoading;
  final VoidCallback? onRefresh;

  const FuzzyCard({
    super.key,
    this.fuzzy,
    this.isLoading = false,
    this.onRefresh,
  });

  Color _labelColor(String label) {
    final l = label.toLowerCase();
    if (l.contains('sangat')) return const Color(0xFF3949AB);
    if (l.contains('berprestasi')) return const Color(0xFF4CAF50);
    if (l.contains('cukup')) return const Color(0xFFFF9800);
    if (l.contains('kurang')) return const Color(0xFFE53935);
    return const Color(0xFF9E9E9E);
  }

  IconData _labelIcon(String label) {
    final l = label.toLowerCase();
    if (l.contains('sangat')) return Icons.stars;
    if (l.contains('berprestasi')) return Icons.emoji_events;
    if (l.contains('cukup')) return Icons.trending_up;
    if (l.contains('kurang')) return Icons.trending_down;
    return Icons.hourglass_empty;
  }

  @override
  Widget build(BuildContext context) {
    if (isLoading) {
      return const Padding(
        padding: EdgeInsets.symmetric(vertical: 8),
        child: Center(
          child: SizedBox(
            width: 22,
            height: 22,
            child: CircularProgressIndicator(strokeWidth: 2.5),
          ),
        ),
      );
    }

    if (fuzzy == null) {
      return Container(
        width: double.infinity,
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: Colors.grey.shade50,
          borderRadius: BorderRadius.circular(14),
          border: Border.all(color: Colors.grey.shade200),
        ),
        child: Row(
          children: [
            Icon(Icons.hourglass_empty, color: Colors.grey.shade400),
            const SizedBox(width: 12),
            Expanded(
              child: Text(
                'Belum ada data klasifikasi',
                style: TextStyle(color: Colors.grey.shade600),
              ),
            ),
            if (onRefresh != null)
              TextButton.icon(
                onPressed: onRefresh,
                icon: const Icon(Icons.refresh, size: 18),
                label: const Text('Hitung'),
              ),
          ],
        ),
      );
    }

    final color = _labelColor(fuzzy!.labelFuzzy);
    final showRefresh = onRefresh != null;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(18),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            color.withValues(alpha: 0.15),
            color.withValues(alpha: 0.05),
          ],
        ),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: color.withValues(alpha: 0.3)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: color.withValues(alpha: 0.15),
                  shape: BoxShape.circle,
                ),
                child: Icon(_labelIcon(fuzzy!.labelFuzzy), size: 26, color: color),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Klasifikasi Prestasi',
                      style: TextStyle(
                        fontSize: 11,
                        color: Colors.grey.shade500,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                    const SizedBox(height: 2),
                    Text(
                      fuzzy!.labelFuzzy,
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                        color: color,
                      ),
                    ),
                  ],
                ),
              ),
              if (showRefresh)
                IconButton(
                  icon: const Icon(Icons.refresh, size: 20),
                  color: color,
                  onPressed: onRefresh,
                  tooltip: 'Hitung ulang klasifikasi',
                ),
            ],
          ),
          const SizedBox(height: 14),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
            decoration: BoxDecoration(
              color: color.withValues(alpha: 0.12),
              borderRadius: BorderRadius.circular(8),
            ),
            child: Text(
              'Skor: ${fuzzy!.skorFuzzy.toStringAsFixed(2)}',
              style: TextStyle(
                fontWeight: FontWeight.w700,
                color: color,
                fontSize: 14,
              ),
            ),
          ),
          const SizedBox(height: 14),
          Row(
            children: [
              _StatChip(
                icon: Icons.emoji_events_outlined,
                label: 'Prestasi',
                value: '${fuzzy!.jumlahPrestasi}',
              ),
              const SizedBox(width: 10),
              _StatChip(
                icon: Icons.score_outlined,
                label: 'Poin',
                value: '${fuzzy!.totalPoin}',
              ),
              const SizedBox(width: 10),
              _StatChip(
                icon: Icons.stars_outlined,
                label: 'Peringkat',
                value: fuzzy!.peringkatTerbaik > 0
                    ? '#${fuzzy!.peringkatTerbaik}'
                    : '-',
              ),
            ],
          ),
        ],
      ),
    );
  }
}

class _StatChip extends StatelessWidget {
  final IconData icon;
  final String label;
  final String value;

  const _StatChip({
    required this.icon,
    required this.label,
    required this.value,
  });

  @override
  Widget build(BuildContext context) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 8, horizontal: 6),
        decoration: BoxDecoration(
          color: Colors.white.withValues(alpha: 0.7),
          borderRadius: BorderRadius.circular(10),
        ),
        child: Column(
          children: [
            Icon(icon, size: 16, color: Colors.grey.shade600),
            const SizedBox(height: 2),
            Text(
              value,
              style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 13),
            ),
            Text(
              label,
              style: TextStyle(fontSize: 10, color: Colors.grey.shade500),
            ),
          ],
        ),
      ),
    );
  }
}
