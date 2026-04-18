@extends('layouts.admin')
@section('title', 'Pengembalian')
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
    }

    .page-header {
        position: relative;
        padding-bottom: 16px;
        margin-bottom: 24px;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--forest-medium), var(--forest-light));
        border-radius: 2px;
    }

    .return-card {
        border: none;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .return-card:hover {
        box-shadow: 0 8px 30px rgba(27, 67, 50, 0.12);
        transform: translateY(-2px);
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        padding: 20px 24px;
        border: none;
    }

    .rental-id {
        font-weight: 800;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rental-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(4px);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .date-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .card-body-custom {
        padding: 24px;
    }

    .item-list {
        background: #f8faf9;
        border-radius: 16px;
        padding: 20px;
    }

    .item-row {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .item-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .item-row:first-child {
        padding-top: 0;
    }

    .item-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-name {
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 2px;
    }

    .item-meta {
        font-size: 0.85rem;
        color: #718096;
    }

    .item-price {
        font-weight: 700;
        color: var(--forest-medium);
        font-size: 0.95rem;
    }

    /* Form Styling */
    .form-custom {
        background: #f8faf9;
        border-radius: 16px;
        padding: 20px;
    }

    .form-label-custom {
        font-weight: 600;
        color: var(--forest-dark);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .input-group-custom {
        position: relative;
    }

    .form-control-custom {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: var(--forest-medium);
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }

    .btn-process {
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        padding: 12px 28px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-process:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(45, 106, 79, 0.3);
        color: white;
    }

    /* Status Alert */
    .status-completed {
        background: linear-gradient(135deg, #d8f3dc, #f0fff4);
        border: 1px solid #9ae6b4;
        border-radius: 16px;
        padding: 20px;
    }

    .status-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .status-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #48bb78, #38a169);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .status-title {
        font-weight: 800;
        color: #1b4332;
        font-size: 1.1rem;
    }

    .status-subtitle {
        color: #2d6a4f;
        font-weight: 600;
    }

    .price-display {
        background: white;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .price-row:last-child {
        margin-bottom: 0;
        padding-top: 8px;
        border-top: 2px dashed #e2e8f0;
    }

    .price-label {
        color: #718096;
        font-size: 0.9rem;
    }

    .price-value {
        font-weight: 700;
        color: #1a202c;
    }

    .price-value.total {
        font-size: 1.2rem;
        color: var(--forest-dark);
    }

    .denda-badge {
        background: #fed7d7;
        color: #c53030;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-lunas {
        background: linear-gradient(135deg, #48bb78, #38a169);
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-lunas:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(72, 187, 120, 0.3);
        color: white;
    }

    .badge-lunas {
        background: linear-gradient(135deg, #48bb78, #38a169);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

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
        color: var(--forest-medium);
        font-size: 3rem;
    }
</style>

<div class="page-header">
    <h4 class="fw-bold mb-1">🔄 Proses Pengembalian</h4>
    <p class="text-muted mb-0">Kelola pengembalian gear camping dan proses pembayaran</p>
</div>

@if($rentals->count() > 0)
    @foreach($rentals as $r)
    <div class="return-card mb-4">
        <div class="card-header-custom">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="rental-id">
                    <i class="bi bi-box-seam"></i>
                    <span>Rental #{{ $r->id }}</span>
                    <span class="rental-badge">{{ $r->user->name }}</span>
                </div>
                <div class="date-info">
                    <i class="bi bi-calendar-event"></i>
                    <span>Rencana selesai: <strong>{{ \Carbon\Carbon::parse($r->tanggal_selesai)->format('d M Y') }}</strong></span>
                </div>
            </div>
        </div>
        
        <div class="card-body-custom">
            <div class="row g-4">
                <!-- Daftar Item -->
                <div class="col-md-6">
                    <div class="item-list">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-list-check text-success"></i>
                            Detail Barang
                        </h6>
                        @foreach($r->details as $d)
                        <div class="item-row">
                            <div class="item-icon">
                                <i class="bi bi-tent"></i>
                            </div>
                            <div class="item-details">
                                <div class="item-name">{{ $d->barang->nama_barang }}</div>
                                <div class="item-meta">{{ $d->jumlah }} unit × Rp {{ number_format($d->barang->harga_sewa_per_hari, 0, ',', '.') }}/hari</div>
                            </div>
                            <div class="item-price">
                                Rp {{ number_format($d->jumlah * $d->barang->harga_sewa_per_hari, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Form/Status Pengembalian -->
                <div class="col-md-6">
                    @if(!$r->pengembalian)
                    <div class="form-custom">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-arrow-counterclockise text-primary"></i>
                            Proses Pengembalian
                        </h6>
                        <form action="{{ route('admin.pengembalian.proses', $r) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label-custom">
                                    <i class="bi bi-calendar-check"></i>
                                    Tanggal Kembali Real
                                </label>
                                <div class="input-group-custom">
                                    <input type="date" name="tanggal_kembali_real" 
                                        class="form-control form-control-custom" 
                                        max="{{ date('Y-m-d') }}" 
                                        value="{{ date('Y-m-d') }}" 
                                        required>
                                </div>
                            </div>
                            <button type="submit" class="btn-process w-100">
                                <i class="bi bi-check-circle-fill"></i>
                                Proses Pengembalian
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="status-completed">
                        <div class="status-header">
                            <div class="status-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div>
                                <div class="status-title">Sudah Diproses</div>
                                <div class="status-subtitle">Pengembalian berhasil dicatat</div>
                            </div>
                        </div>
                        
                        <div class="price-display">
                            <div class="price-row">
                                <span class="price-label">Total Sewa</span>
                                <span class="price-value">Rp {{ number_format($r->pengembalian->total_bayar - $r->pengembalian->denda, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($r->pengembalian->denda > 0)
                            <div class="price-row">
                                <span class="price-label">
                                    <span class="denda-badge">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        Denda Keterlambatan
                                    </span>
                                </span>
                                <span class="price-value text-danger">+ Rp {{ number_format($r->pengembalian->denda, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            
                            <div class="price-row">
                                <span class="price-label">Total Pembayaran</span>
                                <span class="price-value total">Rp {{ number_format($r->pengembalian->total_bayar, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-3">
                            @if($r->pengembalian->status_pembayaran == 'belum_lunas')
                                <form action="{{ route('admin.pengembalian.lunas', $r->pengembalian) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-lunas w-100">
                                        <i class="bi bi-check2-all"></i>
                                        Konfirmasi Lunas
                                    </button>
                                </form>
                            @else
                                <div class="badge-lunas">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Pembayaran Lunas
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="empty-state">
        <div class="empty-icon">
            <i class="bi bi-inbox"></i>
        </div>
        <h5 class="fw-bold text-dark mb-2">Tidak Ada Pengembalian</h5>
        <p class="text-muted mb-0">Belum ada rental yang perlu diproses pengembaliannya saat ini.</p>
    </div>
@endif

@endsection