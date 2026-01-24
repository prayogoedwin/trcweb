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
                        <div class="user-name">{{ ucfirst(Auth::guard('member')->user()->name) }}</div>
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
                    <div class="stat-card-value gold" style="font-size: 2.5rem;">Rp {{ number_format($saldo, 0) }}</div>
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
                        @foreach ($riwayat as $item)
                            @php
                                $isTopup = $item->type === 'topup';
                                $color = $isTopup ? 'var(--profit-green)' : 'var(--loss-red)';
                            @endphp

                            <tr>
                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>

                                <td>
                                    <span style="color: {{ $color }}">
                                        <i
                                            class="bi {{ $isTopup ? 'bi-arrow-down-circle' : 'bi-arrow-up-circle' }} me-1"></i>
                                        {{ ucfirst($item->type) }}
                                    </span>
                                </td>

                                <td style="color: {{ $color }}">
                                    {{ $isTopup ? '+' : '-' }}Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                </td>

                                <td>{{ ucwords($item->metode_pembayaran) }}</td>

                                <td>
                                    <span class="status-badge {{ $item->status == 1 ? 'success' : 'warning' }}">
                                        {{ $item->status == 1 ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
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
                                <input type="number" class="form-control" id="topupAmount" placeholder="Masukkan nominal"
                                    min="10000" max="5000000" style="padding-left: 50px;">
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
                                <img src="{{ asset('template/qris.jpeg') }}" alt="QRIS Code" style="width: 100%;">
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

                        {{-- <button type="button" class="btn-silver w-100 mt-3" onclick="resetTopup()">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button> --}}
                        <button type="button" class="btn-silver w-100 mt-3" onclick="confirmTopup()">
                            <i class="bi bi-arrow-left me-2"></i>Konfirmasi
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
                                {{ number_format($saldo, 0) }}</span>
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
                        <select class="form-control" id="bank_id" name="bank_id">
                            <option value="">Pilih Bank</option>
                            @foreach ($bank as $item)
                                <option value="{{ $item->id }}">
                                    {{ ucwords($item->nama_bank) }} - {{ $item->no_rekening }}
                                    ({{ ucfirst($item->atas_nama) }})
                                </option>
                            @endforeach
                            {{-- <option value="bni">BNI - 0987654321 (Abdul Rahman)</option> --}}
                        </select>
                        {{-- <small style="color: var(--text-muted);">
                            <a href="{{ route('member.profile') }}" class="auth-link">+ Tambah rekening baru</a>
                        </small> --}}
                    </div>

                    <button type="button" class="btn-gold w-100" onclick="processWithdraw()">
                        <i class="bi bi-send me-2"></i>Ajukan Penarikan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function confirmTopup() {
            let amount = document.getElementById('qrisAmount').textContent;
            fetch('/member/topup-saldo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        amount: amount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert(data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

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
            let bankId = $('#bank_id').val();
            if (!amount || amount < 50000) {
                alert('Nominal minimal penarikan Rp 50.000');
                return;
            }

            if (amount > 2500000) {
                alert('Saldo tidak mencukupi');
                return;
            }

            $.ajax({
                type: "post",
                url: "{{ route('member.withdraw-saldo') }}",
                headers: {
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                },
                data: {
                    amount: amount,
                    bank_id: bankId
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        alert('Permintaan penarikan berhasil diajukan!\nProses 1x24 jam hari kerja.');
                        bootstrap.Modal.getInstance(document.getElementById('withdrawModal')).hide();
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    </script>
@endpush
