@extends('layouts.app')

@section('title', 'Riwayat Sewa')

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

    /* Page Header */
    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--forest-dark);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .page-title i {
        color: var(--forest-medium);
    }

    .page-subtitle {
        color: #718096;
        font-size: 1rem;
    }

    /* Rental Card */
    .rental-card {
        border: none;
        border-radius: 20px;
        background: white;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(27, 67, 50, 0.08);
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .rental-card:hover {
        box-shadow: 0 8px 30px rgba(27, 67, 50, 0.15);
        transform: translateY(-2px);
    }

    /* Card Header */
    .rental-header {
        background: linear-gradient(135deg, #f8faf9, #f0fff4);
        padding: 20px 24px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .rental-id {
        font-weight: 700;
        color: var(--forest-dark);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rental-id i {
        color: var(--forest-medium);
        font-size: 0.9rem;
    }

    .rental-date {
        color: #718096;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .rental-date i {
        color: var(--forest-medium);
    }

    /* Status Badge */
    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-disewa {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-selesai {
        background: #d8f3dc;
        color: #1b4332;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Card Body */
    .rental-body {
        padding: 24px;
    }

    /* Item List */
    .item-list {
        margin-bottom: 20px;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .item-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--forest-medium);
        font-size: 1.1rem;
    }

    .item-name {
        font-weight: 600;
        color: #2d3748;
    }

    .item-qty {
        color: #718096;
        font-size: 0.9rem;
    }

    .item-price {
        font-weight: 700;
        color: var(--forest-medium);
        font-size: 0.95rem;
    }

    /* Pengembalian Section */
    .pengembalian-section {
        background: linear-gradient(135deg, #f8faf9, #f0fff4);
        border-radius: 16px;
        padding: 20px 24px;
        margin-top: 20px;
        border-left: 4px solid var(--forest-medium);
    }

    .pengembalian-title {
        font-weight: 700;
        color: var(--forest-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .pengembalian-title i {
        color: var(--forest-medium);
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-label {
        font-size: 0.8rem;
        color: #718096;
        font-weight: 500;
    }

    .info-value {
        font-weight: 600;
        color: #2d3748;
    }

    /* Total Section */
    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e9ecef;
    }

    .denda-text {
        color: #e53e3e;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .total-amount {
        text-align: right;
    }

    .total-label {
        font-size: 0.85rem;
        color: #718096;
        margin-bottom: 4px;
    }

    .total-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest-medium);
    }

    /* Payment Status */
    .payment-status {
        margin-top: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .payment-lunas {
        background: #d8f3dc;
        color: #1b4332;
    }

    .payment-belum {
        background: #fef3c7;
        color: #92400e;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
    }

    .empty-icon i {
        font-size: 3rem;
        color: #a0aec0;
    }

    .empty-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 1.25rem;
    }

    .empty-text {
        color: #718096;
        margin-bottom: 24px;
    }

    .btn-sewa-now {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-sewa-now:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(45, 106, 79, 0.3);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .rental-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .total-section {
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }

        .total-amount {
            text-align: center;
        }
    }
</style>

<div class="container py-5">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="page-title">
            <i class="bi bi-clock-history"></i>
            Riwayat Sewa Saya
        </h2>
        <p class="page-subtitle">Kelola dan pantau semua transaksi rental Anda</p>
    </div>

    @forelse($rentals as $r)
        <div class="rental-card">
            <!-- Card Header -->
            <div class="rental-header">
                <div>
                    <div class="rental-id">
                        <i class="bi bi-ticket-perforated"></i>
                        Order #{{ $r->id }}
                    </div>
                    <div class="rental-date mt-1">
                        <i class="bi bi-calendar3"></i>
                        {{ $r->tanggal_mulai }} s/d {{ $r->tanggal_selesai }}
                    </div>
                </div>
                <span class="status-badge status-{{ $r->status }}">
                    @if($r->status == 'pending')
                        <i class="bi bi-hourglass-split"></i>
                    @elseif($r->status == 'disewa')
                        <i class="bi bi-box-seam"></i>
                    @elseif($r->status == 'selesai')
                        <i class="bi bi-check-circle"></i>
                    @else
                        <i class="bi bi-x-circle"></i>
                    @endif
                    {{ ucfirst($r->status) }}
                </span>
            </div>

            <!-- Card Body -->
            <div class="rental-body">
                <!-- Item List -->
                <div class="item-list">
                    @foreach($r->details as $d)
                        <div class="item-row">
                            <div class="item-info">
                                <div class="item-icon">
                                    <i class="bi bi-tent"></i>
                                </div>
                                <div>
                                    <div class="item-name">{{ $d->barang->nama_barang }}</div>
                                    <div class="item-qty">{{ $d->jumlah }} unit</div>
                                </div>
                            </div>
                            <div class="item-price">
                                Rp {{ number_format($d->barang->harga_sewa_per_hari, 0, ',', '.') }}/hari
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($r->pengembalian)
                    <!-- Pengembalian Section -->
                    <div class="pengembalian-section">
                        <div class="pengembalian-title">
                            <i class="bi bi-arrow-return-left"></i>
                            Detail Pengembalian
                        </div>
                        
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Tanggal Kembali</span>
                                <span class="info-value">{{ $r->pengembalian->tanggal_kembali_real }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Total Hari</span>
                                <span class="info-value">{{ $r->pengembalian->total_hari }} hari</span>
                            </div>
                        </div>

                        <div class="total-section">
                            <div>
                                @if($r->pengembalian->denda > 0)
                                    <div class="denda-text">
                                        <i class="bi bi-exclamation-triangle"></i>
                                        Denda: Rp {{ number_format($r->pengembalian->denda, 0, ',', '.') }}
                                    </div>
                                @endif
                                <span class="payment-status {{ $r->pengembalian->status_pembayaran == 'lunas' ? 'payment-lunas' : 'payment-belum' }}">
                                    @if($r->pengembalian->status_pembayaran == 'lunas')
                                        <i class="bi bi-check-circle-fill"></i> Lunas
                                    @else
                                        <i class="bi bi-hourglass-split"></i> Belum Lunas
                                    @endif
                                </span>
                            </div>
                            <div class="total-amount">
                                <div class="total-label">Total Pembayaran</div>
                                <div class="total-value">
                                    Rp {{ number_format($r->pengembalian->total_bayar, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h4 class="empty-title">Belum Ada Riwayat Sewa</h4>
            <p class="empty-text">Anda belum melakukan transaksi rental. Yuk mulai petualangan Anda!</p>
            <a href="{{ route('home') }}" class="btn-sewa-now">
                <i class="bi bi-compass"></i>
                Mulai Sewa Sekarang
            </a>
        </div>
    @endforelse
</div>
@endsection