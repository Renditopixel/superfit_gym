<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SUPERFIT GYM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons untuk Ikon Mata -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-dark text-white d-flex align-items-center py-5 min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card bg-black text-white border border-secondary p-4 rounded-4 shadow-lg">
                    <div class="text-center mb-4">
                        <a href="/" class="text-decoration-none">
                            <h2 class="fw-bold text-danger">SUPERFIT <span class="text-white">GYM</span></h2>
                        </a>
                        <p class="text-secondary small mb-0">Masuk ke akun kamu untuk melanjutkan</p>
                    </div>

                    <!-- Notifikasi Tambahan dari Halaman Membership -->
                    @if(request('alert') == 'silakan_login')
                        <div class="alert alert-warning py-2 small mb-3 text-center">
                            <strong>Perhatian!</strong> Silakan login terlebih dahulu. Jika belum punya akun, klik <strong>Daftar Akun Baru</strong> di bawah.
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success py-2 small mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-3 small">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-secondary">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control bg-dark text-white border-secondary" required autofocus placeholder="nama@email.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-secondary">Password</label>
                            <div class="input-group">
                                <input type="password" id="loginPassword" name="password" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan password">
                                <button class="btn btn-outline-secondary border-secondary text-secondary" type="button" id="toggleLoginPassword">
                                    <i class="bi bi-eye-slash" id="loginEyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input bg-dark border-secondary" id="remember_me">
                                <label class="form-check-label small text-secondary" for="remember_me">Ingat Saya</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 fw-bold py-2">LOG IN</button>
                    </form>

                    <p class="text-center text-secondary small mt-4 mb-0">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-danger text-decoration-none fw-bold">Daftar Akun Baru</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        const toggleLoginPassword = document.getElementById('toggleLoginPassword');
        const loginPassword = document.getElementById('loginPassword');
        const loginEyeIcon = document.getElementById('loginEyeIcon');

        toggleLoginPassword.addEventListener('click', function () {
            const type = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPassword.setAttribute('type', type);
            
            loginEyeIcon.classList.toggle('bi-eye');
            loginEyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>