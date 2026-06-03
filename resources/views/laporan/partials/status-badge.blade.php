<?php $statusVal = (string) ($status ?? ''); ?>
@php
    $badgeClass = 'badge-na';
    if ($statusVal === 'Berat Badan Sangat Kurang') {
        $badgeClass = 'badge-sangat-kurang';
    } elseif ($statusVal === 'Berat Badan Kurang') {
        $badgeClass = 'badge-kurang';
    } elseif ($statusVal === 'Berat Badan Normal') {
        $badgeClass = 'badge-normal';
    } elseif ($statusVal === 'Risiko Berat Badan Lebih') {
        $badgeClass = 'badge-risiko-lebih';
    } elseif ($statusVal === 'Berat Badan Lebih') {
        $badgeClass = 'badge-lebih';
    }
@endphp
@if($statusVal)
    <span class="badge {{ $badgeClass }}">{{ $statusVal }}</span>
@else
    <span style="color:#aaa;">-</span>
@endif
