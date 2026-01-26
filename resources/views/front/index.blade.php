<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trader Rahman Community (TRC) - Expert Advisor Forex Trading</title>
    <link rel="icon" type="image/x-icon" href="https://traderrahamancommunity.com/trc-logo.jpg">
    <meta name="description"
        content="TRC adalah komunitas trading yang menyediakan layanan Expert Advisor (EA) Forex dengan fokus utama pada pair Gold (XAUUSD).">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('template') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-trc fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="https://traderrahamancommunity.com/trc-logo.jpg" alt="TRC Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mengapa">Mengapa TRC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="{{ route('member.login') }}" class="nav-link btn-login">Login</a>
                    <a href="{{ route('member.register') }}" class="nav-link btn-register">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">Trader Rahman Community</h1>
                        <p class="hero-subtitle">Expert Advisor Forex Trading</p>
                        <p class="hero-description">
                            TRC adalah komunitas trading yang menyediakan layanan Expert Advisor (EA) Forex dengan fokus
                            utama pada pair <strong style="color: var(--gold);">Gold (XAUUSD)</strong> di pasar keuangan
                            terbesar dunia.
                        </p>

                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-value">500+</div>
                                <div class="stat-label">Member Aktif</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">98%</div>
                                <div class="stat-label">Win Rate</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">24/7</div>
                                <div class="stat-label">Support</div>
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-3 flex-wrap">
                            <a href="{{ route('member.register') }}" class="btn-gold">
                                <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang
                            </a>
                            <a href="#layanan" class="btn-silver">
                                <i class="bi bi-info-circle me-2"></i>Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image text-center">
                        <!-- <img src="https://traderrahamancommunity.com/trc-logo.jpg" alt="TRC Trading" style="max-width: 400px;"> -->
                        <img src="https://cdn.litemarkets.com/cache/uploads/blog_previews_enlarged/zhut_e.jpg?q=75&w=1000&s=d4380cdbd61b0846fa0eccee44e10642"
                            alt="TRC Trading">
                    </div>
                </div>
            </div>
        </div>

        <!-- Candlestick Background Animation -->
        <div class="candlestick-bg">
            <svg width="100%" height="100%" viewBox="0 0 400 300">
                <!-- Green Candles -->
                <g class="candle green" style="animation-delay: 0s;">
                    <line x1="30" y1="50" x2="30" y2="100" stroke="#00d26a"
                        stroke-width="2" />
                    <rect x="20" y="60" width="20" height="30" fill="#00d26a" rx="2" />
                </g>
                <g class="candle green" style="animation-delay: 0.5s;">
                    <line x1="70" y1="80" x2="70" y2="150" stroke="#00d26a"
                        stroke-width="2" />
                    <rect x="60" y="90" width="20" height="40" fill="#00d26a" rx="2" />
                </g>
                <g class="candle red" style="animation-delay: 1s;">
                    <line x1="110" y1="70" x2="110" y2="140" stroke="#ff4757"
                        stroke-width="2" />
                    <rect x="100" y="85" width="20" height="35" fill="#ff4757" rx="2" />
                </g>
                <g class="candle green" style="animation-delay: 1.5s;">
                    <line x1="150" y1="60" x2="150" y2="120" stroke="#00d26a"
                        stroke-width="2" />
                    <rect x="140" y="70" width="20" height="35" fill="#00d26a" rx="2" />
                </g>
                <g class="candle green" style="animation-delay: 2s;">
                    <line x1="190" y1="40" x2="190" y2="100" stroke="#00d26a"
                        stroke-width="2" />
                    <rect x="180" y="50" width="20" height="35" fill="#00d26a" rx="2" />
                </g>
                <g class="candle red" style="animation-delay: 2.5s;">
                    <line x1="230" y1="55" x2="230" y2="110" stroke="#ff4757"
                        stroke-width="2" />
                    <rect x="220" y="65" width="20" height="30" fill="#ff4757" rx="2" />
                </g>
                <g class="candle green" style="animation-delay: 3s;">
                    <line x1="270" y1="35" x2="270" y2="90" stroke="#00d26a"
                        stroke-width="2" />
                    <rect x="260" y="45" width="20" height="30" fill="#00d26a" rx="2" />
                </g>
                <!-- Trend Line -->
                <path d="M 20 130 Q 100 100 200 70 T 380 30" stroke="url(#goldGradient)" stroke-width="3"
                    fill="none" stroke-dasharray="5,5" />
                <defs>
                    <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#d4af37" />
                        <stop offset="100%" style="stop-color:#f4d03f" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" id="tentang">
        <div class="container">
            <h2 class="section-title">Tentang <span>TRC</span></h2>
            <p class="section-subtitle">Solusi trading yang konsisten, terukur, dan berkelanjutan</p>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="dashboard-card">
                        <p
                            style="font-size: 1.1rem; color: var(--text-secondary); text-align: center; line-height: 1.8;">
                            <strong style="color: var(--gold);">Trader Rahman Community (TRC)</strong> adalah komunitas
                            trading yang menyediakan layanan Expert Advisor (EA) Forex dengan fokus utama pada pair Gold
                            (XAUUSD) di pasar keuangan terbesar dunia, yaitu Forex.
                        </p>
                        <p
                            style="font-size: 1.1rem; color: var(--text-secondary); text-align: center; line-height: 1.8; margin-top: 20px;">
                            Kami hadir sebagai solusi bagi trader dan investor yang ingin mendapatkan hasil trading yang
                            <strong style="color: var(--profit-green);">konsisten</strong>, <strong
                                style="color: var(--gold);">terukur</strong>, dan <strong
                                style="color: var(--silver);">berkelanjutan</strong>, tanpa harus terlibat langsung
                            dalam aktivitas trading harian.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section" id="layanan" style="background: var(--bg-secondary);">
        <div class="container">
            <h2 class="section-title">Layanan <span>Kami</span></h2>
            <p class="section-subtitle">TRC menyediakan layanan EA Trading Forex serta program Titip Dana Trading</p>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-robot"></i>
                        </div>
                        <h3 class="feature-title">EA Trading Forex</h3>
                        <p class="feature-text">Expert Advisor otomatis yang telah teruji untuk menghasilkan profit
                            konsisten di pair XAUUSD.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h3 class="feature-title">Titip Dana Trading</h3>
                        <p class="feature-text">Program investasi dimana setiap anggota berkesempatan memperoleh hasil
                            yang konsisten setiap minggu.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="feature-title">Manajemen Risiko</h3>
                        <p class="feature-text">Sistem trading dengan kontrol risiko yang jelas untuk menjaga
                            keberlangsungan modal.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="dashboard-card">
                        <h4 style="color: var(--gold); margin-bottom: 25px; text-align: center;">
                            <i class="bi bi-stars me-2"></i>Semua sistem trading yang kami gunakan:
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3"
                                    style="background: var(--bg-tertiary); border-radius: 12px;">
                                    <i class="bi bi-graph-up-arrow"
                                        style="font-size: 2rem; color: var(--profit-green);"></i>
                                    <p class="mt-2 mb-0" style="color: var(--text-secondary);">Berbasis strategi
                                        terukur</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3"
                                    style="background: var(--bg-tertiary); border-radius: 12px;">
                                    <i class="bi bi-shield-lock" style="font-size: 2rem; color: var(--gold);"></i>
                                    <p class="mt-2 mb-0" style="color: var(--text-secondary);">Mengutamakan keamanan
                                        modal</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3"
                                    style="background: var(--bg-tertiary); border-radius: 12px;">
                                    <i class="bi bi-x-octagon" style="font-size: 2rem; color: var(--loss-red);"></i>
                                    <p class="mt-2 mb-0" style="color: var(--text-secondary);">Menghindari praktik
                                        Money Game</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-3"
                                    style="background: var(--bg-tertiary); border-radius: 12px;">
                                    <i class="bi bi-currency-exchange"
                                        style="font-size: 2rem; color: var(--silver);"></i>
                                    <p class="mt-2 mb-0" style="color: var(--text-secondary);">Fokus pada profit riil
                                        dari market</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section" id="mengapa">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih <span>TRC?</span></h2>
            <p class="section-subtitle">Keunggulan kami dalam dunia trading Forex</p>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="bi bi-check-circle-fill" style="color: var(--bg-primary);"></i>
                        </div>
                        <div class="why-content">
                            <h4>Terbukti Konsisten</h4>
                            <p>EA yang digunakan telah melalui proses pengujian dan evaluasi berkelanjutan untuk menjaga
                                performa tetap stabil.</p>
                        </div>
                    </div>

                    <div class="why-item">
                        <div class="why-icon">
                            <i class="bi bi-shield-fill-check" style="color: var(--bg-primary);"></i>
                        </div>
                        <div class="why-content">
                            <h4>Manajemen Risiko Ketat</h4>
                            <p>Setiap sistem dirancang dengan kontrol risiko yang jelas untuk menjaga keberlangsungan
                                modal dan akun trading.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-item">
                        <div class="why-icon">
                            <i class="bi bi-eye-fill" style="color: var(--bg-primary);"></i>
                        </div>
                        <div class="why-content">
                            <h4>Transparan & Terpercaya</h4>
                            <p>Perputaran dana dan hasil trading bersumber langsung dari aktivitas market Forex, bukan
                                dari perputaran dana anggota.</p>
                        </div>
                    </div>

                    <div class="why-item">
                        <div class="why-icon">
                            <i class="bi bi-hourglass-split" style="color: var(--bg-primary);"></i>
                        </div>
                        <div class="why-content">
                            <h4>Konsep Matang & Long-Term</h4>
                            <p>TRC dibangun dengan visi jangka panjang, sistem yang realistis, dan fondasi bisnis yang
                                sehat sehingga mampu bertahan dalam jangka waktu lama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section" id="kontak">
        <div class="container text-center">
            <h2 class="cta-title">Siap Bergabung dengan <span style="color: var(--gold);">TRC?</span></h2>
            <p class="cta-text">Dapatkan hasil trading yang konsisten setiap hari tanpa harus trading sendiri.</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('member.register') }}" class="btn-gold">
                    <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" class="btn-silver">
                    <i class="bi bi-whatsapp me-2"></i>Hubungi Admin
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <img src="https://traderrahamancommunity.com/trc-logo.jpg" alt="TRC Logo">
                    </div>
                    <p class="footer-text">
                        Trader Rahman Community adalah komunitas trading terpercaya dengan fokus pada pair Gold (XAUUSD)
                        menggunakan Expert Advisor yang telah teruji.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-telegram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <h5 class="footer-title">Menu</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#mengapa">Mengapa TRC</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5 class="footer-title">Member Area</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('member.login') }}">Login</a></li>
                        <li><a href="{{ route('member.register') }}">Daftar</a></li>
                        <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('member.profile') }}">Profil</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5 class="footer-title">Kontak</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-envelope me-2 text-gold"></i>traderrahmancommunnity@gmail.com</li>
                        <li><i class="bi bi-whatsapp me-2 text-gold"></i> +62082191756233</li>
                        <li><i class="bi bi-geo-alt me-2 text-gold"></i> Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 Trader Rahman Community (TRC). All Rights Reserved.</p>
                <p style="font-size: 0.85rem; margin-top: 10px;">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Trading forex melibatkan risiko tinggi. Pastikan Anda memahami risiko sebelum berinvestasi.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar Scroll Effect -->
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-trc');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
