@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<style>
    :root {
        --forest-dark: #1b4332;
        --forest-medium: #2d6a4f;
        --forest-light: #40916c;
        --nature-accent: #d8f3dc;
        --cream: #fefae0;
    }

    /* Page Header */
    .page-header { margin-bottom: 32px; }
    .page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--forest-dark);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Cart Card */
    .cart-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.12);
        overflow: hidden;
    }

    .cart-card-header {
        background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
        color: white;
        padding: 20px 32px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Table Styling */
    .cart-table thead th {
        background: #f8faf9;
        color: var(--forest-dark);
        font-weight: 700;
        padding: 18px 24px;
        border-bottom: 2px solid #e9ecef;
    }

    .product-cell { display: flex; align-items: center; gap: 16px; }
    .product-icon {
        width: 40px; height: 40px;
        background: var(--nature-accent);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--forest-medium);
    }

    /* Inputs */
    .qty-input, .date-input {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }
    .qty-input:focus, .date-input:focus {
        border-color: var(--forest-medium);
        outline: none;
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }

    /* Estimation Alert */
    #estimasi {
        border: none;
        border-left: 5px solid var(--forest-medium);
        background: #f0fff4;
        color: var(--forest-dark);
        border-radius: 12px;
    }

    /* Footer Section */
    .total-section {
        background: #f8faf9;
        padding: 32px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--forest-dark);
    }

    .btn-checkout {
        padding: 16px 40px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(45, 106, 79, 0.3);
    }

    /* Opsi Pengiriman */
    .opsi-card {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: block;
    }
    .opsi-card:has(input:checked) {
        border: 2px solid var(--forest-medium);
        background: #f0fff4;
    }
    .opsi-card:hover {
        border-color: var(--forest-light);
    }
    .opsi-card .badge-gratis {
        background: #d8f3dc;
        color: #1b4332;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 999px;
    }
    .opsi-card .badge-ongkir {
        background: #e2e8f0;
        color: #555;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 999px;
    }
    #box-alamat {
        background: #f8faf9;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
    }
    #box-alamat textarea.date-input {
        width: 100%;
        resize: none;
    }
</style>

<div class="container py-5">
    <div class="page-header">
        <h2 class="page-title"><i class="bi bi-cart3"></i> Keranjang Sewa</h2>
        <p class="text-muted">Pastikan durasi sewa dan jumlah barang sudah sesuai.</p>
    </div>

    @if (session('cart') && count(session('cart')) > 0)
        <form action="{{ route('keranjang.checkout') }}" method="POST" enctype="multipart/form-data" id="formCheckout">
            @csrf
            <div class="card cart-card">
                <div class="cart-card-header">
                    <i class="bi bi-bag-check"></i> Rincian Pesanan
                </div>

                <div class="cart-card-body">
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Harga/Hari</th>
                                    <th width="150">Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session('cart') as $id => $item)
                                    <tr class="cart-item" data-harga="{{ $item['harga'] }}">
                                        <td>
                                            <div class="product-cell">
                                                <div class="product-icon"><i class="bi bi-box-seam"></i></div>
                                                <span class="fw-bold">{{ $item['nama'] }}</span>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                        <td>
                                            <input type="number" name="jumlah[{{ $id }}]"
                                                   value="{{ $item['jumlah'] }}" min="1"
                                                   class="qty-input w-100 input-hitung">
                                        </td>
                                        <td class="item-subtotal fw-bold">
                                            Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('keranjang.remove', $id) }}" class="text-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-top">
                        <div class="row g-4">

                            {{-- Tanggal --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold">Tgl Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control date-input input-hitung"
                                               min="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold">Tgl Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control date-input input-hitung" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload KTP --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Foto KTP/Identitas</label>
                                <input type="file" name="ktp_foto" class="form-control @error('ktp_foto') is-invalid @enderror" accept="image/*" required>
                                <div id="previewContainer" class="mt-2" style="display:none;">
                                    <img id="previewKtp" src="" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            </div>

                            {{-- Opsi Pengiriman --}}
                            <div class="col-12">
                                <label class="form-label fw-bold">Opsi Pengiriman</label>
                                <div class="d-flex gap-3">

                                    {{-- Ambil di Tempat --}}
                                    <label class="opsi-card flex-fill">
                                        <input type="radio" name="opsi_pengiriman" value="ambil"
                                               class="d-none" checked onchange="toggleAlamat(this)">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-house-door-fill fs-5 text-success"></i>
                                            <div class="flex-fill">
                                                <div class="fw-bold small">Ambil di Tempat</div>
                                                <div class="text-muted" style="font-size:11px">Datang langsung ke lokasi kami</div>
                                            </div>
                                            <span class="badge-gratis">Gratis</span>
                                        </div>
                                    </label>

                                    {{-- Dikirim --}}
                                    <label class="opsi-card flex-fill">
                                        <input type="radio" name="opsi_pengiriman" value="kirim"
                                               class="d-none" onchange="toggleAlamat(this)">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-truck fs-5 text-secondary"></i>
                                            <div class="flex-fill">
                                                <div class="fw-bold small">Dikirim</div>
                                                <div class="text-muted" style="font-size:11px">Kami antar ke lokasi kamu</div>
                                            </div>
                                            <span class="badge-ongkir">+ 10% Ongkir</span>
                                        </div>
                                    </label>

                                </div>

                                {{-- Box Alamat (muncul jika pilih Dikirim) --}}
                                <div id="box-alamat" class="mt-3" style="display:none;">
                                    <label class="form-label fw-bold small mb-2">
                                        <i class="bi bi-geo-alt-fill me-1 text-success"></i>Alamat Pengiriman
                                    </label>
                                    <textarea name="alamat_pengiriman" id="inputAlamat" rows="3"
                                              class="form-control date-input"
                                              placeholder="Masukkan alamat lengkap, nama jalan, nomor rumah, RT/RW, kelurahan..."></textarea>
                                    <div class="text-muted mt-2" style="font-size:11px">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Ongkos kirim <strong>10%</strong> dari total harga sewa, dihitung otomatis.
                                    </div>
                                </div>
                            </div>
                            {{-- End Opsi Pengiriman --}}

                        </div>

                        {{-- Estimasi Box --}}
                        <div class="alert mt-4" id="estimasi" style="display:none;">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <strong>Estimasi Durasi:</strong> <span id="textDurasi">0</span> Hari
                                </div>
                                <div class="d-flex flex-column align-items-end gap-1">
                                    <div class="text-muted small" id="rowOngkir" style="display:none;">
                                        Ongkos kirim: <strong>Rp 25.000</strong>
                                    </div>
                                    <div id="totalEstimasi" class="fw-bold"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="total-section">
                        <div>
                            <div class="text-muted small uppercase fw-bold">Total yang Harus Dibayar</div>
                            <div class="text-muted small" id="infoOngkirTotal" style="display:none; font-size:12px;">
                                Sudah termasuk ongkir Rp 25.000
                            </div>
                            <div class="total-value" id="grandTotalDisplay">Rp 0</div>
                        </div>
                        <button type="submit" class="btn-checkout">
                            Checkout <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h3 class="mt-3">Keranjang Kosong</h3>
            <a href="{{ route('home') }}" class="btn btn-success mt-3">Mulai Sewa Sekarang</a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputHitung = document.querySelectorAll('.input-hitung');
    const tglMulai = document.querySelector('[name=tanggal_mulai]');
    const tglSelesai = document.querySelector('[name=tanggal_selesai]');
    const previewContainer = document.getElementById('previewContainer');
    const previewKtp = document.getElementById('previewKtp');
    const inputFoto = document.querySelector('[name=ktp_foto]');

    const ONGKIR_PERSEN = 0.10;
    let pakai_ongkir = false;

    function hitungTotal() {
        let subtotalBarang = 0;
        let durasiHari = 0;

        // 1. Hitung Selisih Hari
        if (tglMulai.value && tglSelesai.value) {
            const start = new Date(tglMulai.value);
            const end = new Date(tglSelesai.value);

            if (end > start) {
                const diffTime = Math.abs(end - start);
                durasiHari = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            }
        }

        // 2. Hitung Total per Item
        document.querySelectorAll('.cart-item').forEach(row => {
            const harga = parseFloat(row.dataset.harga);
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            const subtotalItem = harga * qty;

            // Update teks subtotal di tabel (per hari)
            row.querySelector('.item-subtotal').textContent = 'Rp ' + subtotalItem.toLocaleString('id-ID');

            subtotalBarang += (subtotalItem * (durasiHari > 0 ? durasiHari : 1));
        });

        // 3. Tambah ongkir 10% dari harga satuan per jenis barang (bukan dikali qty/durasi)
        let totalOngkir = 0;
        if (pakai_ongkir) {
            document.querySelectorAll('.cart-item').forEach(row => {
                const harga = parseFloat(row.dataset.harga);
                totalOngkir += Math.round(harga * ONGKIR_PERSEN);
            });
        }
        const grandTotal = subtotalBarang + totalOngkir;

        // 4. Update Display
        const rowOngkir = document.getElementById('rowOngkir');
        const infoOngkirTotal = document.getElementById('infoOngkirTotal');

        if (durasiHari > 0) {
            document.getElementById('textDurasi').textContent = durasiHari;
            if (pakai_ongkir) {
                rowOngkir.textContent = 'Ongkos kirim (10%/jenis): Rp ' + totalOngkir.toLocaleString('id-ID');
                rowOngkir.style.display = 'block';
            } else {
                rowOngkir.style.display = 'none';
            }
            document.getElementById('totalEstimasi').textContent = 'Total Akhir: Rp ' + grandTotal.toLocaleString('id-ID');
            document.getElementById('estimasi').style.display = 'block';
        } else {
            document.getElementById('estimasi').style.display = 'none';
        }

        if (pakai_ongkir) {
            infoOngkirTotal.textContent = 'Sudah termasuk ongkir 10%/jenis (Rp ' + totalOngkir.toLocaleString('id-ID') + ')';
            infoOngkirTotal.style.display = 'block';
        } else {
            infoOngkirTotal.style.display = 'none';
        }
        document.getElementById('grandTotalDisplay').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
    }

    // Event Listener untuk setiap perubahan input
    inputHitung.forEach(el => el.addEventListener('input', hitungTotal));

    // Preview Foto KTP
    inputFoto.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewKtp.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Toggle Alamat Pengiriman
    window.toggleAlamat = function(input) {
        const boxAlamat = document.getElementById('box-alamat');
        const inputAlamat = document.getElementById('inputAlamat');
        const tampil = input.value === 'kirim';
        boxAlamat.style.display = tampil ? 'block' : 'none';
        inputAlamat.required = tampil;
        pakai_ongkir = tampil;
        hitungTotal();
    };

    // Jalankan hitung total saat pertama kali load
    hitungTotal();
});
</script>
@endpush