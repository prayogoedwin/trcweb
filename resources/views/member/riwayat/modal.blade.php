@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Riwayat</span> Saldo Lisensi EA</h1>
            </div>
            <div class="user-menu">
                <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                    <div class="user-avatar">AR</div>
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">{{ ucfirst(Auth::guard('member')->user()->name) }}</div>
                        <div class="user-role">Member</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon silver"><i class="bi bi-cash-stack"></i></div>
                    <div class="stat-card-label">Total Saldo Lisensi EA Dimasukkan</div>
                    <div class="stat-card-value">Rp {{ number_format($totalModal, 0) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon gold"><i class="bi bi-play-circle"></i></div>
                    <div class="stat-card-label">Saldo Lisensi EA Aktif</div>
                    <div class="stat-card-value gold">Rp {{ number_format($tradeAktif, 0) }}</div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-icon green"><i class="bi bi-check-circle"></i></div>
                    <div class="stat-card-label">Modal Selesai</div>
                    <div class="stat-card-value green">Rp 1.300.000</div>
                </div>
            </div> --}}
        </div>

        <!-- History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-journal-text"></i> Semua Riwayat Saldo Lisensi EA</h5>
                {{-- <span style="color: var(--text-muted);">Total: 8 Entri</span> --}}
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Masuk</th>
                            <th>Nominal Modal</th>
                            <th>Periode</th>
                            <th>Profit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $item)
                            <tr>
                                <td><code style="color: var(--gold);">{{ $item['id'] }}</code></td>
                                <td>{{ $item['tanggal_masuk'] }}</td>
                                <td style="color: var(--gold);">Rp {{ number_format($item['modal'], 0) }}</td>
                                <td>{{ $item['periode_label'] }}</td>
                                <td style="color: var(--profit-green);">+Rp {{ number_format($item['profit'], 0) }}
                                </td>
                                <td>
                                    @if ($item['status'] === 'active')
                                        <span class="status-badge success">Aktif</span>
                                    @elseif ($item['status'] === 'cancelled')
                                        <span class="status-badge danger">Dibatalkan</span>
                                    @else
                                        <span class="status-badge info">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td><code style="color: var(--gold);">#MDL007</code></td>
                            <td>05 Des 2023</td>
                            <td style="color: var(--silver);">Rp 150.000</td>
                            <td>Minggu ke-1 Des 2023</td>
                            <td style="color: var(--profit-green);">+Rp 21.000</td>
                            <td><span class="status-badge"
                                    style="background: rgba(192, 192, 192, 0.15); color: var(--silver);"><i
                                        class="bi bi-check-circle me-1"></i>Selesai</span></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            <div class="mt-4 p-3"
                style="background: rgba(212, 175, 55, 0.1); border: 1px solid var(--border-color); border-radius: 12px;">
                <p style="color: var(--text-secondary); margin: 0;">
                    <i class="bi bi-info-circle me-2" style="color: var(--gold);"></i>
                    <strong>Catatan:</strong> Saldo Lisensi tidak dapat di tarik Selama Proses trading berlangsung.
                </p>
            </div>
        </div>
    </main>
@endsection
