<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Saya - SUPERFIT GYM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
               <a href="{{ route('dashboard') }}" class="btn btn-outline-light py-1 px-4 fw-bold">Profil</a>
                <a href="{{ route('member.tagihan') }}" class="btn btn-danger btn-sm fw-bold">Tagihan Saya</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- QRIS CODE CARD -->
            <div class="col-lg-4">
                <div class="card bg-black text-white border border-secondary rounded-4 p-4 text-center shadow">
                    <h5 class="fw-bold text-danger mb-2">Pembayaran Via QRIS</h5>
                    <p class="small text-secondary mb-3">Scan kode QRIS di bawah ini menggunakan aplikasi E-Wallet atau Mobile Banking kamu.</p>
                    
                    <div class="bg-white p-3 rounded-3 d-inline-block mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="180" height="180" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                            <path d="M14 14h3v3h-3z"/><path d="M18 18h3v3h-3z"/><path d="M14 18h2v2h-2z"/><path d="M18 14h2v2h-2z"/>
                        </svg>
                    </div>

                    <div class="text-start small text-secondary bg-dark p-3 rounded-3 border border-secondary">
                        <p class="mb-1 text-white"><strong>Atas Nama:</strong> SUPERFIT GYM</p>
                        <p class="mb-0"><strong>Metode:</strong> All Payment / QRIS NSI</p>
                    </div>
                </div>
            </div>

            <!-- DAFTAR TAGIHAN -->
            <div class="col-lg-8">
                <div class="card bg-black text-white border border-secondary rounded-4 p-4 shadow">
                    <h4 class="fw-bold text-danger mb-4">Daftar Tagihan Membership</h4>

                    @if($invoices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>No. Invoice</th>
                                        <th>Paket</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Upload Bukti Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $inv)
                                        <tr>
                                            <td class="fw-bold text-danger">{{ $inv->invoice_number }}</td>
                                            <td>{{ $inv->package_name }}</td>
                                            <td>Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                                            
                                            <!-- STATUS BADGE -->
                                            <td>
                                                @if($inv->status === 'paid')
                                                    <span class="badge bg-success">LUNAS</span>
                                                @elseif($inv->status === 'waiting')
                                                    <span class="badge bg-info text-dark">MENUNGGU VERIFIKASI</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">BELUM DIBAYAR</span>
                                                @endif
                                            </td>

                                            <!-- UPLOAD FORM -->
                                            <td>
                                                @if($inv->status === 'paid')
                                                    <span class="text-success small fw-bold">Selesai</span>
                                                @else
                                                    <form action="{{ route('member.uploadProof', $inv->id) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-2">
                                                        @csrf
                                                        <input type="file" name="proof_of_payment" class="form-control form-control-sm bg-dark text-white border-secondary" required accept="image/*">
                                                        <button type="submit" class="btn btn-danger btn-sm fw-bold">
                                                            {{ $inv->proof_of_payment ? 'Re-upload Bukti' : 'Kirim Bukti' }}
                                                        </button>
                                                    </form>

                                                    @if($inv->proof_of_payment)
                                                        <a href="{{ asset('storage/' . $inv->proof_of_payment) }}" target="_blank" class="small text-info text-decoration-none mt-1 d-inline-block">
                                                            🔍 Lihat Bukti Saya
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-secondary mb-0">Belum ada tagihan. Silakan pilih paket di halaman utama.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>