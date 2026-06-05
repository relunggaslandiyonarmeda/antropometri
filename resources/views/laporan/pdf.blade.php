<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Antropometri Anak</title>
    <style>
        @page { size: A4 portrait; margin: 20mm 20mm 60mm 20mm; }

        /* Beri ruang bawah agar konten tabel tidak tertimpa bottom-anchor */
        body { padding-bottom: 58mm; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 7.5px;
            color: #111827;
            background: #fff;
            line-height: 1.35;
        }

        .doc-header {
            background: #1a365d; color: #fff;
            padding: 6px 10px; margin-bottom: 4px;
            display: table; width: 100%;
        }
        .dh-left  { display: table-cell; width: 68%; vertical-align: middle; }
        .dh-right { display: table-cell; width: 32%; text-align: right; vertical-align: middle; }
        .dh-title { font-size: 9px; font-weight: bold; letter-spacing: .3px; }
        .dh-sub   { font-size: 6px; color: #93c5fd; margin-top: 2px; }
        .dh-meta  { font-size: 5.5px; color: #cbd5e1; }

        .stats-row {
            display: table; width: 100%; margin-bottom: 3px;
            border: .5pt solid #bfdbfe;
        }
        .stat-cell {
            display: table-cell; text-align: center;
            padding: 3px 2px; border-right: .5pt solid #bfdbfe;
            background: #eff6ff; vertical-align: middle;
        }
        .stat-cell:last-child { border-right: none; }
        .stat-val { font-size: 9px; font-weight: bold; color: #1a365d; }
        .stat-lbl { font-size: 4.5px; color: #555; text-transform: uppercase; margin-top: 1px; }

        .filter-row {
            display: table; width: 100%; margin-bottom: 3px;
            font-size: 5.5px; color: #555;
        }
        .filter-left  { display: table-cell; text-align: left; vertical-align: middle; }
        .filter-right { display: table-cell; text-align: right; vertical-align: middle; }

        .sec-head {
            font-size: 6px; font-weight: bold;
            text-transform: uppercase; letter-spacing: .4px; color: #1a365d;
            border-bottom: .8pt solid #2563eb;
            padding-bottom: 1.5px; margin-bottom: 2px; margin-top: 3px;
        }

        .data-tbl {
            width: 100%; border-collapse: collapse;
            font-size: 6px; margin-bottom: 4px;
        }
        .data-tbl thead th {
            background: #1a365d; color: #fff;
            text-align: center; padding: 2.5px 2px;
            border: .35pt solid #243e6b; font-size: 6px; font-weight: bold;
        }
        .data-tbl thead th.th-left { text-align: left; }
        .data-tbl tbody tr { page-break-inside: avoid; }
        .data-tbl tbody tr.row-a  td { background: #fff; }
        .data-tbl tbody tr.row-b  td { background: #f8fafc; }
        .data-tbl tbody tr.row-a2 td { background: #eff6ff; }
        .data-tbl tbody tr.row-b2 td { background: #e6f0fb; }
        .data-tbl tbody td {
            padding: 2px 3px; border: .3pt solid #d1d5db; vertical-align: middle;
        }
        .td-no {
            width: 16px; text-align: center; font-weight: bold;
            background: #e9ecef !important; color: #374151;
            vertical-align: top !important;
        }
        .td-info   { vertical-align: top !important; }
        .td-nama   { font-weight: bold; font-size: 6.5px; }
        .td-sub    { font-weight: normal; font-size: 5.5px; color: #6b7280; }
        .td-detail { font-size: 5.5px; color: #555; margin-top: 1.5px; }
        .td-c      { text-align: center; }
        .td-mono   { text-align: center; font-family: 'DejaVu Sans Mono', monospace; font-size: 6px; font-weight: bold; }
        .td-label  {
            font-size: 5.5px; font-weight: bold; color: #fff;
            background: #2563eb !important;
            text-align: center; padding: 1.5px 3px;
        }
        .td-label-teal { background: #0891b2 !important; }

        .badge-status, .badge-s {
            display: inline-block; padding: 1px 3px; border-radius: 2px;
            font-size: 5.5px; font-weight: bold; color: #fff; white-space: nowrap;
        }
        .bg-danger    { background: #dc2626; }
        .bg-warning   { background: #d97706; }
        .bg-success   { background: #16a34a; }
        .bg-primary   { background: #2563eb; }
        .bg-purple    { background: #7c3aed; }
        .bg-info      { background: #0891b2; }
        .bg-dark      { background: #374151; }
        .bg-secondary { background: #9ca3af; }

        .divider { border-top: .8pt solid #1a365d; margin: 4px 0 3px; }

        /* Bottom section: fixed di bawah halaman (DomPDF support position:fixed) */
        .bottom-anchor {
            position: fixed;
            bottom: 0; left: 0; right: 0;
        }
        .bottom-grid { display: table; width: 100%; padding-top: 3px; }
        .rekap-cell  { display: table-cell; width: 60%; vertical-align: bottom; padding-right: 8px; }
        .ttd-cell    { display: table-cell; width: 40%; vertical-align: bottom; }

        .rekap-cards { display: table; width: 100%; margin-bottom: 3px; }
        .rekap-card  {
            display: table-cell; text-align: center;
            padding: 3px 2px; border: .5pt solid #d1d5db;
            border-top-width: 2pt; vertical-align: middle;
        }
        .rc-val  { font-size: 9px; font-weight: bold; line-height: 1; }
        .rc-pct  { font-size: 4px; color: #6b7280; margin-top: .5px; }
        .rc-lbl  { font-size: 4.5px; font-weight: bold; color: #374151; margin-top: 1.5px; }

        .legend {
            margin-top: 2px; font-size: 4.8px; color: #555;
            padding: 2px 5px; background: #f8fafc;
            border-left: 1.5pt solid #2563eb;
        }

        .sign-box    { border: .5pt solid #d1d5db; border-radius: 2px; overflow: hidden; }
        .sign-header { background: #1a365d; color: #fff; font-size: 5.5px; font-weight: bold; text-align: center; padding: 3px 5px; }
        .sign-body   { padding: 5px 8px 6px; text-align: center; }
        .sign-place  { font-size: 5.5px; color: #374151; margin-bottom: 1.5px; }
        .sign-role   { font-size: 5px; color: #6b7280; line-height: 1.5; }
        .sign-space  { height: 16mm; }
        .sign-line   { border-top: .6pt solid #1a365d; margin: 0 6px 2px; }
        .sign-name   { font-size: 5.5px; font-weight: bold; color: #1a365d; }
        .sign-nip    { font-size: 5px; color: #6b7280; margin-top: 1px; }

        .doc-footer {
            display: table; width: 100%;
            border-top: .8pt solid #1a365d;
            margin-top: 4px; padding-top: 2px;
            font-size: 5.5px; color: #6b7280;
        }
        .footer-l { display: table-cell; vertical-align: middle; }
        .footer-r { display: table-cell; text-align: right; vertical-align: middle; }
        .footer-brand { font-weight: bold; color: #1a365d; }
    </style>
</head>
<body>

{{-- Header --}}
<div class="doc-header">
    <div class="dh-left">
        <div class="dh-title">LAPORAN PENGUKURAN ANTROPOMETRI ANAK</div>
        <div class="dh-sub">Penilaian Status Gizi &mdash; Permenkes No. 2 Tahun 2020</div>
    </div>
    <div class="dh-right">
        <div class="dh-meta">Dicetak: {{ now()->isoFormat('D MMMM Y') }}</div>
        <div class="dh-meta">{{ now()->format('H:i') }} WIB</div>
    </div>
</div>

{{-- Stats --}}
@php
    $total    = $data->count();
    $stBuruk  = $data->where('status_bbu', 'Berat Badan Sangat Kurang')->count();
    $stKurang = $data->where('status_bbu', 'Berat Badan Kurang')->count();
    $stNormal = $data->where('status_bbu', 'Berat Badan Normal')->count();
    $stRisiko = $data->where('status_bbu', 'Risiko Berat Badan Lebih')->count();
    $stLebih  = $data->where('status_bbu', 'Berat Badan Lebih')->count();
@endphp

<div class="stats-row">
    <div class="stat-cell">
        <div class="stat-val">{{ $total }}</div>
        <div class="stat-lbl">Total</div>
    </div>
    <div class="stat-cell">
        <div class="stat-val" style="color:#dc2626;">{{ $stBuruk }}</div>
        <div class="stat-lbl">Sgt Kurang</div>
    </div>
    <div class="stat-cell">
        <div class="stat-val" style="color:#d97706;">{{ $stKurang }}</div>
        <div class="stat-lbl">Kurang</div>
    </div>
    <div class="stat-cell">
        <div class="stat-val" style="color:#16a34a;">{{ $stNormal }}</div>
        <div class="stat-lbl">Normal</div>
    </div>
    <div class="stat-cell">
        <div class="stat-val" style="color:#2563eb;">{{ $stRisiko }}</div>
        <div class="stat-lbl">Risiko Lebih</div>
    </div>
    <div class="stat-cell">
        <div class="stat-val" style="color:#7c3aed;">{{ $stLebih }}</div>
        <div class="stat-lbl">BB Lebih</div>
    </div>
</div>

{{-- Filter --}}
<div class="filter-row">
    <div class="filter-left">
        @if($request->filled('search'))
            <strong>Pencarian:</strong> {{ $request->search }} &nbsp;
        @endif
        @if($request->filled('status_gizi'))
            <strong>Filter:</strong> {{ $request->status_gizi }}
        @endif
        @if(!$request->filled('search') && !$request->filled('status_gizi'))
            Semua Data
        @endif
    </div>
    <div class="filter-right">Sumber: Permenkes No. 2 Tahun 2020</div>
</div>

{{-- Tabel --}}
<div class="sec-head">Data Pengukuran &amp; Status Gizi</div>
<table class="data-tbl">
    <thead>
        <tr>
            <th rowspan="2" style="width:16px;">No</th>
            <th rowspan="2" class="th-left" style="width:23%;">Nama Anak</th>
            <th rowspan="2" style="width:5%;">JK</th>
            <th rowspan="2" style="width:7%;">Umur</th>
            <th rowspan="2" style="width:7%;">BB (kg)</th>
            <th rowspan="2" style="width:7%;">TB (cm)</th>
            <th rowspan="2" style="width:7%;">IMT</th>
            <th colspan="2" style="width:19%;">BB/U</th>
            <th colspan="2" style="width:19%;">TB/U</th>
        </tr>
        <tr>
            <th style="width:7%;">Z</th>
            <th style="width:12%;">Status</th>
            <th style="width:7%;">Z</th>
            <th style="width:12%;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $a)
            @php
                $even = $i % 2 === 0;
                $ra   = $even ? 'row-a' : 'row-a2';
                $rb   = $even ? 'row-b' : 'row-b2';
            @endphp
            <tr class="{{ $ra }}">
                <td class="td-no" rowspan="2">{{ $i + 1 }}</td>
                <td class="td-info" rowspan="2">
                    <div class="td-nama">{{ $a->nama_anak }}</div>
                    @if($a->nama_orang_tua)
                        <div class="td-sub">{{ $a->nama_orang_tua }}</div>
                    @endif
                    @if($a->alamat)
                        <div class="td-sub">{{ $a->alamat }}</div>
                    @endif
                    <div class="td-detail">Ukur: {{ $a->tanggal_pengukuran->format('d/m/Y') }}</div>
                </td>
                <td class="td-c" rowspan="2">{{ $a->jenis_kelamin === 'Laki - Laki' ? 'L' : 'P' }}</td>
                <td class="td-mono" rowspan="2">{{ $a->umur_bulan }} bln</td>
                <td class="td-mono" rowspan="2">{{ $a->berat_badan }}</td>
                <td class="td-mono" rowspan="2">{{ $a->tinggi_badan }}</td>
                <td class="td-mono" rowspan="2">{{ $a->imt ?? '-' }}</td>
                <td class="td-mono">{{ $a->zscore_bbu ?? '-' }}</td>
                <td class="td-c">@include('laporan.partials.status-badge', ['status' => $a->status_bbu])</td>
                <td class="td-mono">{{ $a->zscore_tbu ?? '-' }}</td>
                <td class="td-c">@include('laporan.partials.status-badge', ['status' => $a->status_tbu])</td>
            </tr>
            <tr class="{{ $rb }}">
                <td class="td-label" colspan="2">BB/TB</td>
                <td class="td-mono">{{ $a->zscore_bbtb ?? '-' }}</td>
                <td class="td-c">@include('laporan.partials.status-badge', ['status' => $a->status_bbtb])</td>
                <td class="td-label td-label-teal" colspan="2">IMT/U</td>
                <td class="td-mono">{{ $a->zscore_imtu ?? '-' }}</td>
                <td class="td-c">@include('laporan.partials.status-badge', ['status' => $a->status_imtu])</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" style="text-align:center; padding:10px; color:#9ca3af; font-style:italic;">
                    Tidak ada data untuk ditampilkan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Bottom --}}
<div class="divider"></div>
<div class="bottom-anchor">
<div class="bottom-grid">

    <div class="rekap-cell">
        <div class="sec-head" style="margin-top:0;">Rekapitulasi Status Gizi BB/U</div>
        @php
            $rekapRows = [
                ['BB Sangat Kurang', $stBuruk,  '#dc2626'],
                ['BB Kurang',        $stKurang, '#d97706'],
                ['BB Normal',        $stNormal, '#16a34a'],
                ['Risiko BB Lebih',  $stRisiko, '#2563eb'],
                ['BB Lebih',         $stLebih,  '#7c3aed'],
                ['Total',            $total,    '#1a365d'],
            ];
        @endphp
        <div class="rekap-cards">
            @foreach($rekapRows as $r)
                @php
                    $rl = $r[0]; $rc = $r[1]; $rcolor = $r[2];
                    $rpct = ($total > 0 && $rl !== 'Total') ? round($rc / $total * 100, 1) : ($rl === 'Total' ? 100 : 0);
                    $rbg  = $rl === 'Total' ? 'background:#f0f6ff;' : '';
                @endphp
                <div class="rekap-card" style="border-top-color:{{ $rcolor }}; {{ $rbg }}">
                    <div class="rc-val" style="color:{{ $rcolor }};">{{ $rc }}</div>
                    <div class="rc-pct">{{ $rpct }}%</div>
                    <div class="rc-lbl">{{ $rl }}</div>
                </div>
            @endforeach
        </div>
        <div class="legend">
            <strong>Keterangan Z-Score:</strong>
            &ensp;Z &lt; -3 = Sangat Kurang
            &ensp;|&ensp; -3 &le; Z &lt; -2 = Kurang
            &ensp;|&ensp; -2 &le; Z &le; 2 = Normal
            &ensp;|&ensp; Z &gt; 2 = Lebih / Obesitas
        </div>
    </div>

    <div class="ttd-cell">
        <div class="sign-box">
            <div class="sign-header">MENGETAHUI</div>
            <div class="sign-body">
                <div class="sign-place">______________, {{ now()->isoFormat('D MMMM Y') }}</div>
                <div class="sign-role">Petugas Gizi / Nakes<br>Penanggung Jawab</div>
                <div class="sign-space"></div>
                <div class="sign-line"></div>
                <div class="sign-name">( _________________________ )</div>
                <div class="sign-nip">NIP. _________________________</div>
            </div>
        </div>
    </div>

</div>{{-- /bottom-grid --}}

{{-- Footer --}}
<div class="doc-footer">
    <div class="footer-l">
        <span class="footer-brand">Sistem Informasi Antropometri Anak</span>
        &bull; Berdasarkan Permenkes No. 2 Tahun 2020
    </div>
    <div class="footer-r">{{ now()->format('d/m/Y H:i') }} WIB</div>
</div>
</div>{{-- /bottom-anchor --}}

</body>
</html>
