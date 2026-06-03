<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Antropometri Anak</title>
    <style>
@page {
    margin: 16mm;
    size: A4 landscape;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
    font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    font-size: 7px;
    color: #1a1a1a;
    background: #ffffff;
    line-height: 1.3;
}

.page {
    page-break-inside: auto;
}

.document-header {
    background: #1a365d;
    color: #ffffff;
    padding: 5px 8px;
    border-radius: 2px;
    margin-bottom: 4px;
    display: table;
    width: 100%;
}

.document-header .dh-left {
    display: table-cell;
    width: 58%;
    vertical-align: middle;
}

.document-header .dh-right {
    display: table-cell;
    width: 42%;
    text-align: right;
    vertical-align: middle;
    font-size: 5.5px;
    color: #cbd5e1;
}

.dh-title {
    font-size: 9px;
    font-weight: bold;
    color: #ffffff;
    letter-spacing: 0.3px;
}

.dh-subtitle {
    font-size: 6px;
    color: #93c5fd;
    margin-top: 1px;
}

.dh-info {
    font-size: 5.5px;
    color: #e2e8f0;
    margin-top: 1px;
}

.info-row {
    display: table;
    width: 100%;
    margin-bottom: 3px;
}

.info-cell {
    display: table-cell;
    text-align: center;
    padding: 2.5px 2px;
    border: 0.6pt solid #1a6fa8;
    background: #f0f7ff;
    vertical-align: middle;
}

.info-cell .info-val {
    font-size: 8px;
    font-weight: bold;
    color: #1a365d;
}

.info-cell .info-lbl {
    font-size: 4px;
    color: #555;
    text-transform: uppercase;
    letter-spacing: 0.2px;
    margin-top: 0.5px;
}

.section-heading {
    font-size: 6px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #1a365d;
    padding-bottom: 1px;
    margin-bottom: 2px;
    margin-top: 3px;
    border-bottom: 0.8pt solid #1a6fa8;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 4px;
    font-size: 5.5px;
}

.data-table thead th {
    background: #1a365d;
    color: #ffffff;
    font-weight: bold;
    text-align: center;
    padding: 2px 1.5px;
    border: 0.35pt solid #1e3a8a;
    font-size: 5.5px;
}

.data-table tbody tr {
    page-break-inside: avoid;
}

.data-table tbody tr:nth-child(odd) td {
    background: #ffffff;
}

.data-table tbody tr:nth-child(even) td {
    background: #f0f7ff;
}

.data-table tbody td {
    padding: 1.5px 2px;
    border: 0.3pt solid #c5d5e8;
    vertical-align: middle;
}

.col-no {
    width: 18px;
    text-align: center;
    font-weight: bold;
    background: #e5e7eb !important;
    color: #374151;
}

.col-nama {
    text-align: left;
}

.col-nilai {
    text-align: center;
    font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
    font-size: 5.5px;
    font-weight: 600;
}

.col-status {
    text-align: center;
}

.badge {
    display: inline-block;
    padding: 0.3px 2.5px;
    border-radius: 2px;
    font-size: 4.5px;
    font-weight: bold;
    color: #ffffff;
    letter-spacing: 0.15px;
}

.badge-sangat-kurang { background: #dc2626; }
.badge-kurang        { background: #ea580c; }
.badge-normal        { background: #16a34a; }
.badge-risiko-lebih  { background: #2563eb; }
.badge-lebih         { background: #9333ea; }
.badge-na            { background: #9ca3af; }

.no-data {
    text-align: center;
    padding: 8px;
    color: #888;
    font-style: italic;
}

.h-divider {
    border-top: 0.8pt solid #1a365d;
    margin: 4px 0 3px 0;
}

.bottom-grid {
    display: table;
    width: 100%;
    margin-top: 2px;
}

.rekap-area {
    display: table-cell;
    width: 54%;
    vertical-align: top;
    padding-right: 8px;
}

.ttd-area {
    display: table-cell;
    width: 46%;
    vertical-align: top;
    text-align: center;
}

.rekap-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 5.5px;
}

.rekap-table thead th {
    background: #1a365d;
    color: #ffffff;
    text-align: center;
    padding: 2px 3px;
    border: 0.35pt solid #1e3a8a;
    font-size: 5.5px;
}

.rekap-table tbody td {
    padding: 1.5px 3px;
    border: 0.3pt solid #c5d5e8;
}

.rekap-table tbody tr:nth-child(odd) td {
    background: #ffffff;
}

.rekap-table tbody tr:nth-child(even) td {
    background: #f0f7ff;
}

.rekap-table tbody tr.total-row td {
    background: #e2e8f0 !important;
    font-weight: bold;
    border-top: 0.7pt solid #1a365d;
    color: #1a365d;
}

.bar-track {
    background: #e2e8f0;
    border: 0.3pt solid #94a3b8;
    height: 3.5px;
    width: 55px;
    display: inline-block;
    vertical-align: middle;
    border-radius: 1px;
}

.bar-fill {
    height: 3.5px;
    background: #1a6fa8;
    border-radius: 1px;
}

.ket-skor {
    margin-top: 1.5px;
    font-size: 4.5px;
    color: #555;
    padding: 2px 4px;
    background: #f8fafc;
    border-left: 1.2pt solid #1a6fa8;
}

.signature-box {
    margin-top: 2px;
    padding: 0 6px;
}

.sign-line {
    width: 100%;
    height: 0.7pt;
    background: #1a365d;
    margin: 0 0 2px 0;
}

.sign-role {
    font-size: 5.5px;
    color: #555;
    margin-bottom: 1.5px;
    text-align: center;
}

.sign-name {
    font-size: 6px;
    font-weight: bold;
    color: #1a365d;
    text-align: center;
    min-height: 12px;
}

.sign-nip {
    font-size: 5.5px;
    color: #666;
    text-align: center;
}

.page-footer {
    margin-top: 4px;
    padding-top: 2px;
    border-top: 0.8pt solid #1a365d;
    display: table;
    width: 100%;
    font-size: 5.5px;
    color: #4b5563;
}

.footer-left {
    display: table-cell;
    vertical-align: middle;
}

.footer-left .footer-brand {
    font-weight: bold;
    color: #1a365d;
    font-size: 5.5px;
}

.footer-right {
    display: table-cell;
    text-align: right;
    vertical-align: middle;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
    font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    font-size: 8px;
    color: #1a1a1a;
    background: #ffffff;
    line-height: 1.35;
}

.page {
    page-break-inside: auto;
}

.document-header {
    background: #1a365d;
    color: #ffffff;
    padding: 6px 10px;
    border-radius: 3px;
    margin-bottom: 5px;
    display: table;
    width: 100%;
}

.document-header .dh-left {
    display: table-cell;
    width: 60%;
    vertical-align: middle;
}

.document-header .dh-right {
    display: table-cell;
    width: 40%;
    text-align: right;
    vertical-align: middle;
    font-size: 6px;
    color: #cbd5e1;
}

.dh-title {
    font-size: 10px;
    font-weight: bold;
    color: #ffffff;
    letter-spacing: 0.4px;
}

.dh-subtitle {
    font-size: 6.5px;
    color: #93c5fd;
    margin-top: 2px;
}

.dh-info {
    font-size: 6px;
    color: #e2e8f0;
    margin-top: 2px;
}

.info-row {
    display: table;
    width: 100%;
    margin-bottom: 4px;
}

.info-cell {
    display: table-cell;
    text-align: center;
    padding: 3px 2px;
    border: 0.7pt solid #1a6fa8;
    background: #f0f7ff;
    vertical-align: middle;
}

.info-cell .info-val {
    font-size: 9px;
    font-weight: bold;
    color: #1a365d;
}

.info-cell .info-lbl {
    font-size: 4.5px;
    color: #555;
    text-transform: uppercase;
    letter-spacing: 0.25px;
    margin-top: 1px;
}

.section-heading {
    font-size: 6.5px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    color: #1a365d;
    padding-bottom: 1.5px;
    margin-bottom: 3px;
    margin-top: 4px;
    border-bottom: 1pt solid #1a6fa8;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 5px;
    font-size: 6px;
}

.data-table thead th {
    background: #1a365d;
    color: #ffffff;
    font-weight: bold;
    text-align: center;
    padding: 2.5px 2px;
    border: 0.4pt solid #1e3a8a;
    font-size: 6px;
}

.data-table tbody tr {
    page-break-inside: avoid;
}

.data-table tbody tr:nth-child(odd) td {
    background: #ffffff;
}

.data-table tbody tr:nth-child(even) td {
    background: #f0f7ff;
}

.data-table tbody td {
    padding: 1.8px 2px;
    border: 0.35pt solid #c5d5e8;
    vertical-align: middle;
}

.col-no {
    width: 20px;
    text-align: center;
    font-weight: bold;
    background: #e5e7eb !important;
    color: #374151;
}

.col-nama {
    text-align: left;
}

.col-nilai {
    text-align: center;
    font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
    font-size: 6px;
    font-weight: 600;
}

.col-status {
    text-align: center;
}

.badge {
    display: inline-block;
    padding: 0.5px 3px;
    border-radius: 2px;
    font-size: 5.5px;
    font-weight: bold;
    color: #ffffff;
    letter-spacing: 0.2px;
}

.badge-sangat-kurang { background: #dc2626; }
.badge-kurang        { background: #ea580c; }
.badge-normal        { background: #16a34a; }
.badge-risiko-lebih  { background: #2563eb; }
.badge-lebih         { background: #9333ea; }
.badge-na            { background: #9ca3af; }

.no-data {
    text-align: center;
    padding: 10px;
    color: #888;
    font-style: italic;
}

.h-divider {
    border-top: 1pt solid #1a365d;
    margin: 6px 0 5px 0;
}

.bottom-grid {
    display: table;
    width: 100%;
    margin-top: 3px;
}

.rekap-area {
    display: table-cell;
    width: 54%;
    vertical-align: top;
    padding-right: 10px;
}

.ttd-area {
    display: table-cell;
    width: 46%;
    vertical-align: top;
    text-align: center;
}

.rekap-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 6.5px;
}

.rekap-table thead th {
    background: #1a365d;
    color: #ffffff;
    text-align: center;
    padding: 2.5px 4px;
    border: 0.4pt solid #1e3a8a;
    font-size: 6.5px;
}

.rekap-table tbody td {
    padding: 2px 4px;
    border: 0.35pt solid #c5d5e8;
}

.rekap-table tbody tr:nth-child(odd) td {
    background: #ffffff;
}

.rekap-table tbody tr:nth-child(even) td {
    background: #f0f7ff;
}

.rekap-table tbody tr.total-row td {
    background: #e2e8f0 !important;
    font-weight: bold;
    border-top: 0.8pt solid #1a365d;
    color: #1a365d;
}

.bar-track {
    background: #e2e8f0;
    border: 0.35pt solid #94a3b8;
    height: 4px;
    width: 60px;
    display: inline-block;
    vertical-align: middle;
    border-radius: 1px;
}

.bar-fill {
    height: 4px;
    background: #1a6fa8;
    border-radius: 1px;
}

.ket-skor {
    margin-top: 2px;
    font-size: 5.5px;
    color: #555;
    padding: 2px 5px;
    background: #f8fafc;
    border-left: 1.5pt solid #1a6fa8;
}

.signature-box {
    margin-top: 3px;
    padding: 0 8px;
}

.sign-line {
    width: 100%;
    height: 0.8pt;
    background: #1a365d;
    margin: 0 0 2px 0;
}

.sign-role {
    font-size: 6px;
    color: #555;
    margin-bottom: 2px;
    text-align: center;
}

.sign-name {
    font-size: 7px;
    font-weight: bold;
    color: #1a365d;
    text-align: center;
    min-height: 14px;
}

.sign-nip {
    font-size: 6px;
    color: #666;
    text-align: center;
}

.page-footer {
    margin-top: 5px;
    padding-top: 2px;
    border-top: 1pt solid #1a365d;
    display: table;
    width: 100%;
    font-size: 6px;
    color: #4b5563;
}

.footer-left {
    display: table-cell;
    vertical-align: middle;
}

.footer-left .footer-brand {
    font-weight: bold;
    color: #1a365d;
    font-size: 6px;
}

.footer-right {
    display: table-cell;
    text-align: right;
    vertical-align: middle;
}
</style>
</head>
<body>

{{-- === HEADER === --}}
<div class="document-header">
    <div class="dh-left">
        <div class="dh-title">LAPORAN PENGUKURAN ANTROPOMETRI ANAK</div>
        <div class="dh-subtitle">Penilaian Status Gizi Berdasarkan Permenkes No. 2 Tahun 2020</div>
    </div>
    <div class="dh-right">
        <div class="dh-info">Dicetak: {{ now()->format('d F Y') }}</div>
        <div class="dh-info">{{ now()->format('H:i') }} WIB</div>
    </div>
</div>

{{-- === INFO STATS === --}}
<div class="info-row">
    <div class="info-cell">
        <div class="info-val">{{ $data->count() }}</div>
        <div class="info-lbl">Total Anak</div>
    </div>
    <div class="info-cell">
        <div class="info-val">{{ $data->where('status_bbu', 'Berat Badan Sangat Kurang')->count() }}</div>
        <div class="info-lbl">BB Sangat Kurang</div>
    </div>
    <div class="info-cell">
        <div class="info-val">{{ $data->where('status_bbu', 'Berat Badan Kurang')->count() }}</div>
        <div class="info-lbl">BB Kurang</div>
    </div>
    <div class="info-cell">
        <div class="info-val">{{ $data->where('status_bbu', 'Berat Badan Normal')->count() }}</div>
        <div class="info-lbl">BB Normal</div>
    </div>
    <div class="info-cell">
        <div class="info-val">{{ $data->where('status_bbu', 'Risiko Berat Badan Lebih')->count() }}</div>
        <div class="info-lbl">Risiko BB Lebih</div>
    </div>
    <div class="info-cell">
        <div class="info-val">{{ $data->where('status_bbu', 'Berat Badan Lebih')->count() }}</div>
        <div class="info-lbl">BB Lebih</div>
    </div>
</div>

{{-- FILTER INFO --}}
<div style="margin-bottom:4px; font-size:6px; color:#555; display:table; width:100%;">
    <div style="display:table-cell; text-align:left;">
        @if($request->filled('search'))
            <strong>Pencarian:</strong> {{ $request->search }} &nbsp;&nbsp;
        @endif
        @if($request->filled('status_gizi'))
            <strong>Filter:</strong> {{ $request->status_gizi }}
        @endif
        @if(!$request->filled('search') && !$request->filled('status_gizi'))
            Semua Data
        @endif
    </div>
    <div style="display:table-cell; text-align:right; font-size:5.5px; color:#777;">
        Sumber: Permenkes No. 2 Tahun 2020
    </div>
</div>

{{-- === MAIN TABLE === --}}
<div class="section-heading">Detail Data Pengukuran &amp; Status Gizi</div>

<table class="data-table">
    <thead>
        <tr>
            <th rowspan="2" style="width:1.4%">No</th>
            <th rowspan="2" style="width:11%">Nama Anak / Orang Tua</th>
            <th rowspan="2" style="width:6.5%">Alamat</th>
            <th rowspan="2" style="width:5.5%">Tgl Ukur</th>
            <th rowspan="2" style="width:2.2%">JK</th>
            <th rowspan="2" style="width:3%">Umur</th>
            <th rowspan="2" style="width:3.5%">BB/kg</th>
            <th rowspan="2" style="width:3.5%">TB/cm</th>
            <th rowspan="2" style="width:3%">IMT</th>
            <th colspan="2" style="width:8%">BB/U</th>
            <th colspan="2" style="width:8%">TB/U</th>
            <th colspan="2" style="width:8%">BB/TB</th>
            <th colspan="2" style="width:8%">IMT/U</th>
        </tr>
        <tr>
            <th style="width:4%">Z</th>
            <th style="width:4%">Status</th>
            <th style="width:4%">Z</th>
            <th style="width:4%">Status</th>
            <th style="width:4%">Z</th>
            <th style="width:4%">Status</th>
            <th style="width:4%">Z</th>
            <th style="width:4%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $a)
        <tr>
            <td class="col-no">{{ $i + 1 }}</td>
            <td class="col-nama" style="font-weight:700; font-size:6.5px;">
                {{ $a->nama_anak }}
                @if($a->nama_orang_tua)
                    <div style="font-weight:400; color:#555; font-size:5.5px;">
                        {{ $a->nama_orang_tua }}
                    </div>
                @endif
            </td>
            <td style="font-size:5.5px; padding:1.5px 2px;">{{ $a->alamat ?? '-' }}</td>
            <td class="col-nilai">{{ $a->tanggal_pengukuran->format('d/m/Y') }}</td>
            <td class="col-nilai">{{ $a->jenis_kelamin == 'Laki - Laki' ? 'L' : 'P' }}</td>
            <td class="col-nilai">{{ $a->umur_bulan }}</td>
            <td class="col-nilai">{{ $a->berat_badan }}</td>
            <td class="col-nilai">{{ $a->tinggi_badan }}</td>
            <td class="col-nilai">{{ $a->imt ?? '-' }}</td>

            <td class="col-nilai" style="font-weight:700; color:#1a365d;">
                {{ $a->zscore_bbu ?? '-' }}
            </td>
            <td class="col-status">
                @php
                    $b = $a->status_bbu;
                    $bc = match($b) {
                        'Berat Badan Sangat Kurang' => 'sangat-kurang',
                        'Berat Badan Kurang'        => 'kurang',
                        'Berat Badan Normal'        => 'normal',
                        'Risiko Berat Badan Lebih'  => 'risiko-lebih',
                        'Berat Badan Lebih'         => 'lebih',
                        default                     => 'na',
                    };
                @endphp
                @if($a->status_bbu)
                    <span class="badge badge-{{ $bc }}">{{ $b }}</span>
                @else
                    <span style="color:#aaa;">-</span>
                @endif
            </td>

            <td class="col-nilai" style="font-weight:700; color:#1a365d;">
                {{ $a->zscore_tbu ?? '-' }}
            </td>
            <td class="col-status">
                @php
                    $b = $a->status_tbu;
                    $bc = match($b) {
                        'Berat Badan Sangat Kurang' => 'sangat-kurang',
                        'Berat Badan Kurang'        => 'kurang',
                        'Berat Badan Normal'        => 'normal',
                        'Risiko Berat Badan Lebih'  => 'risiko-lebih',
                        'Berat Badan Lebih'         => 'lebih',
                        default                     => 'na',
                    };
                @endphp
                @if($a->status_tbu)
                    <span class="badge badge-{{ $bc }}">{{ $b }}</span>
                @else
                    <span style="color:#aaa;">-</span>
                @endif
            </td>

            <td class="col-nilai" style="font-weight:700; color:#1a365d;">
                {{ $a->zscore_bbtb ?? '-' }}
            </td>
            <td class="col-status">
                @php
                    $b = $a->status_bbtb;
                    $bc = match($b) {
                        'Berat Badan Sangat Kurang' => 'sangat-kurang',
                        'Berat Badan Kurang'        => 'kurang',
                        'Berat Badan Normal'        => 'normal',
                        'Risiko Berat Badan Lebih'  => 'risiko-lebih',
                        'Berat Badan Lebih'         => 'lebih',
                        default                     => 'na',
                    };
                @endphp
                @if($a->status_bbtb)
                    <span class="badge badge-{{ $bc }}">{{ $b }}</span>
                @else
                    <span style="color:#aaa;">-</span>
                @endif
            </td>

            <td class="col-nilai" style="font-weight:700; color:#1a365d;">
                {{ $a->zscore_imtu ?? '-' }}
            </td>
            <td class="col-status">
                @php
                    $b = $a->status_imtu;
                    $bc = match($b) {
                        'Berat Badan Sangat Kurang' => 'sangat-kurang',
                        'Berat Badan Kurang'        => 'kurang',
                        'Berat Badan Normal'        => 'normal',
                        'Risiko Berat Badan Lebih'  => 'risiko-lebih',
                        'Berat Badan Lebih'         => 'lebih',
                        default                     => 'na',
                    };
                @endphp
                @if($a->status_imtu)
                    <span class="badge badge-{{ $bc }}">{{ $b }}</span>
                @else
                    <span style="color:#aaa;">-</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="18" class="no-data">
                Tidak ada data untuk ditampilkan.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- === BOTTOM: REKAP + TTD === --}}
<div class="h-divider"></div>

<div class="bottom-grid">
    <div class="rekap-area">

        {{-- Rekap BB/U --}}
        <div class="section-heading" style="margin-top:0;">Rekapitulasi Status Gizi (BB/U)</div>
        <table class="rekap-table">
            <thead>
                <tr>
                    <th style="text-align:left; width:35%">Status Gizi</th>
                    <th style="text-align:center; width:12%">Jumlah</th>
                    <th style="text-align:center; width:10%">%</th>
                    <th style="text-align:left">Proporsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total   = $data->count();
                    $rekapBb = [
                        ['label' => 'BB Sangat Kurang',   'count' => $data->where('status_bbu', 'Berat Badan Sangat Kurang')->count(), 'color' => '#dc2626'],
                        ['label' => 'BB Kurang',           'count' => $data->where('status_bbu', 'Berat Badan Kurang')->count(),        'color' => '#ea580c'],
                        ['label' => 'BB Normal',           'count' => $data->where('status_bbu', 'Berat Badan Normal')->count(),        'color' => '#16a34a'],
                        ['label' => 'Risiko BB Lebih',     'count' => $data->where('status_bbu', 'Risiko Berat Badan Lebih')->count(),  'color' => '#2563eb'],
                        ['label' => 'BB Lebih',            'count' => $data->where('status_bbu', 'Berat Badan Lebih')->count(),         'color' => '#9333ea'],
                    ];
                @endphp
                @foreach($rekapBb as $r)
                    @php $pct = $total > 0 ? round($r['count'] / $total * 100, 1) : 0; @endphp
                    <tr>
                        <td>{{ $r['label'] }}</td>
                        <td style="text-align:center; font-weight:bold;">{{ $r['count'] }}</td>
                        <td style="text-align:center;">{{ $pct }}%</td>
                        <td>
                            <div class="bar-track">
                                <div class="bar-fill" style="width:{{ $pct }}%; background:{{ $r['color'] }};"></div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td>Total</td>
                    <td style="text-align:center;">{{ $total }}</td>
                    <td style="text-align:center;">100%</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        {{-- Keterangan Z-Score --}}
        <div class="ket-skor">
            <strong>Keterangan Z-Score:</strong>
            &nbsp; Z &lt; -3 &rarr; Sangat Kurang
            &nbsp;&nbsp;|&nbsp;&nbsp;
            -3 &le; Z &lt; -2 &rarr; Kurang
            &nbsp;&nbsp;|&nbsp;&nbsp;
            -2 &le; Z &le; 2 &rarr; Normal
            &nbsp;&nbsp;|&nbsp;&nbsp;
            Z &gt; 2 &rarr; Lebih / Obesitas
        </div>
    </div>

    {{-- Tanda Tangan --}}
    <div class="ttd-area">
        <div class="signature-box">
            <div class="sign-role">
                <strong>Mengetahui,</strong><br>
                Petugas Gizi / Nakes Penanggung Jawab
            </div>
            <div style="margin-top:16px;"></div>
            <div class="sign-line"></div>
            <div class="sign-name">( _____________________ )</div>
            <div class="sign-nip">NIP. _____________________</div>
        </div>
    </div>
</div>

{{-- === FOOTER === --}}
<div class="page-footer">
    <div class="footer-left">
        <span class="footer-brand">Sistem Informasi Antropometri Anak</span>
        &nbsp;&#8226;&nbsp;
        Berdasarkan Permenkes No. 2 Tahun 2020 &nbsp;&#8226;&nbsp;
        Laporan ini berlaku untuk keperluan penilaian status gizi anak.
    </div>
    <div class="footer-right">
        Halaman 1 &nbsp;&#8226;&nbsp; {{ now()->format('d/m/Y H:i') }} WIB
    </div>
</div>

</body>
</html>
