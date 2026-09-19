<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SUPERFIT GYM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons untuk Ikon Mata -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-dark text-white d-flex align-items-center py-5 min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card bg-black text-white border border-secondary p-4 rounded-4 shadow-lg">
                    <div class="text-center mb-4">
                        <a href="/" class="text-decoration-none">
                            <h2 class="fw-bold text-danger">SUPERFIT <span class="text-white">GYM</span></h2>
                        </a>
                        <p class="text-secondary small mb-0">Daftar member baru dan mulai perjalanan fitnessmu!</p>
                    </div>

                    <!-- Menampilkan Eror Validasi Jika Ada -->
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-3 small">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Email & Phone -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-secondary">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control bg-dark text-white border-secondary" required placeholder="nama@email.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-secondary">No. WhatsApp / HP</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control bg-dark text-white border-secondary" required placeholder="081234567890">
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Jenis Kelamin</label>
                            <select name="gender" class="form-select bg-dark text-white border-secondary" required>
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Tinggi & Berat Badan -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-secondary">Tinggi Badan (cm)</label>
                                <input type="number" step="0.1" name="height" value="{{ old('height') }}" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: 170" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-secondary">Berat Badan (kg)</label>
                                <input type="number" step="0.1" name="weight" value="{{ old('weight') }}" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: 65" required>
                            </div>
                        </div>

                        <!-- Password & Konfirmasi -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-secondary">Password</label>
                                <div class="input-group">
                                    <input type="password" id="regPassword" name="password" class="form-control bg-dark text-white border-secondary" required>
                                    <button class="btn btn-outline-secondary border-secondary text-secondary" type="button" id="toggleRegPassword">
                                        <i class="bi bi-eye-slash" id="regEyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-secondary">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" id="regConfirmPassword" name="password_confirmation" class="form-control bg-dark text-white border-secondary" required>
                                    <button class="btn btn-outline-secondary border-secondary text-secondary" type="button" id="toggleRegConfirmPassword">
                                        <i class="bi bi-eye-slash" id="regConfirmEyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 fw-bold py-2 mt-2">Daftar Sekarang</button>
                    </form>

                    <p class="text-center text-secondary small mt-4 mb-0">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-danger text-decoration-none fw-bold">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Toggle Password -->
    <script>
        // Toggle Password Utama
        const toggleRegPassword = document.getElementById('toggleRegPassword');
        const regPassword = document.getElementById('regPassword');
        const regEyeIcon = document.getElementById('regEyeIcon');

        toggleRegPassword.addEventListener('click', function () {
            const type = regPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            regPassword.setAttribute('type', type);
            regEyeIcon.classList.toggle('bi-eye');
            regEyeIcon.classList.toggle('bi-eye-slash');
        });

        // Toggle Konfirmasi Password
        const toggleRegConfirmPassword = document.getElementById('toggleRegConfirmPassword');
        const regConfirmPassword = document.getElementById('regConfirmPassword');
        const regConfirmEyeIcon = document.getElementById('regConfirmEyeIcon');

        toggleRegConfirmPassword.addEventListener('click', function () {
            const type = regConfirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            regConfirmPassword.setAttribute('type', type);
            regConfirmEyeIcon.classList.toggle('bi-eye');
            regConfirmEyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>