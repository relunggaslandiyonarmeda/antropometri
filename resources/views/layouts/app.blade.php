<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Antropometri Anak') - Permenkes No.2/2020</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 240px;
            --primary: #1a6fa8;
            --primary-dark: #0d4f7c;
            --sidebar-bg: #0d2f4a;
        }

        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #0d2f4a 0%, #0a2240 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 20px 16px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #1a6fa8, #0d4f7c);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: white;
        }

        .sidebar-brand .brand-text {
            font-size: 0.9rem; font-weight: 700; color: #fff;
            line-height: 1.1;
        }

        .sidebar-brand .brand-sub {
            font-size: 0.65rem; color: rgba(255,255,255,0.45);
        }

        .sidebar-nav {
            padding: 12px 0;
            flex: 1;
        }

        .nav-section-label {
            font-size: 0.6rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: rgba(255,255,255,0.3);
            padding: 12px 18px 4px;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.65);
            padding: 9px 18px;
            border-radius: 0;
            font-size: 0.83rem;
            display: flex; align-items: center; gap: 10px;
            transition: all 0.2s;
            position: relative;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.07);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            background: rgba(26,111,168,0.5);
            border-left: 3px solid #4db8ff;
        }

        .sidebar-nav .nav-link .nav-icon {
            width: 18px; text-align: center; font-size: 1rem;
        }

        .sidebar-footer {
            padding: 12px 16px;
            border-top: 1px solid rgba(255,255,255,0.08);
            font-size: 0.7rem;
            color: rgba(255,255,255,0.3);
        }

        /* ── Topbar ── */
        #topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 56px;
            background: #fff;
            box-shadow: 0 1px 6px rgba(0,0,0,0.07);
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 12px;
        }

        #topbar .page-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a2b3c;
            flex: 1;
        }

        #topbar .topbar-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        #topbar .topbar-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* ── Main Content ── */
        #main-content {
            margin-left: var(--sidebar-width);
            margin-top: 56px;
            padding: 24px;
            min-height: calc(100vh - 56px);
        }

        /* ── Cards ── */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-radius: 12px;
        }

        .stat-card {
            border-left: 4px solid;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .stat-card:hover { transform: translateY(-2px); }

        /* ── Table ── */
        .table th {
            background-color: var(--primary);
            color: white;
            font-weight: 500;
            font-size: 0.83rem;
        }

        /* ── Buttons ── */
        .btn-primary { background-color: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background-color: var(--primary-dark); border-color: var(--primary-dark); }

        /* ── Badge status ── */
        .badge-status { font-size: 0.72rem; padding: 4px 9px; border-radius: 20px; }

        /* ── Responsive collapse ── */
        #sidebar-toggle { display: none; }

        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #topbar, #main-content { left: 0; margin-left: 0; }
            #sidebar-toggle { display: flex; }
        }
    </style>
    @yield('head')
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
        <div class="brand-icon"><i class="bi bi-heart-pulse-fill"></i></div>
        <div>
            <div class="brand-text">Antropometri</div>
            <div class="brand-sub">Permenkes No. 2 / 2020</div>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-section-label">Utama</div>

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-grid-fill"></i></span> Dashboard
        </a>

        <a href="{{ route('anak.index') }}"
           class="nav-link {{ request()->routeIs('anak.index') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span> Data Anak
        </a>

        <a href="{{ route('anak.create') }}"
           class="nav-link {{ request()->routeIs('anak.create') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-person-plus-fill"></i></span> Tambah Data
        </a>

        <div class="nav-section-label" style="margin-top:6px;">Laporan</div>

        <a href="{{ route('laporan.print') }}" target="_blank"
           class="nav-link">
            <span class="nav-icon"><i class="bi bi-printer-fill"></i></span> Pratinjau Cetak
        </a>

        <a href="{{ route('laporan.pdf') }}"
           class="nav-link">
            <span class="nav-icon"><i class="bi bi-file-earmark-pdf-fill"></i></span> Download PDF
        </a>

        <a href="{{ route('laporan.excel') }}"
           class="nav-link">
            <span class="nav-icon"><i class="bi bi-file-earmark-excel-fill"></i></span> Export Excel
        </a>

        <a href="{{ route('laporan.csv') }}"
           class="nav-link">
            <span class="nav-icon"><i class="bi bi-filetype-csv"></i></span> Export CSV
        </a>
    </div>

    <div class="sidebar-footer">
        <i class="bi bi-shield-check me-1"></i> Standar WHO / Kemenkes RI
    </div>
</nav>

<!-- Topbar -->
<div id="topbar">
    <button id="sidebar-toggle" class="topbar-btn border-0" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="bi bi-list"></i>
    </button>
    <span class="page-title">@yield('page-title', 'Dashboard')</span>

    <a href="{{ route('anak.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> Tambah Data
    </a>
</div>

<!-- Main Content -->
<div id="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
