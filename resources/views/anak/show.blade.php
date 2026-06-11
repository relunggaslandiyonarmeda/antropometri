@extends('layouts.app')

@section('title', 'Detail Anak')
@section('page-title', 'Detail: {{ $anak->nama_anak ?? "" }}')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('anak.index') }}" class="btn btn-outline-secondary btn-sm me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="mb-0 fw-bold">Detail: {{ $anak->nama_anak }}</h4>
        <p class="text-muted mb-0 small">Hasil pengukuran & status gizi</p>
    </div>
    <div class="ms-auto">
        <a href="{{ route('anak.edit', $anak) }}" class="btn btn-outline-warning btn-sm">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Info Dasar --}}
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="bi bi-person-fill me-1"></i> Identitas Anak
            </div>
            <div class="card-body">
                @php
                    $rows = [
                        'Nama Anak'         => $anak->nama_anak,
                        'NIK'               => $anak->nik_anak ?? '-',
                        'Orang Tua'         => $anak->nama_orang_tua ?? '-',
                        'Tanggal Lahir'     => $anak->tanggal_lahir->format('d F Y'),
                        'Jenis Kelamin'     => $anak->jenis_kelamin,
                        'Alamat/Posyandu'   => $anak->alamat ?? '-',
                        'Tgl Pengukuran'    => $anak->tanggal_pengukuran->format('d F Y'),
                        'Umur'              => $anak->umur_tahun_bulan . ' (' . $anak->umur_bulan . ' bulan)',
                    ];
                @endphp
                @foreach($rows as $label => $val)
                    <div class="d-flex py-2 border-bottom">
                        <span class="text-muted small" style="width:140px;flex-shrink:0">{{ $label }}</span>
                        <span class="fw-medium small">{{ $val }}</span>
                    </div>
                @endforeach
                @if($anak->keterangan)
                    <div class="mt-3">
                        <div class="text-muted small">Keterangan</div>
                        <div class="small">{{ $anak->keterangan }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Hasil Pengukuran --}}
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="bi bi-activity me-1"></i> Hasil Pengukuran & Z-Score
            </div>
            <div class="card-body">
                <div class="row g-2 mb-3">
                    <div class="col-4 text-center p-3 bg-light rounded">
                        <div class="text-muted small">Berat Badan</div>
                        <div class="fs-4 fw-bold text-primary">{{ $anak->berat_badan }}</div>
                        <div class="text-muted small">kg</div>
                    </div>
                    <div class="col-4 text-center p-3 bg-light rounded">
                        <div class="text-muted small">Tinggi/Panjang</div>
                        <div class="fs-4 fw-bold text-primary">{{ $anak->tinggi_badan }}</div>
                        <div class="text-muted small">cm</div>
                    </div>
                    <div class="col-4 text-center p-3 bg-light rounded">
                        <div class="text-muted small">IMT</div>
                        <div class="fs-4 fw-bold text-primary">{{ $anak->imt ?? '-' }}</div>
                        <div class="text-muted small">kg/m²</div>
                    </div>
                </div>

                @php
                    $indikator = [
                        ['label'=>'BB / Umur (BB/U)',          'zscore'=>$anak->zscore_bbu,  'status'=>$anak->status_bbu],
                        ['label'=>'Tinggi / Umur (TB/U)',      'zscore'=>$anak->zscore_tbu,  'status'=>$anak->status_tbu],
                        ['label'=>'BB / Tinggi (BB/TB)',       'zscore'=>$anak->zscore_bbtb, 'status'=>$anak->status_bbtb],
                        ['label'=>'IMT / Umur (IMT/U)',        'zscore'=>$anak->zscore_imtu, 'status'=>$anak->status_imtu],
                    ];
                @endphp

                <table class="table table-sm table-bordered small">
                    <thead>
                        <tr>
                            <th>Indikator</th>
                            <th>Z-Score</th>
                            <th>Status Gizi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($indikator as $item)
                        <tr>
                            <td>{{ $item['label'] }}</td>
                            <td class="text-center fw-semibold">{{ $item['zscore'] ?? '-' }}</td>
                            <td>
                                @if($item['status'])
                                    @php
                                        $c = str_contains($item['status'], 'Buruk') || str_contains($item['status'], 'Sangat') ? 'danger'
                                           : (str_contains($item['status'], 'Kurang') || str_contains($item['status'], 'Pendek') ? 'warning'
                                           : (str_contains($item['status'], 'Normal') || str_contains($item['status'], 'Baik') ? 'success' : 'info'));
                                    @endphp
                                    <span class="badge bg-{{ $c }}">{{ $item['status'] }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
