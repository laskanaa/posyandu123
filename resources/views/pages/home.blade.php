@extends('layouts.app')

@section('title', 'Home')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --teal-dark:  #0a3d38;
    --teal:       #0f766e;
    --teal-mid:   #14b8a6;
    --teal-light: #ccfbf1;
    --accent:     #f59e0b;
    --text-dark:  #0d1f1e;
    --text-mid:   #3d5a58;
    --text-soft:  #7a9e9b;
    --bg-cream:   #f8faf9;
    --bg-white:   #ffffff;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg-white);
    color: var(--text-dark);
    overflow-x: hidden;
}

.wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ══ HERO SLIDER ══ */
.hero {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 520px;
    overflow: hidden;
    background: var(--teal-dark);
}

.hero-slides {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity .9s ease;
}

.hero-slide.active { opacity: 1; }

.hero-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    filter: brightness(.62);
}

.hero-slide::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,61,56,.75) 0%, rgba(10,61,56,.08) 55%, transparent 100%);
    pointer-events: none;
}

.hero-caption {
    position: absolute;
    bottom: 13vh;
    left: 8vw;
    color: white;
    z-index: 2;
    max-width: 680px;
    pointer-events: none;
}

.hero-caption small {
    display: inline-block;
    background: var(--accent);
    color: #1a1000;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .13em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 3px;
    margin-bottom: 22px;
}

.hero-caption h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 4.5vw, 54px);
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 14px;
    text-shadow: 0 2px 24px rgba(0,0,0,.3);
}

.hero-caption p {
    font-size: 17px;
    line-height: 1.8;
    opacity: .82;
    font-weight: 300;
    max-width: 460px;
}

.hero-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    background: rgba(255,255,255,.13);
    border: 1px solid rgba(255,255,255,.28);
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .25s;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
}

.hero-btn:hover { background: rgba(255,255,255,.28); }
.hero-btn.prev  { left: 24px; }
.hero-btn.next  { right: 24px; }

.hero-dots {
    position: absolute;
    bottom: 28px;
    left: 8vw;
    display: flex;
    gap: 8px;
    z-index: 20;
}

.hero-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: rgba(255,255,255,.4);
    cursor: pointer;
    border: none;
    padding: 0;
    transition: all .35s;
}

.hero-dot.active {
    width: 22px;
    border-radius: 3px;
    background: var(--accent);
}

/* ══ SHARED ══ */
.sec-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--teal);
    display: inline-block;
    margin-bottom: 10px;
}

.sec-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(26px, 3vw, 40px);
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.22;
    margin-bottom: 14px;
}

.sec-sub {
    font-size: 17px;
    color: var(--text-soft);
    line-height: 1.8;
    font-weight: 300;
}

.rv {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity .65s ease, transform .65s ease;
}
.rv.left  { transform: translateX(-40px); }
.rv.right { transform: translateX( 40px); }
.rv.on    { opacity: 1; transform: none; }

/* ══ TENTANG ══ */
.tentang {
    padding: 110px 0;
    background: var(--bg-white);
}

.tentang-inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.tentang-foto { position: relative; }

.tentang-foto img {
    width: 100%;
    height: 360px;
    object-fit: cover;
    border-radius: 24px;
    display: block;
    box-shadow: 0 16px 48px rgba(10,61,56,.15);
}

.tentang-sticker {
    position: absolute;
    bottom: -18px;
    right: -18px;
    background: var(--accent);
    color: #1a1000;
    border-radius: 16px;
    padding: 18px 22px;
    font-weight: 700;
    font-size: 13px;
    line-height: 1.5;
    box-shadow: 0 8px 24px rgba(245,158,11,.3);
}

.tentang-sticker b {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    line-height: 1;
    margin-bottom: 2px;
}

.tentang-teks p {
    font-size: 17px;
    color: var(--text-mid);
    line-height: 1.9;
    font-weight: 300;
    margin-top: 20px;
}

.tentang-garis {
    width: 48px;
    height: 3px;
    background: linear-gradient(90deg, var(--teal), var(--accent));
    border-radius: 2px;
    margin-top: 20px;
}

/* ══ STATISTIK ══ */
.statistik {
    padding: 90px 0;
    background: var(--teal-dark);
    position: relative;
    overflow: hidden;
}

.statistik::before {
    content: '';
    position: absolute;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(20,184,166,.12), transparent 70%);
    top: -150px; right: -100px;
    border-radius: 50%;
    pointer-events: none;
}

.statistik .sec-label { color: var(--teal-mid); }
.statistik .sec-title { color: white; }
.statistik .sec-sub   { color: rgba(255,255,255,.5); }

.stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 48px;
    position: relative; z-index: 1;
}

.stat-card {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 16px;
    padding: 36px 28px;
    transition: all .3s;
}

.stat-card:hover {
    background: rgba(255,255,255,.1);
    transform: translateY(-4px);
}

.stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 50px;
    font-weight: 700;
    color: var(--teal-mid);
    line-height: 1;
    margin-bottom: 10px;
}

.stat-num sup {
    font-size: 22px;
    color: var(--accent);
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
}

.stat-label {
    font-size: 15px;
    color: rgba(255,255,255,.58);
    line-height: 1.6;
    font-weight: 300;
}

/* ══ LAYANAN ══ */
.layanan {
    padding: 110px 0;
    background: var(--bg-cream);
}

.layanan-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-top: 52px;
}

.layanan-card {
    background: white;
    border-radius: 16px;
    padding: 32px 22px;
    border: 1px solid rgba(15,118,110,.09);
    transition: all .3s;
    position: relative;
    overflow: hidden;
    cursor: default;
}

.layanan-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(140deg, var(--teal-dark), var(--teal));
    opacity: 0;
    transition: opacity .3s;
}

.layanan-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(10,61,56,.2);
}

.layanan-card:hover::before { opacity: 1; }
.layanan-card:hover .layanan-icon-wrap { background: rgba(255,255,255,.14); }
.layanan-card:hover h3 { color: white; }
.layanan-card > * { position: relative; z-index: 1; }

.layanan-icon-wrap {
    width: 54px; height: 54px;
    background: var(--teal-light);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px;
    margin-bottom: 18px;
    transition: background .3s;
}

.layanan-card h3 {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-dark);
    line-height: 1.45;
    transition: color .3s;
}

/* ══ PENCEGAHAN ══ */
.pencegahan {
    padding: 110px 0;
    background: var(--bg-white);
}

.pencegahan-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 52px;
}

.pencegahan-card {
    background: var(--bg-cream);
    border-radius: 16px;
    padding: 34px 28px;
    border: 1px solid rgba(15,118,110,.07);
    transition: all .3s;
    position: relative;
    overflow: hidden;
}

.pencegahan-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 3px; height: 100%;
    background: linear-gradient(to bottom, var(--teal), var(--teal-mid));
    opacity: 0;
    transition: opacity .3s;
}

.pencegahan-card:hover {
    background: white;
    box-shadow: 0 8px 32px rgba(15,118,110,.1);
    transform: translateY(-3px);
}

.pencegahan-card:hover::after { opacity: 1; }

.pencegahan-card .ikon {
    font-size: 30px;
    margin-bottom: 16px;
    display: block;
}

.pencegahan-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 19px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 10px;
    line-height: 1.3;
}

.pencegahan-card p {
    font-size: 17px;
    color: var(--text-soft);
    line-height: 1.8;
    font-weight: 300;
}

/* ══ GALERI ══ */
.galeri {
    padding: 100px 0 110px;
    background: var(--teal-dark);
}

.galeri .sec-label { color: var(--teal-mid); }
.galeri .sec-title { color: white; }
.galeri .sec-sub   { color: rgba(255,255,255,.5); }

.galeri-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 36px;
}

.galeri-navs { display: flex; gap: 10px; }

.gnav {
    width: 44px; height: 44px;
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 8px;
    background: rgba(255,255,255,.07);
    color: white;
    font-size: 18px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all .25s;
}

.gnav:hover { background: var(--teal); border-color: var(--teal); }

.galeri-scroll {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding-bottom: 8px;
    scrollbar-width: none;
}

.galeri-scroll::-webkit-scrollbar { display: none; }

.galeri-item {
    flex: 0 0 300px;
    height: 220px; /* samain semua */
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 20px rgba(0,0,0,.3);
    display: flex;
}

.galeri-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.galeri-item:hover img { transform: scale(1.06); }

.galeri-item::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,61,56,.5), transparent 50%);
    opacity: 0;
    transition: opacity .3s;
    pointer-events: none;
}

.galeri-item:hover::after { opacity: 1; }

/* ══ RESPONSIVE ══ */
@media (max-width: 1050px) {
    .stat-grid, .layanan-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 860px) {
    .tentang-inner { grid-template-columns: 1fr; gap: 40px; }
    .tentang-sticker { display: none; }
    .tentang-foto img { height: 280px; }
    .pencegahan-grid { grid-template-columns: 1fr 1fr; }
    .galeri-header { flex-direction: column; align-items: flex-start; gap: 20px; }
}

@media (max-width: 580px) {
    .wrap { padding: 0 20px; }
    .stat-grid, .pencegahan-grid { grid-template-columns: 1fr; }
    .layanan-grid { grid-template-columns: repeat(2, 1fr); }
    .hero-caption p { display: none; }
    .galeri-item { flex: 0 0 240px; }
}
</style>

{{-- ══ HERO ══ --}}
@if($sliders->count())
<section class="hero">
    <div class="hero-slides" id="heroSlides">
        @foreach($sliders as $key => $slider)
        <div class="hero-slide {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('slider/' . $slider->gambar) }}" alt="{{ $slider->judul }}">
            <div class="hero-caption">
                <h1>{{ $slider->judul }}</h1>
                <p>{{ $slider->deskripsi }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <button class="hero-btn prev" id="heroPrev" type="button">&#8592;</button>
    <button class="hero-btn next" id="heroNext" type="button">&#8594;</button>

    <div class="hero-dots" id="heroDots">
        @foreach($sliders as $key => $slider)
        <button class="hero-dot {{ $key == 0 ? 'active' : '' }}" data-to="{{ $key }}" type="button"></button>
        @endforeach
    </div>
</section>
@endif

{{-- ══ TENTANG ══ --}}
@if($tentang)
<section id="tentang" class="tentang">
    <div class="wrap">
        <div class="tentang-inner">
            <div class="tentang-foto rv left">
                <img src="{{ asset('tentang/' . $tentang->gambar) }}" alt="Tentang Posyandu">
            </div>
            <div class="tentang-teks rv right">
                <span class="sec-label">Tentang Kami</span>
                <h2 class="sec-title">Posyandu Paguyangan</h2>
                <div class="tentang-garis"></div>
                <p>{{ $tentang->deskripsi1 }}</p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ══ STATISTIK ══ --}}
<section id="informasi" class="statistik">
    <div class="wrap">
        <span class="sec-label">Statistik</span>
        <h2 class="sec-title">Informasi Posyandu Paguyangan</h2>
        <div class="stat-grid">
            @foreach($informasi as $item)
            <div class="stat-card rv">
                <div class="stat-num">
                    <span class="counter" data-target="{{ $item->angka }}">0</span>
                </div>
                <div class="stat-label">{{ $item->judul }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ LAYANAN ══ --}}
@if($layanan->count())
<section id="layanan" class="layanan">
    <div class="wrap">
        <span class="sec-label">Fasilitas</span>
        <h2 class="sec-title">Layanan Posyandu</h2>
        <p class="sec-sub" style="max-width:480px;">Berbagai layanan kesehatan dasar tersedia gratis untuk mendukung tumbuh kembang anak dan ibu.</p>
        <div class="layanan-grid">
            @foreach($layanan as $item)
            <div class="layanan-card rv">
                <div class="layanan-icon-wrap">{!! $item->icon !!}</div>
                <h3>{{ $item->judul }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══ PENCEGAHAN ══ --}}
@if($pencegahans->count())
<section id="pencegahan" class="pencegahan">
    <div class="wrap">
        <span class="sec-label">Edukasi</span>
        <h2 class="sec-title">Pencegahan Stunting</h2>
        <p class="sec-sub" style="max-width:500px;">Panduan penting bagi orang tua untuk memastikan generasi masa depan sehat dan kuat.</p>
        <div class="pencegahan-grid">
            @foreach($pencegahans as $item)
            <div class="pencegahan-card rv">
                <h3>{{ $item->judul }}</h3>
                <p>{{ $item->deskripsi }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══ GALERI ══ --}}
<section id="galeri" class="galeri">
    <div class="wrap">
        <div class="galeri-header">
            <div>
                <span class="sec-label">Dokumentasi</span>
                <h2 class="sec-title">Galeri Kegiatan</h2>
                <p class="sec-sub">Momen keceriaan dan pelayanan kesehatan rutin di Posyandu Paguyangan.</p>
            </div>
            <div class="galeri-navs">
                <button class="gnav" id="gPrev" type="button">&#8592;</button>
                <button class="gnav" id="gNext" type="button">&#8594;</button>
            </div>
        </div>
        <div class="galeri-scroll" id="galeriScroll">
            @foreach($galeri as $item)
            <div class="galeri-item">
                <img src="{{ asset('upload-galeri/' . $item->gambar) }}" alt="Galeri">
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
(function(){

    /* ── HERO SLIDER ── */
    var slides = document.querySelectorAll('.hero-slide');
    var dots   = document.querySelectorAll('.hero-dot');
    var total  = slides.length;
    var cur    = 0;
    var timer  = null;

    function goTo(n) {
        slides[cur].classList.remove('active');
        if (dots[cur]) dots[cur].classList.remove('active');
        cur = ((n % total) + total) % total;
        slides[cur].classList.add('active');
        if (dots[cur]) dots[cur].classList.add('active');
    }

    function startAuto() {
        if (timer) clearInterval(timer);
        if (total > 1) timer = setInterval(function(){ goTo(cur + 1); }, 4500);
    }

    var prevBtn = document.getElementById('heroPrev');
    var nextBtn = document.getElementById('heroNext');

    if (prevBtn) prevBtn.addEventListener('click', function(){ goTo(cur - 1); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function(){ goTo(cur + 1); startAuto(); });

    dots.forEach(function(dot){
        dot.addEventListener('click', function(){
            goTo(parseInt(this.getAttribute('data-to')));
            startAuto();
        });
    });

    startAuto();

    /* ── COUNTER ── */
    document.querySelectorAll('.counter').forEach(function(el){
        var target  = parseInt(el.getAttribute('data-target')) || 0;
        var started = false;
        var io = new IntersectionObserver(function(entries){
            if (entries[0].isIntersecting && !started) {
                started = true;
                var n = 0;
                var step = Math.max(target / 70, 1);
                (function tick(){
                    n += step;
                    if (n < target) {
                        el.textContent = Math.ceil(n).toLocaleString('id-ID');
                        requestAnimationFrame(tick);
                    } else {
                        el.textContent = target.toLocaleString('id-ID');
                    }
                })();
                io.disconnect();
            }
        }, { threshold: 0.5 });
        io.observe(el);
    });

    /* ── REVEAL ── */
    var rvObs = new IntersectionObserver(function(entries){
        entries.forEach(function(e, i){
            if (e.isIntersecting) {
                setTimeout(function(){ e.target.classList.add('on'); }, i * 90);
                rvObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.rv').forEach(function(el){ rvObs.observe(el); });

    /* ── GALERI ── */
    var gs = document.getElementById('galeriScroll');
    var gp = document.getElementById('gPrev');
    var gn = document.getElementById('gNext');
    if (gs && gp && gn) {
        gn.addEventListener('click', function(){ gs.scrollBy({ left:  320, behavior: 'smooth' }); });
        gp.addEventListener('click', function(){ gs.scrollBy({ left: -320, behavior: 'smooth' }); });
    }

})();
</script>

@endsection