<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - CampRent</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body {
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
        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 480px;
            width: 90%;
        }
        .reset-header {
            background-color: #198754;
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }
        .brand-icon {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }
        .btn-success {
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: 600;
            background-color: #198754;
            border: none;
            transition: all 0.3s;
        }
        .btn-success:hover {
            background-color: #146c43;
            transform: translateY(-2px);
        }
        .form-label {
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }
    </style>
</head>
<body>

    <div class="reset-card animate__animated animate__fadeIn">
        <div class="reset-header">
            <span class="brand-icon">🔄</span>
            <h4 class="fw-bold mb-0">Kata Sandi Baru</h4>
            <p class="small opacity-75 mb-0">Silakan tentukan kata sandi baru Anda</p>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold text-secondary">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-envelope text-muted"></i></span>
                        <input id="email" type="email" name="email" 
                               class="form-control border-start-0 rounded-end-3 @error('email') is-invalid @enderror" 
                               value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                               placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-secondary">Kata Sandi Baru</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-lock text-muted"></i></span>
                        <input id="password" type="password" name="password" 
                               class="form-control border-start-0 rounded-end-3 @error('password') is-invalid @enderror" 
                               required autocomplete="new-password"
                               placeholder="Min. 8 karakter">
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold text-secondary">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-shield-check text-muted"></i></span>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               class="form-control border-start-0 rounded-end-3" 
                               required autocomplete="new-password"
                               placeholder="Ulangi kata sandi baru">
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success shadow-sm">
                        Simpan Kata Sandi Baru
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-muted small text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>