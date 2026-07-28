@extends('layout.app')

@section('title', 'Grafik Fungsi Keanggotaan Fuzzy')

@php
function trapPoints($a, $b, $c, $d, $xMin, $xMax) {
    $x = function($v) use ($xMin, $xMax) {
        return 60 + (($v - $xMin) / ($xMax - $xMin)) * 620;
    };
    $y = function($mu) {
        return 180 - $mu * 160;
    };
    return sprintf('%.1f,%.1f %.1f,%.1f %.1f,%.1f %.1f,%.1f',
        $x($a), $y(0), $x($b), $y(1), $x($c), $y(1), $x($d), $y(0));
}

function xLabel($v, $xMin, $xMax) {
    return 60 + (($v - $xMin) / ($xMax - $xMin)) * 620;
}
@endphp

@section('content')
<div class="header-section">
    <h3 class="title-page">Grafik Fungsi Keanggotaan Fuzzy</h3>
</div>

<div class="row g-4">
    {{-- Grafik 1: Jumlah Prestasi --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">1. Variabel Input: Jumlah Prestasi</h5>
                <p class="text-muted">Domain: [0 – 10]</p>
                <svg width="700" height="220" viewBox="0 0 700 220" style="max-width:100%;height:auto;">
                    <rect x="0" y="0" width="700" height="220" fill="#fcfcfc"/>

                    {{-- Grid horizontal --}}
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#ccc" stroke-width="1"/>
                    <line x1="60" y1="100" x2="680" y2="100" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <line x1="60" y1="20" x2="680" y2="20" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>

                    {{-- Sumbu Y --}}
                    <text x="50" y="184" text-anchor="end" font-size="12" fill="#666">0</text>
                    <text x="50" y="104" text-anchor="end" font-size="12" fill="#666">0.5</text>
                    <text x="50" y="24" text-anchor="end" font-size="12" fill="#666">1</text>
                    <text x="15" y="100" text-anchor="middle" font-size="13" fill="#333" transform="rotate(-90,15,100)">μ</text>

                    {{-- Sumbu X --}}
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#333" stroke-width="1.5"/>
                    @foreach([0,1,2,3,4,5,6,7,8,9,10] as $xv)
                        @php $px = xLabel($xv, 0, 10); @endphp
                        <line x1="{{ $px }}" y1="180" x2="{{ $px }}" y2="185" stroke="#333" stroke-width="1"/>
                        <text x="{{ $px }}" y="198" text-anchor="middle" font-size="11" fill="#666">{{ $xv }}</text>
                    @endforeach
                    <text x="370" y="215" text-anchor="middle" font-size="13" fill="#333">Jumlah Prestasi</text>

                    {{-- Kurva Sedikit (0,0,2,3) --}}
                    <polyline points="{{ trapPoints(0,0,2,3,0,10) }}" fill="#e74c3c33" stroke="#e74c3c" stroke-width="2"/>
                    {{-- Kurva Sedang (2,3,5,6) --}}
                    <polyline points="{{ trapPoints(2,3,5,6,0,10) }}" fill="#f39c1233" stroke="#f39c12" stroke-width="2"/>
                    {{-- Kurva Banyak (5,6,10,10) --}}
                    <polyline points="{{ trapPoints(5,6,10,10,0,10) }}" fill="#27ae6033" stroke="#27ae60" stroke-width="2"/>

                    {{-- Legenda --}}
                    <rect x="540" y="25" width="10" height="10" fill="#e74c3c"/>
                    <text x="555" y="34" font-size="12" fill="#333">Sedikit</text>
                    <rect x="540" y="42" width="10" height="10" fill="#f39c12"/>
                    <text x="555" y="51" font-size="12" fill="#333">Sedang</text>
                    <rect x="540" y="59" width="10" height="10" fill="#27ae60"/>
                    <text x="555" y="68" font-size="12" fill="#333">Banyak</text>
                </svg>
            </div>
        </div>
    </div>

    {{-- Grafik 2: Total Poin --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">2. Variabel Input: Total Poin</h5>
                <p class="text-muted">Domain: [0 – 120]</p>
                <svg width="700" height="220" viewBox="0 0 700 220" style="max-width:100%;height:auto;">
                    <rect x="0" y="0" width="700" height="220" fill="#fcfcfc"/>
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#ccc" stroke-width="1"/>
                    <line x1="60" y1="100" x2="680" y2="100" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <line x1="60" y1="20" x2="680" y2="20" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <text x="50" y="184" text-anchor="end" font-size="12" fill="#666">0</text>
                    <text x="50" y="104" text-anchor="end" font-size="12" fill="#666">0.5</text>
                    <text x="50" y="24" text-anchor="end" font-size="12" fill="#666">1</text>
                    <text x="15" y="100" text-anchor="middle" font-size="13" fill="#333" transform="rotate(-90,15,100)">μ</text>
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#333" stroke-width="1.5"/>
                    @foreach([0,20,40,60,80,100,120] as $xv)
                        @php $px = xLabel($xv, 0, 120); @endphp
                        <line x1="{{ $px }}" y1="180" x2="{{ $px }}" y2="185" stroke="#333" stroke-width="1"/>
                        <text x="{{ $px }}" y="198" text-anchor="middle" font-size="11" fill="#666">{{ $xv }}</text>
                    @endforeach
                    <text x="370" y="215" text-anchor="middle" font-size="13" fill="#333">Total Poin</text>

                    {{-- Rendah (0,0,20,40) --}}
                    <polyline points="{{ trapPoints(0,0,20,40,0,120) }}" fill="#e74c3c33" stroke="#e74c3c" stroke-width="2"/>
                    {{-- Sedang (20,40,60,80) --}}
                    <polyline points="{{ trapPoints(20,40,60,80,0,120) }}" fill="#f39c1233" stroke="#f39c12" stroke-width="2"/>
                    {{-- Tinggi (60,80,120,120) --}}
                    <polyline points="{{ trapPoints(60,80,120,120,0,120) }}" fill="#27ae6033" stroke="#27ae60" stroke-width="2"/>

                    <rect x="540" y="25" width="10" height="10" fill="#e74c3c"/>
                    <text x="555" y="34" font-size="12" fill="#333">Rendah</text>
                    <rect x="540" y="42" width="10" height="10" fill="#f39c12"/>
                    <text x="555" y="51" font-size="12" fill="#333">Sedang</text>
                    <rect x="540" y="59" width="10" height="10" fill="#27ae60"/>
                    <text x="555" y="68" font-size="12" fill="#333">Tinggi</text>
                </svg>
            </div>
        </div>
    </div>

    {{-- Grafik 3: Kualitas Peringkat --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">3. Variabel Input: Kualitas Peringkat</h5>
                <p class="text-muted">Domain: [1 – 50] (semakin kecil angka peringkat, semakin baik)</p>
                <svg width="700" height="220" viewBox="0 0 700 220" style="max-width:100%;height:auto;">
                    <rect x="0" y="0" width="700" height="220" fill="#fcfcfc"/>
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#ccc" stroke-width="1"/>
                    <line x1="60" y1="100" x2="680" y2="100" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <line x1="60" y1="20" x2="680" y2="20" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <text x="50" y="184" text-anchor="end" font-size="12" fill="#666">0</text>
                    <text x="50" y="104" text-anchor="end" font-size="12" fill="#666">0.5</text>
                    <text x="50" y="24" text-anchor="end" font-size="12" fill="#666">1</text>
                    <text x="15" y="100" text-anchor="middle" font-size="13" fill="#333" transform="rotate(-90,15,100)">μ</text>
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#333" stroke-width="1.5"/>
                    @foreach([1,5,10,15,20,30,40,50] as $xv)
                        @php $px = xLabel($xv, 1, 50); @endphp
                        <line x1="{{ $px }}" y1="180" x2="{{ $px }}" y2="185" stroke="#333" stroke-width="1"/>
                        <text x="{{ $px }}" y="198" text-anchor="middle" font-size="11" fill="#666">{{ $xv }}</text>
                    @endforeach
                    <text x="370" y="215" text-anchor="middle" font-size="13" fill="#333">Peringkat</text>

                    {{-- Terbaik (1,1,3,5) --}}
                    <polyline points="{{ trapPoints(1,1,3,5,1,50) }}" fill="#27ae6033" stroke="#27ae60" stroke-width="2"/>
                    {{-- Mendekati (5,10,15,20) --}}
                    <polyline points="{{ trapPoints(5,10,15,20,1,50) }}" fill="#f39c1233" stroke="#f39c12" stroke-width="2"/>
                    {{-- Jauh (15,20,50,50) --}}
                    <polyline points="{{ trapPoints(15,20,50,50,1,50) }}" fill="#e74c3c33" stroke="#e74c3c" stroke-width="2"/>

                    <rect x="540" y="25" width="10" height="10" fill="#27ae60"/>
                    <text x="555" y="34" font-size="12" fill="#333">Terbaik</text>
                    <rect x="540" y="42" width="10" height="10" fill="#f39c12"/>
                    <text x="555" y="51" font-size="12" fill="#333">Mendekati</text>
                    <rect x="540" y="59" width="10" height="10" fill="#e74c3c"/>
                    <text x="555" y="68" font-size="12" fill="#333">Jauh</text>
                </svg>
            </div>
        </div>
    </div>

    {{-- Grafik 4: Skor Prestasi (Output) --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">4. Variabel Output: Skor Prestasi</h5>
                <p class="text-muted">Domain: [0 – 100]</p>
                <svg width="700" height="220" viewBox="0 0 700 220" style="max-width:100%;height:auto;">
                    <rect x="0" y="0" width="700" height="220" fill="#fcfcfc"/>
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#ccc" stroke-width="1"/>
                    <line x1="60" y1="100" x2="680" y2="100" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <line x1="60" y1="20" x2="680" y2="20" stroke="#eee" stroke-width="1" stroke-dasharray="4"/>
                    <text x="50" y="184" text-anchor="end" font-size="12" fill="#666">0</text>
                    <text x="50" y="104" text-anchor="end" font-size="12" fill="#666">0.5</text>
                    <text x="50" y="24" text-anchor="end" font-size="12" fill="#666">1</text>
                    <text x="15" y="100" text-anchor="middle" font-size="13" fill="#333" transform="rotate(-90,15,100)">μ</text>
                    <line x1="60" y1="180" x2="680" y2="180" stroke="#333" stroke-width="1.5"/>
                    @foreach([0,10,20,30,40,50,60,70,80,90,100] as $xv)
                        @php $px = xLabel($xv, 0, 100); @endphp
                        <line x1="{{ $px }}" y1="180" x2="{{ $px }}" y2="185" stroke="#333" stroke-width="1"/>
                        @if($xv % 20 == 0)
                        <text x="{{ $px }}" y="198" text-anchor="middle" font-size="11" fill="#666">{{ $xv }}</text>
                        @endif
                    @endforeach
                    <text x="370" y="215" text-anchor="middle" font-size="13" fill="#333">Skor</text>

                    {{-- Kurang (0,0,20,35) --}}
                    <polyline points="{{ trapPoints(0,0,20,35,0,100) }}" fill="#e74c3c33" stroke="#e74c3c" stroke-width="2"/>
                    {{-- Cukup (20,35,45,60) --}}
                    <polyline points="{{ trapPoints(20,35,45,60,0,100) }}" fill="#f39c1233" stroke="#f39c12" stroke-width="2"/>
                    {{-- Berprestasi (45,60,70,85) --}}
                    <polyline points="{{ trapPoints(45,60,70,85,0,100) }}" fill="#27ae6033" stroke="#27ae60" stroke-width="2"/>
                    {{-- Sangat (70,85,100,100) --}}
                    <polyline points="{{ trapPoints(70,85,100,100,0,100) }}" fill="#3498db33" stroke="#3498db" stroke-width="2"/>

                    <rect x="520" y="25" width="10" height="10" fill="#e74c3c"/>
                    <text x="535" y="34" font-size="12" fill="#333">Kurang Berprestasi</text>
                    <rect x="520" y="42" width="10" height="10" fill="#f39c12"/>
                    <text x="535" y="51" font-size="12" fill="#333">Cukup Berprestasi</text>
                    <rect x="520" y="59" width="10" height="10" fill="#27ae60"/>
                    <text x="535" y="68" font-size="12" fill="#333">Berprestasi</text>
                    <rect x="520" y="76" width="10" height="10" fill="#3498db"/>
                    <text x="535" y="85" font-size="12" fill="#333">Sangat Berprestasi</text>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection
