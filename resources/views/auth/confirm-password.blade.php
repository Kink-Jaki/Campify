<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - CampRent</title>
    
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 450px;
            width: 90%;
        }
        .forgot-header {
            background-color: #198754;
            padding: 2rem;
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
    </style>
</head>
<body>

    <div class="forgot-card animate__animated animate__fadeInUp">
        <div class="forgot-header">
            <span class="brand-icon">🔑</span>
            <h4 class="fw-bold mb-0">Atur Ulang Kata Sandi</h4>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <div class="mb-4 text-center">
                <p class="text-muted small">
                    Lupa kata sandi Anda? Tidak masalah. Beritahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success border-0 small mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-envelope text-muted"></i></span>
                        <input id="email" type="email" name="email" 
                               class="form-control border-start-0 rounded-end-3 @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required autofocus
                               placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success shadow-sm">
                        Kirim Tautan Reset Password
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-muted small text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>