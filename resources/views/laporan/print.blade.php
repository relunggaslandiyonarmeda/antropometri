<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratinjau Laporan Antropometri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --brand-navy: #0F3D5C;
            --brand-blue: #1a6fa8;
            --brand-light: #EAF2FB;
            --brand-border: #CBD5E1;
        }

        body {
            background: #F1F5F9;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            padding: 0;
            margin: 0;
        }

        .topbar {
            background: #ffffff;
            border-bottom: 2px solid var(--brand-navy);
            padding: 8px 16px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .topbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-brand {
            font-weight: 700;
            font-size: 12px;
            color: var(--brand-navy);
            letter-spacing: 0.3px;
        }

        .topbar-actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-topbar {
            font-size: 10px;
            padding: 4px 10px;
            border-radius: 4px;
        }

        .report-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 12px 10px 24px 10px;
        }

        .print-only-header {
            display: none;
        }

        /* PRINT STYLES */
        @media print {
html, body {
    background: #ffffff !important;
    font-size: 7.5px !important;
    padding: 0 !important;
    margin: 0 !important;
            }

            .topbar, .no-print {
                display: none !important;
            }

            .print-only-header {
                display: block !important;
            }

            .report-container {
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .print-sheet {
                margin: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

@page {
    margin: 20mm;
    size: A4 landscape;
}
        }

        /* REPORT SHEET */
        .print-sheet {
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .sheet-header {
            background: var(--brand-navy);
            color: #ffffff;
            padding: 10px 14px 8px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sheet-header .sh-title {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.4px;
            color: #ffffff;
        }

        .sheet-header .sh-subtitle {
            font-size: 9px;
            color: #93c5fd;
            margin-top: 2px;
        }

        .sheet-header .sh-meta {
            font-size: 8px;
            color: #cbd5e1;
            text-align: right;
        }

        .info-strip {
            display: flex;
            gap: 8px;
            padding: 8px 12px;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
            flex-wrap: wrap;
        }

        .info-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            background: #ffffff;
            padding: 4px 10px;
            border-radius: 4px;
            border: 1px solid var(--brand-border);
            font-size: 9px;
        }

        .info-pill .pill-val {
            font-weight: 700;
            color: var(--brand-navy);
            font-size: 12px;
        }

        .info-pill .pill-label {
            color: #64748B;
            font-size: 8px;
        }

        .filter-bar {
            padding: 6px 12px;
            font-size: 8.5px;
            color: #555;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
        }

        /* TABLE */
        .data-section-heading {
            font-size: 9px;
            font-weight: 700;
            color: var(--brand-navy);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 12px 3px 12px;
            border-bottom: 1.5px solid var(--brand-blue);
            margin: 0;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 8.5px;
            margin: 0;
        }

        .data-table thead th {
            background: var(--brand-navy);
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            padding: 3px 2px;
            border: 0.4pt solid #1E3A5F;
            font-size: 7px;
            white-space: nowrap;
        }

        .data-table thead th:first-child {
            border-radius: 0;
        }

        .data-table tbody tr {
            page-break-inside: avoid;
        }

        .data-table tbody tr:nth-child(odd) td {
            background: #ffffff;
        }

        .data-table tbody tr:nth-child(even) td {
            background: #F0F7FF;
        }

        .data-table tbody td {
            padding: 2px 3px;
            border: 0.35pt solid var(--brand-border);
            vertical-align: middle;
        }

        .col-no {
            width: 22px;
            text-align: center;
            font-weight: 700;
            background: #E5E7EB !important;
            color: #374151;
            font-size: 8px;
        }

        .col-nama {
            text-align: left;
            font-weight: 700;
            font-size: 8.5px;
            max-width: 140px;
        }

        .col-nilai {
            text-align: center;
            font-family: 'SF Mono', 'Consolas', 'DejaVu Sans Mono', monospace;
            font-size: 8px;
            font-weight: 600;
        }

        .col-status {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 1.5px 5px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.2px;
            line-height: 1.3;
            white-space: nowrap;
        }

        .badge-sangat-kurang { background: #DC2626; }
        .badge-kurang        { background: #EA580C; }
        .badge-normal        { background: #16A34A; }
        .badge-risiko-lebih  { background: #2563EB; }
        .badge-lebih         { background: #9333EA; }
        .badge-na            { background: #9CA3AF; }

        .no-data {
            text-align: center;
            padding: 20px 16px;
            color: #94a3b8;
            font-style: italic;
            font-size: 10px;
        }

        /* BOTTOM SECTION */
        .bottom-section {
            display: flex;
            gap: 16px;
            padding: 10px 12px;
        }

        .h-divider {
            border-top: 1.5pt solid var(--brand-navy);
            margin: 0 12px;
        }

        .rekap-area {
            flex: 1;
            min-width: 0;
        }

        .section-title {
            font-size: 9px;
            font-weight: 700;
            color: var(--brand-navy);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            border-bottom: 1pt solid var(--brand-blue);
            padding-bottom: 2px;
        }

        .table-sm-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5px;
        }

        .table-sm-custom thead th {
            background: var(--brand-navy);
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            padding: 4px 6px;
            border: 0.5pt solid #1E3A5F;
            font-size: 8px;
        }

        .table-sm-custom tbody td {
            padding: 3px 6px;
            border: 0.4pt solid var(--brand-border);
        }

        .table-sm-custom tbody tr:nth-child(odd) td {
            background: #ffffff;
        }

        .table-sm-custom tbody tr:nth-child(even) td {
            background: #F0F7FF;
        }

        .table-sm-custom tbody tr.total-row td {
            background: #E2E8F0 !important;
            font-weight: 700;
            color: var(--brand-navy);
            border-top: 1pt solid var(--brand-navy);
        }

        .bar-outer {
            background: #E2E8F0;
            border: 0.4pt solid #94A3B8;
            height: 6px;
            width: 70px;
            display: inline-block;
            vertical-align: middle;
            border-radius: 2px;
        }

        .bar-inner {
            height: 6px;
            border-radius: 2px;
        }

        .ket-box {
            margin-top: 5px;
            font-size: 7.5px;
            color: #555;
            padding: 3px 6px;
            background: #F8FAFC;
            border-left: 2pt solid var(--brand-blue);
        }

        .ttd-box {
            width: 220px;
            text-align: center;
            flex-shrink: 0;
        }

        .sign-role {
            font-size: 8.5px;
            color: #325;
            text-align: center;
            margin-bottom: 2px;
        }

        .sign-line {
            width: 100%;
            height: 1px;
            background: var(--brand-navy);
            margin: 70px 0 3px 0;
        }

        .sign-name {
            font-size: 9px;
            font-weight: 700;
            color: var(--brand-navy);
            text-align: center;
            min-height: 14px;
        }

        .sign-nip {
            font-size: 8px;
            color: #666;
            text-align: center;
        }

        .sheet-footer {
            background: #ffffff;
            border-top: 1.5pt solid var(--brand-navy);
            padding: 4px 12px;
            font-size: 7.5px;
            color: #64748B;
            display: flex;
            justify-content: space-between;
        }

        .footer-brand {
            font-weight: 700;
            color: var(--brand-navy);
        }

        /* Action buttons */
        .btn {
            font-size: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 600;
        }
        .btn-print-web {
            background: #ffffff;
            border: 1px solid var(--brand-blue);
            color: var(--brand-blue);
        }
        .btn-print-web:hover {
            background: var(--brand-blue);
            color: #ffffff;
        }
        .btn-pdf {
            background: #ffffff;
            border: 1px solid #DC2626;
            color: #DC2626;
        }
        .btn-pdf:hover {
            background: #DC2626;
            color: #ffffff;
        }
        .btn-excel {
            background: #ffffff;
            border: 1px solid #16A34A;
            color: #16A34A;
        }
        .btn-excel:hover {
            background: #16A34A;
            color: #ffffff;
        }
    </style>
</head>
<body>

{{-- PRINT-ONLY HEADER --}}
<div class="print-only-header">
    <div style="background:#0F3D5C; color:#fff; padding:6px 10px; margin-bottom:4px;">
        <div style="font-size:11px; font-weight:700;">LAPORAN PENGUKURAN ANTROPOMETRI ANAK</div>
        <div style="font-size:7px; color:#93c5fd;">Penilaian Status Gizi Berdasarkan Permenkes No. 2 Tahun 2020</div>
    </div>
    <div style="font-size:6.5px; color:#555; padding:2px 0;">
        Dicetak: {{ now()->format('d F Y, H:i') }} WIB
    </div>
</div>

{{-- TOPBAR --}}
<div class="topbar no-print">
    <div class="topbar-inner">
        <div>
            <span class="topbar-brand">
                <i class="bi bi-clipboard2-data me-1"></i>
                Laporan Antropometri — Pratinjau
            </span>
            <span class="text-muted ms-2" style="font-size:9px;">
                {{ $data->count() }} data ditampilkan
            </span>
        </div>
        <div class="topbar-actions">
            <button onclick="window.print()" class="btn btn-print-web btn-topbar">
                <i class="bi bi-printer me-1"></i> Print
            </button>
            <a href="{{ route('laporan.pdf', request()->only(['search','status_gizi'])) }}"
               class="btn btn-pdf btn-topbar" target="_blank">
                <i class="bi bi-file-earmark-pdf me-1"></i> PDF
            </a>
            <a href="{{ route('laporan.excel', request()->only(['search','status_gizi'])) }}"
               class="btn btn-excel btn-topbar">
                <i class="bi bi-file-earmark-excel me-1"></i> Excel
            </a>
        </div>
    </div>
</div>

{{-- REPORT --}}
<div class="report-container">

    @php
        $total   = $data->count();
        $stBuruk = $data->where('status_bbu', 'Berat Badan Sangat Kurang')->count();
        $stKurang= $data->where('status_bbu', 'Berat Badan Kurang')->count();
        $stNormal= $data->where('status_bbu', 'Berat Badan Normal')->count();
        $stRisiko= $data->where('status_bbu', 'Risiko Berat Badan Lebih')->count();
        $stLebih = $data->where('status_bbu', 'Berat Badan Lebih')->count();
    @endphp

    <div class="print-sheet">
        {{-- SHEET HEADER --}}
        <div class="sheet-header">
            <div>
                <div class="sh-title">LAPORAN PENGUKURAN ANTROPOMETRI ANAK</div>
                <div class="sh-subtitle">Penilaian Status Gizi Berdasarkan Permenkes No. 2 Tahun 2020</div>
            </div>
            <div class="sh-meta">
                <div>Dicetak: {{ now()->format('d F Y') }}</div>
                <div>{{ now()->format('H:i') }} WIB</div>
            </div>
        </div>

        {{-- INFO STRIP --}}
        <div class="info-strip">
            <div class="info-pill">
                <span class="pill-val">{{ $total }}</span>
                <span class="pill-label">Total Anak</span>
            </div>
            <div class="info-pill">
                <span class="pill-val" style="color:#DC2626;">{{ $stBuruk }}</span>
                <span class="pill-label">BB Sangat Kurang</span>
            </div>
            <div class="info-pill">
                <span class="pill-val" style="color:#EA580C;">{{ $stKurang }}</span>
                <span class="pill-label">BB Kurang</span>
            </div>
            <div class="info-pill">
                <span class="pill-val" style="color:#16A34A;">{{ $stNormal }}</span>
                <span class="pill-label">BB Normal</span>
            </div>
            <div class="info-pill">
                <span class="pill-val" style="color:#2563EB;">{{ $stRisiko }}</span>
                <span class="pill-label">Risiko BB Lebih</span>
            </div>
            <div class="info-pill">
                <span class="pill-val" style="color:#9333EA;">{{ $stLebih }}</span>
                <span class="pill-label">BB Lebih</span>
            </div>
        </div>

        {{-- FILTER BAR --}}
        <div class="filter-bar">
            <div>
                @if($request->filled('search'))
                    <i class="bi bi-search me-1"></i> Pencarian: <strong>{{ $request->search }}</strong>
                @endif
                @if($request->filled('status_gizi'))
                    &nbsp;&nbsp;Filter: <strong>{{ $request->status_gizi }}</strong>
                @endif
                @if(!$request->filled('search') && !$request->filled('status_gizi'))
                    <i class="bi bi-funnel me-1"></i> Menampilkan seluruh data
                @endif
            </div>
            <div>
                <i class="bi bi-shield-check me-1"></i> Sumber: Permenkes No. 2 Tahun 2020
            </div>
        </div>

        {{-- TABLE --}}
        <div class="data-section-heading">Detail Data Pengukuran &amp; Status Gizi (BB/U, TB/U, BB/TB, IMT/U)</div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:1.6%;">No</th>
                        <th rowspan="2" style="width:10%;">Nama Anak / Orang Tua</th>
                        <th rowspan="2" style="width:6.5%;">Alamat</th>
                        <th rowspan="2" style="width:4.5%;">Tgl Ukur</th>
                        <th rowspan="2" style="width:2%;">JK</th>
                        <th rowspan="2" style="width:3%;">Umur</th>
                        <th rowspan="2" style="width:3.5%;">BB/kg</th>
                        <th rowspan="2" style="width:3.5%;">TB/cm</th>
                        <th rowspan="2" style="width:3%;">IMT</th>
                        <th colspan="2" style="width:8.5%;">BB/U</th>
                        <th colspan="2" style="width:8.5%;">TB/U</th>
                        <th colspan="2" style="width:8.5%;">BB/TB</th>
                        <th colspan="2" style="width:8.5%;">IMT/U</th>
                    </tr>
                    <tr>
                        <th style="width:4%;">Z</th>
                        <th style="width:4.5%;">Status</th>
                        <th style="width:4%;">Z</th>
                        <th style="width:4.5%;">Status</th>
                        <th style="width:4%;">Z</th>
                        <th style="width:4.5%;">Status</th>
                        <th style="width:4%;">Z</th>
                        <th style="width:4.5%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $a)
                    <tr>
                        <td class="col-no">{{ $i + 1 }}</td>
                        <td class="col-nama">
                            {{ $a->nama_anak }}
                            @if($a->nama_orang_tua)
                                <div style="font-weight:400; color:#64748B; font-size:7.5px; font-family: inherit;">
                                    {{ $a->nama_orang_tua }}
                                </div>
                            @endif
                        </td>
                        <td style="font-size:8px;">{{ $a->alamat ?? '-' }}</td>
                        <td class="col-nilai">{{ $a->tanggal_pengukuran->format('d/m/Y') }}</td>
                        <td class="col-nilai">{{ $a->jenis_kelamin == 'Laki - Laki' ? 'L' : 'P' }}</td>
                        <td class="col-nilai">{{ $a->umur_bulan }}</td>
                        <td class="col-nilai">{{ $a->berat_badan }}</td>
                        <td class="col-nilai">{{ $a->tinggi_badan }}</td>
                        <td class="col-nilai">{{ $a->imt ?? '-' }}</td>

                        <td class="col-nilai" style="font-weight:700; color:#0F3D5C;">{{ $a->zscore_bbu ?? '-' }}</td>
                        <td class="col-status">@include('laporan.partials.status-badge', ['status' => $a->status_bbu])</td>

                        <td class="col-nilai" style="font-weight:700; color:#0F3D5C;">{{ $a->zscore_tbu ?? '-' }}</td>
                        <td class="col-status">@include('laporan.partials.status-badge', ['status' => $a->status_tbu])</td>

                        <td class="col-nilai" style="font-weight:700; color:#0F3D5C;">{{ $a->zscore_bbtb ?? '-' }}</td>
                        <td class="col-status">@include('laporan.partials.status-badge', ['status' => $a->status_bbtb])</td>

                        <td class="col-nilai" style="font-weight:700; color:#0F3D5C;">{{ $a->zscore_imtu ?? '-' }}</td>
                        <td class="col-status">@include('laporan.partials.status-badge', ['status' => $a->status_imtu])</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="18" class="no-data">Tidak ada data untuk ditampilkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BOTTOM: REKAP + TTD --}}
        <div class="h-divider" style="margin-top:12px;"></div>
        <div class="bottom-section">
            <div class="rekap-area">
                <div class="section-title">Rekapitulasi Status Gizi (BB/U)</div>
                <table class="table-sm-custom">
                    <thead>
                        <tr>
                            <th style="text-align:left; width:38%;">Status Gizi</th>
                            <th style="text-align:center; width:12%;">Jumlah</th>
                            <th style="text-align:center; width:10%;">%</th>
                            <th style="text-align:left;">Proporsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $rekapBb = [
                                ['label' => 'BB Sangat Kurang',  'count' => $stBuruk, 'color' => '#DC2626'],
                                ['label' => 'BB Kurang',          'count' => $stKurang, 'color' => '#EA580C'],
                                ['label' => 'BB Normal',          'count' => $stNormal, 'color' => '#16A34A'],
                                ['label' => 'Risiko BB Lebih',    'count' => $stRisiko, 'color' => '#2563EB'],
                                ['label' => 'BB Lebih',           'count' => $stLebih, 'color' => '#9333EA'],
                            ];
                        @endphp
                        @foreach($rekapBb as $r)
                            @php $pct = $total > 0 ? round($r['count'] / $total * 100, 1) : 0; @endphp
                            <tr>
                                <td>{{ $r['label'] }}</td>
                                <td style="text-align:center; font-weight:700;">{{ $r['count'] }}</td>
                                <td style="text-align:center;">{{ $pct }}%</td>
                                <td>
                                    <div class="bar-outer">
                                        <div class="bar-inner" style="width:{{ $pct }}%; background:{{ $r['color'] }};"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td>Total</td>
                            <td style="text-align:center;">{{ $total }}</td>
                            <td style="text-align:center;">100%</td>
                            <td style="text-align:center;">100%</td>
                        </tr>
                    </tbody>
                </table>

                <div class="ket-box">
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

            <div class="ttd-box">
                <div class="sign-role">
                    <strong>Mengetahui,</strong><br>
                    Petugas Gizi / Nakes<br>
                    Penanggung Jawab
                </div>
                <div class="sign-line"></div>
                <div class="sign-name">( _____________________ )</div>
                <div class="sign-nip">NIP. _____________________</div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="sheet-footer">
            <div>
                <span class="footer-brand">Sistem Informasi Antropometri Anak</span>
                &nbsp;&#8226;&nbsp; Berdasarkan Permenkes No. 2 Tahun 2020 &nbsp;&#8226;&nbsp;
                Laporan ini berlaku untuk keperluan penilaian status gizi anak.
            </div>
            <div>
                Halaman 1 &nbsp;&#8226;&nbsp; {{ now()->format('d/m/Y H:i') }} WIB
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.no-print').forEach(function(el) {
            el.style.display = '';
        });
    });
</script>

</body>
</html>
