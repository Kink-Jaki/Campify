<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Campify</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --forest-dark: #1b4332;
            --forest-medium: #2d6a4f;
            --forest-light: #40916c;
            --nature-accent: #d8f3dc;
            --cream: #fefae0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, rgba(27, 67, 50, 0.85), rgba(45, 106, 79, 0.9)), 
                        url('https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80&w=2000') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: none;
            box-shadow: 0 25px 50px rgba(27, 67, 50, 0.25);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Login Header */
        .login-header {
            background: linear-gradient(135deg, var(--forest-dark), var(--forest-medium));
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
        }

        .brand-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
            display: block;
            position: relative;
            z-index: 1;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .login-title {
            font-weight: 800;
            font-size: 1.75rem;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .login-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        /* Card Body */
        .card-body {
            padding: 32px;
        }

        /* Alert */
        .alert-success-custom {
            background: linear-gradient(135deg, var(--nature-accent), #f0fff4);
            border: none;
            border-radius: 12px;
            color: var(--forest-dark);
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success-custom i {
            font-size: 1.2rem;
            color: var(--forest-medium);
        }

        /* Form Styling */
        .form-group-custom {
            margin-bottom: 20px;
        }

        .form-label-custom {
            font-weight: 600;
            color: #2d3748;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-size: 1.1rem;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .form-control-custom {
            width: 100%;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 16px 14px 48px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8faf9;
        }

        .form-control-custom:focus {
            border-color: var(--forest-medium);
            background: white;
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
            outline: none;
        }

        .form-control-custom:focus + .input-icon,
        .input-group-custom:focus-within .input-icon {
            color: var(--forest-medium);
        }

        .form-control-custom.is-invalid {
            border-color: #fc8181;
            background: #fff5f5;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #718096;
            cursor: pointer;
            font-size: 1.1rem;
            z-index: 10;
            transition: color 0.3s ease;
            padding: 0;
        }

        .password-toggle:hover {
            color: var(--forest-medium);
        }

        /* Error Message */
        .error-message {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Forgot Password */
        .forgot-link {
            color: var(--forest-medium);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--forest-dark);
            text-decoration: underline;
        }

        /* Checkbox */
        .form-check-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .form-check-input-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            accent-color: var(--forest-medium);
        }

        .form-check-input-custom:checked {
            background-color: var(--forest-medium);
            border-color: var(--forest-medium);
        }

        .form-check-label-custom {
            font-size: 0.9rem;
            color: #4a5568;
            cursor: pointer;
            user-select: none;
        }

        /* Button Login */
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--forest-medium), var(--forest-light));
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(45, 106, 79, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Register Link */
        .register-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .register-text {
            font-size: 0.9rem;
            color: #718096;
        }

        .register-link {
            color: var(--forest-medium);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            color: var(--forest-dark);
            text-decoration: underline;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
            color: #a0aec0;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #718096;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .back-link:hover {
            color: var(--forest-medium);
            background: #f0fff4;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                border-radius: 20px;
            }
            
            .login-header {
                padding: 30px 20px;
            }
            
            .card-body {
                padding: 24px;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <span class="brand-icon">🏕️</span>
            <h4 class="login-title">Selamat Datang</h4>
            <p class="login-subtitle">Masuk ke akun Campify Anda</p>
        </div>
        
        <div class="card-body">
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert-success-custom" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group-custom">
                    <label for="email" class="form-label-custom">
                        <i class="bi bi-envelope"></i>
                        Alamat Email
                    </label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope input-icon"></i>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               class="form-control-custom @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username" 
                               placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group-custom">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label for="password" class="form-label-custom mb-0">
                            <i class="bi bi-lock"></i>
                            Password
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
                        @endif
                    </div>
                    <div class="input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               class="form-control-custom @error('password') is-invalid @enderror" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check-custom">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="form-check-input-custom" 
                           name="remember">
                    <label for="remember_me" class="form-check-label-custom">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk Sekarang
                </button>

                <!-- Register Link -->
                <div class="register-section">
                    <span class="register-text">Belum punya akun? </span>
                    <a href="{{ route('register') }}" class="register-link">Daftar Sekarang</a>
                </div>

                <!-- Divider -->
                <div class="divider">atau</div>

                <!-- Back Link -->
                <div class="text-center">
                    <a href="{{ route('home') }}" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Katalog
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>

</body>
</html>