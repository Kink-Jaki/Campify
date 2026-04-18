<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - CampRent</title>
    
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
        .verify-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 500px;
            width: 90%;
        }
        .verify-header {
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
        .btn-success {
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            background-color: #198754;
            border: none;
            transition: all 0.3s;
        }
        .btn-success:hover {
            background-color: #146c43;
            transform: translateY(-2px);
        }
        .btn-link-custom {
            color: #6c757d;
            text-decoration: underline;
            font-size: 0.875rem;
            transition: color 0.3s;
        }
        .btn-link-custom:hover {
            color: #dc3545;
        }
    </style>
</head>
<body>

    <div class="verify-card animate__animated animate__fadeIn">
        <div class="verify-header">
            <span class="brand-icon">📧</span>
            <h4 class="fw-bold mb-0">Verifikasi Email</h4>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <div class="mb-4 text-center">
                <p class="text-muted">
                    Terima kasih telah mendaftar! Sebelum memulai, harap verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan yang baru.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success border-0 small mb-4 animate__animated animate__headShake" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                </div>
            @endif

            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-success shadow-sm w-100">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link btn-link-custom border-0 bg-transparent">
                        Keluar (Log Out)
                    </button>
                </form>
            </div>
            
            <div class="text-center mt-4">
                <hr class="opacity-25">
                <small class="text-muted">Butuh bantuan? Hubungi dukungan teknis kami.</small>
            </div>
        </div>
    </div>

</body>
</html>