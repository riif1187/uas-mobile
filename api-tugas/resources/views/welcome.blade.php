<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Prestasi Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef2f5;
            color: #24313d;
        }

        .dashboard-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #2c3e50;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
        }

        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 4px;
            background: #3498db;
            color: #fff;
        }

        .login-btn {
            background: #27ae60;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-weight: 600;
            padding: 9px 16px;
            text-decoration: none;
        }

        .login-btn:hover {
            background: #219150;
            color: #fff;
        }

        .hero {
            padding: 52px 0 28px;
        }

        .hero-panel {
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 2px 12px rgba(44, 62, 80, 0.08);
            padding: 32px;
            border-left: 6px solid #3498db;
        }

        .hero-title {
            color: #2c3e50;
            font-size: clamp(28px, 4vw, 46px);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 14px;
        }

        .hero-copy {
            color: #566573;
            font-size: 16px;
            line-height: 1.7;
            max-width: 720px;
            margin-bottom: 24px;
        }

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            padding: 10px 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .action-primary {
            background: #3498db;
            color: #fff;
        }

        .action-primary:hover {
            background: #2980b9;
            color: #fff;
        }

        .action-secondary {
            background: #f5f7f9;
            color: #2c3e50;
            border: 1px solid #dfe6e9;
        }

        .action-secondary:hover {
            background: #ecf0f1;
            color: #2c3e50;
        }

        .stat-card {
            height: 100%;
            background: #fff;
            border: none;
            border-radius: 6px;
            box-shadow: 0 1px 6px rgba(44, 62, 80, 0.08);
            padding: 22px;
        }

        .stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 4px;
            color: #fff;
            margin-bottom: 16px;
        }

        .stat-blue {
            background: #3498db;
        }

        .stat-green {
            background: #27ae60;
        }

        .stat-orange {
            background: #e67e22;
        }

        .stat-red {
            background: #e74c3c;
        }

        .stat-indigo {
            background: #5b6ee1;
        }

        .stat-number {
            color: #2c3e50;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #62717f;
            font-size: 14px;
            margin: 0;
        }

        .module-card {
            display: block;
            height: 100%;
            background: #fff;
            border-radius: 6px;
            border: 1px solid #dfe6e9;
            padding: 18px;
            color: #2c3e50;
            text-decoration: none;
        }

        .module-card:hover {
            border-color: #3498db;
            color: #2c3e50;
            box-shadow: 0 2px 10px rgba(52, 152, 219, 0.12);
        }

        .module-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .module-card p {
            color: #62717f;
            margin: 0;
            font-size: 14px;
            line-height: 1.55;
        }

        footer {
            margin-top: auto;
            padding: 18px 0;
            color: #62717f;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .hero {
                padding-top: 28px;
            }

            .hero-panel {
                padding: 24px;
            }

            .login-btn,
            .action-link {
                width: 100%;
                justify-content: center;
            }
        }

        .svg-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .svg-scroll svg {
            max-width: none;
        }

        @media (max-width: 768px) {
            .container { padding-left: 12px; padding-right: 12px; }
            .stat-card { padding: 14px; }
            .stat-number { font-size: 24px; }
            .hero-title { font-size: 24px; }
            .hero-copy { font-size: 14px; }
            .table-responsive { font-size: 13px; }
            .table thead th, .table tbody td { padding: 10px 8px; white-space: nowrap; }
            .badge { font-size: 11px; }
            .summary-box { padding: 10px; }
            .summary-box .fs-2 { font-size: 22px !important; }
        }

        @media (max-width: 480px) {
            .stat-card { padding: 10px; }
            .stat-number { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-shell">
        <nav class="topbar">
            <div class="container py-3 d-flex justify-content-between align-items-center">
                <a class="brand" href="{{ url('/') }}">
                    <span class="brand-icon"><i class="bi bi-trophy"></i></span>
                    <span>Sistem Prestasi</span>
                </a>
                <div class="d-flex gap-2">
                    @auth
                        <a class="login-btn btn-primary" href="{{ route('data-mahasiswa') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="login-btn" style="background: #e74c3c;">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a class="login-btn" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </a>
                        @if (Route::has('register'))
                            <a class="login-btn" href="{{ route('register') }}" style="background: #3498db;">
                                <i class="bi bi-person-plus"></i> Daftar
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-panel">
                        <h1 class="hero-title">Sistem Pencatatan Prestasi Mahasiswa</h1>
                        <p class="hero-copy">
                            Dashboard untuk mengelola data mahasiswa, referensi kejuaraan, pendaftaran prestasi,
                            dan capaian prestasi dalam satu tempat yang rapi dan mudah dipantau.
                        </p>
                        <div class="quick-actions">
                            @auth
                                <a href="{{ route('data-mahasiswa') }}" class="action-link action-primary">
                                    <i class="bi bi-speedometer2"></i> Buka Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="action-link action-primary">
                                    <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
                                </a>
                            @endauth
                            <a href="{{ route('pendaftaran-prestasi.index') }}" class="action-link action-secondary">
                                <i class="bi bi-clipboard-check"></i> Lihat Pendaftaran
                            </a>
                            <a href="{{ route('capaian-prestasi.index') }}" class="action-link action-secondary">
                                <i class="bi bi-award"></i> Lihat Capaian
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pb-4">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-6 col-xl">
                            <div class="stat-card">
                                <div class="stat-icon stat-blue"><i class="bi bi-people"></i></div>
                                <div class="stat-number">{{ $totalMahasiswa ?? 0 }}</div>
                                <p class="stat-label">Data Mahasiswa</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl">
                            <div class="stat-card">
                                <div class="stat-icon stat-green"><i class="bi bi-person-badge"></i></div>
                                <div class="stat-number">{{ $totalDosen ?? 0 }}</div>
                                <p class="stat-label">Data Dosen</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl">
                            <div class="stat-card">
                                <div class="stat-icon stat-orange"><i class="bi bi-trophy"></i></div>
                                <div class="stat-number">{{ $totalReferensi ?? 0 }}</div>
                                <p class="stat-label">Referensi Kejuaraan</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl">
                            <div class="stat-card">
                                <div class="stat-icon stat-indigo"><i class="bi bi-clipboard-check"></i></div>
                                <div class="stat-number">{{ $totalPendaftaran ?? 0 }}</div>
                                <p class="stat-label">Pendaftaran Prestasi</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl">
                            <div class="stat-card">
                                <div class="stat-icon stat-red"><i class="bi bi-award"></i></div>
                                <div class="stat-number">{{ $totalCapaian ?? 0 }}</div>
                                <p class="stat-label">Capaian Prestasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pb-4">
                <div class="container">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-graph-up"></i> Klasifikasi Prestasi Mahasiswa</h5>
                            <span class="badge bg-info">Mamdani</span>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 rounded" style="background: #f0f7ff;">
                                    <div class="fs-2 fw-bold text-primary">{{ $fuzzySummary['sangat'] }}</div>
                                    <div class="small text-muted">Sangat Berprestasi</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 rounded" style="background: #f0faf0;">
                                    <div class="fs-2 fw-bold text-success">{{ $fuzzySummary['berprestasi'] }}</div>
                                    <div class="small text-muted">Berprestasi</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 rounded" style="background: #fffbeb;">
                                    <div class="fs-2 fw-bold text-warning">{{ $fuzzySummary['cukup'] }}</div>
                                    <div class="small text-muted">Cukup Berprestasi</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="text-center p-3 rounded" style="background: #fff0f0;">
                                    <div class="fs-2 fw-bold text-danger">{{ $fuzzySummary['kurang'] }}</div>
                                    <div class="small text-muted">Kurang Berprestasi</div>
                                </div>
                            </div>
                        </div>

                        @if(count($fuzzyResults) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:4%">No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th class="text-center">Jml Prestasi</th>
                                            <th class="text-center">Total Poin</th>
                                            <th class="text-center">Peringkat Terbaik</th>
                                            <th class="text-center">Skor</th>
                                            <th>Klasifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fuzzyResults as $i => $r)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td><span class="badge bg-info">{{ $r['NIM'] }}</span></td>
                                                <td>{{ $r['nama'] }}</td>
                                                <td>{{ $r['prodi'] }}</td>
                                                <td class="text-center">{{ $r['jumlah_prestasi'] }}</td>
                                                <td class="text-center">{{ $r['total_poin'] }}</td>
                                                <td class="text-center">{{ $r['peringkat_terbaik'] }}</td>
                                                <td class="text-center fw-bold">{{ $r['skor'] }}</td>
                                                <td><span class="badge bg-{{ $r['color'] }}">{{ $r['label'] }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                <i class="bi bi-info-circle"></i> Belum ada data mahasiswa untuk diklasifikasikan.
                            </div>
                        @endif

                        @if(count($fuzzyResults) > 0)
                        <hr class="my-4">
                        <h6 class="fw-bold mb-3"><i class="bi bi-bar-chart"></i> Top 10 Ranking Mahasiswa</h6>
                        @php
                            $top10 = array_slice($fuzzyResults, 0, 10);
                            $svgW = 800;
                            $svgH = 260;
                            $padL = 55;
                            $padR = 20;
                            $padT = 20;
                            $padB = 55;
                            $drawW = $svgW - $padL - $padR;
                            $drawH = $svgH - $padT - $padB;
                            $yZero = $svgH - $padB;
                            $spacing = $drawW / 10;
                            $barW = 36;
                        @endphp
                        <div class="svg-scroll">
                        <svg viewBox="0 0 {{ $svgW }} {{ $svgH }}" style="width:{{ $svgW }}px;height:auto;">
                            <rect x="0" y="0" width="{{ $svgW }}" height="{{ $svgH }}" fill="none"/>
                            @foreach([0,20,40,60,80,100] as $sv)
                                @php $py = $yZero - ($sv/100)*$drawH; @endphp
                                <line x1="{{ $padL }}" y1="{{ $py }}" x2="{{ $svgW-$padR }}" y2="{{ $py }}" stroke="#eee" stroke-width="1" stroke-dasharray="3"/>
                                <text x="{{ $padL-8 }}" y="{{ $py+4 }}" text-anchor="end" font-size="11" fill="#888">{{ $sv }}</text>
                            @endforeach
                            <line x1="{{ $padL }}" y1="{{ $yZero }}" x2="{{ $svgW-$padR }}" y2="{{ $yZero }}" stroke="#333" stroke-width="1.5"/>
                            @foreach($top10 as $i => $r)
                                @php
                                    $cx = $padL + $spacing * ($i + 0.5);
                                    $bx = $cx - $barW/2;
                                    $bH = ($r['skor']/100)*$drawH;
                                    $by = $yZero - $bH;
                                    $cMap = ['Sangat Berprestasi'=>'#3498db','Berprestasi'=>'#27ae60','Cukup Berprestasi'=>'#f39c12','Kurang Berprestasi'=>'#e74c3c'];
                                    $col = $cMap[$r['label']] ?? '#95a5a6';
                                    $nimShort = substr($r['NIM'], -4);
                                @endphp
                                <rect x="{{ $bx }}" y="{{ $by }}" width="{{ $barW }}" height="{{ max($bH,1) }}" rx="3" fill="{{ $col }}" opacity="0.85"/>
                                <text x="{{ $cx }}" y="{{ $by-5 }}" text-anchor="middle" font-size="10" font-weight="bold" fill="{{ $col }}">{{ $r['skor'] }}</text>
                                <text x="{{ $cx }}" y="{{ $yZero+16 }}" text-anchor="middle" font-size="11" fill="#333">{{ $i+1 }}</text>
                                <text x="{{ $cx }}" y="{{ $yZero+29 }}" text-anchor="middle" font-size="9" fill="#888">{{ $nimShort }}</text>
                            @endforeach
                            <text x="{{ $padL-8 }}" y="{{ $padT-2 }}" text-anchor="end" font-size="12" fill="#333">Skor</text>
                            <text x="{{ ($svgW-$padR+$padL)/2 }}" y="{{ $svgH-5 }}" text-anchor="middle" font-size="12" fill="#333">Rank (NIM)</text>
                        </svg>
                        </div>
                        @endif
                    </div>
                </div>
            </section>

@php
function vBarY($v, $xMin, $xMax) {
    return 180 - (($v - $xMin) / ($xMax - $xMin)) * 155;
}
function vBarH($a, $d, $xMin, $xMax) {
    return vBarY($a, $xMin, $xMax) - vBarY($d, $xMin, $xMax);
}
@endphp

<section class="pb-4">
    <div class="container">
        <div class="stat-card">
            <h5 class="mb-0 fw-bold"><i class="bi bi-graph-up"></i> Grafik Fungsi Keanggotaan Fuzzy</h5>
        </div>
        <div class="row g-3 mt-2">

            {{-- Grafik 1: Jumlah Prestasi --}}
            <div class="col-lg-6">
                <div class="stat-card">
                    <h6 class="fw-bold mb-1">1. Jumlah Prestasi</h6>
                    <p class="text-muted small">Domain: [0 – 10]</p>
                    @php
                        $xMin=0; $xMax=10; $svgW=480; $bw=50; $sp=140;
                        $s1 = [
                            ['l'=>'Sedikit','a'=>0,'b'=>0,'c'=>2,'d'=>3,'c1'=>'#e74c3c'],
                            ['l'=>'Sedang', 'a'=>2,'b'=>3,'c'=>5,'d'=>6,'c1'=>'#f39c12'],
                            ['l'=>'Banyak', 'a'=>5,'b'=>6,'c'=>10,'d'=>10,'c1'=>'#27ae60'],
                        ];
                    @endphp
                    <div class="svg-scroll">
                    <svg viewBox="0 0 {{ $svgW }} 230" style="width:{{ $svgW }}px;height:auto;">
                        <rect x="0" y="0" width="{{ $svgW }}" height="230" fill="none"/>
                        <line x1="80" y1="180" x2="{{ $svgW-20 }}" y2="180" stroke="#333" stroke-width="1.5"/>
                        @foreach([0,2,4,6,8,10] as $xv)
                            @php $py = vBarY($xv, $xMin, $xMax); @endphp
                            <line x1="75" y1="{{ $py }}" x2="80" y2="{{ $py }}" stroke="#333" stroke-width="1"/>
                            <text x="70" y="{{ $py+4 }}" text-anchor="end" font-size="11" fill="#666">{{ $xv }}</text>
                            <line x1="80" y1="{{ $py }}" x2="{{ $svgW-20 }}" y2="{{ $py }}" stroke="#eee" stroke-width="1" stroke-dasharray="3"/>
                        @endforeach
                        @foreach($s1 as $i => $s)
                            @php
                                $cx = 80 + $sp * ($i + 0.5);
                                $bx = $cx - $bw / 2;
                                $by = vBarY($s['d'], $xMin, $xMax);
                                $bh = vBarH($s['a'], $s['d'], $xMin, $xMax);
                                $cy = vBarY($s['c'], $xMin, $xMax);
                                $ch = vBarH($s['b'], $s['c'], $xMin, $xMax);
                            @endphp
                            <rect x="{{ $bx }}" y="{{ $by }}" width="{{ $bw }}" height="{{ $bh }}" rx="3" fill="{{ $s['c1'] }}22" stroke="{{ $s['c1'] }}" stroke-width="1"/>
                            <rect x="{{ $bx }}" y="{{ $cy }}" width="{{ $bw }}" height="{{ $ch }}" rx="3" fill="{{ $s['c1'] }}" opacity="0.85"/>
                            <text x="{{ $cx }}" y="200" text-anchor="middle" font-size="11" fill="#333">{{ $s['l'] }}</text>
                            <text x="{{ $cx }}" y="213" text-anchor="middle" font-size="10" fill="#888">{{ $s['a'] }}-{{ $s['d'] }}</text>
                        @endforeach
                        <text x="10" y="100" text-anchor="middle" font-size="13" fill="#333" transform="rotate(-90,10,100)">Nilai</text>
                        <text x="{{ ($svgW-20+80)/2 }}" y="228" text-anchor="middle" font-size="13" fill="#333">Himpunan</text>
                    </svg>
                    </div>
                </div>
            </div>

            {{-- Grafik 2: Total Poin --}}
            <div class="col-lg-6">
                <div class="stat-card">
                    <h6 class="fw-bold mb-1">2. Total Poin</h6>
                    <p class="text-muted small">Domain: [0 – 120]</p>
                    @php
                        $xMin=0; $xMax=120; $svgW=480; $bw=50; $sp=140;
                        $s2 = [
                            ['l'=>'Rendah','a'=>0,'b'=>0,'c'=>20,'d'=>40,'c1'=>'#e74c3c'],
                            ['l'=>'Sedang','a'=>20,'b'=>40,'c'=>60,'d'=>80,'c1'=>'#f39c12'],
                            ['l'=>'Tinggi','a'=>60,'b'=>80,'c'=>120,'d'=>120,'c1'=>'#27ae60'],
                        ];
                    @endphp
                    <div class="svg-scroll">
                    <svg viewBox="0 0 {{ $svgW }} 230" style="width:{{ $svgW }}px;height:auto;">
                        <rect x="0" y="0" width="{{ $svgW }}" height="230" fill="none"/>
                        <line x1="80" y1="180" x2="{{ $svgW-20 }}" y2="180" stroke="#333" stroke-width="1.5"/>
                        @foreach([0,20,40,60,80,100,120] as $xv)
                            @php $py = vBarY($xv, $xMin, $xMax); @endphp
                            <line x1="75" y1="{{ $py }}" x2="80" y2="{{ $py }}" stroke="#333" stroke-width="1"/>
                            <text x="70" y="{{ $py+4 }}" text-anchor="end" font-size="11" fill="#666">{{ $xv }}</text>
                            <line x1="80" y1="{{ $py }}" x2="{{ $svgW-20 }}" y2="{{ $py }}" stroke="#eee" stroke-width="1" stroke-dasharray="3"/>
                        @endforeach
                        @foreach($s2 as $i => $s)
                            @php
                                $cx = 80 + $sp * ($i + 0.5);
                                $bx = $cx - $bw / 2;
                                $by = vBarY($s['d'], $xMin, $xMax);
                                $bh = vBarH($s['a'], $s['d'], $xMin, $xMax);
                                $cy = vBarY($s['c'], $xMin, $xMax);
                                $ch = vBarH($s['b'], $s['c'], $xMin, $xMax);
                            @endphp
                            <rect x="{{ $bx }}" y="{{ $by }}" width="{{ $bw }}" height="{{ $bh }}" rx="3" fill="{{ $s['c1'] }}22" stroke="{{ $s['c1'] }}" stroke-width="1"/>
                            <rect x="{{ $bx }}" y="{{ $cy }}" width="{{ $bw }}" height="{{ $ch }}" rx="3" fill="{{ $s['c1'] }}" opacity="0.85"/>
                            <text x="{{ $cx }}" y="200" text-anchor="middle" font-size="11" fill="#333">{{ $s['l'] }}</text>
                            <text x="{{ $cx }}" y="213" text-anchor="middle" font-size="10" fill="#888">{{ $s['a'] }}-{{ $s['d'] }}</text>
                        @endforeach
                        <text x="{{ ($svgW-20+80)/2 }}" y="228" text-anchor="middle" font-size="13" fill="#333">Himpunan</text>
                    </svg>
                    </div>
                </div>
            </div>

            {{-- Grafik 3: Kualitas Peringkat --}}
            <div class="col-lg-6">
                <div class="stat-card">
                    <h6 class="fw-bold mb-1">3. Kualitas Peringkat</h6>
                    <p class="text-muted small">Domain: [1 – 50]</p>
                    @php
                        $xMin=1; $xMax=50; $svgW=480; $bw=50; $sp=140;
                        $s3 = [
                            ['l'=>'Terbaik',  'a'=>1,'b'=>1,'c'=>3,'d'=>5,'c1'=>'#27ae60'],
                            ['l'=>'Mendekati','a'=>5,'b'=>10,'c'=>15,'d'=>20,'c1'=>'#f39c12'],
                            ['l'=>'Jauh',     'a'=>15,'b'=>20,'c'=>50,'d'=>50,'c1'=>'#e74c3c'],
                        ];
                    @endphp
                    <div class="svg-scroll">
                    <svg viewBox="0 0 {{ $svgW }} 230" style="width:{{ $svgW }}px;height:auto;">
                        <rect x="0" y="0" width="{{ $svgW }}" height="230" fill="none"/>
                        <line x1="80" y1="180" x2="{{ $svgW-20 }}" y2="180" stroke="#333" stroke-width="1.5"/>
                        @foreach([1,5,10,15,20,30,40,50] as $xv)
                            @php $py = vBarY($xv, $xMin, $xMax); @endphp
                            <line x1="75" y1="{{ $py }}" x2="80" y2="{{ $py }}" stroke="#333" stroke-width="1"/>
                            <text x="70" y="{{ $py+4 }}" text-anchor="end" font-size="11" fill="#666">{{ $xv }}</text>
                            <line x1="80" y1="{{ $py }}" x2="{{ $svgW-20 }}" y2="{{ $py }}" stroke="#eee" stroke-width="1" stroke-dasharray="3"/>
                        @endforeach
                        @foreach($s3 as $i => $s)
                            @php
                                $cx = 80 + $sp * ($i + 0.5);
                                $bx = $cx - $bw / 2;
                                $by = vBarY($s['d'], $xMin, $xMax);
                                $bh = vBarH($s['a'], $s['d'], $xMin, $xMax);
                                $cy = vBarY($s['c'], $xMin, $xMax);
                                $ch = vBarH($s['b'], $s['c'], $xMin, $xMax);
                            @endphp
                            <rect x="{{ $bx }}" y="{{ $by }}" width="{{ $bw }}" height="{{ $bh }}" rx="3" fill="{{ $s['c1'] }}22" stroke="{{ $s['c1'] }}" stroke-width="1"/>
                            <rect x="{{ $bx }}" y="{{ $cy }}" width="{{ $bw }}" height="{{ $ch }}" rx="3" fill="{{ $s['c1'] }}" opacity="0.85"/>
                            <text x="{{ $cx }}" y="200" text-anchor="middle" font-size="11" fill="#333">{{ $s['l'] }}</text>
                            <text x="{{ $cx }}" y="213" text-anchor="middle" font-size="10" fill="#888">{{ $s['a'] }}-{{ $s['d'] }}</text>
                        @endforeach
                        <text x="{{ ($svgW-20+80)/2 }}" y="228" text-anchor="middle" font-size="13" fill="#333">Himpunan</text>
                    </svg>
                    </div>
                </div>
            </div>

            {{-- Grafik 4: Skor Prestasi --}}
            <div class="col-lg-6">
                <div class="stat-card">
                    <h6 class="fw-bold mb-1">4. Skor Prestasi (Output)</h6>
                    <p class="text-muted small">Domain: [0 – 100]</p>
                    @php
                        $xMin=0; $xMax=100; $svgW=520; $bw=45; $sp=110;
                        $s4 = [
                            ['l'=>'Kurang','a'=>0,'b'=>0,'c'=>20,'d'=>35,'c1'=>'#e74c3c'],
                            ['l'=>'Cukup','a'=>20,'b'=>35,'c'=>45,'d'=>60,'c1'=>'#f39c12'],
                            ['l'=>'Berprestasi','a'=>45,'b'=>60,'c'=>70,'d'=>85,'c1'=>'#27ae60'],
                            ['l'=>'Sangat','a'=>70,'b'=>85,'c'=>100,'d'=>100,'c1'=>'#3498db'],
                        ];
                    @endphp
                    <div class="svg-scroll">
                    <svg viewBox="0 0 {{ $svgW }} 230" style="width:{{ $svgW }}px;height:auto;">
                        <rect x="0" y="0" width="{{ $svgW }}" height="230" fill="none"/>
                        <line x1="80" y1="180" x2="{{ $svgW-20 }}" y2="180" stroke="#333" stroke-width="1.5"/>
                        @foreach([0,20,40,60,80,100] as $xv)
                            @php $py = vBarY($xv, $xMin, $xMax); @endphp
                            <line x1="75" y1="{{ $py }}" x2="80" y2="{{ $py }}" stroke="#333" stroke-width="1"/>
                            <text x="70" y="{{ $py+4 }}" text-anchor="end" font-size="11" fill="#666">{{ $xv }}</text>
                            <line x1="80" y1="{{ $py }}" x2="{{ $svgW-20 }}" y2="{{ $py }}" stroke="#eee" stroke-width="1" stroke-dasharray="3"/>
                        @endforeach
                        @foreach($s4 as $i => $s)
                            @php
                                $cx = 80 + $sp * ($i + 0.5);
                                $bx = $cx - $bw / 2;
                                $by = vBarY($s['d'], $xMin, $xMax);
                                $bh = vBarH($s['a'], $s['d'], $xMin, $xMax);
                                $cy = vBarY($s['c'], $xMin, $xMax);
                                $ch = vBarH($s['b'], $s['c'], $xMin, $xMax);
                            @endphp
                            <rect x="{{ $bx }}" y="{{ $by }}" width="{{ $bw }}" height="{{ $bh }}" rx="3" fill="{{ $s['c1'] }}22" stroke="{{ $s['c1'] }}" stroke-width="1"/>
                            <rect x="{{ $bx }}" y="{{ $cy }}" width="{{ $bw }}" height="{{ $ch }}" rx="3" fill="{{ $s['c1'] }}" opacity="0.85"/>
                            <text x="{{ $cx }}" y="200" text-anchor="middle" font-size="11" fill="#333">{{ $s['l'] }}</text>
                            <text x="{{ $cx }}" y="213" text-anchor="middle" font-size="10" fill="#888">{{ $s['a'] }}-{{ $s['d'] }}</text>
                        @endforeach
                        <text x="{{ ($svgW-20+80)/2 }}" y="228" text-anchor="middle" font-size="13" fill="#333">Himpunan</text>
                    </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

            <section class="pb-5">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('referensi-kejuaraan.index') }}" class="module-card">
                                <div class="module-title"><i class="bi bi-trophy"></i> Referensi Kejuaraan</div>
                                <p>Kelola nama kejuaraan dan bobot poin sebagai dasar penilaian prestasi.</p>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('pendaftaran-prestasi.index') }}" class="module-card">
                                <div class="module-title"><i class="bi bi-clipboard-check"></i> Pendaftaran Prestasi</div>
                                <p>Catat mahasiswa, kegiatan, dan kategori kejuaraan yang diikuti.</p>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('capaian-prestasi.index') }}" class="module-card">
                                <div class="module-title"><i class="bi bi-award"></i> Capaian Prestasi</div>
                                <p>Simpan hasil capaian, peringkat, dosen pembimbing, dan file bukti.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="container text-center">
                <i class="bi bi-code"></i> Sistem Pencatatan Prestasi Mahasiswa 2026
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
