<header class="header">

    <div class="nav-container">

        <!-- LOGO + JUDUL -->
        <a href="#home" class="logo-area">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="9" stroke="#0d4f4d" stroke-width="2" />
                <path d="M12 7v10M7 12h10" stroke="#0d4f4d" stroke-width="2" stroke-linecap="round" />
            </svg>

            <div class="logo-text">
                <div class="title-main">PEMANTAUAN STUNTING</div>
                <div class="title-sub">Posyandu Paguyangan</div>
            </div>
        </a>

        <!-- MENU -->
        <nav class="menu">
            <a href="{{ route('kader.tentang.index') }}" class="nav-btn">Tentang</a>
            <a href="{{ route('kader.informasi.index') }}" class="nav-btn">Informasi</a>
            <a href="{{ route('kader.layanan.index') }}" class="nav-btn">Layanan</a>
            <a href="{{ route('kader.pencegahan.index') }}" class="nav-btn">Pencegahan</a>
            <a href="{{ route('kader.galeri.index') }}" class="nav-btn">Galeri</a>

            <a href="/login" class="nav-btn login-btn">Login</a>
        </nav>

    </div>

</header>

<style>
    /* HEADER */
    .header {
        background: white;
        padding: 18px 60px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        position: sticky;
        top: 0;
        z-index: 999;
    }

    /* CONTAINER */
    .nav-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* LOGO AREA */
    .logo-area {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    /* ICON */
    .logo-icon {
        width: 48px;
        height: 48px;
    }

    /* TEXT */
    .logo-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .title-main {
        font-size: 22px;
        font-weight: 800;
        color: #0d4f4d;
        letter-spacing: 0.5px;
    }

    .title-sub {
        font-size: 13px;
        color: #64748b;
    }

    /* MENU */
    .menu {
        display: flex;
        gap: 16px;
    }

    /* BUTTON STYLE */
    .nav-btn {
        padding: 10px 22px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        color: #0d4f4d;
        background: white;

        /* 🔥 soft border pake shadow */
        box-shadow: 0 0 0 1px rgba(13, 79, 77, 0.25);
        transition: all 0.3s ease;
    }

    /* HOVER */
    .nav-btn:hover {
        background: linear-gradient(135deg, #0d4f4d, #0f766e);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 79, 77, 0.25);
    }

    /* LOGIN BUTTON */
    .login-btn {
        background: linear-gradient(135deg, #0d4f4d, #0f766e);
        color: white;
        box-shadow: none;
    }

    /* LOGIN HOVER */
    .login-btn:hover {
        background: white;
        color: #0d4f4d;
        box-shadow: 0 0 0 1px rgba(13, 79, 77, 0.25);
    }

    /* RESPONSIVE */
    @media(max-width: 768px) {
        .header {
            padding: 15px 20px;
        }

        .menu {
            display: none;
        }

        .title-main {
            font-size: 18px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
        }
    }
</style>