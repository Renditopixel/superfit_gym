<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member - SUPERFIT GYM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white min-vh-100">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary px-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger fs-3 d-flex align-items-center" href="/">
                <img src="{{ asset('assets/image/logosuperfit.png') }}" alt="Logo Superfit Gym" height="35" class="me-2 d-inline-block align-text-top">
                <span>SUPERFIT <span class="text-white">GYM</span></span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('member.tagihan') }}" class="btn btn-outline-danger btn-sm fw-bold">Tagihan Saya</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <!-- NOTIFIKASI SUKSES -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- WELCOME BANNER & STATUS MEMBERSHIP -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card bg-black text-white border border-secondary rounded-4 p-4 shadow h-100 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge bg-danger mb-2">Member Area</span>
                        <h2 class="fw-bold">Selamat Datang, <span class="text-danger">{{ $user->name }}</span>!</h2>
                        <p class="text-secondary small">Pantau status keanggotaan dan perkembangan fisik kamu di sini.</p>
                    </div>

                    <!-- KARTU STATUS MEMBERSHIP AKTIF -->
                    <div class="p-3 bg-dark rounded-3 border border-secondary mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-secondary d-block">Status Membership</small>
                                @if($activeSubscription && $activeSubscription->status === 'paid')
                                    <span class="badge bg-success fs-6 mt-1">AKTIF</span>
                                    <p class="mb-0 mt-2 small text-white">
                                        Paket: <strong>{{ $activeSubscription->package_name }}</strong><br>
                                        <span class="text-secondary">Disetujui Tanggal: {{ \Carbon\Carbon::parse($activeSubscription->paid_at)->format('d M Y') }}</span>
                                    </p>
                                @elseif($activeSubscription && $activeSubscription->status === 'waiting')
                                    <span class="badge bg-info text-dark fs-6 mt-1">MENUNGGU VERIFIKASI ADMIN</span>
                                    <p class="mb-0 mt-2 small text-secondary">
                                        Bukti pembayaran telah terkirim. Mohon tunggu verifikasi dari admin.
                                    </p>
                                @else
                                    <span class="badge bg-warning text-dark fs-6 mt-1">BELUM AKTIF / TIDAK ADA PAKET</span>
                                    <p class="mb-0 mt-2 small text-secondary">
                                        Kamu belum memiliki paket aktif. Silakan pilih paket di menu <a href="{{ url('/#paket') }}" class="text-danger fw-bold">Membership</a>.
                                    </p>
                                @endif
                            </div>
                            <div>
                                @if(!$activeSubscription)
                                    <a href="{{ url('/#paket') }}" class="btn btn-danger btn-sm fw-bold">Pilih Paket</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU PROFIL FISIK & BMI -->
            <div class="col-lg-4">
                <div class="card bg-black text-white border border-secondary rounded-4 p-4 shadow h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-danger mb-0">Profil Fisik (BMI)</h5>
                        <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            Edit TB/BB
                        </button>
                    </div>

                    <div class="row text-center mb-3 g-2">
                        <div class="col-6">
                            <div class="p-2 bg-dark rounded-3 border border-secondary">
                                <small class="text-secondary d-block">Tinggi Badan</small>
                                <span class="fs-4 fw-bold text-white">{{ $user->height ?? '-' }}</span> <small>cm</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-dark rounded-3 border border-secondary">
                                <small class="text-secondary d-block">Berat Badan</small>
                                <span class="fs-4 fw-bold text-white">{{ $user->weight ?? '-' }}</span> <small>kg</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-dark rounded-3 text-center border border-secondary">
                        <small class="text-secondary d-block">Indeks Massa Tubuh (BMI)</small>
                        <h3 class="fw-bold text-white my-1">{{ $user->bmi }}</h3>
                        <span class="badge {{ $user->bmi_status['badge'] }} px-3 py-2 fs-6">
                            {{ $user->bmi_status['label'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- MODAL EDIT PROFIL FISIK -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-black text-white border border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-danger fw-bold">Update Data Fisik</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="height" class="form-control bg-dark text-white border-secondary" value="{{ old('height', $user->height) }}" required placeholder="Contoh: 170">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="weight" class="form-control bg-dark text-white border-secondary" value="{{ old('weight', $user->weight) }}" required placeholder="Contoh: 65">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary">No. Whatsapp / HP</label>
                            <input type="text" name="phone" class="form-control bg-dark text-white border-secondary" value="{{ old('phone', $user->phone) }}" placeholder="08123456789">
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-sm fw-bold">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>