<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Campify - @yield('title', 'Home')</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        :root {
            --forest-dark: #1b4332;
            --forest-medium: #2d6a4f;
            --forest-light: #40916c;
            --nature-accent: #d8f3dc;
            --cream: #fefae0;
        }

        body { 
            background-color: #f8faf9;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        /* ========== NAVBAR STYLING ========== */
        .navbar-custom {
            background: rgba(27, 67, 50, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
        }
        
        .navbar-brand { 
            font-weight: 800; 
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }
        
        /* Tombol Katalog */
        .nav-btn-katalog {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white !important;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .nav-btn-katalog::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-btn-katalog:hover {
            background: rgba(255, 193, 7, 0.9);
            border-color: #ffc107;
            color: #1b4332 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
        }

        .nav-btn-katalog:hover::before {
            left: 100%;
        }

        .nav-btn-katalog i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-btn-katalog:hover i {
            transform: rotate(15deg) scale(1.1);
        }

        .nav-btn-katalog.active {
            background: #ffc107;
            border-color: #ffc107;
            color: #1b4332 !important;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }
        
        /* Tombol Riwayat */
        .nav-btn-riwayat {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .nav-btn-riwayat:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
        }
        
        /* Tombol Admin */
        .nav-btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: 50px;
            color: #1b4332 !important;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }
        
        .nav-btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            color: #1b4332 !important;
        }

        /* Tombol Profile / User Dropdown */
        .nav-btn-profile {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px 10px 14px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 50px;
            color: white !important;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .nav-btn-profile::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 50px;
            padding: 2px;
            background: linear-gradient(135deg, #ffc107, #ff9800, #ffc107);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .nav-btn-profile:hover::after {
            opacity: 1;
        }

        .nav-btn-profile:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.1));
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .nav-btn-profile .avatar-circle {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #1b4332;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .nav-btn-profile:hover .avatar-circle {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
        }

        .nav-btn-profile .dropdown-arrow {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .nav-btn-profile.show .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Dropdown Menu Styling */
        .dropdown-menu-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(27, 67, 50, 0.2);
            padding: 12px;
            margin-top: 12px;
            min-width: 220px;
        }

        .dropdown-item-custom {
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #4a5568;
            font-weight: 500;
            transition: all 0.2s ease;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item-custom:hover {
            background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
            color: var(--forest-dark);
            transform: translateX(4px);
        }

        .dropdown-item-custom i {
            font-size: 1.1rem;
            color: var(--forest-medium);
        }

        .dropdown-item-custom.text-danger {
            color: #e53e3e;
        }

        .dropdown-item-custom.text-danger:hover {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .dropdown-item-custom.text-danger i {
            color: #e53e3e;
        }

        .dropdown-divider-custom {
            margin: 8px 0;
            border-color: #e2e8f0;
        }

        /* Tombol Masuk & Daftar (untuk guest) */
        .nav-btn-masuk {
            padding: 10px 22px;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            border-radius: 50px;
            color: white !important;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            background: transparent;
        }

        .nav-btn-masuk:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.6);
            color: white !important;
            transform: translateY(-2px);
        }

        .nav-btn-daftar {
            padding: 10px 22px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border: none;
            border-radius: 50px;
            color: #1b4332 !important;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .nav-btn-daftar:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            color: #1b4332 !important;
        }

        /* Alert Styling */
        .alert-success {
            background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
            border: none;
            border-radius: 12px;
            color: var(--forest-dark);
        }
        
        .alert-danger {
            border-radius: 12px;
            border: none;
        }

        /* Footer */
        .footer-custom {
            background: linear-gradient(135deg, #1b4332, #2d6a4f);
            color: rgba(255, 255, 255, 0.8);
            padding: 40px 0;
            margin-top: 80px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(27, 67, 50, 0.98);
                border-radius: 16px;
                padding: 20px;
                margin-top: 10px;
            }
            
            .nav-btn-katalog,
            .nav-btn-riwayat,
            .nav-btn-admin,
            .nav-btn-profile,
            .nav-btn-masuk,
            .nav-btn-daftar {
                margin-bottom: 8px;
                width: 100%;
                justify-content: center;
            }
        }

        /* Existing styles */
        .badge-stok-habis { font-size: 0.7rem; }
        .card-barang:hover { transform: translateY(-3px); transition: .2s; box-shadow: 0 4px 15px rgba(0,0,0,.1); }
    </style>
</head>
<body>

<!-- NAVBAR BARU DENGAN TOMBOL MENARIK -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span></span>
            <span>Campify</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto align-items-center gap-2">
                <!-- Tombol Katalog -->
                <li class="nav-item">
                    <a class="nav-btn-katalog {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Katalog</span>
                    </a>
                </li>
                
                @auth
                    <!-- Tombol Riwayat -->
                    <li class="nav-item">
                        <a class="nav-btn-riwayat {{ request()->routeIs('riwayat') ? 'active' : '' }}" href="{{ route('riwayat') }}">
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat Sewa</span>
                        </a>
                    </li>
                    
                    @if(auth()->user()->role === 'admin')
                        <!-- Tombol Admin -->
                        <li class="nav-item">
                            <a class="nav-btn-admin" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-gear-fill"></i>
                                <span>Admin</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <ul class="navbar-nav align-items-center gap-2">
                @guest
                    <!-- Tombol Masuk & Daftar -->
                    <li class="nav-item">
                        <a class="nav-btn-masuk" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-btn-daftar" href="{{ route('register') }}">Daftar</a>
                    </li>
                @else
                    <!-- Tombol Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-btn-profile dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-circle">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <i class="bi bi-chevron-down dropdown-arrow"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom shadow-lg">
                            <li>
                                <a class="dropdown-item-custom" href="{{ route('riwayat') }}">
                                    <i class="bi bi-clock-history"></i>
                                    Riwayat Sewa
                                </a>
                            </li>
                            <li><hr class="dropdown-divider dropdown-divider-custom"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item-custom text-danger">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif
    
    @yield('content')
</div>

<footer class="footer-custom text-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    <span class="fs-4">🏕️</span>
                    <span class="fw-bold fs-4">Campify</span>
                </div>
                <p class="small mb-0 opacity-75">Partner terpercaya untuk petualangan alam bebas Anda.</p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <p class="mb-0 opacity-75">© {{ date('Y') }} Campify. All rights reserved.</p>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-3 justify-content-center">
                    <a href="#" class="text-white opacity-75 hover-opacity-100" style="transition: opacity 0.3s;">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100" style="transition: opacity 0.3s;">
                        <i class="bi bi-whatsapp fs-5"></i>
                    </a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100" style="transition: opacity 0.3s;">
                        <i class="bi bi-envelope fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>