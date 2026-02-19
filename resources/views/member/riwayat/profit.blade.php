@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Riwayat</span> Hasil Sewa</h1>
            </div>
            <div class="user-menu">
                <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                    <div class="user-avatar">{{ Auth::guard('member')->user()->alias }}</div>
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">{{ Auth::guard('member')->user()->name }}</div>
                        <div class="user-role">Member</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-card-icon green"><i class="bi bi-graph-up-arrow"></i></div>
                    <div class="stat-card-label">Total Imbal Hasil Sewa</div>
                    <div class="stat-card-value green">Rp {{ number_format($totalProfit, 0) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-card-icon gold"><i class="bi bi-calendar-week"></i></div>
                    <div class="stat-card-label">Hasil Sewa Bulan Ini</div>
                    <div class="stat-card-value gold">Rp {{ number_format($month, 0) }}</div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-card-icon silver"><i class="bi bi-cash-coin"></i></div>
                    <div class="stat-card-label">Total Ditarik</div>
                    <div class="stat-card-value">Rp 300.000</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-card-icon green"><i class="bi bi-wallet"></i></div>
                    <div class="stat-card-label">Profit Tersedia</div>
                    <div class="stat-card-value green">Rp 450.000</div>
                </div>
            </div> --}}
        </div>

        <!-- Filter -->
        <div class="dashboard-card mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Tipe</label>
                    <select class="form-control">
                        <option value="">Semua</option>
                        <option value="profit">Hasil Sewa Masuk</option>
                        <option value="withdraw">Penarikan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Bulan</label>
                    <select class="form-control">
                        <option value="">Semua</option>
                        <option value="01">Januari 2024</option>
                        <option value="12">Desember 2023</option>
                        <option value="11">November 2023</option>
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

        <!-- History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-bar-chart"></i> Semua Riwayat Hasil Sewa</h5>
                <span style="color: var(--text-muted);">Total: {{ $listProfit->total() }} Entri</span>
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Modal Terkait</th>
                            <th>ROI</th>
                            {{-- <th>Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listProfit as $item)
                            <tr>
                                <td><code style="color: var(--gold);">{{ $item['id'] }}</code></td>
                                <td>{{ $item['tanggal'] }}</td>
                                <td><span style="color: var(--profit-green);"><i
                                            class="bi bi-plus-circle me-1"></i>{{ $item['tipe'] }}</span></td>
                                <td style="color: var(--profit-green);">+Rp {{ number_format($item['nominal'], 0) }}</td>
                                <td>Rp {{ number_format($item['modal'], 0) }}</td>
                                <td><span class="stat-card-badge up">+{{ $item['roi'] }}%</span></td>
                                {{-- <td><span class="status-badge success">Diterima</span></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span style="color: var(--text-muted);">
                    Menampilkan {{ $listProfit->firstItem() }}-{{ $listProfit->lastItem() }}
                    dari {{ $listProfit->total() }}
                </span>
                {{ $listProfit->links('vendor.pagination.custom') }}
            </div>
        </div>
    </main>
@endsection
