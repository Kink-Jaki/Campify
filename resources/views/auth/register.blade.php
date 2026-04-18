<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - CampRent</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css untuk efek halus -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body {
            /* Latar belakang alam dengan overlay gelap */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80&w=2000') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 500px;
            width: 90%;
        }

        .register-header {
            background-color: #198754; /* Success Green */
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }

        .brand-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            color: #6c757d;
            border-right: none;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
            background-color: #fff;
        }

        .btn-success {
            border-radius: 0.75rem;
            padding: 0.8rem;
            font-weight: 600;
            background-color: #198754;
            border: none;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .text-success {
            color: #198754 !important;
        }

        hr {
            border-top: 1px solid #dee2e6;
            margin: 2rem 0;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .register-header { padding: 1.5rem; }
            .card-body { padding: 1.5rem !important; }
        }
    </style>
</head>
<body>

    <div class="register-card animate__animated animate__zoomIn">
        <!-- Bagian Atas / Header -->
        <div class="register-header">
            <span class="brand-icon">🏕️</span>
            <h4 class="fw-bold mb-0">Petualangan Dimulai</h4>
            <p class="small opacity-75 mb-0">Daftar sekarang untuk mulai menyewa alat camping</p>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold text-secondary">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" name="name" 
                               class="form-control rounded-end-3 @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" required autofocus placeholder="Masukkan nama Anda">
                    </div>
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-secondary">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" name="email" 
                               class="form-control rounded-end-3 @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required placeholder="email@contoh.com">
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-secondary">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" name="password" 
                               class="form-control rounded-end-3 @error('password') is-invalid @enderror" 
                               required placeholder="Min. 8 karakter">
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold text-secondary">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3"><i class="bi bi-shield-check"></i></span>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               class="form-control rounded-end-3" 
                               required placeholder="Ulangi kata sandi">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success shadow-sm">
                        Buat Akun Sekarang
                    </button>
                </div>

                <!-- Tautan Bawah -->
                <div class="text-center">
                    <p class="small text-muted mb-0">Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none border-bottom border-success">Masuk di sini</a>
                    </p>
                    <hr class="opacity-25">
                    <a href="{{ route('home') }}" class="text-muted small text-decoration-none hover-link">
                        <i class="bi bi-arrow-left"></i> Kembali ke Katalog
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>