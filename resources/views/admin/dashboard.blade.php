@extends('layouts.admin')

@section('title', 'Dashboard')

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
        font-size: 2rem;
    }

    .page-subtitle {
        color: #718096;
        font-size: 1rem;
    }

    /* Stats Cards */
    .stats-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0.6), rgba(255,255,255,0.3));
    }

    .stats-card-barang {
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
    }

    .stats-card-user {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    .stats-card-pending {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .stats-card-aktif {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
    }

    .stats-card-body {
        padding: 28px 24px;
        color: white;
        text-align: center;
        position: relative;
    }

    .stats-icon {
        font-size: 2.5rem;
        margin-bottom: 12px;
        display: block;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 4px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stats-label {
        font-size: 0.95rem;
        opacity: 0.95;
        font-weight: 500;
    }

    /* Table Card */
    .table-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .table-card-header {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        padding: 20px 24px;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-card-body {
        padding: 0;
    }

    /* Table Styling */
    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead th {
        background: #f8faf9;
        color: var(--forest-dark);
        font-weight: 700;
        font-size: 0.9rem;
        padding: 16px 20px;
        border-bottom: 2px solid #e9ecef;
    }

    .table-custom tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #4a5568;
    }

    .table-custom tbody tr {
        transition: all 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background: linear-gradient(135deg, #f8faf9, #f0fff4);
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

    /* User Cell */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-icon {
        font-size: 3rem;
        color: #a0aec0;
        margin-bottom: 12px;
    }

    .empty-text {
        color: #718096;
        font-size: 0.95rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-card-body {
            padding: 20px 16px;
        }
        
        .stats-number {
            font-size: 2rem;
        }
        
        .table-card-header {
            padding: 16px 20px;
        }
        
        .table-custom thead th,
        .table-custom tbody td {
            padding: 12px 16px;
        }
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="page-title">
            <i class="bi bi-speedometer2"></i>
            Dashboard Admin
        </h2>
        <p class="page-subtitle">Pantau dan kelola aktivitas rental camping</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card stats-card stats-card-barang">
                <div class="card-body stats-card-body">
                    <span class="stats-icon">📦</span>
                    <div class="stats-number">{{ $stats['total_barang'] }}</div>
                    <div class="stats-label">Total Barang</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card stats-card stats-card-user">
                <div class="card-body stats-card-body">
                    <span class="stats-icon">👥</span>
                    <div class="stats-number">{{ $stats['total_user'] }}</div>
                    <div class="stats-label">Total User</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card stats-card stats-card-pending">
                <div class="card-body stats-card-body">
                    <span class="stats-icon">⏳</span>
                    <div class="stats-number">{{ $stats['rental_pending'] }}</div>
                    <div class="stats-label">Menunggu Approval</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card stats-card stats-card-aktif">
                <div class="card-body stats-card-body">
                    <span class="stats-icon">🏕️</span>
                    <div class="stats-number">{{ $stats['rental_aktif'] }}</div>
                    <div class="stats-label">Sedang Disewa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rental Terbaru Table -->
    <div class="card table-card">
        <div class="table-card-header">
            <i class="bi bi-clock-history"></i>
            Rental Terbaru
        </div>
        <div class="table-card-body">
            @if(count($rental_terbaru) > 0)
                <table class="table table-custom table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rental_terbaru as $r)
                        <tr>
                            <td>
                                <span class="fw-bold text-muted">#{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        {{ substr($r->user->name, 0, 1) }}
                                    </div>
                                    <span class="fw-semibold">{{ $r->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-calendar3 text-muted me-2"></i>
                                {{ $r->tanggal_mulai }}
                            </td>
                            <td>
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>
                    <p class="empty-text">Belum ada rental terbaru</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection