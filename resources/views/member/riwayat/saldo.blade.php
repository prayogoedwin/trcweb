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
                    <div class="user-avatar">{{ Auth::guard('member')->user()->alias }}</div>
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">{{ Auth::guard('member')->user()->name }}</div>
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
                    <div class="stat-card-value green">Rp {{ number_format($totalTopup, 0) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon red"><i class="bi bi-arrow-up-circle"></i></div>
                    <div class="stat-card-label">Total Withdraw</div>
                    <div class="stat-card-value" style="color: var(--loss-red);">Rp {{ number_format($totalWithdraw, 0) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon gold"><i class="bi bi-wallet2"></i></div>
                    <div class="stat-card-label">Saldo Saat Ini</div>
                    <div class="stat-card-value gold">Rp {{ number_format($saldo, 0) }}</div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-clock-history"></i> Semua Transaksi Saldo</h5>
                <span style="color: var(--text-muted);">Total: {{ $allTransaction->count() }} Transaksi</span>
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
                        @foreach ($allTransaction as $item)
                            @php
                                $isTradeLock = $item->metode_pembayaran === 'trade_lock';

                                if ($isTradeLock) {
                                    $label = 'Trade';
                                    $color = 'var(--gold)';
                                    $icon = 'bi-arrow-up-circle';
                                    $sign = '-';
                                } elseif ($item->type === 'profit') {
                                    $label = 'Profit';
                                    $color = 'var(--profit-green)';
                                    $icon = 'bi-arrow-down-circle';
                                    $sign = '+';
                                } elseif ($item->type === 'topup') {
                                    $label = 'Topup';
                                    $color = 'var(--profit-green)';
                                    $icon = 'bi-arrow-down-circle';
                                    $sign = '+';
                                } else {
                                    $label = 'Withdraw';
                                    $color = 'var(--loss-red)';
                                    $icon = 'bi-arrow-up-circle';
                                    $sign = '-';
                                }
                            @endphp
                            <tr>
                                <td><code style="color: var(--gold);">#{{ $item->id }}</code></td>
                                <td>
                                    {{ $item->created_at->format('d-m-Y') }}
                                </td>

                                <td>
                                    <span style="color: {{ $color }}">
                                        <i class="bi {{ $icon }} me-1"></i>
                                        {{ $label }}
                                    </span>
                                </td>

                                <td style="color: {{ $color }}">
                                    {{ $sign }}Rp {{ number_format($item->nominal) }}
                                </td>
                                <td>{{ str_replace('_', ' ', ucwords($item->metode_pembayaran)) }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="status-badge success">Terverifikasi</span>
                                    @else
                                        <span class="status-badge warning">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span style="color: var(--text-muted);">
                    Menampilkan {{ $allTransaction->firstItem() }}-{{ $allTransaction->lastItem() }}
                    dari {{ $allTransaction->total() }}
                </span>
                {{ $allTransaction->links('vendor.pagination.custom') }}
            </div>
        </div>
    </main>
@endsection
