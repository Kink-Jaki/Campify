@extends('layouts.admin')
@section('title', 'Kelola Barang')
@section('content')

<style>
    :root {
        --forest-dark: #1b4332;
        --forest-medium: #2d6a4f;
        --forest-light: #40916c;
        --nature-accent: #d8f3dc;
        --earth-brown: #bc6c25;
        --sunset-orange: #e76f51;
        --cream: #fefae0;
        --warning-gold: #ffc107;
    }

    /* Page Header */
    .page-header-manage {
        background: linear-gradient(135deg, var(--forest-dark) 0%, var(--forest-medium) 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .page-header-manage::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05));
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-title-manage {
        color: white;
        font-weight: 800;
        font-size: 1.75rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
    }

    .title-icon {
        width: 52px;
        height: 52px;
        background: rgba(255, 193, 7, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    /* Add Button */
    .btn-tambah {
        background: linear-gradient(135deg, var(--warning-gold), #ff9800);
        border: none;
        color: var(--forest-dark);
        font-weight: 700;
        padding: 14px 28px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        text-decoration: none;
    }

    .btn-tambah:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
        color: var(--forest-dark);
    }

    .btn-tambah i {
        font-size: 1.2rem;
    }

    /* Stats Bar */
    .stats-bar-manage {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(27, 67, 50, 0.1);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon.total { background: linear-gradient(135deg, #e3f2fd, #bbdefb); color: #1976d2; }
    .stat-icon.available { background: linear-gradient(135deg, #e8f5e9, #c8e6c9); color: #388e3c; }
    .stat-icon.empty { background: linear-gradient(135deg, #ffebee, #ffcdd2); color: #d32f2f; }

    .stat-info h6 {
        font-size: 0.875rem;
        color: #718096;
        margin: 0 0 4px 0;
        font-weight: 600;
    }

    .stat-info h3 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--forest-dark);
        margin: 0;
    }

    /* Table Card */
    .table-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.08);
        overflow: hidden;
    }

    .table-card .card-body {
        padding: 0;
    }

    /* Custom Table */
    .table-custom {
        margin: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 20px 24px;
        border: none;
    }

    .table-custom thead th:first-child {
        border-radius: 0;
    }

    .table-custom thead th:last-child {
        border-radius: 0;
    }

    .table-custom tbody tr {
        transition: all 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background: var(--nature-accent);
        transform: scale(1.002);
    }

    .table-custom tbody td {
        padding: 20px 24px;
        vertical-align: middle;
        border-bottom: 1px solid #edf2f7;
        font-size: 0.95rem;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* Product Name Cell */
    .product-name {
        font-weight: 700;
        color: var(--forest-dark);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .product-avatar {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    /* Category Badge */
    .category-badge {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .category-badge i {
        font-size: 0.875rem;
    }

    /* Stock Indicator */
    .stock-indicator {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        color: var(--forest-dark);
    }

    .stock-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    .stock-dot.available { background: #48bb78; }
    .stock-dot.low { background: #ed8936; animation: pulse 1s infinite; }
    .stock-dot.empty { background: #e53e3e; animation: none; }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .stock-badge-habis {
        background: #e53e3e;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* Price Tag */
    .price-tag-table {
        font-weight: 800;
        color: var(--forest-medium);
        font-size: 1rem;
    }

    .price-unit {
        font-size: 0.875rem;
        color: #718096;
        font-weight: 500;
    }

    /* Condition Badge */
    .condition-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .condition-badge.baik {
        background: linear-gradient(135deg, #d8f3dc, #b7e4c7);
        color: #1b4332;
    }

    .condition-badge.rusak {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
    }

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
        color: #e65100;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #ffe0b2, #ffcc80);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(230, 81, 0, 0.2);
        color: #e65100;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(198, 40, 40, 0.2);
        color: #c62828;
    }

    /* Empty State */
    .empty-state-manage {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        font-size: 3rem;
        color: #a0aec0;
    }

    /* Pagination */
    .pagination-container {
        margin-top: 24px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        gap: 8px;
    }

    .page-item .page-link {
        border: none;
        border-radius: 12px;
        padding: 12px 18px;
        font-weight: 600;
        color: #4a5568;
        transition: all 0.3s ease;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        color: white;
        box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
    }

    .page-item .page-link:hover {
        background: var(--nature-accent);
        color: var(--forest-dark);
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header-manage {
            padding: 20px;
        }

        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-custom thead {
            display: none;
        }

        .table-custom tbody tr {
            display: block;
            margin-bottom: 16px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background: white;
        }

        .table-custom tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #edf2f7;
        }

        .table-custom tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            color: var(--forest-dark);
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .table-custom tbody td:last-child {
            border-bottom: none;
        }

        .action-group {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header-manage">
    <div class="header-content">
        <h4 class="page-title-manage">
            <span class="title-icon">📦</span>
            <span>Kelola Barang</span>
        </h4>
        <a href="{{ route('admin.barang.create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Barang</span>
        </a>
    </div>
</div>

<!-- Stats Bar -->
<div class="stats-bar-manage">
    <div class="stat-card">
        <div class="stat-icon total">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="stat-info">
            <h6>Total Barang</h6>
            <h3>{{ $barang->total() }}</h3>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon available">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="stat-info">
            <h6>Tersedia</h6>
            <h3>{{ $barang->filter(fn($b) => $b->stok > 0)->count() }}</h3>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon empty">
            <i class="bi bi-x-circle"></i>
        </div>
        <div class="stat-info">
            <h6>Stok Habis</h6>
            <h3>{{ $barang->filter(fn($b) => $b->stok == 0)->count() }}</h3>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card table-card">
    <div class="card-body">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga/Hari</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $b)
                <tr>
                    <td data-label="No">{{ $loop->iteration }}</td>
                    <td data-label="Nama Barang">
                        <div class="product-name">
                            <div class="product-avatar">
                                {{ substr($b->nama_barang, 0, 1) }}
                            </div>
                            <span>{{ $b->nama_barang }}</span>
                        </div>
                    </td>
                    <td data-label="Kategori">
                        <span class="category-badge">
                            <i class="bi bi-tag-fill"></i>
                            {{ $b->kategori->nama_kategori }}
                        </span>
                    </td>
                    <td data-label="Stok">
                        <div class="stock-indicator">
                            <span class="stock-dot {{ $b->stok == 0 ? 'empty' : ($b->stok <= 3 ? 'low' : 'available') }}"></span>
                            <span>{{ $b->stok }}</span>
                            @if($b->stok == 0)
                                <span class="stock-badge-habis">Habis</span>
                            @elseif($b->stok <= 3)
                                <span class="badge bg-warning text-dark ms-1">Segera habis</span>
                            @endif
                        </div>
                    </td>
                    <td data-label="Harga">
                        <span class="price-tag-table">
                            Rp {{ number_format($b->harga_sewa_per_hari, 0, ',', '.') }}
                            <span class="price-unit">/hari</span>
                        </span>
                    </td>
                    <td data-label="Kondisi">
                        <span class="condition-badge {{ $b->kondisi }}">
                            <i class="bi bi-{{ $b->kondisi == 'baik' ? 'check-circle' : 'x-circle' }}-fill"></i>
                            {{ ucfirst($b->kondisi) }}
                        </span>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-group">
                            <a href="{{ route('admin.barang.edit', $b) }}" class="btn-action btn-edit" title="Edit Barang">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('admin.barang.destroy', $b) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Barang">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state-manage">
                            <div class="empty-icon-large">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Barang</h5>
                            <p class="text-muted mb-4">Silakan tambahkan barang baru untuk mulai mengelola katalog.</p>
                            <a href="{{ route('admin.barang.create') }}" class="btn-tambah">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Tambah Barang Pertama</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<!-- Pagination -->
@if($barang->hasPages())
<div class="pagination-container">
    {{ $barang->links('pagination::bootstrap-5') }}
</div>
@endif

<!-- Tambahkan style ini di bagian <style> yang sudah ada, ganti yang lama -->

<style>
    /* Pagination - FIXED */
    .pagination-container {
        margin-top: 32px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 6px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .page-item .page-link {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 600;
        font-size: 0.9rem;
        color: #4a5568;
        background: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
    }

    .page-item .page-link:hover:not(.disabled) {
        background: var(--nature-accent);
        border-color: var(--forest-medium);
        color: var(--forest-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .page-item.disabled .page-link {
        background: #f7fafc;
        border-color: #e2e8f0;
        color: #a0aec0;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Prev/Next buttons styling */
    .page-item:first-child .page-link,
    .page-item:last-child .page-link {
        padding: 10px 20px;
        gap: 6px;
    }

    .page-item:first-child .page-link::before {
        content: '←';
        font-size: 1rem;
    }

    .page-item:last-child .page-link::after {
        content: '→';
        font-size: 1rem;
    }

    /* Responsive Pagination */
    @media (max-width: 576px) {
        .pagination-container {
            margin-top: 24px;
        }

        .pagination {
            gap: 4px;
        }

        .page-item .page-link {
            padding: 8px 12px;
            min-width: 36px;
            height: 36px;
            font-size: 0.85rem;
            border-radius: 8px;
        }

        /* Hide text on mobile for prev/next, show only arrows */
        .page-item:first-child .page-link span,
        .page-item:last-child .page-link span {
            display: none;
        }

        .page-item:first-child .page-link::before {
            content: '←';
            margin: 0;
        }

        .page-item:last-child .page-link::after {
            content: '→';
            margin: 0;
        }
    }
</style>

@endsection