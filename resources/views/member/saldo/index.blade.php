@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Saldo</span> Akun</h1>
            </div>
            <div class="user-menu">
                <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                    <div class="user-avatar">AR</div>
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">Abdul Rahman</div>
                        <div class="user-role">Member</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Saldo Card -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="stat-card"
                    style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.15) 0%, var(--bg-card) 100%);">
                    <div class="stat-card-header">
                        <div class="stat-card-icon gold"><i class="bi bi-wallet2"></i></div>
                        <span class="stat-card-badge up"><i class="bi bi-check-circle"></i> Dapat Ditarik</span>
                    </div>
                    <div class="stat-card-label">Saldo Akun Anda</div>
                    <div class="stat-card-value gold" style="font-size: 2.5rem;">Rp 2.500.000</div>
                    <div class="mt-3 d-flex gap-2">
                        <button class="btn-green" data-bs-toggle="modal" data-bs-target="#topupModal">
                            <i class="bi bi-plus-circle me-1"></i>Topup
                        </button>
                        <button class="btn-silver" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                            <i class="bi bi-cash-coin me-1"></i>Tarik Saldo
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="dashboard-card h-100">
                    <h5 style="color: var(--gold); margin-bottom: 20px;"><i class="bi bi-info-circle me-2"></i>Informasi
                        Saldo</h5>
                    <div class="mb-3 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <div class="d-flex justify-content-between">
                            <span style="color: var(--text-muted);">Minimal Topup</span>
                            <span style="color: var(--profit-green);">Rp 10.000</span>
                        </div>
                    </div>
                    <div class="mb-3 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <div class="d-flex justify-content-between">
                            <span style="color: var(--text-muted);">Maksimal Topup</span>
                            <span style="color: var(--gold);">Rp 5.000.000</span>
                        </div>
                    </div>
                    <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <div class="d-flex justify-content-between">
                            <span style="color: var(--text-muted);">Metode Pembayaran</span>
                            <span style="color: var(--silver);">QRIS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Topup/Withdraw -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-clock-history"></i> Transaksi Saldo Terakhir</h5>
                <a href="riwayat-saldo.html" class="auth-link">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>17 Jan 2024, 10:30</td>
                            <td><span style="color: var(--profit-green);"><i
                                        class="bi bi-arrow-down-circle me-1"></i>Topup</span></td>
                            <td style="color: var(--profit-green);">+Rp 500.000</td>
                            <td>QRIS</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td>15 Jan 2024, 08:00</td>
                            <td><span style="color: var(--loss-red);"><i
                                        class="bi bi-arrow-up-circle me-1"></i>Withdraw</span></td>
                            <td style="color: var(--loss-red);">-Rp 200.000</td>
                            <td>Bank Transfer</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td>12 Jan 2024, 16:45</td>
                            <td><span style="color: var(--profit-green);"><i
                                        class="bi bi-arrow-down-circle me-1"></i>Topup</span></td>
                            <td style="color: var(--profit-green);">+Rp 1.000.000</td>
                            <td>QRIS</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
