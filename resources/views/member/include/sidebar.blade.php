<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="dashboard.html">
            <img src="https://traderrahamancommunity.com/trc-logo.jpeg" alt="TRC Logo">
        </a>
    </div>

    <nav class="sidebar-menu">
        <div class="menu-label">Menu Utama</div>
        <a href="{{ route('member.dashboard') }}" class="menu-item active">
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('member.saldo') }}" class="menu-item">
            <i class="bi bi-wallet2"></i>
            <span>Saldo Akun</span>
        </a>
        <a href="{{ route('member.modal') }}" class="menu-item">
            <i class="bi bi-cash-stack"></i>
            <span>Modal</span>
        </a>
        <a href="{{ route('member.profit') }}" class="menu-item">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Profit</span>
        </a>

        <div class="menu-label">Riwayat</div>
        <a href="{{ route('member.riwayat-saldo') }}" class="menu-item">
            <i class="bi bi-clock-history"></i>
            <span>Riwayat Saldo</span>
        </a>
        <a href="{{ route('member.riwayat-modal') }}" class="menu-item">
            <i class="bi bi-journal-text"></i>
            <span>Riwayat Modal</span>
        </a>
        <a href="{{ route('member.riwayat-profit') }}" class="menu-item">
            <i class="bi bi-bar-chart"></i>
            <span>Riwayat Profit</span>
        </a>

        <div class="menu-label">Akun</div>
        <a href="{{ route('member.profile') }}" class="menu-item">
            <i class="bi bi-person-circle"></i>
            <span>Profil</span>
        </a>
        <a href="{{ route('member.logout') }}" class="menu-item" onclick="return confirm('Yakin ingin logout?')">
            <i class="bi bi-box-arrow-left"></i>
            <span>Logout</span>
        </a>
    </nav>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
