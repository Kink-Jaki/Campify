@extends('layouts.admin')
@section('title', 'Detail Rental')
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

    .page-header-detail {
        background: linear-gradient(135deg, var(--forest-dark) 0%, var(--forest-medium) 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .page-header-detail::before {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 200px; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05));
    }

    .header-content-detail {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-title-detail {
        color: white;
        font-weight: 800;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
    }

    .title-icon-detail {
        width: 52px; height: 52px;
        background: rgba(255,193,7,0.2);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    .rental-id-badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .btn-kembali {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-kembali:hover {
        background: rgba(255,255,255,0.2);
        color: white;
        transform: translateX(-4px);
    }

    .info-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27,67,50,0.08);
        overflow: hidden;
        height: 100%;
    }

    .card-header-detail {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        font-weight: 700;
        padding: 20px 24px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
        border: none;
    }

    .card-body-detail { padding: 28px; }

    .info-table { width: 100%; margin: 0; }
    .info-table tr { border-bottom: 1px solid #edf2f7; }
    .info-table tr:last-child { border-bottom: none; }
    .info-table td { padding: 16px 0; vertical-align: middle; }
    .info-table td:first-child { width: 40%; color: #718096; font-weight: 600; font-size: 0.9rem; }
    .info-table td:last-child { font-weight: 700; color: var(--forest-dark); font-size: 0.95rem; }

    .user-info-detail { display: flex; align-items: center; gap: 14px; }

    .user-avatar-detail {
        width: 56px; height: 56px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        color: white; font-weight: 700; font-size: 1.5rem;
    }

    .user-text h5 { font-weight: 800; color: var(--forest-dark); margin: 0; font-size: 1.1rem; }
    .user-text small { color: #718096; font-size: 0.85rem; }

    .status-badge-detail {
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-transform: capitalize;
    }

    .status-badge-detail.pending { background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: #e65100; }
    .status-badge-detail.disewa  { background: linear-gradient(135deg, #e3f2fd, #bbdefb); color: #1565c0; }
    .status-badge-detail.selesai { background: linear-gradient(135deg, #d8f3dc, #b7e4c7); color: #1b4332; }
    .status-badge-detail.ditolak { background: linear-gradient(135deg, #ffebee, #ffcdd2); color: #c62828; }

    /* KTP Preview */
    .ktp-preview-box {
        background: linear-gradient(135deg, #f8faf9, #f0fff4);
        border: 2px dashed #95d5b2;
        border-radius: 16px;
        padding: 16px;
        text-align: center;
    }

    .ktp-preview-box img {
        max-height: 160px;
        max-width: 100%;
        border-radius: 10px;
        border: 2px solid #b7e4c7;
        object-fit: cover;
        cursor: zoom-in;
        transition: transform 0.2s ease;
    }

    .ktp-preview-box img:hover { transform: scale(1.02); }

    .btn-lihat-ktp {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        color: white;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    .btn-lihat-ktp:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(45,106,79,0.3);
        color: white;
    }

    .items-table { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }

    .items-table thead th {
        background: var(--nature-accent);
        color: var(--forest-dark);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border: none;
    }

    .items-table thead th:first-child { border-radius: 12px 0 0 12px; }
    .items-table thead th:last-child  { border-radius: 0 12px 12px 0; }

    .items-table tbody td {
        padding: 18px 20px;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    .items-table tbody tr:last-child td { border-bottom: none; }

    .item-name-cell { display: flex; align-items: center; gap: 12px; font-weight: 700; color: var(--forest-dark); }

    .item-icon {
        width: 40px; height: 40px;
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--forest-medium); font-size: 1.1rem;
    }

    .item-qty {
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-block;
    }

    .item-price { font-weight: 800; color: var(--forest-medium); font-size: 1rem; }

    .payment-card .card-header-detail { background: linear-gradient(135deg, #0288d1, #29b6f6); }
    .payment-table td:first-child { color: #4a5568; }
    .payment-amount { font-size: 1.5rem; font-weight: 800; }
    .payment-amount.success { color: #2e7d32; }
    .payment-amount.danger  { color: #c62828; }

    .payment-status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .payment-status-badge.lunas { background: linear-gradient(135deg, #d8f3dc, #b7e4c7); color: #1b4332; }
    .payment-status-badge.belum { background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: #e65100; }

    .action-section {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 40px rgba(27,67,50,0.08);
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn-approve-detail {
        background: linear-gradient(135deg, #d8f3dc, #b7e4c7);
        border: none;
        color: #1b4332;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(27,67,50,0.1);
        cursor: pointer;
    }

    .btn-approve-detail:hover {
        background: linear-gradient(135deg, #b7e4c7, #95d5b2);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(27,67,50,0.2);
        color: #1b4332;
    }

    .btn-tolak-detail {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        border: none;
        color: #c62828;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(198,40,40,0.1);
        cursor: pointer;
    }

    .btn-tolak-detail:hover {
        background: linear-gradient(135deg, #ffcdd2, #ef9a9a);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(198,40,40,0.2);
        color: #c62828;
    }

    .rental-timeline {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
        padding: 20px;
        background: var(--nature-accent);
        border-radius: 16px;
    }

    .timeline-icon {
        width: 48px; height: 48px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 1.25rem;
    }

    .timeline-info h6 { font-weight: 700; color: var(--forest-dark); margin: 0; }
    .timeline-info p  { color: #718096; margin: 0; font-size: 0.9rem; }

    /* Modal */
    .modal-content { border: none; border-radius: 24px; overflow: hidden; }

    .modal-header {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        border: none;
        padding: 24px 28px;
    }

    .modal-title { font-weight: 700; font-size: 1.1rem; }
    .modal-header .btn-close { filter: invert(1); }
    .modal-body { padding: 28px; }
    .modal-footer { padding: 20px 28px; border-top: 2px solid #f1f5f9; }

    .form-control-modal {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control-modal:focus {
        border-color: var(--forest-medium);
        box-shadow: 0 0 0 4px rgba(45,106,79,0.1);
        outline: none;
    }

    .btn-modal-secondary {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        border: 2px solid #e2e8f0;
        background: white;
        color: #4a5568;
        cursor: pointer;
    }

    .btn-modal-danger {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        background: linear-gradient(135deg, #ff6b6b, #ee5a5a);
        color: white;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .page-header-detail { padding: 20px; }
        .header-content-detail { flex-direction: column; align-items: flex-start; }
        .card-body-detail { padding: 20px; }
        .info-table td { display: block; width: 100% !important; }
        .info-table td:first-child { padding-bottom: 4px; font-size: 0.8rem; }
        .info-table td:last-child  { padding-top: 4px; font-size: 1rem; }
        .action-section { flex-direction: column; }
        .btn-approve-detail, .btn-tolak-detail { width: 100%; justify-content: center; }
    }
</style>

<!-- Page Header -->
<div class="page-header-detail">
    <div class="header-content-detail">
        <div class="d-flex align-items-center gap-4 flex-wrap">
            <h4 class="page-title-detail mb-0">
                <span class="title-icon-detail">📋</span>
                <span>Detail Rental</span>
            </h4>
            <span class="rental-id-badge">#{{ $rental->id }}</span>
        </div>
        <a href="{{ route('admin.rental.index') }}" class="btn-kembali">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>
</div>

<div class="row g-4">

    <!-- Info Penyewa -->
    <div class="col-md-6">
        <div class="card info-card">
            <div class="card-header-detail">
                <i class="bi bi-person-fill"></i>
                <span>Informasi Penyewa</span>
            </div>
            <div class="card-body-detail">
                <div class="user-info-detail mb-4">
                    <div class="user-avatar-detail">
                        {{ substr($rental->user->name, 0, 1) }}
                    </div>
                    <div class="user-text">
                        <h5>{{ $rental->user->name }}</h5>
                        <small><i class="bi bi-envelope me-1"></i>{{ $rental->user->email }}</small>
                    </div>
                </div>

                <table class="info-table">
                    <tr>
                        <td><i class="bi bi-calendar-event me-2"></i>Tanggal Mulai</td>
                        <td>{{ $rental->tanggal_mulai }}</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-calendar-check me-2"></i>Tanggal Selesai</td>
                        <td>{{ $rental->tanggal_selesai }}</td>
                    </tr>
                    <tr>
                        <td><i class="bi bi-activity me-2"></i>Status Rental</td>
                        <td>
                            <span class="status-badge-detail {{ $rental->status }}">
                                <i class="bi bi-{{ $rental->status == 'pending' ? 'hourglass-split' : ($rental->status == 'disewa' ? 'box-seam' : ($rental->status == 'selesai' ? 'check-circle-fill' : 'x-circle-fill')) }}"></i>
                                {{ ucfirst($rental->status) }}
                            </span>
                            @if($rental->status == 'ditolak' && $rental->alasan_ditolak)
                                <div class="mt-1">
                                    <small class="text-danger">
                                        <i class="bi bi-info-circle me-1"></i>{{ $rental->alasan_ditolak }}
                                    </small>
                                </div>
                            @endif
                        </td>
                    </tr>

                    <!-- Foto Identitas / KTP -->
                    <tr>
                        <td><i class="bi bi-card-image me-2"></i>Foto Identitas</td>
                        <td>
                            @if($rental->foto_ident)
                                <div class="ktp-preview-box">
                                    <a href="{{ asset('storage/' . $rental->foto_ident) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $rental->foto_ident) }}"
                                             alt="Foto Identitas"
                                             title="Klik untuk lihat penuh">
                                    </a>
                                    <br>
                                    <a href="{{ asset('storage/' . $rental->foto_ident) }}"
                                       target="_blank"
                                       class="btn-lihat-ktp">
                                        <i class="bi bi-zoom-in"></i> Lihat Penuh
                                    </a>
                                </div>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2">
                                    <i class="bi bi-exclamation-triangle me-1"></i>Belum Upload
                                </span>
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- Rental Timeline -->
                <div class="rental-timeline">
                    <div class="timeline-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="timeline-info">
                        <h6>Durasi Rental</h6>
                        <p>
                            @php
                                $start = \Carbon\Carbon::parse($rental->tanggal_mulai);
                                $end   = \Carbon\Carbon::parse($rental->tanggal_selesai);
                                $days  = $start->diffInDays($end) + 1;
                            @endphp
                            {{ $days }} hari ({{ $start->format('d M Y') }} - {{ $end->format('d M Y') }})
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Barang -->
    <div class="col-md-6">
        <div class="card info-card">
            <div class="card-header-detail">
                <i class="bi bi-box-seam-fill"></i>
                <span>Detail Barang Disewa</span>
            </div>
            <div class="card-body-detail p-0">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga/Hari</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalItems = 0; @endphp
                        @foreach($rental->details as $d)
                            @php $totalItems += $d->jumlah; @endphp
                            <tr>
                                <td>
                                    <div class="item-name-cell">
                                        <div class="item-icon"><i class="bi bi-box"></i></div>
                                        <span>{{ $d->barang->nama_barang }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="item-qty">×{{ $d->jumlah }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="item-price">Rp {{ number_format($d->barang->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4 bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Total Barang Disewa</span>
                        <span class="fw-bold fs-5 text-dark">{{ $totalItems }} unit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Pembayaran -->
    @if($rental->pengembalian)
        <div class="col-12">
            <div class="card info-card payment-card">
                <div class="card-header-detail">
                    <i class="bi bi-cash-stack"></i>
                    <span>Informasi Pembayaran</span>
                </div>
                <div class="card-body-detail">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <table class="info-table payment-table">
                                <tr>
                                    <td><i class="bi bi-calendar-return me-2"></i>Tanggal Kembali Real</td>
                                    <td class="fw-bold">{{ $rental->pengembalian->tanggal_kembali_real }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-clock me-2"></i>Total Hari</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $rental->pengembalian->total_hari }} hari
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-exclamation-triangle me-2"></i>Denda Keterlambatan</td>
                                    <td class="payment-amount danger">
                                        Rp {{ number_format($rental->pengembalian->denda, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="info-table payment-table">
                                <tr>
                                    <td><i class="bi bi-wallet2 me-2"></i>Total Pembayaran</td>
                                    <td class="payment-amount success">
                                        Rp {{ number_format($rental->pengembalian->total_bayar, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-check-circle me-2"></i>Status Pembayaran</td>
                                    <td>
                                        <span class="payment-status-badge {{ $rental->pengembalian->status_pembayaran }}">
                                            <i class="bi bi-{{ $rental->pengembalian->status_pembayaran == 'lunas' ? 'check-circle-fill' : 'hourglass-split' }}"></i>
                                            {{ $rental->pengembalian->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    @if($rental->status == 'pending')
        <div class="col-12">
            <div class="action-section">
                <!-- Approve -->
                <form action="{{ route('admin.rental.approve', $rental) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-approve-detail"
                        onclick="return confirm('Apakah Anda yakin ingin menyetujui rental ini?')">
                        <i class="bi bi-check-lg fs-5"></i>
                        <span>Setujui Rental</span>
                    </button>
                </form>

                <!-- Tolak — buka modal -->
                <button type="button" class="btn-tolak-detail"
                    data-bs-toggle="modal" data-bs-target="#modalTolak">
                    <i class="bi bi-x-lg fs-5"></i>
                    <span>Tolak Rental</span>
                </button>
            </div>
        </div>
    @endif

</div>

<!-- Modal Tolak -->
<div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-x-circle-fill me-2"></i>
                    Alasan Penolakan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.rental.tolak', $rental->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label class="form-label fw-semibold text-dark mb-2">
                        Berikan alasan penolakan:
                    </label>
                    <textarea name="alasan_ditolak"
                              class="form-control-modal"
                              rows="4"
                              required
                              placeholder="Contoh: Stok barang tidak mencukupi..."></textarea>
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

@endsection