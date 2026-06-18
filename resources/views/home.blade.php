<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campify - Katalog Gear Camping</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --forest-dark: #1b4332;
            --forest-medium: #2d6a4f;
            --forest-light: #40916c;
            --nature-accent: #d8f3dc;
            --earth-brown: #bc6c25;
            --sunset-orange: #e76f51;
            --cream: #fefae0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8faf9;
            color: #2d3748;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--forest-medium);
            border-radius: 4px;
        }

        /* Navbar dengan efek glassmorphism */
        .navbar-custom {
            background: rgba(27, 67, 50, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* ========== TOMBOL KATALOG & PROFILE - BARU & MENARIK ========== */
        
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
            color: white;
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
            color: #1b4332;
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
            color: #1b4332;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }

        /* ========== TOMBOL KERANJANG - BARU ========== */
        .nav-btn-keranjang {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .nav-btn-keranjang::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-btn-keranjang:hover {
            background: rgba(255, 193, 7, 0.9);
            border-color: #ffc107;
            color: #1b4332;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
        }

        .nav-btn-keranjang:hover::before {
            left: 100%;
        }

        .nav-btn-keranjang i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-btn-keranjang:hover i {
            transform: rotate(-10deg) scale(1.1);
        }

        .nav-btn-keranjang.active {
            background: #ffc107;
            border-color: #ffc107;
            color: #1b4332;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }

        /* Badge jumlah item keranjang */
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, #e76f51, #e63946);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            border: 2px solid var(--forest-dark);
            box-shadow: 0 2px 8px rgba(231, 111, 81, 0.4);
            animation: bounceIn 0.5s ease;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
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
            color: white;
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
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            background: transparent;
        }

        .nav-btn-masuk:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.6);
            color: white;
            transform: translateY(-2px);
        }

        .nav-btn-daftar {
            padding: 10px 22px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border: none;
            border-radius: 50px;
            color: #1b4332;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .nav-btn-daftar:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            color: #1b4332;
        }

        /* Hero Section dengan gradient alam */
        .hero-section {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 50%, #40916c 100%);
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 193, 7, 0.1) 0%, transparent 50%);
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Floating animation untuk icon */
        .float-icon {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Kategori Container - FIXED: tambah padding untuk ruang hover */
        .category-container {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding: 20px 10px;
            margin: -10px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .category-container::-webkit-scrollbar {
            display: none;
        }

        /* Kategori Pills - FIXED: hover tidak tembus */
        .category-pill {
            background: white;
            border: 2px solid #e9ecef;
            color: #495057;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            position: relative;
            flex-shrink: 0;
            /* FIXED: tambah margin untuk ruang shadow */
            margin: 4px;
        }

        .category-pill:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(45, 106, 79, 0.2);
            border-color: var(--forest-medium);
            color: var(--forest-medium);
            background: white;
            z-index: 100;
        }

        .category-pill.active {
            background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.4);
        }

        .category-pill.active:hover {
            background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
            color: white;
            border-color: transparent;
            box-shadow: 0 8px 25px rgba(45, 106, 79, 0.5);
            transform: translateY(-4px) scale(1.02);
        }

        .category-icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Card Produk Premium */
        .product-card {
            border: none;
            border-radius: 20px;
            background: white;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(27, 67, 50, 0.15);
        }

        .product-image-wrapper {
            height: 260px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        /* Badge styling */
        .badge-category {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(27, 67, 50, 0.9);
            backdrop-filter: blur(4px);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            z-index: 2;
        }

        .badge-stock {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .badge-available {
            background: #d8f3dc;
            color: #1b4332;
        }

        .badge-empty {
            background: #ff6b6b;
            color: white;
        }

        /* Overlay gradient pada gambar */
        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.4), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .image-overlay {
            opacity: 1;
        }

        /* Card Body */
        .card-body-custom {
            padding: 24px;
        }

        .product-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #1a202c;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .price-tag {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--forest-medium);
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .price-unit {
            font-size: 0.9rem;
            font-weight: 500;
            color: #718096;
        }

        .stock-info {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #f7fafc;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #4a5568;
            margin: 12px 0;
        }

        .stock-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #48bb78;
            animation: pulse 2s infinite;
        }

        .stock-indicator.low {
            background: #ed8936;
        }

        .stock-indicator.empty {
            background: #e53e3e;
            animation: none;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Action Buttons */
        .btn-group-custom {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .btn-detail {
            flex: 1;
            padding: 12px;
            border: 2px solid #e2e8f0;
            background: white;
            color: #4a5568;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn-detail:hover {
            border-color: var(--forest-medium);
            color: var(--forest-medium);
            background: #f0fff4;
        }

        /* Button Sewa dengan animasi baru */
        .btn-sewa {
            position: relative;
            flex: 1.5;
            height: 44px;
            cursor: pointer;
            display: flex;
            align-items: center;
            border: 1px solid var(--forest-medium);
            background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
        }

        .btn-sewa, .btn-sewa__icon, .btn-sewa__text {
            transition: all 0.3s;
        }

        .btn-sewa .btn-sewa__text {
            transform: translateX(20px);
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .btn-sewa .btn-sewa__icon {
            position: absolute;
            right: 0;
            height: 100%;
            width: 40px;
            background-color: var(--forest-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-sewa .btn-sewa__icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
        }

        .btn-sewa:hover {
            background: var(--forest-medium);
        }

        .btn-sewa:hover .btn-sewa__text {
            color: transparent;
        }

        .btn-sewa:hover .btn-sewa__icon {
            width: 100%;
            transform: translateX(0);
            right: 0;
        }

        .btn-sewa:active .btn-sewa__icon {
            background-color: var(--forest-dark);
        }

        .btn-sewa:active {
            border: 1px solid var(--forest-dark);
        }

        .btn-sewa:disabled {
            background: #cbd5e0;
            border-color: #cbd5e0;
            cursor: not-allowed;
        }

        .btn-sewa:disabled .btn-sewa__icon {
            background-color: #a0aec0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        /* Footer */
        .footer-custom {
            background: linear-gradient(135deg, #1b4332, #2d6a4f);
            color: white;
            padding: 40px 0;
            margin-top: 80px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            color: #ffc107;
        }

        /* Section Divider */
        .section-divider {
            height: 4px;
            width: 60px;
            background: linear-gradient(90deg, var(--forest-medium), var(--forest-light));
            border-radius: 2px;
            margin: 16px 0 24px 0;
        }

        /* Quick Stats Bar */
        .stats-bar {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--forest-medium);
            display: block;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 300px;
            }

            .product-image-wrapper {
                height: 200px;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- NAVBAR - DENGAN TOMBOL KERANJANG BARU -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fs-4" href="{{ route('home') }}">
            <img src="{{ asset('/storage/barang/log.png') }}" height="36" class="d-inline-block">
            <span>Campify</span>
        </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    
                    <!-- Tombol Katalog -->
                    <li class="nav-item">
                        <a class="nav-btn-katalog {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-grid-fill"></i>
                            <span>Katalog</span>
                        </a>
                    </li>

                    <!-- Tombol Keranjang - BARU -->
                    <li class="nav-item">
                        <a class="nav-btn-keranjang" href="/keranjang">
                            <i class="bi bi-cart-fill"></i>
                            <span>Keranjang</span>
                            @if(isset($cartCount) && $cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    @auth
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <!-- Tombol untuk Guest -->
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-btn-masuk">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-btn-daftar">Daftar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section text-white d-flex align-items-center">
        <div class="hero-pattern"></div>
        <div class="container hero-content py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="hero-badge badge rounded-pill px-4 py-2 mb-4 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-stars"></i>
                        <span>Perlengkapan Outdoor Berkualitas Terpercaya 2026</span>
                    </span>
                    <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">
                        Ciptakan Jejak Baru Dengan, 
                        Perlengkapan<span class="text-success"> Terbaik.</span><br>
                    </h1>
                    <p class="lead mb-4 opacity-90" style="max-width: 500px;">
                        "Perlengkapan yang berkualitas, membuat peetualangan anda lebih lebih ringan, melangkah lebih jauh,ciptakan momen indah di setiap Perjalanan."
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#katalog" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold text-dark shadow-lg">
                            <i class="bi bi-compass me-2"></i>Jelajahi Katalog
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <i class="bi bi-tent-fill float-icon" style="font-size: 12rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container my-5 flex-grow-1" id="katalog">

        <!-- Quick Stats -->
        <div class="stats-bar">
            <div class="stat-item">
                <span class="stat-number">150+</span>
                <span class="stat-label">Gear Tersedia</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Brand Terpercaya</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">4.9</span>
                <span class="stat-label">Rating Pelanggan</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Support</span>
            </div>
        </div>

        <!-- Kategori Filter -->
        <div class="mb-5">
            <h3 class="fw-bold text-dark mb-2">Kategori Gear</h3>
            <div class="section-divider"></div>

            <!-- FIXED: Container dengan padding untuk ruang hover -->
            <div class="category-container">
                <a href="{{ route('home') }}" class="category-pill {{ !request('kategori') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Semua Gear</span>
                </a>

                @foreach ($kategori as $k)
                    <a href="?kategori={{ $k->id }}"
                        class="category-pill {{ request('kategori') == $k->id ? 'active' : '' }}">
                        <i class="bi bi-{{ $k->icon ?? 'tag' }}"></i>
                        <span>{{ $k->nama_kategori }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @forelse($barang as $b)
                <div class="col">
                    <div class="product-card h-100 {{ $b->stok == 0 ? 'opacity-75' : '' }}">

                        <!-- Image Area -->
                        <div class="product-image-wrapper">
                            @if ($b->foto)
                                <img src="{{ asset('storage/' . $b->foto) }}" alt="{{ $b->nama_barang }}"
                                    class="product-image" loading="lazy">
                            @else
                                <div
                                    class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                    <i class="bi bi-image-alt display-1 opacity-25"></i>
                                    <span class="mt-2 small">No Image Available</span>
                                </div>
                            @endif

                            <div class="image-overlay"></div>

                            <!-- Category Badge -->
                            <span class="badge-category">
                                <i class="bi bi-tag-fill me-1"></i>
                                {{ $b->kategori->nama_kategori }}
                            </span>

                            <!-- Stock Badge -->
                            @if ($b->stok == 0)
                                <span class="badge-stock badge-empty">
                                    <i class="bi bi-x-circle-fill me-1"></i>Stok Habis
                                </span>
                            @elseif ($b->stok <= 3)
                                <span class="badge-stock badge-available">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>Sisa {{ $b->stok }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="card-body-custom d-flex flex-column">
                            <h5 class="product-title text-truncate" title="{{ $b->nama_barang }}">
                                {{ $b->nama_barang }}
                            </h5>

                            <div class="price-tag">
                                <span>Rp {{ number_format($b->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                <span class="price-unit">/ hari</span>
                            </div>

                            <div class="stock-info">
                                <span
                                    class="stock-indicator {{ $b->stok == 0 ? 'empty' : ($b->stok <= 3 ? 'low' : '') }}"></span>
                                <span>
                                    @if ($b->stok == 0)
                                        Stok habis
                                    @elseif ($b->stok <= 3)
                                        Segera habis
                                    @else
                                        Stok tersedia: <strong>{{ $b->stok }}</strong> unit
                                    @endif
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="btn-group-custom mt-auto">
                                <a href="{{ route('barang.show', $b) }}" class="btn-detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                @auth
                                    @if ($b->stok > 0)
                                        <a href="{{ route('rental.create', $b) }}" class="btn-sewa">
                                            <span class="btn-sewa__text">Sewa</span>
                                            <span class="btn-sewa__icon">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </a>
                                    @else
                                        <button class="btn-sewa" disabled>
                                            <span class="btn-sewa__text">Kosong</span>
                                            <span class="btn-sewa__icon">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-sewa">
                                        <span class="btn-sewa__text">Login</span>
                                        <span class="btn-sewa__icon">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M13.8 12H3" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-inbox text-secondary display-1"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Belum Ada Barang</h4>
                        <p class="text-muted mb-4 max-w-md mx-auto">
                            Katalog sedang dalam pembaruan. Silakan kembali lagi nanti atau hubungi kami untuk info
                            lebih lanjut.
                        </p>
                        @if (request('kategori'))
                            <a href="{{ route('home') }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Lihat Semua Kategori
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination (jika ada) -->
        @if (isset($barang) && method_exists($barang, 'links'))
            <div class="d-flex justify-content-center mt-5">
                {{ $barang->links() }}
            </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-tent-fill text-warning fs-3"></i>
                        <span class="fw-bold fs-4">Campify</span>
                    </div>
                    <p class="text-white-50 small mb-0">Partner terpercaya untuk setiap petualangan alam bebas Anda.
                    </p>
                </div>

                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <p class="mb-0 text-white-50">&copy; {{ date('Y') }} Campify. All rights reserved.</p>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="d-flex gap-3 justify-content-md-end justify-content-center">
                        <a href="#" class="social-icon" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" title="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="#" class="social-icon" title="Email">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
            } else {
                navbar.style.padding = '1rem 0';
            }
        });
    </script>
</body>

</html>