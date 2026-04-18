@extends('layouts.app')

@section('title', 'Form Rental')

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

    /* Card Form */
    .rental-card {
        border: none;
        border-radius: 24px;
        background: white;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.12);
    }

    .rental-header {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        padding: 24px 32px;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .rental-body {
        padding: 32px;
    }

    /* Product Summary Box */
    .product-summary {
        background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 28px;
        border-left: 4px solid var(--forest-medium);
    }

    .product-summary-title {
        font-size: 0.85rem;
        color: #718096;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .product-summary-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--forest-dark);
        margin-bottom: 4px;
    }

    .product-summary-price {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--forest-medium);
    }

    /* Form Styling */
    .form-group-custom {
        margin-bottom: 24px;
    }

    .form-label-custom {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-label-custom .required {
        color: #e53e3e;
    }

    /* FIXED: Input lebar penuh */
    .form-control-custom {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8faf9;
    }

    .form-control-custom:focus {
        border-color: var(--forest-medium);
        background: white;
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
    }

    .form-control-custom:disabled {
        background: #edf2f7;
        cursor: not-allowed;
    }

    .form-control-custom.is-invalid {
        border-color: #fc8181;
        background: #fff5f5;
    }

    /* FIXED: Jumlah input styling */
    .input-jumlah {
        width: 100%;
        text-align: left;
    }

    .form-text-custom {
        font-size: 0.85rem;
        color: #718096;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-text-custom i {
        color: var(--forest-medium);
    }

    /* Invalid Feedback */
    .invalid-feedback-custom {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Estimasi Box */
    .estimasi-box {
        background: linear-gradient(135deg, #ebf8ff, #bee3f8);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
        border-left: 4px solid #4299e1;
        display: none;
    }

    .estimasi-box.show {
        display: block;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .estimasi-label {
        font-weight: 600;
        color: #2b6cb0;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .estimasi-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2c5282;
    }

    /* Button Ajukan dengan Animasi */
    .btn-ajukan {
        position: relative;
        width: 100%;
        height: 52px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--forest-medium);
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 600;
    }

    .btn-ajukan, .btn-ajukan__icon, .btn-ajukan__text {
        transition: all 0.3s;
    }

    .btn-ajukan .btn-ajukan__text {
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-ajukan .btn-ajukan__icon {
        position: absolute;
        right: 0;
        height: 100%;
        width: 52px;
        background-color: var(--forest-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translateX(100%);
        opacity: 0;
    }

    .btn-ajukan .btn-ajukan__icon svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: #fff;
        stroke-width: 2.5;
    }

    .btn-ajukan:hover {
        background: var(--forest-medium);
    }

    .btn-ajukan:hover .btn-ajukan__text {
        transform: translateX(-20px);
    }

    .btn-ajukan:hover .btn-ajukan__icon {
        transform: translateX(0);
        opacity: 1;
    }

    .btn-ajukan:active {
        border: 1px solid var(--forest-dark);
        transform: scale(0.98);
    }

    /* Button Batal */
    .btn-batal {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 24px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #4a5568;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 12px;
    }

    .btn-batal:hover {
        border-color: var(--forest-medium);
        color: var(--forest-medium);
        background: #f0fff4;
    }

    /* FIXED: Date Input dengan icon Bootstrap */
    .date-input-wrapper {
        position: relative;
        width: 100%;
    }

    .date-input-wrapper input {
        width: 100%;
        padding-right: 45px;
    }

    .date-input-wrapper .calendar-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--forest-medium);
        font-size: 1.2rem;
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .rental-header {
            padding: 20px 24px;
            font-size: 1rem;
        }
        
        .rental-body {
            padding: 24px;
        }
        
        .product-summary {
            padding: 16px 20px;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="rental-card">
                <div class="rental-header">
                    <i class="bi bi-clipboard-check"></i>
                    Form Rental - {{ $barang->nama_barang }}
                </div>
                
                <div class="rental-body">
                    <form action="{{ route('rental.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                        <!-- Product Summary -->
                        <div class="product-summary">
                            <div class="product-summary-title">Barang yang Dipilih</div>
                            <div class="product-summary-name">{{ $barang->nama_barang }}</div>
                            <div class="product-summary-price">
                                Rp {{ number_format($barang->harga_sewa_per_hari, 0, ',', '.') }}/hari
                            </div>
                        </div>

                        <!-- Jumlah - FIXED: lebar penuh -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Jumlah <span class="required">*</span>
                            </label>
                            <input type="number" 
                                   name="jumlah" 
                                   class="form-control-custom input-jumlah @error('jumlah') is-invalid @enderror"
                                   min="1" 
                                   max="{{ $barang->stok }}" 
                                   value="{{ old('jumlah', 1) }}" 
                                   required>
                            <div class="form-text-custom">
                                <i class="bi bi-box-seam"></i>
                                Stok tersedia: {{ $barang->stok }} unit
                            </div>
                            @error('jumlah')
                                <div class="invalid-feedback-custom">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai - FIXED: icon Bootstrap -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Tanggal Mulai <span class="required">*</span>
                            </label>
                            <div class="date-input-wrapper">
                                <input type="date" 
                                       name="tanggal_mulai" 
                                       class="form-control-custom @error('tanggal_mulai') is-invalid @enderror"
                                       min="{{ date('Y-m-d') }}" 
                                       value="{{ old('tanggal_mulai') }}" 
                                       required>
                                <i class="bi bi-calendar3 calendar-icon"></i>
                            </div>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback-custom">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai - FIXED: icon Bootstrap -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Tanggal Selesai (Rencana) <span class="required">*</span>
                            </label>
                            <div class="date-input-wrapper">
                                <input type="date" 
                                    name="tanggal_selesai" 
                                    class="form-control-custom @error('tanggal_selesai') is-invalid @enderror"
                                    value="{{ old('tanggal_selesai') }}" 
                                    required>
                                <i class="bi bi-calendar3 calendar-icon"></i>
                            </div>
                            @error('tanggal_selesai')
                                <div class="invalid-feedback-custom">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Estimasi Biaya -->
                        <div class="estimasi-box" id="estimasi">
                            <div class="estimasi-label">
                                <i class="bi bi-calculator"></i>
                                Estimasi Biaya
                            </div>
                            <div class="estimasi-value" id="totalEstimasi"></div>
                        </div>

                        <!-- Buttons -->
                        <button type="submit" class="btn-ajukan">
                            <span class="btn-ajukan__text">
                                <i class="bi bi-check-lg"></i>
                                Ajukan Rental
                            </span>
                            <span class="btn-ajukan__icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>
                        
                        <a href="{{ route('home') }}" class="btn-batal">
                            <i class="bi bi-arrow-left"></i>
                            Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const harga = {{ $barang->harga_sewa_per_hari }};

function hitungEstimasi() {
    const mulai   = new Date(document.querySelector('[name=tanggal_mulai]').value);
    const selesai = new Date(document.querySelector('[name=tanggal_selesai]').value);
    const jumlah  = parseInt(document.querySelector('[name=jumlah]').value) || 1;
    
    if (mulai && selesai && selesai > mulai) {
        const hari   = Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24));
        const total  = hari * jumlah * harga;
        
        document.getElementById('totalEstimasi').innerHTML = 
            `<strong>${jumlah}</strong> barang × <strong>${hari}</strong> hari × Rp ${harga.toLocaleString('id-ID')} = 
             <strong style="color: var(--forest-medium);">Rp ${total.toLocaleString('id-ID')}</strong>`;
        
        document.getElementById('estimasi').classList.add('show');
    } else {
        document.getElementById('estimasi').classList.remove('show');
    }
}

document.querySelectorAll('[name=tanggal_mulai],[name=tanggal_selesai],[name=jumlah]')
    .forEach(el => el.addEventListener('change', hitungEstimasi));
</script>
@endpush