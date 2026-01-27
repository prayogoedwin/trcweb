<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Trader Rahman Community (TRC)</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('template') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="auth-page">
        <div class="auth-container" style="max-width: 520px;">
            <div class="auth-card">
                <div class="auth-logo">
                    <a href="{{ route('home') }}">
                        <img src="https://traderrahamancommunity.com/trc-logo.jpg" alt="TRC Logo">
                    </a>
                </div>

                <h1 class="auth-title">Bergabung dengan TRC</h1>
                <p class="auth-subtitle">Daftar dan mulai trading bersama kami</p>

                <form id="registerForm" action="{{ route('member.register.referal.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="referal" value="{{ $referal }}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <i class="bi bi-person input-icon"></i>
                                    <input type="text" class="form-control" id="fullname" placeholder="Nama lengkap"
                                        name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">No. HP / WhatsApp</label>
                                <div class="input-group">
                                    <i class="bi bi-phone input-icon"></i>
                                    <input type="tel" class="form-control" id="phone" placeholder="08xxxxxxxxxx"
                                        name="whatsapp" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email aktif"
                                name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" class="form-control" id="password" placeholder="Minimal 8 karakter"
                                required minlength="8" name="password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Ulangi password" required name="password_confirmation">
                            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                                <i class="bi bi-eye" id="confirmPasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" class="auth-link">Syarat & Ketentuan</a> serta <a
                                href="#" class="auth-link">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="btn-gold w-100 mb-3">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </button>

                    <div class="auth-divider">
                        <span>atau</span>
                    </div>

                    <p class="text-center" style="color: var(--text-secondary);">
                        Sudah punya akun? <a href="{{ route('member.login') }}" class="auth-link">Login disini</a>
                    </p>
                </form>
            </div>

            <p class="text-center mt-4" style="color: var(--text-muted); font-size: 0.9rem;">
                <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none;">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                </a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + 'Icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        // document.getElementById('registerForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     const password = document.getElementById('password').value;
        //     const confirmPassword = document.getElementById('confirmPassword').value;

        //     if (password !== confirmPassword) {
        //         alert('Password tidak cocok!');
        //         return;
        //     }

        //     // Demo: redirect to login
        //     alert('Pendaftaran berhasil! Silakan login.');
        //     window.location.href = 'login.html';
        // });
    </script>
</body>

</html>
