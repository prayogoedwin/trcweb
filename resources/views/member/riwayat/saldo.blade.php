@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Riwayat</span> Saldo</h1>
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

        <!-- Filter -->
        <div class="dashboard-card mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Tipe Transaksi</label>
                    <select class="form-control">
                        <option value="">Semua</option>
                        <option value="topup">Topup</option>
                        <option value="withdraw">Withdraw</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-control">
                        <option value="">Semua</option>
                        <option value="success">Berhasil</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Gagal</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon green"><i class="bi bi-arrow-down-circle"></i></div>
                    <div class="stat-card-label">Total Topup</div>
                    <div class="stat-card-value green">Rp 3.500.000</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon red"><i class="bi bi-arrow-up-circle"></i></div>
                    <div class="stat-card-label">Total Withdraw</div>
                    <div class="stat-card-value" style="color: var(--loss-red);">Rp 1.000.000</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon gold"><i class="bi bi-wallet2"></i></div>
                    <div class="stat-card-label">Saldo Saat Ini</div>
                    <div class="stat-card-value gold">Rp 2.500.000</div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-clock-history"></i> Semua Transaksi Saldo</h5>
                <span style="color: var(--text-muted);">Total: 12 Transaksi</span>
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX001</code></td>
                            <td>17 Jan 2024, 10:30</td>
                            <td><span style="color: var(--profit-green);"><i
                                        class="bi bi-arrow-down-circle me-1"></i>Topup</span></td>
                            <td style="color: var(--profit-green);">+Rp 500.000</td>
                            <td>QRIS</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX002</code></td>
                            <td>15 Jan 2024, 08:00</td>
                            <td><span style="color: var(--loss-red);"><i
                                        class="bi bi-arrow-up-circle me-1"></i>Withdraw</span></td>
                            <td style="color: var(--loss-red);">-Rp 200.000</td>
                            <td>Bank BCA</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX003</code></td>
                            <td>12 Jan 2024, 16:45</td>
                            <td><span style="color: var(--profit-green);"><i
                                        class="bi bi-arrow-down-circle me-1"></i>Topup</span></td>
                            <td style="color: var(--profit-green);">+Rp 1.000.000</td>
                            <td>QRIS</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX004</code></td>
                            <td>10 Jan 2024, 14:20</td>
                            <td><span style="color: var(--loss-red);"><i
                                        class="bi bi-arrow-up-circle me-1"></i>Withdraw</span></td>
                            <td style="color: var(--loss-red);">-Rp 300.000</td>
                            <td>Bank BNI</td>
                            <td><span class="status-badge pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX005</code></td>
                            <td>08 Jan 2024, 09:15</td>
                            <td><span style="color: var(--profit-green);"><i
                                        class="bi bi-arrow-down-circle me-1"></i>Topup</span></td>
                            <td style="color: var(--profit-green);">+Rp 750.000</td>
                            <td>QRIS</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX006</code></td>
                            <td>05 Jan 2024, 11:30</td>
                            <td><span style="color: var(--loss-red);"><i
                                        class="bi bi-arrow-up-circle me-1"></i>Withdraw</span></td>
                            <td style="color: var(--loss-red);">-Rp 500.000</td>
                            <td>Bank BCA</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td><code style="color: var(--gold);">#TRX007</code></td>
                            <td>03 Jan 2024, 15:00</td>
                            <td><span style="color: var(--profit-green);"><i
                                        class="bi bi-arrow-down-circle me-1"></i>Topup</span></td>
                            <td style="color: var(--profit-green);">+Rp 1.250.000</td>
                            <td>QRIS</td>
                            <td><span class="status-badge success">Berhasil</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span style="color: var(--text-muted);">Menampilkan 1-7 dari 12</span>
                <nav>
                    <ul class="pagination mb-0" style="gap: 5px;">
                        <li class="page-item disabled"><a class="page-link" href="#"
                                style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-muted);">Prev</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#"
                                style="background: var(--gold); border-color: var(--gold); color: var(--bg-primary);">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#"
                                style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#"
                                style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection
