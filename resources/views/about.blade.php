<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SUPERFIT GYM</title>

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
                        <a class="nav-link active" href="/about">About</a>
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

                <!-- TOMBOL PINTAR AKUN / LOGIN (DISAMAKAN PERSIS DENGAN HOME) -->
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

    <!-- BANNER HALAMAN ABOUT -->
    <section class="py-5 bg-black text-center border-bottom border-secondary">
        <div class="container py-3">
            <h1 class="display-4 fw-bold text-uppercase">Tentang <span class="text-danger">Kami</span></h1>
            <p class="lead text-secondary mb-0">Mengenal lebih dekat SUPERFIT GYM dan komitmen kami untuk kesehatan Anda.</p>
        </div>
    </section>

    <!-- PROFIL GYM & FOTO -->
    <section class="py-5">
        <div class="container py-3">
            <div class="row align-items-center g-5">
                <!-- Kolom Foto (Terdiri dari 2 Foto) -->
                <div class="col-lg-6">
                    <img src="{{ asset('assets/image/bggym.jpg') }}" alt="Superfit Gym Interior" class="img-fluid rounded-4 shadow border border-secondary mb-3">
                    <img src="{{ asset('assets/image/fotogym1.png') }}" alt="Suasana Latihan Superfit Gym" class="img-fluid rounded-4 shadow border border-secondary">
                </div>

                <!-- Kolom Teks / Deskripsi -->
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Selamat Datang di <span class="text-danger">SUPERFIT GYM</span></h2>
                    <p class="text-light fs-5">
                        SUPERFIT GYM merupakan pusat kebugaran yang berlokasi di Jebres, Solo, yang hadir untuk membantu masyarakat menjalani gaya hidup yang lebih sehat dan aktif.
                    </p>
                    <p class="text-secondary">
                        Kami menyediakan tempat latihan yang nyaman serta berbagai fasilitas fitness untuk mendukung berbagai kebutuhan olahraga, mulai dari latihan kekuatan, pembentukan otot, hingga meningkatkan kebugaran tubuh.
                    </p>
                    <p class="text-secondary">
                        Baik pemula maupun yang sudah berpengalaman, SUPERFIT GYM menjadi tempat untuk berlatih, berkembang, dan mencapai target kebugaran secara konsisten.
                    </p>
                    
                    <!-- TOMBOL GOOGLE MAPS -->
                    <div class="mt-4">
                        <a href="https://maps.app.goo.gl/H73aNjgHG6ShPUrS8" target="_blank" class="btn btn-danger fw-bold px-4 py-2">
                            📍 Lihat Lokasi di Google Maps
                        </a>
                    </div>

                    <div class="row mt-4 g-3 text-center">
                        <div class="col-4">
                            <div class="p-3 bg-black rounded-3 border border-secondary">
                                <h3 class="fw-bold text-danger mb-0">700+</h3>
                                <small class="text-secondary">Member Aktif</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-black rounded-3 border border-secondary">
                                <h3 class="fw-bold text-danger mb-0">15+</h3>
                                <small class="text-secondary">Trainer Profesional</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-black rounded-3 border border-secondary">
                                <h3 class="fw-bold text-danger mb-0">100%</h3>
                                <small class="text-secondary">Fasilitas Standar</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section class="py-5 bg-black">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase">Visi & <span class="text-danger">Misi</span></h2>
                <p class="text-secondary">Pijakan kami dalam memberikan layanan kebugaran terbaik.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 bg-dark rounded-4 h-100 border border-secondary shadow">
                        <div class="fs-1 text-danger mb-3">🎯</div>
                        <h3 class="fw-bold mb-3">Visi Kami</h3>
                        <p class="text-light">
                            Menjadi pusat kebugaran terdepan dan terpercaya yang menginspirasi masyarakat untuk mengadopsi gaya hidup sehat, aktif, dan berkelanjutan.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-dark rounded-4 h-100 border border-secondary shadow">
                        <div class="fs-1 text-danger mb-3">🚀</div>
                        <h3 class="fw-bold mb-3">Misi Kami</h3>
                        <ul class="text-light ps-3 mb-0">
                            <li class="mb-2">Menyediakan fasilitas dan alat latihan modern berkualitas tinggi.</li>
                            <li class="mb-2">Menyediakan bimbingan personal trainer yang ramah dan tersertifikasi.</li>
                            <li class="mb-2">Menciptakan lingkungan gym yang nyaman dan suportif bagi semua kalangan.</li>
                        </ul>
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