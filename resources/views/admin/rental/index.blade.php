@extends('layouts.admin')

@section('title', 'Kelola Rental')

@section('content')
    <style>
        :root {
            --forest-dark: #1b4332;
            --forest-medium: #2d6a4f;
            --forest-light: #40916c;
            --forest-lighter: #52b788;
            --nature-accent: #d8f3dc;
            --nature-light: #f0fff4;
            --earth-brown: #bc6c25;
            --earth-light: #dda15e;
            --sunset-orange: #e76f51;
            --sunset-light: #f4a261;
            --cream: #fefae0;
            --stone: #e5e5e5;
            --mist: #f8faf9;
        }

        /* ============================================
           PAGE HEADER
        ============================================ */
        .page-header-admin {
            background: linear-gradient(135deg, var(--forest-dark) 0%, var(--forest-medium) 50%, var(--forest-light) 100%);
            border-radius: 24px;
            padding: 32px 36px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(27, 67, 50, 0.2);
        }

        .page-header-admin::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .page-header-admin::after {
            content: '📋';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 8rem;
            opacity: 0.04;
            pointer-events: none;
        }

        .header-content-admin {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-title-group {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon-box {
            width: 56px;
            height: 56px;
            background: rgba(255, 193, 7, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .header-title {
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .header-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin: 4px 0 0 0;
        }

        /* ============================================
           STATS CARDS
        ============================================ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-card.pending {
            border-color: #fff3e0;
        }

        .stat-card.pending .stat-icon {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #e65100;
        }

        .stat-card.disewa {
            border-color: #e3f2fd;
        }

        .stat-card.disewa .stat-icon {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
        }

        .stat-card.selesai {
            border-color: var(--nature-accent);
        }

        .stat-card.selesai .stat-icon {
            background: linear-gradient(135deg, var(--nature-accent), #b7e4c7);
            color: var(--forest-dark);
        }

        .stat-card.ditolak {
            border-color: #ffebee;
        }

        .stat-card.ditolak .stat-icon {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-info h6 {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 600;
            margin: 0 0 4px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--forest-dark);
            margin: 0;
        }

        /* ============================================
           TABLE CARD
        ============================================ */
        .table-card {
            border: none;
            border-radius: 24px;
            background: white;
            box-shadow: 0 8px 30px rgba(27, 67, 50, 0.08);
            overflow: hidden;
        }

        .table-card-header {
            padding: 24px 28px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .table-card-title {
            font-weight: 800;
            color: var(--forest-dark);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .table-card-title i {
            color: var(--forest-medium);
        }

        /* Search & Filter */
        .table-filters {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 16px 10px 40px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
            width: 240px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: var(--forest-medium);
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        /* ============================================
           TABLE STYLING
        ============================================ */
        .table-rental {
            margin: 0;
            width: 100%;
        }

        .table-rental thead th {
            background: var(--nature-accent);
            color: var(--forest-dark);
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 20px;
            border: none;
            white-space: nowrap;
        }

        .table-rental tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1.5px solid #f1f5f9;
            color: #4a5568;
        }

        .table-rental tbody tr {
            transition: all 0.2s ease;
        }

        .table-rental tbody tr:hover {
            background: linear-gradient(90deg, var(--nature-light), transparent);
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
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
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
            font-size: 0.9rem;
        }

        .date-main i {
            color: var(--forest-medium);
        }

        .date-range {
            font-size: 0.8rem;
            color: #718096;
            padding-left: 22px;
        }

        /* Items List */
        .items-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .item-badge {
            background: linear-gradient(135deg, var(--nature-accent), var(--nature-light));
            color: var(--forest-dark);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(45, 106, 79, 0.1);
        }

        .item-badge i {
            color: var(--forest-medium);
            font-size: 0.75rem;
        }

        /* Status Badge */
        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status-badge.pending {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #e65100;
        }

        .status-badge.disewa {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
        }

        .status-badge.selesai {
            background: linear-gradient(135deg, var(--nature-accent), #b7e4c7);
            color: var(--forest-dark);
        }

        .status-badge.ditolak {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-detail {
            background: #f1f5f9;
            color: #4a5568;
        }

        .btn-detail:hover {
            background: #e2e8f0;
            color: var(--forest-dark);
        }

        .btn-approve {
            background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
            color: white;
        }

        .btn-approve:hover {
            background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        }

        .btn-reject {
            background: linear-gradient(135deg, #ff6b6b, #ee5a5a);
            color: white;
        }

        .btn-reject:hover {
            background: linear-gradient(135deg, #ee5a5a, #dc3545);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .empty-icon i {
            font-size: 3rem;
            color: #a0aec0;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 20px 28px;
            border-top: 2px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-info {
            color: #718096;
            font-size: 0.9rem;
        }

        /* ============================================
           MODAL STYLING
        ============================================ */
        .modal-content {
            border: none;
            border-radius: 24px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
            color: white;
            border: none;
            padding: 24px 28px;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-body {
            padding: 28px;
        }

        .modal-footer {
            padding: 20px 28px;
            border-top: 2px solid #f1f5f9;
        }

        .form-control-modal {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control-modal:focus {
            border-color: var(--forest-medium);
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
            outline: none;
        }

        .btn-modal-secondary {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            background: white;
            color: #4a5568;
        }

        .btn-modal-danger {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            background: linear-gradient(135deg, #ff6b6b, #ee5a5a);
            color: white;
        }

        /* ============================================
           RESPONSIVE
        ============================================ */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .page-header-admin {
                padding: 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-filters {
                width: 100%;
            }

            .search-box input {
                width: 100%;
            }

            .table-rental thead {
                display: none;
            }

            .table-rental tbody td {
                display: block;
                padding: 12px 20px;
                text-align: right;
            }

            .table-rental tbody td::before {
                content: attr(data-label);
                float: left;
                font-weight: 700;
                color: var(--forest-dark);
                text-transform: uppercase;
                font-size: 0.8rem;
            }

            .table-rental tbody tr {
                display: block;
                border-bottom: 2px solid #e2e8f0;
                padding: 16px 0;
            }

            .action-group {
                justify-content: flex-end;
            }
        }
    </style>

    <!-- PAGE HEADER -->
    <div class="page-header-admin">
        <div class="header-content-admin">
            <div class="header-title-group">
                <div class="header-icon-box">📋</div>
                <div>
                    <h4 class="header-title">Kelola Rental</h4>
                    <p class="header-subtitle">Pantau dan kelola semua penyewaan gear camping</p>
                </div>
            </div>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="stats-grid">
        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-info">
                <h6>Menunggu</h6>
                <h3>{{ $rentals->where('status', 'pending')->count() }}</h3>
            </div>
        </div>

        <div class="stat-card disewa">
            <div class="stat-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div class="stat-info">
                <h6>Disewa</h6>
                <h3>{{ $rentals->where('status', 'disewa')->count() }}</h3>
            </div>
        </div>

        <div class="stat-card selesai">
            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-info">
                <h6>Selesai</h6>
                <h3>{{ $rentals->where('status', 'selesai')->count() }}</h3>
            </div>
        </div>

        <div class="stat-card ditolak">
            <div class="stat-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-info">
                <h6>Ditolak</h6>
                <h3>{{ $rentals->where('status', 'ditolak')->count() }}</h3>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
        <div class="table-card-header">
            <h5 class="table-card-title">
                <i class="bi bi-list-ul"></i>
                Daftar Rental
            </h5>
            <div class="table-filters">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchRental" placeholder="Cari rental..." onkeyup="filterTable()">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-rental" id="rentalTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Penyewa</th>
                        <th>Periode</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $r)
                        <tr>
                            <td data-label="#">{{ $loop->iteration }}</td>

                            <!-- USER -->
                            <td data-label="Penyewa">
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($r->user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-info">
                                        <h6>{{ $r->user->name }}</h6>
                                        <small>{{ $r->user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <!-- TANGGAL -->
                            <td data-label="Periode">
                                <div class="date-cell">
                                    <span class="date-main">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ \Carbon\Carbon::parse($r->tanggal_mulai)->format('d M Y') }}
                                    </span>
                                    <span class="date-range">
                                        s/d {{ \Carbon\Carbon::parse($r->tanggal_selesai)->format('d M Y') }}
                                    </span>
                                </div>
                            </td>

                            <!-- BARANG -->
                            <td data-label="Barang">
                                <div class="items-list">
                                    @foreach ($r->details as $d)
                                        <span class="item-badge">
                                            <i class="bi bi-box"></i>
                                            {{ $d->barang->nama_barang }} ×{{ $d->jumlah }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            <!-- STATUS -->
                            <td data-label="Status">
                                <span class="status-badge {{ $r->status }}">
                                    <i class="bi bi-{{ $r->status == 'pending' ? 'hourglass-split' : ($r->status == 'disewa' ? 'box-seam' : ($r->status == 'selesai' ? 'check-circle-fill' : 'x-circle-fill')) }}"></i>
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td data-label="Aksi">
                                <div class="action-group">
                                    <a href="{{ route('admin.rental.show', $r) }}" class="btn-action btn-detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>

                                    @if ($r->status == 'pending')
                                        <form action="{{ route('admin.rental.approve', $r) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-approve" onclick="return confirm('Setujui rental ini?')">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>

                                        <button type="button" class="btn-action btn-reject" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $r->id }}">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL TOLAK -->
                        <div class="modal fade" id="modalTolak{{ $r->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="bi bi-x-circle-fill me-2"></i>
                                            Alasan Penolakan
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.rental.tolak', $r->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <label class="form-label fw-semibold text-dark mb-2">Berikan alasan penolakan:</label>
                                            <textarea name="alasan_ditolak" class="form-control-modal" rows="4" required placeholder="Contoh: Stok barang tidak mencukupi..."></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg me-1"></i> Batal
                                            </button>
                                            <button type="submit" class="btn-modal-danger">
                                                <i class="bi bi-check-lg me-1"></i> Tolak Rental
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-2">Belum Ada Rental</h5>
                                    <p class="text-muted mb-0">Data penyewaan akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($rentals) && method_exists($rentals, 'links'))
            <div class="pagination-wrapper">
                <span class="pagination-info">
                    Menampilkan {{ $rentals->firstItem() ?? 0 }} - {{ $rentals->lastItem() ?? 0 }} dari {{ $rentals->total() }} data
                </span>
                {{ $rentals->links() }}
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        // Filter table
        function filterTable() {
            const input = document.getElementById('searchRental');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('rentalTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        const txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                tr[i].style.display = found ? '' : 'none';
            }
        }
    </script>
    @endpush
@endsection