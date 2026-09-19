<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPERFIT GYM - Fitness & Health Center</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger fs-3 d-flex align-items-center" href="/">
                <img src="{{ asset('assets/image/logosuperfit.png') }}" alt="Logo Superfit Gym" height="35" class="me-2 d-inline-block align-text-top">
                <span>SUPERFIT <span class="text-white">GYM</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/membership">Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/trainer">Trainer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>

                <!-- TOMBOL PINTAR AKUN / LOGIN -->
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning fw-bold me-2">Panel Admin</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-light fw-bold me-2">Profil</a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger fw-bold">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger fw-bold px-4">Login</a>
                    @endauth
                </div>

            </div>
        </div> 
    </nav>

    <!-- 1. HERO SECTION -->
    <section class="hero-section d-flex align-items-center text-white text-center border-bottom border-secondary" 
             style="min-height: 85vh; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('assets/image/bggym.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <h1 class="display-3 fw-bold text-uppercase mb-3">Bentuk Tubuh Idealmu <br><span class="text-danger">Mulai Hari Ini</span></h1>
            <p class="lead mb-4 mx-auto style-p" style="max-width: 700px;">
                Fasilitas terlengkap, pelatih profesional, dan komunitas yang siap mendukung target fitness kamu di SUPERFIT GYM.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="/membership" class="btn btn-danger btn-lg px-4 py-2 fw-bold">Daftar Membership</a>
                <a href="/about" class="btn btn-outline-light btn-lg px-4 py-2 fw-bold">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- 2. KEUNGGULAN / FEATURES -->
    <section class="py-5 bg-dark text-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase">Mengapa Memilih <span class="text-danger">Superfit Gym?</span></h2>
                <p class="text-secondary">Kami berikan pelayanan dan fasilitas terbaik untuk latihan maksimal kamu.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card bg-secondary text-white border-0 h-100 p-4 text-center shadow">
                        <div class="fs-1 text-danger mb-3">🏋️‍♂️</div>
                        <h4 class="card-title fw-bold">Peralatan Modern</h4>
                        <p class="card-text text-light">Peralatan standar internasional yang dirawat secara rutin demi keamanan dan kenyamanan latihan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-secondary text-white border-0 h-100 p-4 text-center shadow">
                        <div class="fs-1 text-danger mb-3">👟</div>
                        <h4 class="card-title fw-bold">Trainer Profesional</h4>
                        <p class="card-text text-light">Instruktur berpengalaman dan tersertifikasi siap memandu program latihan personal kamu.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-secondary text-white border-0 h-100 p-4 text-center shadow">
                        <div class="fs-1 text-danger mb-3">⏰</div>
                        <h4 class="card-title fw-bold">Jam Latihan Fleksibel</h4>
                        <p class="card-text text-light">Buka setiap hari mulai pukul 06.00–22.00, sehingga kamu dapat menyesuaikan waktu latihan dengan aktivitas sehari-hari..</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-white text-center py-4 border-top border-secondary">
        <p class="mb-0 text-secondary">&copy; 2026 SUPERFIT GYM. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>