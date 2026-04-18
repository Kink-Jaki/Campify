<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: #198754; }
        .sidebar .nav-link { color: rgba(255,255,255,.8); }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.15); border-radius: 8px; }
        .sidebar .nav-link i { width: 20px; }
        body { background: #f0f2f5; }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3" style="width:240px; min-width:240px;">
        <div class="text-white fw-bold fs-5 mb-4 text-center">⚙️ Admin Panel</div>
        <ul class="nav flex-column gap-1">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}"><i class="bi bi-box-seam"></i> Barang</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}"><i class="bi bi-tags"></i> Kategori</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.rental.*') ? 'active' : '' }}" href="{{ route('admin.rental.index') }}"><i class="bi bi-clipboard-check"></i> Rental</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}" href="{{ route('admin.pengembalian.index') }}"><i class="bi bi-arrow-return-left"></i> Pengembalian</a></li>
            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="nav-link text-warning border-0 bg-transparent w-100 text-start"><i class="bi bi-box-arrow-left"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>