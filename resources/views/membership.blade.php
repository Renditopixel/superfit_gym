<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Paket - SUPERFIT GYM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .card-paket {
            background-color: #000000;
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            transition: transform 0.2s, border-color 0.2s;
        }
        .card-paket:hover {
            border-color: #dc3545;
        }
        .card-paket.highlight {
            border: 2px solid #dc3545;
        }
        .price-box {
            background-color: #1e242b;
            border-radius: 8px;
            padding: 8px;
        }
    </style>
</head>

<body class="bg-dark text-white d-flex flex-column min-vh-100">

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
                        <a class="nav-link active" href="{{ route('membership') }}">Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trainer') }}">Trainer</a>
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

    <!-- BANNER HALAMAN MEMBERSHIP -->
    <section class="py-5 bg-black text-center border-bottom border-secondary">
        <div class="container py-3">
            <h1 class="display-4 fw-bold text-uppercase">PAKET <span class="text-danger">MEMBERSHIP</span></h1>
            <p class="lead text-secondary mb-0">Pilih paket latihan yang sesuai dengan kebutuhan fitness Anda.</p>
        </div>
    </section>

    <!-- DAFTAR PAKET MEMBERSHIP -->
    <section class="py-5 my-auto">
        <div class="container py-3">
            <div class="row g-4 justify-content-center">

                <!-- PAKET 1 BULAN -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-paket p-4 h-100 text-center d-flex flex-column">
                        <h3 class="fw-bold fs-3 text-white">1 BULAN</h3>
                        <p class="text-secondary small mb-3">Paket Bulanan</p>
                        
                        <div class="price-box mb-2">
                            <small class="text-secondary d-block">UMUM</small>
                            <span class="fw-bold fs-4 text-danger">IDR 150K</span>
                        </div>

                        <div class="price-box mb-4">
                            <small class="text-secondary d-block">PELAJAR *S&K</small>
                            <span class="fw-bold fs-4 text-warning">IDR 135K</span>
                        </div>

                        <ul class="list-unstyled text-start small mb-4 text-light">
                            <li class="mb-2">✔ Akses seluruh peralatan gym</li>
                            <li class="mb-2">✔ Akses locker room & shower</li>
                            <li class="mb-2">✔ Free Wi-Fi</li>
                        </ul>

                        <div class="mt-auto d-flex gap-2">
                            @auth
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 1 Bulan">
                                    <input type="hidden" name="category" value="Umum">
                                    <input type="hidden" name="amount" value="150000">
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-bold">Pilih Umum</button>
                                </form>
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 1 Bulan">
                                    <input type="hidden" name="category" value="Pelajar">
                                    <input type="hidden" name="amount" value="135000">
                                    <button type="submit" class="btn btn-outline-warning btn-sm w-100 fw-bold">Pilih Pelajar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger w-100 fw-bold btn-sm py-2">Login untuk Pilih</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- PAKET 3 BULAN -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-paket p-4 h-100 text-center d-flex flex-column">
                        <h3 class="fw-bold fs-3 text-white">3 BULAN</h3>
                        <p class="text-secondary small mb-3">Paket Triwulan</p>

                        <div class="price-box mb-2">
                            <small class="text-secondary d-block">UMUM</small>
                            <span class="fw-bold fs-4 text-danger">IDR 400K</span>
                        </div>

                        <div class="price-box mb-4">
                            <small class="text-secondary d-block">PELAJAR *S&K</small>
                            <span class="fw-bold fs-4 text-warning">IDR 360K</span>
                        </div>

                        <ul class="list-unstyled text-start small mb-4 text-light">
                            <li class="mb-2">✔ Akses seluruh peralatan gym</li>
                            <li class="mb-2">✔ Akses locker room & shower</li>
                            <li class="mb-2">✔ Free Wi-Fi</li>
                        </ul>

                        <div class="mt-auto d-flex gap-2">
                            @auth
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 3 Bulan">
                                    <input type="hidden" name="category" value="Umum">
                                    <input type="hidden" name="amount" value="400000">
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-bold">Pilih Umum</button>
                                </form>
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 3 Bulan">
                                    <input type="hidden" name="category" value="Pelajar">
                                    <input type="hidden" name="amount" value="360000">
                                    <button type="submit" class="btn btn-outline-warning btn-sm w-100 fw-bold">Pilih Pelajar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger w-100 fw-bold btn-sm py-2">Login untuk Pilih</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- PAKET 6 BULAN (HEMAT) -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-paket highlight p-4 h-100 text-center d-flex flex-column position-relative">
                        <span class="position-absolute top-0 start-50 translate-middle badge bg-danger px-3 py-1 fw-bold">HEMAT</span>
                        <h3 class="fw-bold fs-3 text-white mt-2">6 BULAN</h3>
                        <p class="text-secondary small mb-3">Paket Semester</p>

                        <div class="price-box mb-2">
                            <small class="text-secondary d-block">UMUM</small>
                            <span class="fw-bold fs-4 text-danger">IDR 700K</span>
                        </div>

                        <div class="price-box mb-4">
                            <small class="text-secondary d-block">PELAJAR *S&K</small>
                            <span class="fw-bold fs-4 text-warning">IDR 630K</span>
                        </div>

                        <ul class="list-unstyled text-start small mb-4 text-light">
                            <li class="mb-2">✔ Akses seluruh peralatan gym</li>
                            <li class="mb-2">✔ Akses locker room & shower</li>
                            <li class="mb-2">✔ Free Wi-Fi</li>
                        </ul>

                        <div class="mt-auto d-flex gap-2">
                            @auth
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 6 Bulan">
                                    <input type="hidden" name="category" value="Umum">
                                    <input type="hidden" name="amount" value="700000">
                                    <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">Pilih Umum</button>
                                </form>
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 6 Bulan">
                                    <input type="hidden" name="category" value="Pelajar">
                                    <input type="hidden" name="amount" value="630000">
                                    <button type="submit" class="btn btn-warning btn-sm w-100 fw-bold text-dark">Pilih Pelajar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger w-100 fw-bold btn-sm py-2">Login untuk Pilih</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- PAKET 1 TAHUN -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-paket p-4 h-100 text-center d-flex flex-column">
                        <h3 class="fw-bold fs-3 text-white">1 TAHUN</h3>
                        <p class="text-secondary small mb-3">Paket Tahunan</p>

                        <div class="price-box mb-2">
                            <small class="text-secondary d-block">UMUM</small>
                            <span class="fw-bold fs-4 text-danger">IDR 1.200K</span>
                        </div>

                        <div class="price-box mb-4">
                            <small class="text-secondary d-block">PELAJAR *S&K</small>
                            <span class="fw-bold fs-4 text-warning">IDR 1.080K</span>
                        </div>

                        <ul class="list-unstyled text-start small mb-4 text-light">
                            <li class="mb-2">✔ Akses seluruh peralatan gym</li>
                            <li class="mb-2">✔ Akses locker room & shower</li>
                            <li class="mb-2">✔ Free Wi-Fi</li>
                        </ul>

                        <div class="mt-auto d-flex gap-2">
                            @auth
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 1 Tahun">
                                    <input type="hidden" name="category" value="Umum">
                                    <input type="hidden" name="amount" value="1200000">
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-bold">Pilih Umum</button>
                                </form>
                                <form action="{{ route('checkout') }}" method="POST" class="w-50">
                                    @csrf
                                    <input type="hidden" name="package_name" value="Paket 1 Tahun">
                                    <input type="hidden" name="category" value="Pelajar">
                                    <input type="hidden" name="amount" value="1080000">
                                    <button type="submit" class="btn btn-outline-warning btn-sm w-100 fw-bold">Pilih Pelajar</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger w-100 fw-bold btn-sm py-2">Login untuk Pilih</a>
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-white text-center py-4 border-top border-secondary mt-auto">
        <p class="mb-0 text-secondary">&copy; 2026 SUPERFIT GYM. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>