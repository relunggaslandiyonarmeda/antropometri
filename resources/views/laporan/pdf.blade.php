<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Antropometri Anak</title>
    <style>
@page {
    margin: 7mm 7mm 7mm 7mm;
    size: A4 landscape;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'DejaVu Sans', Arial, sans-serif;
    font-size: 6.5px;
    color: #1a1a1a;
    background: #fff;
    line-height: 1.35;
}

.page-header {
    border-bottom: 1.25pt solid #000;
    padding-bottom: 4px;
    margin-bottom: 6px;
    display: table;
    width: 100%;
}

.header-cell {
    display: table-cell;
    vertical-align: middle;
}

.header-title {
    font-size: 11px;
    font-weight: bold;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.header-subtitle {
    font-size: 6.5px;
    color: #444;
    margin-top: 0.5px;
    letter-spacing: 0.2px;
}

.header-meta {
    text-align: right;
    font-size: 6px;
    color: #555;
}

.section-title {
    font-size: 7px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.35px;
    margin-top: 8px;
    margin-bottom: 3px;
    padding-bottom: 2px;
    border-bottom: 0.5pt solid #000;
}

.stats-strip {
    display: table;
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 6px;
}

.stat-box {
    display: table-cell;
    width: 16.66%;
    text-align: center;
    border: 0.5pt solid #000;
    padding: 3px 2px;
}

.stat-box:not(:last-child) {
    border-right: none;
}

.stat-number {
    font-size: 12px;
    font-weight: bold;
}

.stat-label {
    font-size: 5.5px;
    margin-top: 1px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #333;
}

.main-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 6px;
}

.main-table thead th {
    background: #000;
    color: #fff;
    font-size: 5.5px;
    font-weight: bold;
    text-align: center;
    padding: 2.5px 1px;
    border: 0.5pt solid #000;
}

.main-table tbody tr:nth-child(odd)  { background: #fff; }
.main-table tbody tr:nth-child(even) { background: #f5f5f5; }

.main-table tbody td {
    padding: 2px 1px;
    border: 0.5pt solid #ccc;
    font-size: 5.5px;
    vertical-align: middle;
}

.row-no {
    background: #e5e5e5 !important;
    font-weight: bold;
    text-align: center;
    width: 16px;
}

.td-center { text-align: center; }
.td-name   { font-weight: bold; }
.td-mono   { font-family: monospace; text-align: center; }

.badge {
    display: inline-block;
    padding: 0px 1.5px;
    border: 0.5pt solid #000;
    font-size: 4.5px;
    font-weight: bold;
    background: #fff;
    color: #000;
}

.bottom-section-spacer {
    height: 45px;
}

.bottom-section {
    display: table;
    width: 100%;
    margin-top: 4px;
    page-break-inside: avoid;
}

.rekap-cell {
    display: table-cell;
    width: 55%;
    vertical-align: top;
    padding-right: 8px;
}

.ttd-cell {
    display: table-cell;
    text-align: right;
    vertical-align: top;
}

.rekap-table {
    width: 100%;
    border-collapse: collapse;
}

.rekap-table thead th {
    background: #000;
    color: #fff;
    font-size: 6px;
    padding: 3px 4px;
    text-align: center;
    border: 0.5pt solid #000;
}

.rekap-table tbody td {
    font-size: 6px;
    padding: 2px 4px;
    border: 0.5pt solid #ccc;
}

.rekap-table tbody tr:nth-child(odd)  { background: #fff; }
.rekap-table tbody tr:nth-child(even) { background: #f5f5f5; }

.rekap-table tbody tr.total-row {
    font-weight: bold;
    background: #e5e5e5 !important;
}

.bar-track {
    background: #e0e0e0;
    border: 0.5pt solid #999;
    height: 4px;
    width: 70px;
    display: inline-block;
}

.bar-fill {
    height: 4px;
    background: #000;
}

.ttd-box {
    display: inline-block;
    border: 0.5pt solid #000;
    padding: 6px 12px;
    text-align: center;
    min-width: 120px;
}

.ttd-city   { font-size: 6.5px; margin-bottom: 0.5px; }
.ttd-title  { font-size: 6px; color: #555; margin-bottom: 20px; }
.ttd-line   { border-top: 0.5pt solid #000; margin: 0 3px; }
.ttd-name   { font-size: 6.5px; font-weight: bold; margin-top: 1.5px; }
.ttd-jabatan { font-size: 5.5px; color: #555; }

.page-footer {
    margin-top: 6px;
    padding-top: 3px;
    border-top: 0.5pt solid #000;
    display: table;
    width: 100%;
    font-size: 5.5px;
    color: #555;
}

.footer-left {
    display: table-cell;
    vertical-align: middle;
}

.footer-right {
    display: table-cell;
    text-align: right;
    vertical-align: middle;
}

.footer-brand {
    font-weight: bold;
    color: #000;
}
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="page-header">
    <div class="header-cell">
        <div class="header-title">Laporan Pengukuran Antropometri</div>
        <div class="header-subtitle">Penilaian Status Gizi Anak Usia 0–60 Bulan &nbsp;&bull;&nbsp; Berdasarkan Permenkes No. 2 Tahun 2020</div>
    </div>
    <div class="header-cell header-meta">
        <div>Dicetak: {{ now()->format('d F Y, H:i') }} WIB</div>
    </div>
</div>

{{-- STATS --}}
@php
    $total    = $data->count();
    $stBuruk  = $data->where('status_bbu', 'Berat Badan Sangat Kurang')->count();
    $stKurang = $data->where('status_bbu', 'Berat Badan Kurang')->count();
    $stNormal = $data->where('status_bbu', 'Berat Badan Normal')->count();
    $stRisiko = $data->where('status_bbu', 'Risiko Berat Badan Lebih')->count();
    $stLebih  = $data->where('status_bbu', 'Berat Badan Lebih')->count();
@endphp

<div class="stats-strip">
    <div class="stat-box">
        <div class="stat-number">{{ $total }}</div>
        <div class="stat-label">Total Anak</div>
    </div>
    <div class="stat-box">
        <div class="stat-number">{{ $stBuruk }}</div>
        <div class="stat-label">BB Sangat Kurang</div>
    </div>
    <div class="stat-box">
        <div class="stat-number">{{ $stKurang }}</div>
        <div class="stat-label">BB Kurang</div>
    </div>
    <div class="stat-box">
        <div class="stat-number">{{ $stNormal }}</div>
        <div class="stat-label">BB Normal</div>
    </div>
    <div class="stat-box">
        <div class="stat-number">{{ $stRisiko }}</div>
        <div class="stat-label">Risiko BB Lebih</div>
    </div>
    <div class="stat-box">
        <div class="stat-number">{{ $stLebih }}</div>
        <div class="stat-label">BB Lebih</div>
    </div>
</div>

{{-- DATA TABLE --}}
<div class="section-title">Data Pengukuran dan Status Gizi</div>

<table class="main-table">
    <thead>
        <tr>
            <th rowspan="2" style="width:1.5%">No</th>
            <th rowspan="2" style="width:10.5%">Nama Anak</th>
            <th rowspan="2" style="width:8.5%">Alamat</th>
            <th rowspan="2" style="width:5.5%">Tgl Ukur</th>
            <th rowspan="2" style="width:2.5%">JK</th>
            <th rowspan="2" style="width:3.2%">Umur</th>
            <th rowspan="2" style="width:3.2%">BB</th>
            <th rowspan="2" style="width:3.2%">TB/PB</th>
            <th rowspan="2" style="width:3%">IMT</th>
            <th colspan="2" style="width:8.5%">BB/U</th>
            <th colspan="2" style="width:8.5%">TB/U</th>
            <th colspan="2" style="width:8.5%">BB/TB</th>
            <th colspan="2" style="width:8.5%">IMT/U</th>
            <th rowspan="2" style="width:9%">Ket</th>
        </tr>
        <tr>
            <th style="width:4%">Z</th>
            <th style="width:4.5%">St</th>
            <th style="width:4%">Z</th>
            <th style="width:4.5%">St</th>
            <th style="width:4%">Z</th>
            <th style="width:4.5%">St</th>
            <th style="width:4%">Z</th>
            <th style="width:4.5%">St</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $a)
        <tr>
            <td class="row-no">{{ $i + 1 }}</td>
            <td class="td-name">
                {{ $a->nama_anak }}
                @if($a->nama_orang_tua)
                    <br><span style="font-weight:normal;color:#666;font-size:5px">{{ $a->nama_orang_tua }}</span>
                @endif
            </td>
            <td>{{ $a->alamat ?? '-' }}</td>
            <td class="td-center">{{ $a->tanggal_pengukuran->format('d/m/Y') }}</td>
            <td class="td-center">{{ $a->jenis_kelamin == 'Laki - Laki' ? 'L' : 'P' }}</td>
            <td class="td-center">{{ $a->umur_bulan }}</td>
            <td class="td-mono">{{ $a->berat_badan }}</td>
            <td class="td-mono">{{ $a->tinggi_badan }}</td>
            <td class="td-mono">{{ $a->imt ?? '-' }}</td>

            <td class="td-mono" style="font-weight:600">{{ $a->zscore_bbu ?? '-' }}</td>
            <td>@if($a->status_bbu)<span class="badge">{{ $a->status_bbu }}</span>@else - @endif</td>

            <td class="td-mono" style="font-weight:600">{{ $a->zscore_tbu ?? '-' }}</td>
            <td>@if($a->status_tbu)<span class="badge">{{ $a->status_tbu }}</span>@else - @endif</td>

            <td class="td-mono" style="font-weight:600">{{ $a->zscore_bbtb ?? '-' }}</td>
            <td>@if($a->status_bbtb)<span class="badge">{{ $a->status_bbtb }}</span>@else - @endif</td>

            <td class="td-mono" style="font-weight:600">{{ $a->zscore_imtu ?? '-' }}</td>
            <td>@if($a->status_imtu)<span class="badge">{{ $a->status_imtu }}</span>@else - @endif</td>

            <td style="color:#333">{{ $a->keterangan ?? '' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="19" class="td-center" style="padding:8px; color:#777; font-style:italic">
                Tidak ada data untuk ditampilkan.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- BOTTOM SECTION WITH SPACER --}}
<div class="bottom-section-spacer"></div>

<div class="bottom-section">
    <div class="rekap-cell">
        <div class="section-title" style="margin-top:0">Rekapitulasi Status Gizi (BB/U)</div>
        <table class="rekap-table">
            <thead>
                <tr>
                    <th style="text-align:left">Status Gizi</th>
                    <th style="text-align:center;width:25px">Jumlah</th>
                    <th style="text-align:center;width:25px">%</th>
                    <th style="width:60px">Proporsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rekapList = [
                        ['label' => 'BB Sangat Kurang',  'count' => $stBuruk],
                        ['label' => 'BB Kurang',          'count' => $stKurang],
                        ['label' => 'BB Normal',          'count' => $stNormal],
                        ['label' => 'Risiko BB Lebih',    'count' => $stRisiko],
                        ['label' => 'BB Lebih',           'count' => $stLebih],
                    ];
                @endphp
                @foreach($rekapList as $r)
                @php $pct = $total > 0 ? round($r['count']/$total*100, 1) : 0; @endphp
                <tr>
                    <td>{{ $r['label'] }}</td>
                    <td style="text-align:center;font-weight:bold">{{ $r['count'] }}</td>
                    <td style="text-align:center">{{ $pct }}%</td>
                    <td>
                        <div class="bar-track">
                            <div class="bar-fill" style="width:{{ $pct }}%"></div>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td>Total</td>
                    <td style="text-align:center">{{ $total }}</td>
                    <td style="text-align:center">100%</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top:3px;font-size:5.5px;color:#333">
            <span style="font-weight:bold">Keterangan Z-Score:</span>
            &nbsp; Z &lt; -3: Sangat Kurang &nbsp;|&nbsp; -3 &le; Z &lt; -2: Kurang
            &nbsp;|&nbsp; -2 &le; Z &le; 1: Normal &nbsp;|&nbsp; 1 &lt; Z &le; 2: Risiko Lebih
            &nbsp;|&nbsp; Z &gt; 2: Lebih/Obesitas
        </div>
    </div>

    <div class="ttd-cell">
        <div class="ttd-box">
            <div class="ttd-city">Mengetahui,</div>
            <div class="ttd-title">Petugas Gizi / Bidan</div>
            <div class="ttd-line"></div>
            <div class="ttd-name">( ________________________ )</div>
            <div class="ttd-jabatan">NIP. ____________________</div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<div class="page-footer">
    <div class="footer-left">
        <span class="footer-brand">Sistem Informasi Antropometri Anak</span>
        &nbsp;&mdash;&nbsp; Berdasarkan Permenkes No. 2 Tahun 2020 &nbsp;&mdash;&nbsp;
        Data valid per tanggal cetak.
    </div>
    <div class="footer-right">
        Halaman 1 &nbsp;|&nbsp; {{ now()->format('d/m/Y H:i') }} WIB
    </div>
</div>

</body>
</html>
