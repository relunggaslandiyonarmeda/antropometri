@php
    $s = (string)($status ?? '');
    $cls = match($s) {
        'Berat Badan Sangat Kurang'  => 'bg-danger',
        'Berat Badan Kurang'         => 'bg-warning',
        'Berat Badan Normal'         => 'bg-success',
        'Risiko Berat Badan Lebih'   => 'bg-primary',
        'Berat Badan Lebih'          => 'bg-purple',
        'Sangat Pendek'              => 'bg-danger',
        'Pendek'                     => 'bg-warning',
        'Normal'                     => 'bg-success',
        'Tinggi'                     => 'bg-info',
        'Gizi Buruk'                 => 'bg-danger',
        'Gizi Kurang'                => 'bg-warning',
        'Gizi Baik'                  => 'bg-success',
        'Berisiko Gizi Lebih'        => 'bg-primary',
        'Gizi Lebih'                 => 'bg-purple',
        'Obesitas'                   => 'bg-dark',
        default                      => 'bg-secondary',
    };
    $short = match($s) {
        'Berat Badan Sangat Kurang'  => 'Sgt Kurang',
        'Berat Badan Kurang'         => 'Kurang',
        'Berat Badan Normal'         => 'Normal',
        'Risiko Berat Badan Lebih'   => 'Risiko Lebih',
        'Berat Badan Lebih'          => 'Lebih',
        'Sangat Pendek'              => 'Sgt Pendek',
        'Pendek'                     => 'Pendek',
        'Normal'                     => 'Normal',
        'Tinggi'                     => 'Tinggi',
        'Gizi Buruk'                 => 'Gizi Buruk',
        'Gizi Kurang'                => 'Gizi Kurang',
        'Gizi Baik'                  => 'Gizi Baik',
        'Berisiko Gizi Lebih'        => 'Brs. Lebih',
        'Gizi Lebih'                 => 'Gizi Lebih',
        'Obesitas'                   => 'Obesitas',
        default                      => $s,
    };
@endphp
@if($s)
    {{-- class badge-status dipakai print.blade; badge-s dipakai pdf.blade (dompdf) --}}
    <span class="badge-status badge-s {{ $cls }}" title="{{ $s }}">{{ $short }}</span>
@else
    <span style="color:#aaa;">-</span>
@endif
