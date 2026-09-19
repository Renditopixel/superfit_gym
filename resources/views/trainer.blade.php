<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Trainer - SUPERFIT GYM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-dark text-white">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger fs-3 d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('assets/image/logosuperfit.png') }}" alt="Logo Superfit Gym" height="35" class="me-2 d-inline-block align-text-top">
                <span>SUPERFIT <span class="text-white">GYM</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('membership') }}">Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('trainer') }}">Trainer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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

    <!-- HEADER SECTION -->
    <section class="py-5 bg-black text-center border-bottom border-secondary">
        <div class="container py-3">
            <h1 class="display-4 fw-bold text-uppercase">Pelatih <span class="text-danger">Profesional</span></h1>
            <p class="lead text-secondary mb-0">Dampingi perjalanan fitness kamu bersama personal trainer tersertifikasi.</p>
        </div>
    </section>

    <!-- TRAINER LIST SECTION -->
    <section class="py-5">
        <div class="container py-3">
            <div class="row g-4">
                
                <!-- TRAINER 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card bg-black text-white border border-secondary rounded-4 overflow-hidden h-100 shadow">
                        <img src="https://images.unsplash.com/photo-1567013127542-490d757e51fc?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Alex Rivera" style="height: 320px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <span class="badge bg-danger mb-2">Bodybuilding & Strength</span>
                            <h3 class="card-title fw-bold">Yuda Wisnu</h3>
                            <p class="text-secondary small">Pengalaman: 6+ Tahun</p>
                            <p class="card-text text-light">Spesialis pembentukan otot, pembakaran lemak ekstrem, dan teknik angkat beban tingkat lanjut.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-danger w-100 mt-2 fw-bold">Konsultasi Latihan</a>
                        </div>
                    </div>
                </div>

                <!-- TRAINER 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card bg-black text-white border border-secondary rounded-4 overflow-hidden h-100 shadow">
                        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Sarah Jenkins" style="height: 320px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <span class="badge bg-danger mb-2">Weight Loss & Cardio</span>
                            <h3 class="card-title fw-bold">Angela Fortuna</h3>
                            <p class="text-secondary small">Pengalaman: 4+ Tahun</p>
                            <p class="card-text text-light">Fokus pada program penurunan berat badan, HIIT, ketahanan fisik, serta manajemen pola makan sehat.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-danger w-100 mt-2 fw-bold">Konsultasi Latihan</a>
                        </div>
                    </div>
                </div>

                <!-- TRAINER 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card bg-black text-white border border-secondary rounded-4 overflow-hidden h-100 shadow">
                        <img src="{{ asset('assets/image/rendy.png') }}" class="card-img-top" alt="Rendy" style="height: 320px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <span class="badge bg-danger mb-2">Calisthenics & Mobility</span>
                            <h3 class="card-title fw-bold">Rendy</h3>
                            <p class="text-secondary small">Pengalaman: 5+ Tahun</p>
                            <p class="card-text text-light">Spesialis olah tubuh beban jasmani, kelenturan sendi, perbaikan postur, dan rehabilitasi stamina.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-danger w-100 mt-2 fw-bold">Konsultasi Latihan</a>
                        </div>
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