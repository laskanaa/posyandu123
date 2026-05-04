<style>
:root {
    --teal-dark:  #0a3d38;
    --teal:       #0f766e;
    --teal-mid:   #14b8a6;
    --teal-light: #ccfbf1;
    --accent:     #f59e0b;
}

.site-header {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    transition: all .4s cubic-bezier(.22,1,.36,1);
}

.site-header.at-top {
    background: transparent;
}

.site-header.scrolled {
    background: rgba(10, 61, 56, 0.96);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    box-shadow: 0 4px 32px rgba(0,0,0,.18);
}

.nav-container {
    max-width: 1240px;
    margin: auto;
    padding: 0 40px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo-area {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    flex: 1;
    min-width: 0;
}

.logo-emblem {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, var(--teal), var(--teal-mid));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 4px 14px rgba(20,184,166,.35);
    flex-shrink: 0;
}

.logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
    overflow: hidden;
}

.logo-main {
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    font-weight: 700;
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.logo-sub {
    font-size: 11px;
    color: var(--teal-mid);
    letter-spacing: .08em;
    text-transform: uppercase;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 4px;
}

.nav-link {
    font-size: 13.5px;
    color: rgba(255,255,255,.75);
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 8px;
    transition: .25s;
}

.nav-link:hover {
    color: white;
    background: rgba(255,255,255,.08);
}

.nav-login {
    font-size: 13px;
    font-weight: 600;
    color: var(--teal-dark);
    background: white;
    text-decoration: none;
    padding: 9px 20px;
    border-radius: 10px;
    margin-left: 8px;
}

.nav-hamburger {
    display: none;
    width: 40px;
    height: 40px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 8px;
    flex-shrink: 0;
}

.nav-hamburger span {
    width: 20px;
    height: 2px;
    background: white;
    transition: .3s;
}

.nav-hamburger.open span:nth-child(1) {
    transform: translateY(6px) rotate(45deg);
}
.nav-hamburger.open span:nth-child(2) {
    opacity: 0;
}
.nav-hamburger.open span:nth-child(3) {
    transform: translateY(-6px) rotate(-45deg);
}

.nav-drawer {
    position: absolute;
    top: 72px;
    left: 0;
    right: 0;

    display: flex;
    flex-direction: column;
    background: rgba(10,61,56,.97);
    backdrop-filter: blur(16px);
    overflow: hidden;

    max-height: 0;
    padding: 0 20px;
    transition: all .35s ease;
}

.nav-drawer.open {
    max-height: 400px;
    padding: 16px 20px 24px;
}

.nav-drawer .nav-link {
    padding: 12px;
    font-size: 15px;
}

.nav-drawer .nav-login {
    margin-top: 10px;
    text-align: center;
}

@media (max-width: 900px) {

    .nav-container {
        padding: 0 16px;
    }

    .nav-menu {
        display: none;
    }

    .nav-hamburger {
        display: flex;
    }
}

@media (max-width: 480px) {

    .logo-main {
        font-size: 14px;
        max-width: 150px;
    }

    .logo-sub {
        font-size: 10px;
    }
}
</style>

<header class="site-header at-top" id="siteHeader">

    <div class="nav-container">

        <a href="{{ url('/') }}#home" class="logo-area">
            <div class="logo-emblem">🌿</div>
            <div class="logo-text">
                <span class="logo-main">Pemantauan Stunting</span>
                <span class="logo-sub">Posyandu Puskesmas Paguyangan</span>
            </div>
        </a>

        <nav class="nav-menu">
            <a href="{{ url('/') }}#tentang"    class="nav-link">Tentang</a>
            <a href="{{ url('/') }}#informasi"  class="nav-link">Informasi</a>
            <a href="{{ url('/') }}#layanan"    class="nav-link">Layanan</a>
            <a href="{{ url('/') }}#pencegahan" class="nav-link">Pencegahan</a>
            <a href="{{ url('/') }}#galeri"     class="nav-link">Galeri</a>
            <a href="/login" class="nav-login">
                <span class="nav-login-icon">🔑</span> Login
            </a>
        </nav>

        <button class="nav-hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

    </div>

    <nav class="nav-drawer" id="navDrawer">
        <a href="{{ url('/') }}#tentang"    class="nav-link">Tentang</a>
        <a href="{{ url('/') }}#informasi"  class="nav-link">Informasi</a>
        <a href="{{ url('/') }}#layanan"    class="nav-link">Layanan</a>
        <a href="{{ url('/') }}#pencegahan" class="nav-link">Pencegahan</a>
        <a href="{{ url('/') }}#galeri"     class="nav-link">Galeri</a>
        <a href="/login" class="nav-login">
            <span class="nav-login-icon">🔑</span> Login
        </a>
    </nav>
</header>

<script>
(function () {
    const header    = document.getElementById('siteHeader');
    const hamburger = document.getElementById('hamburger');
    const drawer    = document.getElementById('navDrawer');

    function onScroll() {
        if (window.scrollY > 40) {
            header.classList.remove('at-top');
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
            header.classList.add('at-top');
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    hamburger.addEventListener('click', function () {
        const open = hamburger.classList.toggle('open');
        drawer.classList.toggle('open', open);
    });

    drawer.querySelectorAll('.nav-link, .nav-login').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('open');
            drawer.classList.remove('open');
        });
    });

    const sections = ['tentang','informasi','layanan','pencegahan','galeri'];
    const links = document.querySelectorAll('.nav-link');

    function setActive() {
        let current = '';
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - 100) current = id;
        });
        links.forEach(link => {
            link.classList.toggle('active', link.getAttribute('href').includes(current) && current);
        });
    }
    window.addEventListener('scroll', setActive, { passive: true });
})();
</script>