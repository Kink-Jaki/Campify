@extends('layouts.admin')
@section('title', 'Tambah Barang')

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

    /* Breadcrumb */
    .breadcrumb-custom {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 16px;
    }

    .breadcrumb-custom a {
        color: var(--warning-gold);
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.3s ease;
    }

    .breadcrumb-custom a:hover {
        opacity: 0.8;
    }

    /* Card Styling */
    .add-card {
        border: none;
        border-radius: 24px;
        background: white;
        box-shadow: 0 10px 40px rgba(27, 67, 50, 0.08);
        overflow: hidden;
    }

    .add-card .card-body {
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

    .form-control-custom.is-invalid, .form-select-custom.is-invalid {
        border-color: #e53e3e;
        background: #fff5f5;
    }

    /* Invalid Feedback */
    .invalid-feedback-custom {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
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

    /* File Upload Area - Modern Drag & Drop */
    .file-upload-area {
        border: 3px dashed #e9ecef;
        border-radius: 20px;
        padding: 48px;
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
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-bottom: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(45, 106, 79, 0.2);
    }

    .file-upload-area:hover .file-upload-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 32px rgba(45, 106, 79, 0.3);
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

    #selected-file-name {
        margin-top: 16px;
        padding: 12px 20px;
        background: white;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--forest-medium);
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Buttons */
    .btn-group-actions {
        display: flex;
        gap: 16px;
        margin-top: 40px;
        padding-top: 32px;
        border-top: 2px solid #f1f3f4;
    }

    .btn-simpan {
        position: relative;
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
        overflow: hidden;
    }

    .btn-simpan::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-simpan:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
        color: var(--forest-dark);
    }

    .btn-simpan:hover::before {
        left: 100%;
    }

    .btn-batal {
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

    .btn-batal:hover {
        border-color: var(--forest-medium);
        color: var(--forest-medium);
        background: var(--nature-accent);
        transform: translateY(-2px);
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
        .page-header {
            padding: 20px;
        }
        
        .add-card .card-body {
            padding: 24px;
        }
        
        .btn-group-actions {
            flex-direction: column;
        }
        
        .btn-simpan, .btn-batal {
            justify-content: center;
        }
        
        .file-upload-area {
            padding: 32px 20px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="breadcrumb-custom">
        <a href="{{ route('admin.barang.index') }}">
            <i class="bi bi-box-seam"></i> Barang
        </a>
        <i class="bi bi-chevron-right" style="font-size: 0.75rem;"></i>
        <span>Tambah Barang</span>
    </div>
    <h4 class="page-title mb-0">
        <span class="page-title-icon">+</span>
        <span>Tambah Barang Baru</span>
    </h4>
</div>

<!-- Form Card -->
<div class="card add-card">
    <div class="card-body">
        <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Section: Informasi Dasar -->
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
                            <input type="text" name="nama_barang" 
                                class="form-control form-control-custom @error('nama_barang') is-invalid @enderror" 
                                value="{{ old('nama_barang') }}" 
                                placeholder="Masukkan nama barang..." required>
                        </div>
                        @error('nama_barang')
                            <div class="invalid-feedback-custom">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">
                            <i class="bi bi-grid-3x3-gap"></i> Kategori
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-folder input-icon"></i>
                            <select name="kategori_id" 
                                class="form-select form-select-custom @error('kategori_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('kategori_id')
                            <div class="invalid-feedback-custom">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Detail Barang -->
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
                            <input type="number" name="stok" 
                                class="form-control form-control-custom" 
                                value="{{ old('stok', 1) }}" 
                                min="0" placeholder="0" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-cash-stack"></i> Harga Sewa per Hari
                        </label>
                        <div class="price-input">
                            <span class="price-prefix">Rp</span>
                            <input type="number" name="harga_sewa_per_hari" 
                                class="form-control form-control-custom" 
                                value="{{ old('harga_sewa_per_hari') }}" 
                                min="0" placeholder="0" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-custom">
                            <i class="bi bi-shield-check"></i> Kondisi Barang
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-activity input-icon"></i>
                            <select name="kondisi" class="form-select form-select-custom" required>
                                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                                    Baik
                                </option>
                                <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>
                                    Rusak
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Deskripsi -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-text-paragraph"></i> Deskripsi
                </div>
                <div class="col-12">
                    <label class="form-label-custom">
                        <i class="bi bi-card-text"></i> Deskripsi Barang
                    </label>
                    <textarea name="deskripsi" 
                        class="form-control form-control-custom" 
                        rows="4" 
                        placeholder="Jelaskan spesifikasi dan detail barang...">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <!-- Section: Foto -->
            <div class="form-section">
                <div class="section-title">
                    <i class="bi bi-image"></i> Foto Barang
                </div>
                <div class="col-12">
                    <label class="form-label-custom">
                        <i class="bi bi-camera"></i> Upload Foto
                    </label>
                    <div class="file-upload-area" onclick="document.getElementById('foto-input').click()">
                        <input type="file" name="foto" id="foto-input" class="file-input-hidden" accept="image/*" onchange="handleFileSelect(this)">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                        <div class="file-upload-text">
                            <p class="mb-1"><strong>Klik untuk upload</strong> atau drag and drop</p>
                            <small class="text-muted">PNG, JPG, JPEG (Maks. 2MB)</small>
                        </div>
                        <div id="selected-file-name" style="display: none;">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span id="file-name-text"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group-actions">
                <button type="submit" class="btn btn-simpan">
                    <i class="bi bi-check-lg"></i>
                    <span>Simpan Barang</span>
                </button>
                <a href="{{ route('admin.barang.index') }}" class="btn btn-batal">
                    <i class="bi bi-arrow-left"></i>
                    <span>Batal & Kembali</span>
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // File upload handler
    function handleFileSelect(input) {
        const fileName = input.files[0]?.name;
        const fileDisplay = document.getElementById('selected-file-name');
        const fileText = document.getElementById('file-name-text');
        const uploadArea = document.querySelector('.file-upload-area');
        
        if (fileName) {
            fileText.textContent = fileName;
            fileDisplay.style.display = 'inline-flex';
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