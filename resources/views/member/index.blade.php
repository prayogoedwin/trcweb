@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Dashboard</span> Member</h1>
            </div>

            <div class="user-menu">
                <div class="user-profile dropdown">
                    <div data-bs-toggle="dropdown" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <div class="user-avatar">AR</div>
                        <div class="user-info d-none d-sm-block">
                            <div class="user-name">{{ ucfirst(Auth::guard('member')->user()->name) }}</div>
                            <div class="user-role">Member</div>
                        </div>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background: var(--bg-card); border-color: var(--border-color);">
                        <li><a class="dropdown-item" href="{{ route('member.profile') }}"
                                style="color: var(--text-secondary);"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li>
                            <hr class="dropdown-divider" style="border-color: var(--border-color);">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('member.logout') }}" style="color: var(--loss-red);"><i
                                    class="bi bi-box-arrow-left me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Welcome -->
        <div class="dashboard-card mb-4"
            style="background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, var(--bg-card) 100%);">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h3 style="color: var(--gold); margin-bottom: 5px;"><i class="bi bi-stars me-2"></i>Selamat
                        Datang, {{ ucfirst(Auth::guard('member')->user()->name) }}!</h3>
                    <p style="color: var(--text-secondary); margin: 0;">Pantau trading dan profit Anda dari
                        dashboard ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('member.saldo') }}" class="btn-green"><i class="bi bi-plus-circle me-1"></i>Topup</a>
                    <a href="{{ route('member.modal') }}" class="btn-gold" style="padding: 12px 20px;"><i
                            class="bi bi-graph-up me-1"></i>Trade</a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon gold"><i class="bi bi-wallet2"></i></div>
                    <span class="stat-card-badge up"><i class="bi bi-arrow-up"></i> Aktif</span>
                </div>
                <div class="stat-card-label">Saldo Akun</div>
                <div class="stat-card-value gold">Rp {{ number_format($saldo, 0) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon silver"><i class="bi bi-cash-stack"></i></div>
                    <span class="stat-card-badge pending"><i class="bi bi-lock"></i> Terkunci</span>
                </div>
                <div class="stat-card-label">Modal Trading</div>
                <div class="stat-card-value">Rp {{ number_format($tradeAktif, 0) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon green"><i class="bi bi-graph-up-arrow"></i></div>
                    <span class="stat-card-badge up"><i class="bi bi-arrow-up"></i> +12.5%</span>
                </div>
                <div class="stat-card-label">Total Profit</div>
                <div class="stat-card-value green">Rp {{ number_format($totalProfit, 0) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon gold"><i class="bi bi-trophy"></i></div>
                </div>
                <div class="stat-card-label">Profit Minggu Ini</div>
                <div class="stat-card-value gold">Rp {{ number_format($week, 0) }}</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <h5 style="color: var(--text-secondary); margin-bottom: 20px;"><i class="bi bi-lightning-charge me-2"
                style="color: var(--gold);"></i>Aksi Cepat</h5>
        <div class="quick-actions">
            <a href="{{ route('member.saldo') }}" class="action-card">
                <div class="action-icon topup"><i class="bi bi-plus-circle"></i></div>
                <div class="action-title">Topup Saldo</div>
                <div class="action-desc">Isi saldo akun Anda</div>
            </a>
            <a href="{{ route('member.modal') }}" class="action-card">
                <div class="action-icon trade"><i class="bi bi-graph-up"></i></div>
                <div class="action-title">Masukkan Modal</div>
                <div class="action-desc">Mulai trading sekarang</div>
            </a>
            <a href="{{ route('member.saldo') }}" class="action-card">
                <div class="action-icon withdraw"><i class="bi bi-cash-coin"></i></div>
                <div class="action-title">Tarik Saldo</div>
                <div class="action-desc">Withdraw ke rekening</div>
            </a>
            {{-- <a href="profit.html#withdraw" class="action-card">
                <div class="action-icon topup"><i class="bi bi-currency-dollar"></i></div>
                <div class="action-title">Tarik Profit</div>
                <div class="action-desc">Cairkan profit Anda</div>
            </a> --}}
        </div>

        <!-- Recent Transactions -->
        <div class="row">
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="bi bi-clock-history"></i> Transaksi Terakhir</h5>
                        <a href="{{ route('member.riwayat-saldo') }}" class="auth-link">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table-dark-custom">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tipe</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lastTransaction as $item)
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
                                        <td>
                                            {{ $item->created_at->format('d-m-Y') }},
                                            {{ $item->created_at->format('H:i') }}
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
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="bi bi-info-circle"></i> Info Akun</h5>
                    </div>
                    <div class="mb-3 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <small style="color: var(--text-muted);">Status Member</small>
                        <div style="color: var(--profit-green); font-weight: 600;"><i
                                class="bi bi-patch-check-fill me-1"></i>Aktif</div>
                    </div>
                    <div class="mb-3 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <small style="color: var(--text-muted);">Bergabung Sejak</small>
                        <div style="color: var(--text-primary);">{{ $join }}</div>
                    </div>
                    <div class="mb-3 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <small style="color: var(--text-muted);">Total Trade</small>
                        <div style="color: var(--gold); font-weight: 600;">{{ $totalTrade }} Kali</div>
                    </div>
                    <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <small style="color: var(--text-muted);">Win Rate</small>
                        <div style="color: var(--profit-green); font-weight: 600;">92%</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<!-- Topup Modal -->
<div class="modal fade" id="topupModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Topup Saldo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="topupForm">
                    <div class="form-group">
                        <label class="form-label">Nominal Topup</label>
                        <div class="input-group">
                            <span class="input-icon" style="left: 15px;">Rp</span>
                            <input type="number" class="form-control" id="topupAmount"
                                placeholder="Masukkan nominal" min="10000" max="5000000"
                                style="padding-left: 50px;">
                        </div>
                        <small style="color: var(--text-muted);">Min: Rp 10.000 | Max: Rp 5.000.000</small>
                    </div>
                    <div class="d-flex gap-2 flex-wrap mt-3 mb-4">
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setAmount(50000)">Rp 50.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setAmount(100000)">Rp 100.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setAmount(500000)">Rp 500.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setAmount(1000000)">Rp 1.000.000</button>
                    </div>
                    <button type="button" class="btn-gold w-100" onclick="processTopup()">
                        <i class="bi bi-qr-code me-2"></i>Lanjut ke Pembayaran
                    </button>
                </div>

                <div id="qrisSection" style="display: none;">
                    <div class="qris-section">
                        <div class="mb-3">
                            <small style="color: var(--text-muted);">Total Pembayaran</small>
                            <div class="qris-amount" id="qrisAmount">Rp 500.123</div>
                            <div class="qris-unique">
                                <i class="bi bi-info-circle me-1"></i>
                                Kode Unik: <span id="uniqueCode">123</span>
                            </div>
                        </div>

                        <div class="qris-code">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=TRC-PAYMENT-DEMO"
                                alt="QRIS Code" style="width: 100%;">
                        </div>

                        <div class="qris-status pending" id="qrisStatus">
                            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                            Menunggu Pembayaran...
                        </div>

                        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 15px;">
                            Scan QRIS di atas menggunakan aplikasi e-wallet atau mobile banking Anda.
                        </p>

                        <div class="mt-3 p-3" style="background: var(--bg-primary); border-radius: 10px;">
                            <small style="color: var(--loss-red);"><i
                                    class="bi bi-exclamation-triangle me-1"></i>Penting!</small>
                            <p style="color: var(--text-secondary); font-size: 0.85rem; margin: 5px 0 0;">
                                Pastikan nominal transfer <strong style="color: var(--gold);">sama persis</strong>
                                termasuk 3 digit kode unik untuk verifikasi otomatis.
                            </p>
                        </div>
                    </div>

                    <button type="button" class="btn-silver w-100 mt-3" onclick="resetTopup()">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Withdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cash-coin me-2"></i>Tarik Saldo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: var(--text-muted);">Saldo Tersedia</span>
                        <span style="color: var(--gold); font-family: 'Orbitron', sans-serif; font-size: 1.3rem;">Rp
                            2.500.000</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nominal Penarikan</label>
                    <div class="input-group">
                        <span class="input-icon" style="left: 15px;">Rp</span>
                        <input type="number" class="form-control" id="withdrawAmount"
                            placeholder="Masukkan nominal" min="50000" style="padding-left: 50px;">
                    </div>
                    <small style="color: var(--text-muted);">Min: Rp 50.000</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Bank Tujuan</label>
                    <select class="form-control">
                        <option value="">Pilih Bank</option>
                        <option value="bca">BCA - 1234567890 (Abdul Rahman)</option>
                        <option value="bni">BNI - 0987654321 (Abdul Rahman)</option>
                    </select>
                    <small style="color: var(--text-muted);">
                        <a href="profile.html" class="auth-link">+ Tambah rekening baru</a>
                    </small>
                </div>

                <button type="button" class="btn-gold w-100" onclick="processWithdraw()">
                    <i class="bi bi-send me-2"></i>Ajukan Penarikan
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function setAmount(amount) {
            document.getElementById('topupAmount').value = amount;
        }

        function processTopup() {
            const amount = parseInt(document.getElementById('topupAmount').value);

            if (!amount || amount < 10000 || amount > 5000000) {
                alert('Nominal harus antara Rp 10.000 - Rp 5.000.000');
                return;
            }

            // Generate unique 3 digit code
            const uniqueCode = Math.floor(Math.random() * 900) + 100;
            const totalAmount = amount + uniqueCode;

            document.getElementById('uniqueCode').textContent = uniqueCode;
            document.getElementById('qrisAmount').textContent = 'Rp ' + totalAmount.toLocaleString('id-ID');

            document.getElementById('topupForm').style.display = 'none';
            document.getElementById('qrisSection').style.display = 'block';
        }

        function resetTopup() {
            document.getElementById('topupForm').style.display = 'block';
            document.getElementById('qrisSection').style.display = 'none';
            document.getElementById('topupAmount').value = '';
        }

        function processWithdraw() {
            const amount = parseInt(document.getElementById('withdrawAmount').value);

            if (!amount || amount < 50000) {
                alert('Nominal minimal penarikan Rp 50.000');
                return;
            }

            if (amount > 2500000) {
                alert('Saldo tidak mencukupi');
                return;
            }

            alert('Permintaan penarikan berhasil diajukan!\nProses 1x24 jam hari kerja.');
            bootstrap.Modal.getInstance(document.getElementById('withdrawModal')).hide();
        }
    </script>
@endpush
