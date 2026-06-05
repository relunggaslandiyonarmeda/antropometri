<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Antropometri Anak</title>
    <style>
        :root {
            --navy:   #1a365d;
            --blue:   #2563eb;
            --border: #d1d5db;
            --stripe: #f0f6ff;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 11px;
            color: #111827;
            background: #f3f4f6;
        }

        /* Toolbar */
        .toolbar {
            position: sticky; top: 0; z-index: 50;
            background: #fff; border-bottom: 2px solid var(--navy);
            padding: 8px 16px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .toolbar-brand { font-weight: 700; font-size: 12px; color: var(--navy); }
        .toolbar-brand small { font-weight: 400; color: #6b7280; font-size: 10px; margin-left: 8px; }
        .toolbar-actions { display: flex; gap: 6px; }
        .btn {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 5px 12px; border-radius: 4px; font-size: 11px;
            font-weight: 600; cursor: pointer; text-decoration: none;
            border: 1.5px solid transparent; transition: .15s;
        }
        .btn-outline-navy  { border-color: var(--navy); color: var(--navy); background: #fff; }
        .btn-outline-navy:hover  { background: var(--navy); color: #fff; }
        .btn-outline-red   { border-color: #dc2626; color: #dc2626; background: #fff; }
        .btn-outline-red:hover   { background: #dc2626; color: #fff; }
        .btn-outline-green { border-color: #16a34a; color: #16a34a; background: #fff; }
        .btn-outline-green:hover { background: #16a34a; color: #fff; }

        /* Page */
        .page { max-width: 780px; margin: 16px auto; padding: 0 12px 32px; }
        .card { background: #fff; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,.08); overflow: hidden; }

        /* Report header */
        .report-header {
            background: var(--navy); color: #fff; padding: 12px 16px;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        .rh-title { font-size: 13px; font-weight: 700; letter-spacing: .3px; }
        .rh-sub   { font-size: 9px; color: #93c5fd; margin-top: 3px; }
        .rh-meta  { font-size: 9px; color: #cbd5e1; text-align: right; white-space: nowrap; }

        /* Stats */
        .stats { display: flex; border-bottom: 1px solid var(--border); }
        .stat-cell { flex: 1; padding: 8px 6px; text-align: center; border-right: 1px solid var(--border); }
        .stat-cell:last-child { border-right: none; }
        .stat-val { font-size: 16px; font-weight: 700; line-height: 1; }
        .stat-lbl { font-size: 8px; color: #6b7280; margin-top: 2px; }

        /* Filter */
        .filter-bar {
            padding: 5px 14px; font-size: 9px; color: #6b7280;
            border-bottom: 1px solid var(--border);
            display: flex; justify-content: space-between;
        }

        /* Section head */
        .section-head {
            font-size: 9px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .5px; color: var(--navy);
            padding: 7px 14px 5px; border-bottom: 1.5px solid var(--blue);
        }

        /* Table */
        .data-tbl { width: 100%; border-collapse: collapse; font-size: 8px; }
        .data-tbl thead th {
            background: var(--navy); color: #fff; padding: 4px 4px;
            font-size: 7.5px; font-weight: 700; text-align: center; border: .4pt solid #243e6b;
        }
        .data-tbl thead th.th-left { text-align: left; }
        .data-tbl tbody tr.row-a  td { background: #fff; }
        .data-tbl tbody tr.row-b  td { background: #f8fafc; }
        .data-tbl tbody tr.row-a2 td { background: var(--stripe); }
        .data-tbl tbody tr.row-b2 td { background: #e8f0fb; }
        .data-tbl tbody td { padding: 3px 5px; border: .35pt solid var(--border); vertical-align: middle; }
        .td-no    { text-align: center; font-weight: 700; color: #374151; background: #e9ecef !important; width: 26px; vertical-align: top !important; }
        .td-info  { vertical-align: top !important; }
        .td-nama  { font-weight: 700; font-size: 8.5px; }
        .td-sub   { font-weight: 400; font-size: 7.5px; color: #6b7280; }
        .td-detail{ font-size: 7.5px; color: #374151; margin-top: 2px; }
        .td-c     { text-align: center; }
        .td-mono  { text-align: center; font-family: 'Consolas', monospace; font-size: 8px; font-weight: 600; }
        .td-label { font-size: 7px; font-weight: 700; color: #fff; background: var(--blue) !important; text-align: center; padding: 2px 4px; }

        /* Badges */
        .badge-status, .badge-s {
            display: inline-block; padding: 2px 6px; border-radius: 3px;
            font-size: 7.5px; font-weight: 700; color: #fff; white-space: nowrap;
        }
        .bg-danger    { background: #dc2626; }
        .bg-warning   { background: #d97706; }
        .bg-success   { background: #16a34a; }
        .bg-primary   { background: #2563eb; }
        .bg-purple    { background: #7c3aed; }
        .bg-info      { background: #0891b2; }
        .bg-dark      { background: #374151; }
        .bg-secondary { background: #9ca3af; }

        /* ── Bottom (screen) ── */
        .bottom {
            display: flex; gap: 16px;
            padding: 14px 14px 16px; align-items: flex-end;
        }
        .rekap     { flex: 1; min-width: 0; }
        .sign-area { width: 200px; flex-shrink: 0; }

        .sub-head {
            font-size: 8.5px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .4px; color: var(--navy);
            border-bottom: 1pt solid var(--blue); padding-bottom: 3px; margin-bottom: 8px;
        }
        .rekap-cards { display: flex; gap: 5px; margin-bottom: 7px; flex-wrap: wrap; }
        .rekap-card {
            flex: 1; min-width: 60px; border: 1px solid var(--border);
            border-radius: 5px; padding: 6px 4px; text-align: center;
        }
        .rc-val { font-size: 18px; font-weight: 700; line-height: 1; }
        .rc-pct { font-size: 7.5px; color: #6b7280; margin-top: 1px; }
        .rc-lbl { font-size: 7px; color: #374151; margin-top: 3px; font-weight: 600; }
        .legend {
            font-size: 7.5px; color: #555; padding: 4px 8px;
            background: #f8fafc; border-left: 2.5pt solid var(--blue);
        }

        /* TTD */
        .sign-box { border: 1px solid var(--border); border-radius: 5px; overflow: hidden; }
        .sign-header { background: var(--navy); color: #fff; font-size: 8px; font-weight: 700; text-align: center; padding: 5px 8px; }
        .sign-body   { padding: 10px 14px 12px; text-align: center; }
        .sign-place  { font-size: 8.5px; color: #374151; margin-bottom: 2px; }
        .sign-role   { font-size: 8px; color: #6b7280; line-height: 1.5; }
        .sign-space  { height: 52px; }
        .sign-line   { border-top: 1px solid var(--navy); margin: 0 8px 4px; }
        .sign-name   { font-size: 9px; font-weight: 700; color: var(--navy); }
        .sign-nip    { font-size: 8px; color: #6b7280; margin-top: 1px; }

        /* Divider & footer */
        .divider { border-top: 1.5pt solid var(--navy); margin: 0 14px; }
        .report-footer {
            border-top: 1.5pt solid var(--navy); padding: 5px 14px;
            display: flex; justify-content: space-between;
            font-size: 7.5px; color: #6b7280;
        }
        .footer-brand { font-weight: 700; color: var(--navy); }

        /* ══════════════════
           PRINT
        ══════════════════ */
        @media print {
            body { background: #fff; font-size: 7.5px; }
            .toolbar { display: none !important; }
            .page { max-width: none; margin: 0; padding: 0; }
            .card { border-radius: 0; box-shadow: none; }
            .stat-val { font-size: 13px; }
            .data-tbl { font-size: 7.5px; }
            .data-tbl thead th { font-size: 7px; }
            .badge-status, .badge-s { font-size: 7px; padding: 1.5px 4px; }
            .sign-area { width: 170px; }

            /* Bottom section fixed di bawah halaman */
            .bottom-anchor {
                position: fixed;
                bottom: 0; left: 0; right: 0;
                background: #fff;
                padding: 0 12mm;
            }
            /* Beri ruang agar konten tidak tertimpa bottom-anchor */
            .bottom-spacer { height: 200px; }

            @page { size: A4 portrait; margin: 12mm 12mm 0 12mm; }
        }
    </style>
</head>
<body>

{{-- Toolbar --}}
<div class="toolbar">
    <div>
        <span class="toolbar-brand">
            Laporan Antropometri
            <small>{{ $data->count() }} data</small>
        </span>
    </div>
    <div class="toolbar-actions">
        <button onclick="window.print()" class="btn btn-outline-navy">&#128438; Print</button>
        <a href="{{ route('laporan.pdf', request()->only(['search','status_gizi'])) }}"
           target="_blank" class="btn btn-outline-red">&#128196; PDF</a>
        <a href="{{ route('laporan.excel', request()->only(['search','status_gizi'])) }}"
           class="btn btn-outline-green">&#128202; Excel</a>
    </div>
</div>

<div class="page">
<div class="card">

    {{-- Header --}}
    <div class="report-header">
        <div>
            <div class="rh-title">LAPORAN PENGUKURAN ANTROPOMETRI ANAK</div>
            <div class="rh-sub">Penilaian Status Gizi &mdash; Permenkes No. 2 Tahun 2020</div>
        </div>
        <div class="rh-meta">
            Dicetak: {{ now()->isoFormat('D MMMM Y') }}<br>{{ now()->format('H:i') }} WIB
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
    <div class="stats">
        <div class="stat-cell">
            <div class="stat-val" style="color:var(--navy);">{{ $total }}</div>
            <div class="stat-lbl">Total Anak</div>
        </div>
        <div class="stat-cell">
            <div class="stat-val" style="color:#dc2626;">{{ $stBuruk }}</div>
            <div class="stat-lbl">BB Sgt Kurang</div>
        </div>
        <div class="stat-cell">
            <div class="stat-val" style="color:#d97706;">{{ $stKurang }}</div>
            <div class="stat-lbl">BB Kurang</div>
        </div>
        <div class="stat-cell">
            <div class="stat-val" style="color:#16a34a;">{{ $stNormal }}</div>
            <div class="stat-lbl">BB Normal</div>
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
    <div class="filter-bar">
        <span>
            @if($request->filled('search'))
                Pencarian: <strong>{{ $request->search }}</strong>
            @endif
            @if($request->filled('status_gizi'))
                &nbsp; Filter: <strong>{{ $request->status_gizi }}</strong>
            @endif
            @if(!$request->filled('search') && !$request->filled('status_gizi'))
                Menampilkan seluruh data
            @endif
        </span>
        <span>Permenkes No. 2 Tahun 2020</span>
    </div>

    {{-- Table --}}
    <div class="section-head">Data Pengukuran &amp; Status Gizi</div>
    <table class="data-tbl">
        <thead>
            <tr>
                <th rowspan="2" style="width:26px;">No</th>
                <th rowspan="2" class="th-left" style="width:22%;">Nama Anak</th>
                <th rowspan="2" style="width:6%;">JK</th>
                <th rowspan="2" style="width:7%;">Umur</th>
                <th rowspan="2" style="width:7%;">BB (kg)</th>
                <th rowspan="2" style="width:7%;">TB (cm)</th>
                <th rowspan="2" style="width:6%;">IMT</th>
                <th colspan="2" style="width:18%;">BB/U</th>
                <th colspan="2" style="width:18%;">TB/U</th>
            </tr>
            <tr>
                <th style="width:6%;">Z-Score</th>
                <th style="width:12%;">Status</th>
                <th style="width:6%;">Z-Score</th>
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
                    <div class="td-detail">Umur: {{ $a->tanggal_pengukuran->format('d/m/Y') }}</div>
                </td>
                <td class="td-c"    rowspan="2">{{ $a->jenis_kelamin === 'Laki - Laki' ? 'L' : 'P' }}</td>
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
                <td class="td-label" colspan="2" style="background:#0891b2 !important;">IMT/U</td>
                <td class="td-mono">{{ $a->zscore_imtu ?? '-' }}</td>
                <td class="td-c">@include('laporan.partials.status-badge', ['status' => $a->status_imtu])</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" style="text-align:center; padding:24px; color:#9ca3af; font-style:italic;">
                    Tidak ada data untuk ditampilkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Spacer: hanya aktif saat print agar konten tidak tertimpa bottom-anchor --}}
    <div class="bottom-spacer"></div>

</div>{{-- /card --}}
</div>{{-- /page --}}

{{-- ══════════════════════════════════════════
     BOTTOM ANCHOR — rekap kiri, TTD kanan
     Di screen: normal flow. Di print: fixed bottom.
══════════════════════════════════════════ --}}
<div class="bottom-anchor">
    <div class="bottom">

        {{-- Rekap --}}
        <div class="rekap">
            <div class="sub-head">Rekapitulasi Status Gizi BB/U</div>
            @php
                $rekapRows = [
                    ['BB Sangat Kurang', $stBuruk,  '#dc2626'],
                    ['BB Kurang',        $stKurang, '#d97706'],
                    ['BB Normal',        $stNormal, '#16a34a'],
                    ['Risiko BB Lebih',  $stRisiko, '#2563eb'],
                    ['BB Lebih',         $stLebih,  '#7c3aed'],
                ];
            @endphp
            <div class="rekap-cards">
                @foreach($rekapRows as [$rl, $rc, $rcolor])
                    @php $rpct = $total > 0 ? round($rc / $total * 100, 1) : 0; @endphp
                    <div class="rekap-card" style="border-top: 3px solid {{ $rcolor }};">
                        <div class="rc-val" style="color:{{ $rcolor }};">{{ $rc }}</div>
                        <div class="rc-pct">{{ $rpct }}%</div>
                        <div class="rc-lbl">{{ $rl }}</div>
                    </div>
                @endforeach
                <div class="rekap-card" style="border-top: 3px solid var(--navy); background:#f8fafc;">
                    <div class="rc-val" style="color:var(--navy);">{{ $total }}</div>
                    <div class="rc-pct">100%</div>
                    <div class="rc-lbl" style="color:var(--navy);">Total</div>
                </div>
            </div>
            <div class="legend">
                <strong>Keterangan Z-Score:</strong>
                &ensp;Z &lt; &minus;3 = Sangat Kurang
                &ensp;&bull;&ensp; &minus;3 &le; Z &lt; &minus;2 = Kurang
                &ensp;&bull;&ensp; &minus;2 &le; Z &le; 2 = Normal
                &ensp;&bull;&ensp; Z &gt; 2 = Lebih / Obesitas
            </div>
        </div>

        {{-- TTD --}}
        <div class="sign-area">
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

    </div>{{-- /bottom --}}

    {{-- Footer --}}
    <div class="report-footer">
        <span>
            <span class="footer-brand">Sistem Informasi Antropometri Anak</span>
            &bull; Permenkes No. 2 Tahun 2020
        </span>
        <span>{{ now()->format('d/m/Y H:i') }} WIB</span>
    </div>
</div>{{-- /bottom-anchor --}}

</body>
</html>
