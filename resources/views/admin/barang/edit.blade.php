@extends('layouts.admin')
@section('title', 'Edit Barang')
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
    .page-header {
        background: linear-gradient(135deg, var(--forest-dark) 0%, var(--forest-medium) 100%);
        border-radius: 20px;
        padding: 24px 32px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05));
    }

    .page-title {
        color: white;
        font-weight: 800;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        z-index: 1;
    }

    .page-title-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Card Styling */
    .edit-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.08);
        overflow: hidden;
    }

    .edit-card .card-body {
        padding: 40px;
    }

    /* Form Labels */
    .form-label-custom {
        font-weight: 700;
        color: var(--forest-dark);
        font-size: 0.9rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label-custom i {
        color: var(--forest-medium);
        font-size: 1rem;
    }

    /* Form Controls */
    .form-control-custom, .form-select-custom {
        border: 2px solid #e9ecef;
        border-radius: 14px;
        padding: 14px 18px;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #fafbfc;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        border-color: var(--forest-medium);
        background: white;
        box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        outline: none;
    }

    .form-control-custom:hover, .form-select-custom:hover {
        border-color: var(--forest-light);
    }

    /* Input Groups */
    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--forest-medium);
        font-size: 1.1rem;
    }

    .input-icon-wrapper .form-control-custom,
    .input-icon-wrapper .form-select-custom {
        padding-left: 48px;
    }

    /* Price Input Special */
    .price-input {
        position: relative;
    }

    .price-prefix {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 700;
        color: var(--forest-medium);
        font-size: 0.95rem;
    }

    .price-input .form-control-custom {
        padding-left: 52px;
    }

    /* Textarea */
    textarea.form-control-custom {
        min-height: 120px;
        resize: vertical;
    }

    /* File Upload Area */
    .file-upload-area {
        border: 3px dashed #e9ecef;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        transition: all 0.3s ease;
        background: #fafbfc;
        cursor: pointer;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: var(--forest-medium);
        background: var(--nature-accent);
    }

    .file-upload-area.has-file {
        border-color: var(--forest-medium);
        background: var(--nature-accent);
        border-style: solid;
    }

    .file-upload-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        margin-bottom: 16px;
        transition: transform 0.3s ease;
    }

    .file-upload-area:hover .file-upload-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .file-upload-text {
        color: #6c757d;
        font-weight: 500;
    }

    .file-upload-text strong {
        color: var(--forest-dark);
    }

    .file-input-hidden {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    /* Current Image Preview */
    .current-image-container {
        position: relative;
        display: inline-block;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    .current-image-container img {
        height: 120px;
        width: auto;
        display: block;
    }

    .current-image-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(27, 67, 50, 0.9);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Buttons */
    .btn-group-actions {
        display: flex;
        gap: 16px;
        margin-top: 40px;
        padding-top: 32px;
        border-top: 2px solid #f1f3f4;
    }

    .btn-update {
        background: linear-gradient(135deg, var(--warning-gold), #ff9800);
        border: none;
        color: var(--forest-dark);
        font-weight: 700;
        padding: 14px 32px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
        color: var(--forest-dark);
    }

    .btn-cancel {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        font-weight: 600;
        padding: 14px 32px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-cancel:hover {
        border-color: var(--forest-medium);
        color: var(--forest-medium);
        background: var(--nature-accent);
    }

    /* Section Divider */
    .form-section {
        margin-bottom: 32px;
    }

    .section-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--forest-medium);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--nature-accent), transparent);
    }

    /* Status Badge in Select */
    .status-option {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .status-dot.baik { background: #48bb78; }
    .status-dot.rusak { background: #e53e3e; }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-card .card-body {
            padding: 24px;
        }
        
        .btn-group-actions {
            flex-direction: column;
        }
        
        .btn-update, .btn-cancel {
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h4 class="page-title mb-0">
        <span class="page-title-icon">✏️</span>
        <span>Edit Barang</span>
    </h4>
</div>

<!-- Edit Form Card -->
<div class="card edit-card">
    <div class="card-body">
        <form action="{{ route('admin.barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-info-circle"></i> Informasi Dasar
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-box-seam"></i> Nama Barang
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-tag input-icon"></i>
                            <input type="text" name="nama_barang" class="form-control form-control-custom" 
                                value="{{ old('nama_barang', $barang->nama_barang) }}" 
                                placeholder="Masukkan nama barang" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-grid-3x3-gap"></i> Kategori
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-folder input-icon"></i>
                            <select name="kategori_id" class="form-select form-select-custom" required>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Barang Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-gear"></i> Detail Barang
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-stack"></i> Stok Tersedia
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-boxes input-icon"></i>
                            <input type="number" name="stok" class="form-control form-control-custom" 
                                value="{{ old('stok', $barang->stok) }}" 
                                min="0" placeholder="0" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-cash-stack"></i> Harga Sewa per Hari
                        </label>
                        <div class="price-input">
                            <span class="price-prefix">Rp</span>
                            <input type="number" name="harga_sewa_per_hari" class="form-control form-control-custom" 
                                value="{{ old('harga_sewa_per_hari', $barang->harga_sewa_per_hari) }}" 
                                placeholder="0" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-shield-check"></i> Kondisi Barang
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-activity input-icon"></i>
                            <select name="kondisi" class="form-select form-select-custom" required>
                                <option value="baik" {{ $barang->kondisi == 'baik' ? 'selected' : '' }}>
                                    <span class="status-option">
                                        <span class="status-dot baik"></span> Baik
                                    </span>
                                </option>
                                <option value="rusak" {{ $barang->kondisi == 'rusak' ? 'selected' : '' }}>
                                    <span class="status-option">
                                        <span class="status-dot rusak"></span> Rusak
                                    </span>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-text-paragraph"></i> Deskripsi
                </div>
                <div class="col-12">
                    <label class="form-label-custom">
                        <i class="bi bi-card-text"></i> Deskripsi Barang
                    </label>
                    <textarea name="deskripsi" class="form-control form-control-custom" rows="4" 
                        placeholder="Jelaskan spesifikasi dan detail barang...">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                </div>
            </div>

            <!-- Foto Upload Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-image"></i> Foto Barang
                </div>
                
                <div class="col-12">
                    @if($barang->foto)
                        <label class="form-label-custom mb-3">
                            <i class="bi bi-eye"></i> Foto Saat Ini
                        </label>
                        <div class="mb-4">
                            <div class="current-image-container">
                                <img src="{{ asset('storage/'.$barang->foto) }}" alt="{{ $barang->nama_barang }}">
                                <span class="current-image-badge">
                                    <i class="bi bi-check-circle-fill me-1"></i>Aktif
                                </span>
                            </div>
                        </div>
                    @endif

                    <label class="form-label-custom">
                        <i class="bi bi-cloud-upload"></i> {{ $barang->foto ? 'Ganti Foto' : 'Upload Foto' }}
                    </label>
                    
                    <div class="file-upload-area {{ $barang->foto ? 'has-file' : '' }}" onclick="document.getElementById('foto-input').click()">
                        <input type="file" name="foto" id="foto-input" class="file-input-hidden" accept="image/*" onchange="handleFileSelect(this)">
                        <div class="file-upload-icon">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                        <div class="file-upload-text">
                            <p class="mb-1"><strong>Klik untuk upload</strong> atau drag and drop</p>
                            <small class="text-muted">PNG, JPG, JPEG (Maks. 2MB)</small>
                        </div>
                        <div id="selected-file-name" class="mt-2 fw-bold text-success" style="display: none;">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            <span id="file-name-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group-actions">
                <button type="submit" class="btn btn-update">
                    <i class="bi bi-check-lg"></i>
                    <span>Simpan Perubahan</span>
                </button>
                
                <a href="{{ route('admin.barang.index') }}" class="btn btn-cancel">
                    <i class="bi bi-arrow-left"></i>
                    <span>Batal & Kembali</span>
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Navbar scroll effect (jika ada navbar)
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-custom');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
            } else {
                navbar.style.padding = '1rem 0';
            }
        }
    });

    // File upload handler
    function handleFileSelect(input) {
        const fileName = input.files[0]?.name;
        const fileDisplay = document.getElementById('selected-file-name');
        const fileText = document.getElementById('file-name-text');
        const uploadArea = document.querySelector('.file-upload-area');
        
        if (fileName) {
            fileText.textContent = fileName;
            fileDisplay.style.display = 'block';
            uploadArea.classList.add('has-file');
        } else {
            fileDisplay.style.display = 'none';
            uploadArea.classList.remove('has-file');
        }
    }

    // Drag and drop support
    const uploadArea = document.querySelector('.file-upload-area');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadArea.style.borderColor = 'var(--forest-medium)';
        uploadArea.style.background = 'var(--nature-accent)';
    }

    function unhighlight(e) {
        uploadArea.style.borderColor = '#e9ecef';
        if (!uploadArea.classList.contains('has-file')) {
            uploadArea.style.background = '#fafbfc';
        }
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const fileInput = document.getElementById('foto-input');
        
        fileInput.files = files;
        handleFileSelect(fileInput);
    }
</script>

@endsection