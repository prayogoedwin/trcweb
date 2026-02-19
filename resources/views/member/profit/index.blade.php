@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Hasil</span> Sewa</h1>
            </div>
            <div class="user-menu">
                <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                    <div class="user-avatar">{{ Auth::guard('member')->user()->alias }}</div>
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">{{ ucfirst(Auth::guard('member')->user()->name) }}</div>
                        <div class="user-role">Member</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Profit Cards -->
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="stat-card"
                    style="background: linear-gradient(135deg, rgba(0, 210, 106, 0.15) 0%, var(--bg-card) 100%);">
                    <div class="stat-card-header">
                        <div class="stat-card-icon green"><i class="bi bi-graph-up-arrow"></i></div>
                        {{-- <span class="stat-card-badge up"><i class="bi bi-arrow-up"></i> +12.5%</span> --}}
                    </div>
                    <div class="stat-card-label">Total Imbal Hasil Sewa</div>
                    <div class="stat-card-value green" style="font-size: 2.2rem;">Rp. {{ number_format($totalProfit, 0) }}
                    </div>
                    {{-- <button class="btn-green mt-3" data-bs-toggle="modal" data-bs-target="#withdrawProfitModal">
                        <i class="bi bi-cash-coin me-1"></i>Tarik Profit
                    </button> --}}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-icon gold"><i class="bi bi-calendar-week"></i></div>
                    </div>
                    <div class="stat-card-label">Imbal Hasil Sewa Minggu Ini</div>
                    <div class="stat-card-value gold" style="font-size: 2rem;">Rp {{ number_format($week, 0) }}</div>
                    {{-- <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">
                        <i class="bi bi-clock me-1"></i>Update terakhir: 17 Jan 2024
                    </p> --}}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-icon silver"><i class="bi bi-cash-stack"></i></div>
                    </div>
                    <div class="stat-card-label">Saldo Lisensi EA Aktif</div>
                    <div class="stat-card-value" style="font-size: 2rem;">Rp {{ number_format($active, 0) }}</div>
                    {{-- <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">
                        <i class="bi bi-percent me-1"></i>ROI: 75%
                    </p> --}}
                </div>
            </div>
        </div>

        <!-- Profit Stats -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <h5 style="color: var(--gold); margin-bottom: 25px;"><i class="bi bi-bar-chart-line me-2"></i>Statistik
                        Hasil Sewa</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: var(--text-muted);">Hasil Sewa Bulan Ini</span>
                                    {{-- <span class="stat-card-badge up"><i class="bi bi-arrow-up"></i> +18%</span> --}}
                                </div>
                                <div
                                    style="color: var(--profit-green); font-family: 'Orbitron', sans-serif; font-size: 1.5rem;">
                                    Rp {{ number_format($month, 0) }}</div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: var(--text-muted);">Total Ditarik</span>
                                </div>
                                <div style="color: var(--silver); font-family: 'Orbitron', sans-serif; font-size: 1.5rem;">
                                    Rp 300.000</div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: var(--text-muted);">Rata-rata Hasil Sewa/Minggu</span>
                                </div>
                                <div style="color: var(--gold); font-family: 'Orbitron', sans-serif; font-size: 1.5rem;">Rp
                                    {{ number_format($avgWeeklyProfit, 0) }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span style="color: var(--text-muted);">Total Sewa EA</span>
                                </div>
                                <div
                                    style="color: var(--text-primary); font-family: 'Orbitron', sans-serif; font-size: 1.5rem;">
                                    {{ $totalSewa }} Trade</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dashboard-card h-100">
                    <h5 style="color: var(--gold); margin-bottom: 20px;"><i class="bi bi-trophy me-2"></i>Performa</h5>
                    <div class="text-center py-4">
                        <div
                            style="width: 120px; height: 120px; background: conic-gradient(var(--profit-green) 0deg 331deg, var(--bg-tertiary) 331deg 360deg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <div
                                style="width: 90px; height: 90px; background: var(--bg-card); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <span
                                    style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; color: var(--profit-green);">92%</span>
                            </div>
                        </div>
                        <p style="color: var(--text-muted); margin-top: 15px;">Win Rate</p>
                    </div>
                    <div class="d-flex justify-content-around text-center pt-3"
                        style="border-top: 1px solid var(--border-color);">
                        <div>
                            <div style="color: var(--profit-green); font-size: 1.3rem; font-weight: 700;">43</div>
                            <small style="color: var(--text-muted);">Win</small>
                        </div>
                        <div>
                            <div style="color: var(--loss-red); font-size: 1.3rem; font-weight: 700;">4</div>
                            <small style="color: var(--text-muted);">Loss</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-clock-history"></i> Riwayat Profit</h5>
                <a href="{{ route('member.riwayat-profit') }}" class="auth-link">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Profit</th>
                            <th>Modal</th>
                            <th>ROI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $item)
                            <tr>
                                <td>{{ $item['label'] }}</td>
                                <td><span style="color: var(--profit-green);"><i
                                            class="bi bi-plus-circle me-1"></i>Profit</span></td>
                                <td style="color: var(--profit-green);">+Rp {{ number_format($item['profit'], 0) }}</td>
                                <td>Rp {{ number_format($item['modal'], 0) }}</td>
                                <td><span class="stat-card-badge up">+{{ $item['roi'] }}%</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Withdraw Profit Modal -->
    <div class="modal fade" id="withdrawProfitModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-cash-coin me-2"></i>Tarik Profit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 p-3" style="background: rgba(0, 210, 106, 0.1); border-radius: 12px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="color: var(--text-muted);">Profit Tersedia</span>
                            <span
                                style="color: var(--profit-green); font-family: 'Orbitron', sans-serif; font-size: 1.3rem;">Rp
                                750.000</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nominal Penarikan</label>
                        <div class="input-group">
                            <span class="input-icon" style="left: 15px;">Rp</span>
                            <input type="number" class="form-control" id="withdrawProfitAmount"
                                placeholder="Masukkan nominal" min="50000" style="padding-left: 50px;">
                        </div>
                        <small style="color: var(--text-muted);">Min: Rp 50.000</small>
                    </div>

                    <div class="d-flex gap-2 flex-wrap mt-3 mb-4">
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setProfitAmount(100000)">Rp 100.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setProfitAmount(250000)">Rp 250.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setProfitAmount(500000)">Rp 500.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: rgba(0, 210, 106, 0.15); color: var(--profit-green); border: 1px solid var(--profit-green);"
                            onclick="setProfitAmount(750000)">Semua</button>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bank Tujuan</label>
                        <select class="form-control" id="profitBank">
                            <option value="">Pilih Bank</option>
                            <option value="bca">BCA - 1234567890 (Abdul Rahman)</option>
                            <option value="bni">BNI - 0987654321 (Abdul Rahman)</option>
                        </select>
                        <small style="color: var(--text-muted);">
                            <a href="profile.html" class="auth-link">+ Tambah rekening baru</a>
                        </small>
                    </div>

                    <button type="button" class="btn-green w-100" onclick="processWithdrawProfit()">
                        <i class="bi bi-send me-2"></i>Ajukan Penarikan Profit
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function setProfitAmount(amount) {
            document.getElementById('withdrawProfitAmount').value = amount;
        }

        function processWithdrawProfit() {
            const amount = parseInt(document.getElementById('withdrawProfitAmount').value);
            const bank = document.getElementById('profitBank').value;

            if (!amount || amount < 50000) {
                alert('Nominal minimal penarikan Rp 50.000');
                return;
            }

            if (amount > 750000) {
                alert('Profit tidak mencukupi');
                return;
            }

            if (!bank) {
                alert('Pilih bank tujuan');
                return;
            }

            alert('Permintaan penarikan profit berhasil diajukan!\nProses 1x24 jam hari kerja.');
            bootstrap.Modal.getInstance(document.getElementById('withdrawProfitModal')).hide();
        }
    </script>
@endpush
