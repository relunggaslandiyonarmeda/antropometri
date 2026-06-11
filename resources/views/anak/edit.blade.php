@extends('layouts.app')

@section('title', 'Edit Data')
@section('page-title', 'Edit Data: {{ $anak->nama_anak ?? "" }}')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('anak.index') }}" class="btn btn-outline-secondary btn-sm me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="mb-0 fw-bold">Edit Data: {{ $anak->nama_anak }}</h4>
        <p class="text-muted mb-0 small">Perbarui informasi pengukuran</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('anak.update', $anak) }}" method="POST">
            @csrf @method('PUT')
            @include('anak._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Perbarui Data
                </button>
                <a href="{{ route('anak.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
