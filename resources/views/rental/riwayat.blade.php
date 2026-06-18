@extends('layouts.app')

@section('title', 'Riwayat Sewa')

@section('content')
    <style>
        :root {
            --forest-dark: #1b4332;
            --forest-medium: #2d6a4f;
            --forest-light: #40916c;
            --nature-accent: #d8f3dc;
            --cream: #fefae0;
        }

        .page-header { margin-bottom: 32px; }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--forest-dark);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .page-title i { color: var(--forest-medium); }
        .page-subtitle { color: #718096; font-size: 1rem; }

        .rental-card {
            border: none;
            border-radius: 20px;
            background: white;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(27,67,50,0.08);
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .rental-card:hover {
            box-shadow: 0 8px 30px rgba(27,67,50,0.15);
            transform: translateY(-2px);
        }

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

        .rental-id i { color: var(--forest-medium); font-size: 0.9rem; }

        .rental-date {
            color: #718096;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .rental-date i { color: var(--forest-medium); }

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

        .status-pending  { background: #fef3c7; color: #92400e; }
        .status-disewa   { background: #dbeafe; color: #1e40af; }
        .status-selesai  { background: #d8f3dc; color: #1b4332; }
        .status-ditolak  { background: #fee2e2; color: #991b1b; }

        .rental-body { padding: 24px; }

        .item-list { margin-bottom: 20px; }

        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .item-row:last-child { border-bottom: none; }

        .item-info { display: flex; align-items: center; gap: 12px; }

        .item-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--forest-medium);
            font-size: 1.1rem;
        }

        .item-name { font-weight: 600; color: #2d3748; }
        .item-qty  { color: #718096; font-size: 0.9rem; }
        .item-price { font-weight: 700; color: var(--forest-medium); font-size: 0.95rem; }

        /* === NEXT STEP SECTION (disewa) === */
        .next-step-section {
            background: linear-gradient(135deg, #e0f2fe, #f0f9ff);
            border: 2px solid #93c5fd;
            border-radius: 20px;
            padding: 24px;
            margin-top: 16px;
            position: relative;
            overflow: hidden;
        }

        .next-step-section::before {
            content: '📞';
            position: absolute;
            right: 20px;
            top: 16px;
            font-size: 4rem;
            opacity: 0.1;
        }

        .next-step-title {
            font-weight: 800;
            color: #1e40af;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .next-step-title .step-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .step-list {
            list-style: none;
            padding: 0; margin: 0 0 20px 0;
        }

        .step-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            color: #1e40af;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .step-number {
            width: 24px; height: 24px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .contact-cards {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .contact-card {
            flex: 1;
            min-width: 140px;
            background: white;
            border-radius: 14px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .contact-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            border-color: #93c5fd;
        }

        .contact-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .contact-icon.wa  { background: #dcfce7; color: #16a34a; }
        .contact-icon.ig  { background: #fce7f3; color: #db2777; }
        .contact-icon.tel { background: #ede9fe; color: #7c3aed; }

        .contact-info { flex: 1; min-width: 0; }

        .contact-label {
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-value {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        .pengembalian-title i { color: var(--forest-medium); }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .info-item { display: flex; flex-direction: column; gap: 4px; }
        .info-label { font-size: 0.8rem; color: #718096; font-weight: 500; }
        .info-value { font-weight: 600; color: #2d3748; }

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

        .total-amount { text-align: right; }
        .total-label  { font-size: 0.85rem; color: #718096; margin-bottom: 4px; }
        .total-value  { font-size: 1.5rem; font-weight: 800; color: var(--forest-medium); }

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

        .payment-lunas { background: #d8f3dc; color: #1b4332; }
        .payment-belum { background: #fef3c7; color: #92400e; }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .empty-icon {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 24px;
        }

        .empty-icon i { font-size: 3rem; color: #a0aec0; }
        .empty-title  { font-weight: 700; color: #2d3748; margin-bottom: 8px; font-size: 1.25rem; }
        .empty-text   { color: #718096; margin-bottom: 24px; }

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
            box-shadow: 0 8px 20px rgba(45,106,79,0.3);
            color: white;
        }

        @media (max-width: 768px) {
            .rental-header  { flex-direction: column; align-items: flex-start; }
            .info-grid      { grid-template-columns: 1fr; }
            .total-section  { flex-direction: column; gap: 12px; text-align: center; }
            .total-amount   { text-align: center; }
            .contact-cards  { flex-direction: column; }
            .contact-card   { min-width: unset; }
        }
    </style>

    <div class="container py-5">
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
                    @if($r->status == 'ditolak' && $r->alasan_ditolak)
                        <small class="text-danger">
                            <i class="bi bi-info-circle me-1"></i>{{ $r->alasan_ditolak }}
                        </small>
                    @endif
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

                    {{-- ✅ NEXT STEP — muncul saat status DISEWA --}}
                    @if($r->status == 'disewa')
                        <div class="next-step-section">
                            <div class="next-step-title">
                                <div class="step-icon">
                                    <i class="bi bi-stars"></i>
                                </div>
                                Rental Disetujui! Ini Langkah Selanjutnya
                            </div>

                            <ul class="step-list">
                                <li>
                                    <span class="step-number">1</span>
                                    <span>Hubungi admin melalui kontak di bawah untuk konfirmasi pengambilan barang.</span>
                                </li>
                                <li>
                                    <span class="step-number">2</span>
                                    <span>Siapkan identitas diri (KTP/SIM) saat pengambilan barang.</span>
                                </li>
                                <li>
                                    <span class="step-number">3</span>
                                    <span>Kembalikan barang sesuai tanggal yang telah disepakati (<strong>{{ $r->tanggal_selesai }}</strong>).</span>
                                </li>
                                <li>
                                    <span class="step-number">4</span>
                                    <span>Keterlambatan pengembalian akan dikenakan denda 50% dari harga sewa per hari.</span>
                                </li>
                            </ul>

                            <div class="contact-cards">
                                <!-- WhatsApp -->
                                <a href="https://wa.me/6289509570460?text=Halo+admin+Campify,+saya+ingin+konfirmasi+rental+%23{{ $r->id }}"
                                   target="_blank"
                                   class="contact-card">
                                    <div class="contact-icon wa">
                                        <i class="bi bi-whatsapp"></i>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-label">WhatsApp</div>
                                        <div class="contact-value">0895-0957-0460</div>
                                    </div>
                                </a>

                                <!-- Instagram -->
                                <a href="https://instagram.com/fzaky.13"
                                   target="_blank"
                                   class="contact-card">
                                    <div class="contact-icon ig">
                                        <i class="bi bi-instagram"></i>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-label">Instagram</div>
                                        <div class="contact-value">@fzaky.13</div>
                                    </div>
                                </a>

                                <!-- Telepon -->
                                <a href="tel:+6289509570460"
                                   class="contact-card">
                                    <div class="contact-icon tel">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-label">Telepon</div>
                                        <div class="contact-value">0895-0957-0460</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- Detail Pengembalian --}}
                    @if($r->pengembalian)
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