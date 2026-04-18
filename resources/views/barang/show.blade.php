@extends('layouts.app')

@section('title', $barang->nama_barang)

@section('content')
<style>
    /* Tema Campify - Warna Hijau Hutan */
    :root {
        --forest-dark: #1b4332;
        --forest-medium: #2d6a4f;
        --forest-light: #40916c;
        --nature-accent: #d8f3dc;
        --cream: #fefae0;
    }

    /* Card Detail Produk */
    .detail-card {
        border: none;
        border-radius: 24px;
        background: white;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.12);
    }

    /* Image Container */
    .image-container {
        position: relative;
        height: 100%;
        min-height: 350px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .detail-card:hover .image-container img {
        transform: scale(1.05);
    }

    /* Badge Kategori */
    .badge-kategori {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(27, 67, 50, 0.9);
        backdrop-filter: blur(10px);
        color: white;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        z-index: 2;
    }

    /* Card Body */
    .card-body-custom {
        padding: 40px;
    }

    .product-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a202c;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .product-desc {
        color: #718096;
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    /* Price Tag */
    .price-box {
        background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
        border-left: 4px solid var(--forest-medium);
    }

    .price-label {
        font-size: 0.9rem;
        color: #718096;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .price-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--forest-medium);
    }

    .price-unit {
        font-size: 1rem;
        color: #718096;
        font-weight: 500;
    }

    /* Info Table */
    .info-table {
        background: #f8faf9;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #e9ecef;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #718096;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value {
        font-weight: 600;
        color: #2d3748;
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-available {
        background: #d8f3dc;
        color: #1b4332;
    }

    .status-empty {
        background: #fed7d7;
        color: #c53030;
    }

    .status-good {
        background: #c6f6d5;
        color: #276749;
    }

    .status-damaged {
        background: #fed7d7;
        color: #c53030;
    }

    /* Button Sewa dengan Animasi */
    .btn-sewa {
        position: relative;
        width: 160px;
        height: 48px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 1px solid var(--forest-medium);
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-sewa, .btn-sewa__icon, .btn-sewa__text {
        transition: all 0.3s;
    }

    .btn-sewa .btn-sewa__text {
        transform: translateX(20px);
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .btn-sewa .btn-sewa__icon {
        position: absolute;
        right: 0;
        height: 100%;
        width: 44px;
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
        stroke-width: 2.5;
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

    /* Button Kembali */
    .btn-kembali {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #4a5568;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-kembali:hover {
        border-color: var(--forest-medium);
        color: var(--forest-medium);
        background: #f0fff4;
        transform: translateY(-2px);
    }

    /* Section Divider */
    .section-divider {
        height: 4px;
        width: 60px;
        background: linear-gradient(90deg, var(--forest-medium), var(--forest-light));
        border-radius: 2px;
        margin: 16px 0 24px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body-custom {
            padding: 24px;
        }
        
        .product-title {
            font-size: 1.5rem;
        }
        
        .image-container {
            min-height: 250px;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="detail-card">
                <div class="row g-0">
                    <!-- Image Section -->
                    <div class="col-md-5">
                        <div class="image-container">
                            @if($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}">
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                    <i class="bi bi-image-alt" style="font-size: 5rem; opacity: 0.3;"></i>
                                    <span class="mt-3">No Image Available</span>
                                </div>
                            @endif
                            <span class="badge-kategori">
                                <i class="bi bi-tag-fill me-1"></i>
                                {{ $barang->kategori->nama_kategori }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Content Section -->
                    <div class="col-md-7">
                        <div class="card-body-custom">
                            <h2 class="product-title">{{ $barang->nama_barang }}</h2>
                            <div class="section-divider"></div>
                            
                            <p class="product-desc">{{ $barang->deskripsi ?? 'Tidak ada deskripsi untuk barang ini.' }}</p>
                            
                            <!-- Price Box -->
                            <div class="price-box">
                                <div class="price-label">Harga Sewa per Hari</div>
                                <div class="price-value">
                                    Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}
                                    <span class="price-unit">/hari</span>
                                </div>
                            </div>
                            
                            <!-- Info Table -->
                            <div class="info-table">
                                <div class="info-row">
                                    <span class="info-label">
                                        <i class="bi bi-box-seam me-2"></i>Stok Tersedia
                                    </span>
                                    <span class="info-value">
                                        @if($barang->stok > 0)
                                            <span class="status-badge status-available">{{ $barang->stok }} unit</span>
                                        @else
                                            <span class="status-badge status-empty">Habis</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">
                                        <i class="bi bi-check-circle me-2"></i>Kondisi
                                    </span>
                                    <span class="info-value">
                                        <span class="status-badge {{ $barang->kondisi == 'baik' ? 'status-good' : 'status-damaged' }}">
                                            {{ ucfirst($barang->kondisi) }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 flex-wrap">
                                @auth
                                    @if($barang->stok > 0)
                                        <a href="{{ route('rental.create', $barang) }}" class="btn-sewa">
                                            <span class="btn-sewa__text">Sewa</span>
                                            <span class="btn-sewa__icon">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/>
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
                                
                                <a href="{{ route('home') }}" class="btn-kembali">
                                    <i class="bi bi-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection