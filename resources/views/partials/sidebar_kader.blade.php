<style>
    .sidebar-nav-section {
        padding: 8px 16px 4px;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .28);
        margin-top: 8px;
    }

    .sidebar-nav-item {
        padding: 2px 12px;
    }

    .sidebar-nav-link {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 10px 12px;
        border-radius: 10px;
        text-decoration: none;
        color: rgba(255, 255, 255, .6);
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        transition: all .22s;
        position: relative;
    }

    .sidebar-nav-link:hover {
        background: rgba(255, 255, 255, .08);
        color: white;
    }

    .sidebar-nav-link.is-active {
        background: rgba(20, 184, 166, .15);
        color: white;
        font-weight: 600;
    }

    .sidebar-nav-link.is-active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 20%;
        bottom: 20%;
        width: 3px;
        background: #14b8a6;
        border-radius: 0 2px 2px 0;
    }

    .nav-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
        background: rgba(255, 255, 255, .06);
        transition: background .22s;
    }

    .sidebar-nav-link:hover .nav-icon,
    .sidebar-nav-link.is-active .nav-icon {
        background: rgba(20, 184, 166, .18);
    }

    .nav-label {
        flex: 1;
    }

    .sidebar-divider {
        height: 1px;
        background: rgba(255, 255, 255, .07);
        margin: 10px 12px;
    }

    .sidebar-logout-wrap {
        padding: 4px 12px 8px;
    }

    .sidebar-logout-btn {
        display: flex;
        align-items: center;
        gap: 11px;
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        background: rgba(239, 68, 68, .1);
        border: 1px solid rgba(239, 68, 68, .18);
        color: #fca5a5;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        cursor: pointer;
        text-align: left;
        transition: all .22s;
    }

    .sidebar-logout-btn:hover {
        background: rgba(239, 68, 68, .2);
        color: #fee2e2;
        border-color: rgba(239, 68, 68, .35);
    }

    .logout-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(239, 68, 68, .15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
</style>

<div class="sidebar-nav-section">Menu Utama</div>

<div class="sidebar-nav-item">
    <a href="{{ route('dashboard.kader') }}"
        class="sidebar-nav-link {{ request()->routeIs('dashboard.kader') ? 'is-active' : '' }}">
        <span class="nav-icon">📊</span>
        <span class="nav-label">Dashboard</span>
    </a>
</div>

<div class="sidebar-nav-item">
    <a href="{{ route('balita.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('balita.*') ? 'is-active' : '' }}">
        <span class="nav-icon">👶</span>
        <span class="nav-label">Data Balita</span>
    </a>
</div>

<div class="sidebar-divider"></div>
<div class="sidebar-nav-section">Konten Website</div>

<div class="sidebar-nav-item">
    <a href="{{ route('kader.slider.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('kader.slider.*') ? 'is-active' : '' }}">
        <span class="nav-icon">🖼️</span>
        <span class="nav-label">Slider</span>
    </a>
</div>

<div class="sidebar-nav-item">
    <a href="{{ route('kader.tentang.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('kader.tentang.*') ? 'is-active' : '' }}">
        <span class="nav-icon">🏥</span>
        <span class="nav-label">Tentang Posyandu</span>
    </a>
</div>

<div class="sidebar-nav-item">
    <a href="{{ route('kader.informasi.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('kader.informasi.*') ? 'is-active' : '' }}">
        <span class="nav-icon">📋</span>
        <span class="nav-label">Informasi</span>
    </a>
</div>

<div class="sidebar-nav-item">
    <a href="{{ route('kader.layanan.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('kader.layanan.*') ? 'is-active' : '' }}">
        <span class="nav-icon">🩺</span>
        <span class="nav-label">Layanan</span>
    </a>
</div>

<div class="sidebar-nav-item">
    <a href="{{ route('kader.pencegahan.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('kader.pencegahan.*') ? 'is-active' : '' }}">
        <span class="nav-icon">🛡️</span>
        <span class="nav-label">Pencegahan</span>
    </a>
</div>

<div class="sidebar-nav-item">
    <a href="{{ route('kader.galeri.index') }}"
        class="sidebar-nav-link {{ request()->routeIs('kader.galeri.*') ? 'is-active' : '' }}">
        <span class="nav-icon">🖼️</span>
        <span class="nav-label">Galeri</span>
    </a>
</div>

<div class="sidebar-divider"></div>

<div class="sidebar-logout-wrap">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="sidebar-logout-btn">
            <span class="logout-icon">🚪</span>
            Logout
        </button>
    </form>
</div>