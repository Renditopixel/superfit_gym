<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SUPERFIT GYM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-dark text-white min-vh-100">

    <!-- Navbar Admin -->
    <nav class="navbar navbar-dark bg-black border-bottom border-danger px-4 py-3 sticky-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="/" class="navbar-brand fw-bold text-danger fs-4 mb-0 d-flex align-items-center gap-2">
                SUPERFIT <span class="badge bg-danger text-white fs-6">ADMIN</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-4">
        
        <!-- Notifikasi Berhasil -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Summary Cards / Statistik Ringkas -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card bg-black border-secondary text-white p-3 shadow-sm rounded-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary small">Total Member</span>
                            <h3 class="fw-bold mb-0 text-white">{{ count($members) }}</h3>
                        </div>
                        <i class="bi bi-people fs-1 text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black border-secondary text-white p-3 shadow-sm rounded-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary small">Perlu Verifikasi</span>
                            <h3 class="fw-bold mb-0 text-warning">
                                {{ $invoices->where('status', 'waiting')->count() }}
                            </h3>
                        </div>
                        <i class="bi bi-clock-history fs-1 text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black border-secondary text-white p-3 shadow-sm rounded-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary small">Total Transaksi Lunas</span>
                            <h3 class="fw-bold mb-0 text-success">
                                {{ $invoices->where('status', 'paid')->count() }}
                            </h3>
                        </div>
                        <i class="bi bi-check-circle fs-1 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Member Registered -->
        <div class="card bg-black text-white border-secondary p-4 mb-4 shadow rounded-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-danger fw-bold mb-0"><i class="bi bi-people-fill me-2"></i>Daftar Member Terdaftar</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="table-secondary text-uppercase small">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>TB / BB</th>
                            <th>Status BMI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $member)
                            <tr>
                                <td class="fw-semibold">{{ $member->name }}</td>
                                <td class="text-secondary">{{ $member->email }}</td>
                                <td>{{ $member->phone ?? '-' }}</td>
                                <td>{{ $member->height }} cm / {{ $member->weight }} kg</td>
                                <td>
                                    <span class="badge {{ $member->bmi_status['badge'] ?? 'bg-secondary' }}">
                                        {{ $member->bmi_status['label'] ?? 'N/A' }} ({{ $member->bmi ?? '-' }})
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">Belum ada member mendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kelola Tagihan & Pembayaran -->
        <div class="card bg-black text-white border-secondary p-4 shadow rounded-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-danger fw-bold mb-0"><i class="bi bi-receipt me-2"></i>Kelola Tagihan & Konfirmasi Pembayaran</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="table-secondary text-uppercase small">
                        <tr>
                            <th>No. Invoice</th>
                            <th>Member</th>
                            <th>Paket</th>
                            <th>Nominal</th>
                            <th>Bukti TF</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $inv)
                            <tr>
                                <td><span class="fw-bold text-danger">{{ $inv->invoice_number }}</span></td>
                                <td>{{ $inv->user->name ?? 'User Terhapus' }}</td>
                                <td><span class="badge bg-outline-light border">{{ $inv->package_name }}</span></td>
                                <td class="fw-semibold">Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($inv->proof_of_payment)
                                        <button type="button" class="btn btn-sm btn-outline-info fw-bold d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalProof{{ $inv->id }}">
                                            <i class="bi bi-search"></i> Lihat Bukti
                                        </button>

                                        <!-- Modal Preview Bukti Transfer -->
                                        <div class="modal fade" id="modalProof{{ $inv->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-dark text-white border-secondary">
                                                    <div class="modal-header border-secondary">
                                                        <h5 class="modal-title fs-6">Bukti Transfer - {{ $inv->invoice_number }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $inv->proof_of_payment) }}" class="img-fluid rounded border border-secondary" alt="Bukti Transfer">
                                                    </div>
                                                    <div class="modal-footer border-secondary">
                                                        <a href="{{ asset('storage/' . $inv->proof_of_payment) }}" target="_blank" class="btn btn-sm btn-info text-dark fw-bold">
                                                            Buka di Tab Baru
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-secondary small italic">Belum Upload</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($inv->status === 'paid')
                                        <span class="badge bg-success">LUNAS</span>
                                    @elseif ($inv->status === 'waiting')
                                        <span class="badge bg-info text-dark">MENUNGGU VERIFIKASI</span>
                                    @else
                                        <span class="badge bg-warning text-dark">BELUM DIBAYAR</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <!-- Tombol Konfirmasi Bayar -->
                                        @if ($inv->status !== 'paid')
                                            <form action="{{ route('admin.invoice.confirm', $inv->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success fw-bold d-flex align-items-center gap-1" {{ $inv->status === 'pending' ? 'disabled title="Menunggu upload dari member"' : '' }}>
                                                    <i class="bi bi-check-circle-fill"></i> Konfirmasi
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                                <i class="bi bi-check-all me-1"></i>Disetujui
                                            </span>
                                        @endif

                                        <!-- Tombol Hapus Tagihan -->
                                        <form action="{{ route('admin.invoice.destroy', $inv->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('Yakin ingin menghapus tagihan ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary py-4">Belum ada transaksi tagihan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>