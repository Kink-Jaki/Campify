@extends('layouts.admin')
@section('title', 'Kelola Rental')
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
    .page-header-rental {
        background: linear-gradient(135deg, var(--forest-dark) 0%, var(--forest-medium) 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .page-header-rental::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05));
    }

    .page-title-rental {
        color: white;
        font-weight: 800;
        font-size: 1.75rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .title-icon-rental {
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

    /* Stats Bar */
    .stats-bar-rental {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }

    .stat-card-rental {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.3s ease;
    }

    .stat-card-rental:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(27, 67, 50, 0.1);
    }

    .stat-icon-rental {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-icon-rental.pending { background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: #e65100; }
    .stat-icon-rental.disewa { background: linear-gradient(135deg, #e3f2fd, #bbdefb); color: #1565c0; }
    .stat-icon-rental.selesai { background: linear-gradient(135deg, #e8f5e9, #c8e6c9); color: #388e3c; }
    .stat-icon-rental.ditolak { background: linear-gradient(135deg, #ffebee, #ffcdd2); color: #c62828; }

    .stat-info-rental h6 {
        font-size: 0.8rem;
        color: #718096;
        margin: 0 0 4px 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-info-rental h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--forest-dark);
        margin: 0;
    }

    /* Table Card */
    .table-card-rental {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.08);
        overflow: hidden;
    }

    .table-card-rental .card-body {
        padding: 0;
    }

    /* Custom Table */
    .table-rental {
        margin: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-rental thead th {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 20px 24px;
        border: none;
    }

    .table-rental tbody tr {
        transition: all 0.2s ease;
    }

    .table-rental tbody tr:hover {
        background: var(--nature-accent);
        transform: scale(1.002);
    }

    .table-rental tbody td {
        padding: 20px 24px;
        vertical-align: middle;
        border-bottom: 1px solid #edf2f7;
        font-size: 0.95rem;
    }

    .table-rental tbody tr:last-child td {
        border-bottom: none;
    }

    /* User Cell */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .user-info h6 {
        font-weight: 700;
        color: var(--forest-dark);
        margin: 0;
        font-size: 0.95rem;
    }

    .user-info small {
        color: #718096;
        font-size: 0.8rem;
    }

    /* Date Cell */
    .date-cell {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .date-main {
        font-weight: 700;
        color: var(--forest-dark);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .date-range {
        font-size: 0.85rem;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Items Cell */
    .items-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .item-badge {
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.85rem;
        color: var(--forest-dark);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .item-badge i {
        color: var(--forest-medium);
    }

    /* Status Badge */
    .status-badge-rental {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: capitalize;
    }

    .status-badge-rental.pending {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
        color: #e65100;
    }

    .status-badge-rental.disewa {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
    }

    .status-badge-rental.selesai {
        background: linear-gradient(135deg, #d8f3dc, #b7e4c7);
        color: #1b4332;
    }

    .status-badge-rental.ditolak {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
    }

    /* Action Buttons */
    .action-group-rental {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-action-rental {
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-detail-rental {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
    }

    .btn-detail-rental:hover {
        background: linear-gradient(135deg, #bbdefb, #90caf9);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(21, 101, 192, 0.2);
        color: #1565c0;
    }

    .btn-approve-rental {
        background: linear-gradient(135deg, #d8f3dc, #b7e4c7);
        color: #1b4332;
    }

    .btn-approve-rental:hover {
        background: linear-gradient(135deg, #b7e4c7, #95d5b2);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(27, 67, 50, 0.2);
        color: #1b4332;
    }

    .btn-tolak-rental {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
    }

    .btn-tolak-rental:hover {
        background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(198, 40, 40, 0.2);
        color: #c62828;
    }

    /* Empty State */
    .empty-state-rental {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon-rental {
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
    .pagination-container-rental {
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
        .page-header-rental {
            padding: 20px;
        }

        .stats-bar-rental {
            grid-template-columns: repeat(2, 1fr);
        }

        .table-rental thead {
            display: none;
        }

        .table-rental tbody tr {
            display: block;
            margin-bottom: 16px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background: white;
        }

        .table-rental tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #edf2f7;
        }

        .table-rental tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            color: var(--forest-dark);
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .table-rental tbody td:last-child {
            border-bottom: none;
        }

        .action-group-rental {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header-rental">
    <h4 class="page-title-rental">
        <span class="title-icon-rental">📋</span>
        <span>Kelola Rental</span>
    </h4>
</div>

<!-- Stats Bar -->
<div class="stats-bar-rental">
    <div class="stat-card-rental">
        <div class="stat-icon-rental pending">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div class="stat-info-rental">
            <h6>Pending</h6>
            <h3>{{ $rentals->where('status', 'pending')->count() }}</h3>
        </div>
    </div>
    <div class="stat-card-rental">
        <div class="stat-icon-rental disewa">
            <i class="bi bi-box-seam"></i>
        </div>
        <div class="stat-info-rental">
            <h6>Disewa</h6>
            <h3>{{ $rentals->where('status', 'disewa')->count() }}</h3>
        </div>
    </div>
    <div class="stat-card-rental">
        <div class="stat-icon-rental selesai">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="stat-info-rental">
            <h6>Selesai</h6>
            <h3>{{ $rentals->where('status', 'selesai')->count() }}</h3>
        </div>
    </div>
    <div class="stat-card-rental">
        <div class="stat-icon-rental ditolak">
            <i class="bi bi-x-circle"></i>
        </div>
        <div class="stat-info-rental">
            <h6>Ditolak</h6>
            <h3>{{ $rentals->where('status', 'ditolak')->count() }}</h3>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card table-card-rental">
    <div class="card-body">
        <table class="table table-rental">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rentals as $r)
                <tr>
                    <td data-label="No">{{ $loop->iteration }}</td>
                    <td data-label="User">
                        <div class="user-cell">
                            <div class="user-avatar">
                                {{ substr($r->user->name, 0, 1) }}
                            </div>
                            <div class="user-info">
                                <h6>{{ $r->user->name }}</h6>
                                <small>{{ $r->user->email }}</small>
                            </div>
                        </div>
                    </td>
                    <td data-label="Tanggal">
                        <div class="date-cell">
                            <span class="date-main">
                                <i class="bi bi-calendar-event"></i>
                                {{ $r->tanggal_mulai }}
                            </span>
                            <span class="date-range">
                                <i class="bi bi-arrow-right"></i>
                                s/d {{ $r->tanggal_selesai }}
                            </span>
                        </div>
                    </td>
                    <td data-label="Barang">
                        <div class="items-list">
                            @foreach($r->details as $d)
                                <span class="item-badge">
                                    <i class="bi bi-box"></i>
                                    {{ $d->barang->nama_barang }} ×{{ $d->jumlah }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td data-label="Status">
                        <span class="status-badge-rental {{ $r->status }}">
                            <i class="bi bi-{{ 
                                $r->status == 'pending' ? 'hourglass-split' : 
                                ($r->status == 'disewa' ? 'box-seam' : 
                                ($r->status == 'selesai' ? 'check-circle-fill' : 'x-circle-fill')) 
                            }}"></i>
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-group-rental">
                            <a href="{{ route('admin.rental.show', $r) }}" class="btn-action-rental btn-detail-rental">
                                <i class="bi bi-eye-fill"></i>
                                Detail
                            </a>
                            @if($r->status == 'pending')
                                <form action="{{ route('admin.rental.approve', $r) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-action-rental btn-approve-rental" onclick="return confirm('Apakah Anda yakin ingin menyetujui rental ini?')">
                                        <i class="bi bi-check-lg"></i>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.rental.tolak', $r) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-action-rental btn-tolak-rental" onclick="return confirm('Apakah Anda yakin ingin menolak rental ini?')">
                                        <i class="bi bi-x-lg"></i>
                                        Tolak
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state-rental">
                            <div class="empty-icon-rental">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Rental</h5>
                            <p class="text-muted">Belum ada data rental yang masuk saat ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($rentals->hasPages())
<div class="pagination-container-rental">
    {{ $rentals->links() }}
</div>
@endif

@endsection