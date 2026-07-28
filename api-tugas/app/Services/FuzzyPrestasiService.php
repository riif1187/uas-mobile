<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Models\PendaftaranPrestasi;
use App\Models\CapaianPrestasi;
use App\Models\ReferensiKejuaraan;

class FuzzyPrestasiService
{
    private array $rules = [];

    public function __construct()
    {
        $this->initRules();
    }

    private function trapezoid($x, $a, $b, $c, $d): float
    {
        if ($x < $a || $x > $d) return 0.0;
        if ($x >= $b && $x <= $c) return 1.0;
        if ($b > $a && $x >= $a && $x < $b) return ($x - $a) / ($b - $a);
        if ($d > $c && $x > $c && $x <= $d) return ($d - $x) / ($d - $c);
        return 0.0;
    }

    private function fuzzifyJumlahPrestasi($jumlah): array
    {
        return [
            'sedikit' => $this->trapezoid($jumlah, 0, 0, 2, 3),
            'sedang'  => $this->trapezoid($jumlah, 2, 3, 5, 6),
            'banyak'  => $this->trapezoid($jumlah, 5, 6, 10, 10),
        ];
    }

    private function fuzzifyTotalPoin($poin): array
    {
        return [
            'rendah' => $this->trapezoid($poin, 0, 0, 20, 40),
            'sedang' => $this->trapezoid($poin, 20, 40, 60, 80),
            'tinggi' => $this->trapezoid($poin, 60, 80, 120, 120),
        ];
    }

    private function fuzzifyKualitasPeringkat($peringkat): array
    {
        return [
            'jauh'      => $this->trapezoid($peringkat, 15, 20, 50, 50),
            'mendekati' => $this->trapezoid($peringkat, 5, 10, 15, 20),
            'terbaik'   => $this->trapezoid($peringkat, 1, 1, 3, 5),
        ];
    }

    private function initRules(): void
    {
        $this->rules = [
            ['sedikit', 'rendah', 'jauh',      'Kurang Berprestasi'],
            ['sedikit', 'rendah', 'mendekati',  'Kurang Berprestasi'],
            ['sedikit', 'rendah', 'terbaik',    'Cukup Berprestasi'],
            ['sedikit', 'sedang', 'jauh',       'Kurang Berprestasi'],
            ['sedikit', 'sedang', 'mendekati',  'Cukup Berprestasi'],
            ['sedikit', 'sedang', 'terbaik',    'Cukup Berprestasi'],
            ['sedikit', 'tinggi', 'jauh',       'Cukup Berprestasi'],
            ['sedikit', 'tinggi', 'mendekati',  'Cukup Berprestasi'],
            ['sedikit', 'tinggi', 'terbaik',    'Berprestasi'],

            ['sedang', 'rendah', 'jauh',       'Kurang Berprestasi'],
            ['sedang', 'rendah', 'mendekati',  'Cukup Berprestasi'],
            ['sedang', 'rendah', 'terbaik',    'Cukup Berprestasi'],
            ['sedang', 'sedang', 'jauh',       'Cukup Berprestasi'],
            ['sedang', 'sedang', 'mendekati',  'Berprestasi'],
            ['sedang', 'sedang', 'terbaik',    'Berprestasi'],
            ['sedang', 'tinggi', 'jauh',       'Berprestasi'],
            ['sedang', 'tinggi', 'mendekati',  'Berprestasi'],
            ['sedang', 'tinggi', 'terbaik',    'Sangat Berprestasi'],

            ['banyak', 'rendah', 'jauh',       'Cukup Berprestasi'],
            ['banyak', 'rendah', 'mendekati',  'Berprestasi'],
            ['banyak', 'rendah', 'terbaik',    'Berprestasi'],
            ['banyak', 'sedang', 'jauh',       'Berprestasi'],
            ['banyak', 'sedang', 'mendekati',  'Berprestasi'],
            ['banyak', 'sedang', 'terbaik',    'Sangat Berprestasi'],
            ['banyak', 'tinggi', 'jauh',       'Berprestasi'],
            ['banyak', 'tinggi', 'mendekati',  'Sangat Berprestasi'],
            ['banyak', 'tinggi', 'terbaik',    'Sangat Berprestasi'],
        ];
    }

    private function getOutputCentroid($label): array
    {
        return match ($label) {
            'Kurang Berprestasi' => [0, 0, 20, 35],
            'Cukup Berprestasi'  => [20, 35, 45, 60],
            'Berprestasi'        => [45, 60, 70, 85],
            'Sangat Berprestasi' => [70, 85, 100, 100],
            default              => [0, 0, 0, 0],
        };
    }

    private function defuzzify(array $aggregated): float
    {
        $numerator = 0.0;
        $denominator = 0.0;
        $step = 0.5;

        for ($x = 0; $x <= 100; $x += $step) {
            $mu = 0.0;
            foreach ($aggregated as $label => $degree) {
                if ($degree <= 0) continue;
                $trap = $this->getOutputCentroid($label);
                $muOutput = $this->trapezoid($x, $trap[0], $trap[1], $trap[2], $trap[3]);
                $mu = max($mu, min($degree, $muOutput));
            }
            $numerator += $x * $mu;
            $denominator += $mu;
        }

        return $denominator > 0 ? round($numerator / $denominator, 2) : 0.0;
    }

    private function getLabel($skor): string
    {
        return match (true) {
            $skor < 26  => 'Kurang Berprestasi',
            $skor < 51  => 'Cukup Berprestasi',
            $skor < 76  => 'Berprestasi',
            default     => 'Sangat Berprestasi',
        };
    }

    private function getColor($label): string
    {
        return match ($label) {
            'Kurang Berprestasi' => 'danger',
            'Cukup Berprestasi'  => 'warning',
            'Berprestasi'        => 'success',
            'Sangat Berprestasi' => 'primary',
            default              => 'secondary',
        };
    }

    public function classify(string $nim): ?array
    {
        $mahasiswa = Mahasiswa::with('pendaftaranPrestasi.referensiKejuaraan', 'pendaftaranPrestasi.capaianPrestasi')
            ->where('NIM', $nim)
            ->first();

        if (!$mahasiswa) return null;

        $approved = $mahasiswa->pendaftaranPrestasi->where('status', 'disetujui');

        $jumlahPrestasi = $approved->count();

        if ($jumlahPrestasi === 0) {
            return [
                'NIM'            => $nim,
                'nama'           => $mahasiswa->nama,
                'fakultas'       => $mahasiswa->fakultas,
                'prodi'          => $mahasiswa->prodi,
                'jumlah_prestasi' => 0,
                'total_poin'     => 0,
                'peringkat_terbaik' => '-',
                'skor'           => 0,
                'label'          => 'Tidak Ada Data',
                'color'          => 'secondary',
            ];
        }

        $totalPoin = 0;
        foreach ($approved as $p) {
            $totalPoin += $p->referensiKejuaraan->bobot_poin ?? 0;
        }

        $peringkatTerbaik = 50;
        foreach ($approved as $p) {
            if ($p->capaianPrestasi && preg_match('/\d+/', $p->capaianPrestasi->peringkat, $matches)) {
                $pVal = (int) $matches[0];
                if ($pVal < $peringkatTerbaik) {
                    $peringkatTerbaik = $pVal;
                }
            }
        }

        $fpJumlah = $this->fuzzifyJumlahPrestasi($jumlahPrestasi);
        $fpPoin   = $this->fuzzifyTotalPoin($totalPoin);
        $fpRank   = $this->fuzzifyKualitasPeringkat($peringkatTerbaik);

        $aggregated = [
            'Kurang Berprestasi' => 0,
            'Cukup Berprestasi'  => 0,
            'Berprestasi'        => 0,
            'Sangat Berprestasi' => 0,
        ];

        foreach ($this->rules as $rule) {
            $mu1 = $fpJumlah[$rule[0]] ?? 0;
            $mu2 = $fpPoin[$rule[1]] ?? 0;
            $mu3 = $fpRank[$rule[2]] ?? 0;
            $firingStrength = min($mu1, $mu2, $mu3);
            $outputLabel = $rule[3];

            if ($firingStrength > 0) {
                $aggregated[$outputLabel] = max($aggregated[$outputLabel], $firingStrength);
            }
        }

        $skor = $this->defuzzify($aggregated);
        $label = $this->getLabel($skor);
        $color = $this->getColor($label);

        return [
            'NIM'              => $nim,
            'nama'             => $mahasiswa->nama,
            'fakultas'         => $mahasiswa->fakultas,
            'prodi'            => $mahasiswa->prodi,
            'jumlah_prestasi'  => $jumlahPrestasi,
            'total_poin'       => $totalPoin,
            'peringkat_terbaik'=> $peringkatTerbaik <= 49 ? $peringkatTerbaik : '-',
            'skor'             => $skor,
            'label'            => $label,
            'color'            => $color,
        ];
    }

    public function classifyAll(): array
    {
        $mahasiswas = Mahasiswa::all();
        $results = [];

        foreach ($mahasiswas as $m) {
            $result = $this->classify($m->NIM);
            if ($result) {
                $results[] = $result;
            }
        }

        usort($results, fn($a, $b) => $b['skor'] <=> $a['skor']);

        return $results;
    }
}
