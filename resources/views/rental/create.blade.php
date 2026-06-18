@extends('layouts.app')

@section('title', 'Tambah ke Keranjang')

@section('content')
    <style>
        :root {
            --forest-dark: #1b4332;
            --forest-medium: #2d6a4f;
            --forest-light: #40916c;
            --nature-accent: #d8f3dc;
            --cream: #fefae0;
            --sunset: #e76f51;
        }

        .rental-page {
            background: linear-gradient(135deg, #f8faf9 0%, #e8f5e9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .rental-page::before {
            content: '🏕️';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 15rem;
            opacity: 0.03;
            transform: rotate(-15deg);
            pointer-events: none;
        }

        .rental-page::after {
            content: '🌲';
            position: absolute;
            bottom: -30px;
            left: -30px;
            font-size: 12rem;
            opacity: 0.03;
            pointer-events: none;
        }

        /* Card Compact */
        .rental-card {
            border: none;
            border-radius: 24px;
            background: white;
            box-shadow: 0 20px 60px rgba(27, 67, 50, 0.15);
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .rental-header {
            background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
            color: white;
            padding: 24px 28px;
            position: relative;
            overflow: hidden;
        }

        .rental-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .rental-header-content {
            position: relative;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 1px solid rgba(255,255,255,0.3);
            flex-shrink: 0;
        }

        .header-text h4 {
            font-weight: 800;
            margin: 0;
            font-size: 1.15rem;
            letter-spacing: -0.3px;
        }

        .header-text p {
            margin: 2px 0 0 0;
            opacity: 0.85;
            font-size: 0.85rem;
        }

        .rental-body {
            padding: 28px;
        }

        /* Product Info Box */
        .product-box {
            background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            border: 2px solid rgba(45, 106, 79, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .product-img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            object-fit: cover;
            background: #e2e8f0;
            flex-shrink: 0;
        }

        .product-img-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-name {
            font-weight: 700;
            color: var(--forest-dark);
            font-size: 1.05rem;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--forest-medium);
        }

        .product-price-unit {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--forest-light);
        }

        .product-stock {
            font-size: 0.8rem;
            color: #718096;
            font-weight: 600;
            margin-top: 2px;
        }

        /* Quantity Section */
        .qty-section {
            margin-bottom: 24px;
        }

        .qty-label {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .qty-label i {
            color: var(--forest-medium);
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-qty {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            background: white;
            color: var(--forest-medium);
            font-size: 1.3rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .btn-qty:hover {
            background: var(--nature-accent);
            border-color: var(--forest-medium);
        }

        .btn-qty:active {
            transform: scale(0.95);
        }

        .btn-qty:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .qty-input {
            flex: 1;
            height: 44px;
            border: 2.5px solid #e2e8f0;
            border-radius: 12px;
            text-align: center;
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--forest-dark);
            background: #fafcfb;
            transition: all 0.3s ease;
        }

        .qty-input:focus {
            border-color: var(--forest-medium);
            background: white;
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
            outline: none;
        }

        /* Estimasi */
        .estimasi-box {
            background: linear-gradient(135deg, #ebf8ff, #e0f2fe);
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 24px;
            border: 2px solid rgba(66, 153, 225, 0.15);
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .estimasi-box.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .estimasi-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
            font-size: 0.9rem;
            color: #4a5568;
        }

        .estimasi-row:last-child {
            margin-bottom: 0;
            padding-top: 8px;
            border-top: 1px dashed #a0aec0;
            margin-top: 8px;
        }

        .estimasi-total {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--forest-medium);
        }

        /* Buttons */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-tambah {
            position: relative;
            width: 100%;
            height: 52px;
            border: none;
            background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
            border-radius: 14px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .btn-tambah:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 106, 79, 0.4);
        }

        .btn-tambah:active {
            transform: translateY(0) scale(0.98);
        }

        .btn-batal {
            width: 100%;
            height: 48px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 14px;
            color: #4a5568;
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-batal:hover {
            border-color: var(--forest-medium);
            color: var(--forest-medium);
            background: var(--nature-accent);
        }

        /* Trust text */
        .trust-text {
            text-align: center;
            margin-top: 16px;
            font-size: 0.8rem;
            color: #a0aec0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .trust-text span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trust-text i {
            color: var(--forest-medium);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .rental-card {
                border-radius: 20px;
            }
            .rental-body {
                padding: 20px;
            }
        }
    </style>

    <div class="rental-page">
        <div class="rental-card">
            <!-- Header -->
            <div class="rental-header">
                <div class="rental-header-content">
                    <div class="header-icon">
                        <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    <div class="header-text">
                        <h4>Tambah ke Keranjang</h4>
                        <p>Pilih jumlah barang</p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="rental-body">
                <!-- Product Info -->
                <div class="product-box">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="product-img">
                    @else
                        <div class="product-img-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                    <div class="product-info">
                        <div class="product-name" title="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</div>
                        <div class="product-price">
                            Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}
                            <span class="product-price-unit">/ hari</span>
                        </div>
                        <div class="product-stock">
                            <i class="bi bi-layers-fill" style="color: var(--forest-medium);"></i>
                            Stok tersedia: {{ $barang->stok }} unit
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('keranjang.add') }}" method="POST" id="rentalForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                    <!-- Quantity -->
                    <div class="qty-section">
                        <label class="qty-label">
                            <i class="bi bi-stack"></i>
                            Jumlah Barang
                        </label>
                        <div class="qty-control">
                            <button type="button" class="btn-qty" onclick="adjustQty(-1)" id="btnMinus">
                                <i class="bi bi-dash-lg"></i>
                            </button>
                            <input type="number" 
                                   name="jumlah" 
                                   id="qtyInput"
                                   class="qty-input"
                                   value="1"
                                   min="1" 
                                   max="{{ $barang->stok }}"
                                   required
                                   readonly>
                            <button type="button" class="btn-qty" onclick="adjustQty(1)" id="btnPlus">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Estimasi (harga per hari × jumlah) -->
                    <div class="estimasi-box" id="estimasiBox">
                        <div class="estimasi-row">
                            <span>Harga per hari</span>
                            <strong>Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}</strong>
                        </div>
                        <div class="estimasi-row">
                            <span>Jumlah</span>
                            <strong id="estimasiJumlah">1 unit</strong>
                        </div>
                        <div class="estimasi-row">
                            <span>Estimasi / hari</span>
                            <span class="estimasi-total" id="estimasiTotal">Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="btn-group">
                        <button type="submit" class="btn-tambah">
                            <i class="bi bi-cart-plus"></i>
                            Tambah ke Keranjang
                        </button>
                        <a href="{{ url()->previous() }}" class="btn-batal">
                            <i class="bi bi-x-lg"></i>
                            Batal
                        </a>
                    </div>
                </form>

                <!-- Trust -->
                <div class="trust-text">
                    <span><i class="bi bi-shield-check"></i> Aman</span>
                    <span><i class="bi bi-lightning"></i> Cepat</span>
                    <span><i class="bi bi-arrow-counterclockwise"></i> Batal</span>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const harga = {{ $barang->harga_sewa_per_hari }};
        const maxStok = {{ $barang->stok }};
        const qtyInput = document.getElementById('qtyInput');
        const btnMinus = document.getElementById('btnMinus');
        const btnPlus = document.getElementById('btnPlus');
        const estimasiBox = document.getElementById('estimasiBox');
        const estimasiJumlah = document.getElementById('estimasiJumlah');
        const estimasiTotal = document.getElementById('estimasiTotal');

        function updateEstimasi() {
            const qty = parseInt(qtyInput.value);
            const total = qty * harga;

            estimasiJumlah.textContent = qty + ' unit';
            estimasiTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');

            // Show estimasi if qty > 1
            if (qty > 1) {
                estimasiBox.classList.add('show');
            } else {
                estimasiBox.classList.remove('show');
            }

            // Update button states
            btnMinus.disabled = qty <= 1;
            btnPlus.disabled = qty >= maxStok;
        }

        function adjustQty(delta) {
            let value = parseInt(qtyInput.value) + delta;
            if (value < 1) value = 1;
            if (value > maxStok) value = maxStok;
            qtyInput.value = value;
            updateEstimasi();
        }

        // Initialize
        updateEstimasi();
    </script>
    @endpush
@endsection