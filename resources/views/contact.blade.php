<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - SUPERFIT GYM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-dark text-white min-vh-100 d-flex flex-column justify-content-between">

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
                        <a class="nav-link" href="/">Home</a>
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
                        <a class="nav-link active" href="/contact">Contact</a>
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

    <!-- BANNER JUDUL CONTACT (Disamakan ukurannya dengan Halaman About) -->
    <section class="py-5 bg-black text-center border-bottom border-secondary">
        <div class="container py-3">
            <h1 class="display-4 fw-bold text-uppercase">Hubungi <span class="text-danger">Kami</span></h1>
            <p class="lead text-secondary mb-0">Punya pertanyaan? Kami siap membantu memberikan informasi untukmu.</p>
        </div>
    </section>

    <!-- SECTION KARTU KONTAK (WHATSAPP & INSTAGRAM) -->
    <section class="py-5">
        <div class="container py-3">
            <div class="row g-4 justify-content-center">
                
                <!-- CARD WHATSAPP -->
                <div class="col-md-5 col-lg-4">
                    <div class="card bg-black text-white border border-secondary rounded-4 p-4 text-center shadow h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="mb-3">
                                <img src="{{ asset('assets/image/logowa.png') }}" alt="Logo WhatsApp" height="50">
                            </div>
                            <h4 class="fw-bold mb-2">WhatsApp</h4>
                            <p class="fs-5 fw-semibold text-light mb-4">+62 878-3898-2811</p>
                        </div>
                        <a href="https://wa.me/6287838982811?text=Halo%20Admin%20Superfit%20Gym,%20saya%20ingin%20bertanya" target="_blank" class="btn btn-success fw-bold w-100 py-2">
                            Chat WhatsApp
                        </a>
                    </div>
                </div>

                <!-- CARD INSTAGRAM -->
                <div class="col-md-5 col-lg-4">
                    <div class="card bg-black text-white border border-secondary rounded-4 p-4 text-center shadow h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="mb-3">
                                <img src="{{ asset('assets/image/logoig.png') }}" alt="Logo Instagram" height="50">
                            </div>
                            <h4 class="fw-bold mb-2">Instagram</h4>
                            <p class="fs-5 fw-semibold text-light mb-4">@superfit.jebres</p>
                        </div>
                        <a href="https://instagram.com/superfit.jebres" target="_blank" class="btn btn-outline-danger fw-bold w-100 py-2">
                            Kunjungi Instagram
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION CALL TO ACTION (SIAP UNTUK MULAI LATIHAN?) -->
    <section class="py-5 bg-black text-center border-top border-secondary">
        <div class="container py-3">
            <h2 class="fw-bold text-uppercase mb-2">Siap Untuk <span class="text-danger">Mulai Latihan?</span></h2>
            <p class="text-secondary mb-4">Hubungi SUPERFIT GYM sekarang dan mulai perjalanan kebugaranmu.</p>
            <a href="https://wa.me/6287838982811?text=Halo%20Admin%20Superfit%20Gym,%20saya%20siap%20mulai%20latihan!" target="_blank" class="btn btn-danger btn-lg px-5 py-2 fw-bold">
                Hubungi Kami
            </a>
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