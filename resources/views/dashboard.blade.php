@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Monitoring Gizi Anak')

@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endsection

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card p-3 stat-card h-100" style="border-color:#1a6fa8">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:#e8f3fb">
                    <i class="bi bi-people-fill text-primary fs-5"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.75rem">Total Anak</div>
                    <div class="fs-3 fw-bold text-primary lh-1">{{ $totalAnak }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 stat-card h-100" style="border-color:#0891b2">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:#e0f7fa">
                    <i class="bi bi-gender-male fs-5" style="color:#0891b2"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.75rem">Laki-Laki</div>
                    <div class="fs-3 fw-bold lh-1" style="color:#0891b2">{{ $totalLaki }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 stat-card h-100" style="border-color:#db2777">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:#fce7f3">
                    <i class="bi bi-gender-female fs-5" style="color:#db2777"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.75rem">Perempuan</div>
                    <div class="fs-3 fw-bold lh-1" style="color:#db2777">{{ $totalPerempuan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 stat-card h-100" style="border-color:#16a34a">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:#dcfce7">
                    <i class="bi bi-calendar-check-fill fs-5 text-success"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.75rem">Bulan Ini</div>
                    <div class="fs-3 fw-bold text-success lh-1">{{ $pengukuranBulanIni }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Row Grafik 1 --}}
<div class="row g-3 mb-3">
    {{-- Grafik Tren Pengukuran --}}
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-graph-up me-1 text-primary"></i>
                    Tren Pengukuran 6 Bulan Terakhir
                </h6>
                <canvas id="chartTren" height="160"></canvas>
            </div>
        </div>
    </div>

    {{-- Grafik Distribusi Gender --}}
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-pie-chart-fill me-1 text-primary"></i>
                    Distribusi Jenis Kelamin
                </h6>
                <div style="position:relative; height:200px; width:200px; margin:0 auto">
                    <canvas id="chartGender"></canvas>
                </div>
                <div class="d-flex justify-content-center gap-4 mt-2">
                    <div class="text-center">
                        <div class="fw-bold" style="color:#0891b2">{{ $totalLaki }}</div>
                        <div class="text-muted" style="font-size:0.72rem">Laki-Laki</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold" style="color:#db2777">{{ $totalPerempuan }}</div>
                        <div class="text-muted" style="font-size:0.72rem">Perempuan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Row Grafik 2 --}}
<div class="row g-3 mb-3">
    {{-- Status BB/U --}}
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-bar-chart-fill me-1 text-primary"></i>
                    Status BB/U
                </h6>
                <canvas id="chartBBU" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- Status TB/U --}}
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-bar-chart-fill me-1 text-primary"></i>
                    Status TB/U
                </h6>
                <canvas id="chartTBU" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- Distribusi Umur --}}
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-bar-chart-fill me-1 text-primary"></i>
                    Distribusi Kelompok Umur
                </h6>
                <canvas id="chartUmur" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Row: Status Gizi BB/TB + Tabel Data Terbaru --}}
<div class="row g-3">
    {{-- Status BB/TB --}}
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-semibold text-dark mb-3">
                    <i class="bi bi-pie-chart-fill me-1 text-primary"></i>
                    Status Gizi (BB/TB)
                </h6>
                <div class="d-flex justify-content-center">
                    <canvas id="chartBBTB" height="200" style="max-width:260px"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Terbaru --}}
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold text-dark mb-0">
                        <i class="bi bi-clock-history me-1 text-primary"></i>
                        Pengukuran Terbaru
                    </h6>
                    <a href="{{ route('anak.index') }}" class="btn btn-outline-primary btn-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tgl Ukur</th>
                                <th>BB/TB</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataRecent as $anak)
                            <tr>
                                <td>
                                    <div class="fw-medium" style="font-size:0.83rem">{{ $anak->nama_anak }}</div>
                                    <div class="text-muted" style="font-size:0.72rem">{{ $anak->jenis_kelamin }}</div>
                                </td>
                                <td class="text-nowrap" style="font-size:0.8rem">
                                    {{ $anak->tanggal_pengukuran->format('d/m/Y') }}
                                </td>
                                <td style="font-size:0.8rem">
                                    {{ $anak->berat_badan }}kg / {{ $anak->tinggi_badan }}cm
                                </td>
                                <td>
                                    @php
                                        $status = $anak->status_bbu;
                                        $color = match(true) {
                                            str_contains($status ?? '', 'Sangat Kurang') => 'danger',
                                            str_contains($status ?? '', 'Kurang')        => 'warning',
                                            str_contains($status ?? '', 'Normal')        => 'success',
                                            default => 'info'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $color }}-subtle text-{{ $color }} badge-status">
                                        {{ $status ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
const colorMap = {
    'Berat Badan Sangat Kurang': '#dc2626',
    'Berat Badan Kurang':        '#f59e0b',
    'Berat Badan Normal':        '#16a34a',
    'Risiko Berat Badan Lebih':  '#0891b2',
    'Berat Badan Lebih':         '#7c3aed',
    'Sangat Pendek': '#dc2626',
    'Pendek':        '#f59e0b',
    'Normal':        '#16a34a',
    'Tinggi':        '#0891b2',
    'Gizi Buruk':    '#dc2626',
    'Gizi Kurang':   '#f59e0b',
    'Gizi Baik':     '#16a34a',
    'Berisiko Gizi Lebih': '#0891b2',
    'Gizi Lebih':    '#7c3aed',
    'Obesitas':      '#9f1239',
};

Chart.defaults.font.family = "'Segoe UI', sans-serif";
Chart.defaults.font.size = 11;

// Tren Pengukuran
const trenData = @json($trenBulan);
new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: {
        labels: trenData.map(d => d.label),
        datasets: [{
            label: 'Jumlah Pengukuran',
            data: trenData.map(d => d.count),
            borderColor: '#1a6fa8',
            backgroundColor: 'rgba(26,111,168,0.1)',
            borderWidth: 2.5,
            pointRadius: 5,
            pointBackgroundColor: '#1a6fa8',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false } }
        }
    }
});

// Gender Donut
new Chart(document.getElementById('chartGender'), {
    type: 'doughnut',
    data: {
        labels: ['Laki-Laki', 'Perempuan'],
        datasets: [{
            data: [{{ $totalLaki }}, {{ $totalPerempuan }}],
            backgroundColor: ['#0891b2', '#db2777'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});

// BB/U Bar
const bbuData = @json($statusBBU);
const bbuLabels = Object.keys(bbuData);
new Chart(document.getElementById('chartBBU'), {
    type: 'bar',
    data: {
        labels: bbuLabels.map(l => l.replace('Berat Badan ', '')),
        datasets: [{
            label: 'Anak',
            data: Object.values(bbuData),
            backgroundColor: bbuLabels.map(l => colorMap[l] ?? '#64748b'),
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false }, ticks: { font: { size: 9 } } }
        }
    }
});

// TB/U Bar
const tbuData = @json($statusTBU);
const tbuLabels = Object.keys(tbuData);
new Chart(document.getElementById('chartTBU'), {
    type: 'bar',
    data: {
        labels: tbuLabels,
        datasets: [{
            label: 'Anak',
            data: Object.values(tbuData),
            backgroundColor: tbuLabels.map(l => colorMap[l] ?? '#64748b'),
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false }, ticks: { font: { size: 9 } } }
        }
    }
});

// Distribusi Umur
const umurData = @json($distribusiUmur);
new Chart(document.getElementById('chartUmur'), {
    type: 'bar',
    data: {
        labels: Object.keys(umurData),
        datasets: [{
            label: 'Anak',
            data: Object.values(umurData),
            backgroundColor: '#1a6fa8',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false }, ticks: { font: { size: 9 } } }
        }
    }
});

// BB/TB Donut
const bbtbData = @json($statusBBTB);
const bbtbLabels = Object.keys(bbtbData);
new Chart(document.getElementById('chartBBTB'), {
    type: 'doughnut',
    data: {
        labels: bbtbLabels,
        datasets: [{
            data: Object.values(bbtbData),
            backgroundColor: bbtbLabels.map(l => colorMap[l] ?? '#64748b'),
            borderWidth: 2,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true,
        cutout: '55%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: { font: { size: 9 }, padding: 8, boxWidth: 12 }
            }
        }
    }
});
</script>
@endsection
