@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Modal</span> Trading</h1>
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

        <!-- Modal Cards -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="stat-card"
                    style="background: linear-gradient(135deg, rgba(192, 192, 192, 0.15) 0%, var(--bg-card) 100%);">
                    <div class="stat-card-header">
                        <div class="stat-card-icon silver"><i class="bi bi-cash-stack"></i></div>
                        <span class="stat-card-badge pending"><i class="bi bi-lock"></i> Terkunci</span>
                    </div>
                    <div class="stat-card-label">Modal Trading Aktif</div>
                    <div class="stat-card-value" style="font-size: 2.5rem;">Rp
                        {{ number_format($tradeAktif, 0) }}</div>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">
                        <i class="bi bi-info-circle me-1"></i>Modal tidak dapat ditarik selama periode trading berlangsung.
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-card-icon gold"><i class="bi bi-wallet2"></i></div>
                    </div>
                    <div class="stat-card-label">Saldo Tersedia untuk Trading</div>
                    <div class="stat-card-value gold" style="font-size: 2rem;">Rp {{ number_format($saldo, 0) }}</div>
                    <button class="btn-gold mt-3" data-bs-toggle="modal" data-bs-target="#tradeModal">
                        <i class="bi bi-graph-up me-2"></i>Masukkan Modal Baru
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-card">
                    <h5 style="color: var(--gold); margin-bottom: 20px;"><i class="bi bi-lightbulb me-2"></i>Cara Kerja
                        Modal Trading</h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="text-center p-4"
                                style="background: var(--bg-tertiary); border-radius: 15px; height: 100%;">
                                <div
                                    style="width: 50px; height: 50px; background: var(--gradient-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; color: var(--bg-primary);">
                                    1</div>
                                <h6 style="color: var(--gold);">Masukkan Modal</h6>
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Pilih nominal modal dari
                                    saldo akun Anda</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-4"
                                style="background: var(--bg-tertiary); border-radius: 15px; height: 100%;">
                                <div
                                    style="width: 50px; height: 50px; background: var(--gradient-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; color: var(--bg-primary);">
                                    2</div>
                                <h6 style="color: var(--gold);">EA Bekerja</h6>
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Expert Advisor trading
                                    otomatis di XAUUSD</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-4"
                                style="background: var(--bg-tertiary); border-radius: 15px; height: 100%;">
                                <div
                                    style="width: 50px; height: 50px; background: var(--gradient-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; color: var(--bg-primary);">
                                    3</div>
                                <h6 style="color: var(--gold);">Profit Mingguan</h6>
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Hasil trading masuk ke
                                    profit Anda setiap minggu</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-4"
                                style="background: var(--bg-tertiary); border-radius: 15px; height: 100%;">
                                <div
                                    style="width: 50px; height: 50px; background: var(--gradient-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 700; color: var(--bg-primary);">
                                    4</div>
                                <h6 style="color: var(--gold);">Tarik Profit</h6>
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Profit dapat ditarik
                                    kapan saja ke rekening Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal History -->
        <div class="dashboard-card">
            <div class="card-header">
                <h5 class="card-title"><i class="bi bi-journal-text"></i> Riwayat Modal</h5>
                <a href="riwayat-modal.html" class="auth-link">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nominal Modal</th>
                            {{-- <th>Periode</th> --}}
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td style="color: var(--gold);">Rp {{ number_format($item->modal, 0) }}</td>
                                {{-- <td>Minggu ke-3</td> --}}
                                <td>
                                    @if ($item->status === 'active')
                                        <span class="status-badge success">
                                            <i class="bi bi-play-circle me-1"></i>
                                            Aktif Trading
                                        </span>
                                    @elseif ($item->status === 'cancelled')
                                        <span class="status-badge danger">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Trading Dibatalkan
                                        </span>
                                    @elseif ($item->status === 'completed')
                                        <span class="status-badge info">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Trading Selesai
                                        </span>
                                    @else
                                        <span class="status-badge secondary">
                                            <i class="bi bi-question-circle me-1"></i>
                                            Status Tidak Diketahui
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status === 'active')
                                        <button class="status-badge info btn-cancel-trade" data-id="{{ $item->id }}"
                                            style="border: none; background: transparent; font-color: white;">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Batalkan Trading
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Trade Modal -->
    <div class="modal fade" id="tradeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-graph-up me-2"></i>Masukkan Modal Trading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="color: var(--text-muted);">Saldo Tersedia</span>
                            <span style="color: var(--gold); font-family: 'Orbitron', sans-serif; font-size: 1.3rem;">Rp.
                                {{ number_format($saldo, 0) }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nominal Modal</label>
                        <div class="input-group">
                            <span class="input-icon" style="left: 15px;">Rp</span>
                            <input type="number" class="form-control" id="modalAmount"
                                placeholder="Masukkan nominal modal" min="10000" max="5000000"
                                style="padding-left: 50px;">
                        </div>
                        <small style="color: var(--text-muted);">Min: Rp 10.000 | Max: Rp 5.000.000</small>
                    </div>

                    <div class="d-flex gap-2 flex-wrap mt-3 mb-4">
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setModalAmount(100000)">Rp 100.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setModalAmount(500000)">Rp 500.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setModalAmount(1000000)">Rp 1.000.000</button>
                        <button type="button" class="btn btn-sm"
                            style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                            onclick="setModalAmount(2500000)">Rp 2.500.000</button>
                    </div>

                    <div class="p-3 mb-4"
                        style="background: rgba(255, 71, 87, 0.1); border: 1px solid rgba(255, 71, 87, 0.3); border-radius: 12px;">
                        <small style="color: var(--loss-red);"><i
                                class="bi bi-exclamation-triangle me-1"></i>Perhatian!</small>
                        <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 5px 0 0;">
                            Modal yang sudah dimasukkan <strong style="color: var(--loss-red);">tidak dapat
                                ditarik</strong> selama periode trading berlangsung. Pastikan Anda memahami risiko trading.
                        </p>
                    </div>

                    <button type="button" class="btn-gold w-100" onclick="processTrade()">
                        <i class="bi bi-check-circle me-2"></i>Konfirmasi Trade
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function setModalAmount(amount) {
            document.getElementById('modalAmount').value = amount;
        }

        function processTrade() {
            const amount = parseInt($('#modalAmount').val());

            if (isNaN(amount) || amount < 10000) {
                alert('Nominal minimal Rp 10.000');
                return;
            }

            if (!confirm(
                    'Anda yakin ingin memasukkan modal sebesar Rp ' +
                    amount.toLocaleString('id-ID') +
                    '?\n\nModal tidak dapat ditarik selama periode trading.'
                )) {
                return;
            }

            $.ajax({
                url: "{{ route('member.topup-modal') }}",
                type: "POST",
                dataType: "json",
                data: {
                    modal: amount
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    // optional: disable button
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.message);

                        const modalEl = document.getElementById('tradeModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalEl);
                        modalInstance.hide();

                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr) {
                    // console.error(xhr.responseJSON.message);

                    if (xhr.status === 401) {
                        alert('Silakan login ulang');
                        location.href = '/login';
                    } else if (xhr.status === 419) {
                        alert('Session habis, refresh halaman');
                        location.reload();
                    } else {
                        if (xhr.responseJSON.message == 'Saldo tidak mencukupi') {
                            alert('Saldo tidak mencukupi');
                        } else {
                            alert('Terjadi kesalahan sistem');
                        }
                    }
                }
            });
        }

        $(document).on('click', '.btn-cancel-trade', function() {

            const tradeId = $(this).data('id');

            if (!confirm('Yakin ingin membatalkan trade ini?\n\n30% modal akan dipotong.')) {
                return;
            }

            $.ajax({
                url: '/member/cancel-modal/' + tradeId,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);

                    if (xhr.status === 403) {
                        alert('Tidak diizinkan');
                    } else if (xhr.status === 404) {
                        alert('Trade tidak ditemukan');
                    } else {
                        alert('Terjadi kesalahan sistem');
                    }
                }
            });
        });
    </script>
@endpush
