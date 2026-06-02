@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">Data Pengukuran Antropometri</h4>
        <p class="text-muted mb-0 small">Penilaian Status Gizi Anak</p>
    </div>
    <a href="{{ route('anak.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Data
    </a>
</div>

{{-- Statistik Ringkas --}}
<div class="row g-3 mb-4">
    @php
        $total      = $data->total();
        $giziBuruk  = \App\Models\Anak::where('status_bbu', 'Berat Badan Sangat Kurang')->count();
        $giziKurang = \App\Models\Anak::where('status_bbu', 'Berat Badan Kurang')->count();
        $giziBaik   = \App\Models\Anak::where('status_bbu', 'Berat Badan Normal')->count();
    @endphp
    <div class="col-md-3">
        <div class="card p-3 stat-card" style="border-color:#1a6fa8">
            <div class="text-muted small">Total Anak</div>
            <div class="fs-4 fw-bold text-primary">{{ $total }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 stat-card" style="border-color:#dc3545">
            <div class="text-muted small">BB Sangat Kurang</div>
            <div class="fs-4 fw-bold text-danger">{{ $giziBuruk }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 stat-card" style="border-color:#ffc107">
            <div class="text-muted small">BB Kurang</div>
            <div class="fs-4 fw-bold text-warning">{{ $giziKurang }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 stat-card" style="border-color:#198754">
            <div class="text-muted small">BB Normal</div>
            <div class="fs-4 fw-bold text-success">{{ $giziBaik }}</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Cari nama anak, NIK, atau alamat..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status_gizi" class="form-select form-select-sm">
                    <option value="">Semua Status BB/U</option>
                    @foreach(['Berat Badan Sangat Kurang','Berat Badan Kurang','Berat Badan Normal','Risiko Berat Badan Lebih','Berat Badan Lebih'] as $s)
                        <option value="{{ $s }}" {{ request('status_gizi') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary btn-sm me-1" type="submit">
                    <i class="bi bi-search"></i> Filter
                </button>
                <a href="{{ route('anak.index') }}" class="btn btn-outline-secondary btn-sm me-2">Reset</a>
                {{-- Tombol Export --}}
                @php $q = http_build_query(request()->only(['search','status_gizi'])) @endphp
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-download me-1"></i>Export
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('laporan.pdf') }}?{{ $q }}" target="_blank">
                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>PDF
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('laporan.excel') }}?{{ $q }}">
                                <i class="bi bi-file-earmark-excel text-success me-2"></i>Excel (.xlsx)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('laporan.csv') }}?{{ $q }}">
                                <i class="bi bi-filetype-csv text-secondary me-2"></i>CSV
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Tabel --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0 small">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Anak</th>
                        <th>Alamat</th>
                        <th>Tgl Ukur</th>
                        <th>Umur</th>
                        <th>JK</th>
                        <th>BB (kg)</th>
                        <th>TB (cm)</th>
                        <th>IMT</th>
                        <th>Status BB/U</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $anak)
                    <tr>
                        <td>{{ $data->firstItem() + $i }}</td>
                        <td>
                            <div class="fw-semibold">{{ $anak->nama_anak }}</div>
                            @if($anak->nama_orang_tua)
                                <div class="text-muted" style="font-size:0.75rem">{{ $anak->nama_orang_tua }}</div>
                            @endif
                        </td>
                        <td>{{ $anak->alamat ?? '-' }}</td>
                        <td>{{ $anak->tanggal_pengukuran->format('d/m/Y') }}</td>
                        <td>{{ $anak->umur_bulan }} bln</td>
                        <td>{{ $anak->jenis_kelamin == 'Laki - Laki' ? 'L' : 'P' }}</td>
                        <td>{{ $anak->berat_badan }}</td>
                        <td>{{ $anak->tinggi_badan }}</td>
                        <td>{{ $anak->imt ?? '-' }}</td>
                        <td>
                            @php
                                $color = match($anak->status_bbu) {
                                    'Berat Badan Sangat Kurang' => 'danger',
                                    'Berat Badan Kurang'        => 'warning',
                                    'Berat Badan Normal'        => 'success',
                                    'Risiko Berat Badan Lebih'  => 'info',
                                    default                     => 'secondary',
                                };
                            @endphp
                            @if($anak->status_bbu)
                                <span class="badge bg-{{ $color }} badge-status">{{ $anak->status_bbu }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('anak.show', $anak) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('anak.edit', $anak) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('anak.destroy', $anak) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($data->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan {{ $data->firstItem() }}-{{ $data->lastItem() }} dari {{ $data->total() }} data</small>
        {{ $data->links() }}
    </div>
    @endif
</div>
@endsection
