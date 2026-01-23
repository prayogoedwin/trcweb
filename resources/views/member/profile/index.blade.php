@extends('member.layout')
@section('content')
    <main class="main-content">
        <header class="dashboard-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="dashboard-title"><span>Profil</span> Saya</h1>
            </div>
            <div class="user-menu">
                <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                    <div class="user-avatar">AR</div>
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">{{ ucwords($data->name) }}</div>
                        <div class="user-role">Member</div>
                    </div>
                </div>
            </div>
        </header>

        <div class="profile-header">
            <div class="profile-avatar-large">AR</div>
            <div class="profile-info">
                <h2>{{ ucwords($data->name) }}</h2>
                <p><i class="bi bi-envelope me-2"></i>{{ $data->email }}</p>
                <p><i class="bi bi-phone me-2"></i>{{ $data->whatsapp }}</p>
                <span class="profile-badge"><i class="bi bi-patch-check-fill me-1"></i>Member Aktif</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="dashboard-card h-100">
                    <div class="card-header">
                        <h5 class="card-title"><i class="bi bi-person"></i> Informasi Pribadi</h5>
                        <button class="auth-link" style="background: none; border: none;" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </button>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-muted); font-size: 0.85rem;">Nama Lengkap</label>
                        <p style="color: var(--text-primary); margin: 5px 0 0;">{{ ucwords($data->name) }}</p>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-muted); font-size: 0.85rem;">Email</label>
                        <p style="color: var(--text-primary); margin: 5px 0 0;">{{ $data->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-muted); font-size: 0.85rem;">No. HP / WhatsApp</label>
                        <p style="color: var(--text-primary); margin: 5px 0 0;">{{ $data->whatsapp }}</p>
                    </div>
                    <div class="mb-3">
                        <label style="color: var(--text-muted); font-size: 0.85rem;">Bergabung Sejak</label>
                        <p style="color: var(--text-primary); margin: 5px 0 0;">{{ $data->created_at }}</p>
                    </div>
                    <div>
                        <label style="color: var(--text-muted); font-size: 0.85rem;">Kode Referral Anda</label>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <code
                                style="background: var(--bg-tertiary); padding: 10px 20px; border-radius: 8px; color: var(--gold); font-size: 1.1rem;">{{ $data->no_referal }}</code>
                            <button class="btn btn-sm"
                                style="background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color);"
                                onclick="copyReferral()">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="dashboard-card h-100">
                    <div class="card-header">
                        <h5 class="card-title"><i class="bi bi-credit-card"></i> Rekening Bank</h5>
                        @if ($bank->count() == 0)
                            <button class="auth-link" style="background: none; border: none;" data-bs-toggle="modal"
                                data-bs-target="#addBankModal">
                                <i class="bi bi-plus-circle me-1"></i>Tambah
                            </button>
                        @endif
                    </div>
                    @foreach ($bank as $item)
                        <div class="bank-card mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="bank-name"><i class="bi bi-bank me-2"></i>Bank {{ $item->nama_bank }}</div>
                                <form action="{{ route('member.bank-delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-md">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <div class="bank-number">{{ $item->no_rekening }}</div>
                            <div class="bank-holder">{{ ucwords($item->atas_nama) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="dashboard-card">
                    <h5 style="color: var(--gold); margin-bottom: 25px;"><i class="bi bi-bar-chart me-2"></i>Ringkasan Akun
                    </h5>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <i class="bi bi-wallet2" style="font-size: 2rem; color: var(--gold);"></i>
                                <div
                                    style="color: var(--text-primary); font-family: 'Orbitron', sans-serif; font-size: 1.2rem; margin-top: 10px;">
                                    Rp 2.5jt</div>
                                <small style="color: var(--text-muted);">Saldo Akun</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <i class="bi bi-cash-stack" style="font-size: 2rem; color: var(--silver);"></i>
                                <div
                                    style="color: var(--text-primary); font-family: 'Orbitron', sans-serif; font-size: 1.2rem; margin-top: 10px;">
                                    Rp 1jt</div>
                                <small style="color: var(--text-muted);">Modal Aktif</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <i class="bi bi-graph-up-arrow" style="font-size: 2rem; color: var(--profit-green);"></i>
                                <div
                                    style="color: var(--profit-green); font-family: 'Orbitron', sans-serif; font-size: 1.2rem; margin-top: 10px;">
                                    Rp 750rb</div>
                                <small style="color: var(--text-muted);">Total Profit</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <i class="bi bi-graph-up" style="font-size: 2rem; color: var(--gold);"></i>
                                <div
                                    style="color: var(--text-primary); font-family: 'Orbitron', sans-serif; font-size: 1.2rem; margin-top: 10px;">
                                    15</div>
                                <small style="color: var(--text-muted);">Total Trade</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="dashboard-card">
                    <h5 style="color: var(--gold); margin-bottom: 25px;"><i class="bi bi-shield-lock me-2"></i>Keamanan
                        Akun</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <div>
                                        <h6 style="color: var(--text-primary); margin-bottom: 5px;"><i
                                                class="bi bi-key me-2"></i>Ubah Password</h6>
                                        <small style="color: var(--text-muted);">Terakhir diubah:
                                            {{ $data->updated_at->diffForHumans() }}</small>
                                    </div>
                                    <button class="btn-silver" style="padding: 8px 16px; font-size: 0.9rem;"
                                        data-bs-toggle="modal" data-bs-target="#changePasswordModal">Ubah</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3" style="background: var(--bg-tertiary); border-radius: 12px;">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <div>
                                        <h6 style="color: var(--text-primary); margin-bottom: 5px;"><i
                                                class="bi bi-phone me-2"></i>Verifikasi 2 Langkah</h6>
                                        <small style="color: var(--text-muted);">Status: <span
                                                style="color: var(--loss-red);">Tidak Aktif</span></small>
                                    </div>
                                    <button class="btn-green"
                                        style="padding: 8px 16px; font-size: 0.9rem;">Aktifkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.profil-update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ ucwords($data->name) }}"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $data->email }}" name="email">
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. HP / WhatsApp</label>
                            <input type="tel" class="form-control" value="{{ $data->whatsapp }}" name="whatsapp">
                        </div>
                        <button type="submit" class="btn-gold w-100"><i class="bi bi-check-circle me-2"></i>Simpan
                            Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bank Modal -->
    <div class="modal fade" id="addBankModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Rekening Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('member.bank') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Nama Bank</label>
                            <select class="form-control" name="nama_bank">
                                <option value="">Pilih Bank</option>
                                <option value="bca">Bank BCA</option>
                                <option value="bni">Bank BNI</option>
                                <option value="bri">Bank BRI</option>
                                <option value="mandiri">Bank Mandiri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control" name="no_rekening"
                                placeholder="Masukkan nomor rekening">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" name="atas_nama"
                                placeholder="Sesuai buku tabungan">
                        </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="primaryBank" name="utama">
                            <label class="form-check-label" for="primaryBank">Jadikan rekening utama</label>
                        </div>
                        <button type="submit" class="btn-gold w-100"><i class="bi bi-plus-circle me-2"></i>Tambah
                            Rekening</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-key me-2"></i>Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.profil-update-password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Password Lama</label>
                            <input type="password" class="form-control" placeholder="Masukkan password lama"
                                name="current_password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" placeholder="Minimal 8 karakter"
                                name="password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" placeholder="Ulangi password baru"
                                name="password_confirmation">
                        </div>
                        <button type="submit" class="btn-gold w-100"><i class="bi bi-check-circle me-2"></i>Ubah
                            Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function copyReferral() {
            navigator.clipboard.writeText('{{ $data->no_referal }}');
            alert('Kode referral berhasil disalin!');
        }
    </script>
@endpush
