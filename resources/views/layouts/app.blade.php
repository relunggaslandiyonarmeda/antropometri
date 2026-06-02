<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antropometri Anak - Permenkes No.2/2020</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4f8; }
        .navbar { background: linear-gradient(135deg, #1a6fa8, #0d4f7c); }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-radius: 10px; }
        .badge-status { font-size: 0.75rem; padding: 4px 8px; border-radius: 20px; }
        .table th { background-color: #1a6fa8; color: white; font-weight: 500; }
        .btn-primary { background-color: #1a6fa8; border-color: #1a6fa8; }
        .btn-primary:hover { background-color: #0d4f7c; border-color: #0d4f7c; }
        .stat-card { border-left: 4px solid; border-radius: 10px; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark py-2">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('anak.index') }}">
            <i class="bi bi-heart-pulse-fill me-2"></i>Antropometri Anak
        </a>
        <span class="text-white-50 small">Permenkes No. 2 Tahun 2020</span>
    </div>
</nav>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
