@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .homepage {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* HERO */
        .hero-slider {
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .carousel-item {
            height: 100vh;
            position: relative;
        }

        .slider-img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        .slider-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60%;
            background: linear-gradient(to top, rgba(0, 0, 0, .75), transparent);
        }

        .slider-caption {
            position: absolute;
            bottom: 90px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: white;
            max-width: 720px;
        }

        .slider-caption h1 {
            font-size: 38px;
            font-weight: 600;
        }

        .slider-caption p {
            font-size: 15px;
            opacity: .9;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 20px;
            border-radius: 50%;
        }

        /* CONTAINER */
        .container-home {
            max-width: 1400px;
            margin: auto;
            padding: 0 20px;
        }

        /* TITLE & SUBTITLE - UPDATED */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 36px;
            /* Ukuran diperbesar */
            margin-bottom: 10px;
            color: #0f172a;
            font-weight: 700;
        }

        .section-subtitle {
            font-size: 16px;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* TENTANG */
        .tentang-section {
            padding: 110px 0;
        }

        .tentang-wrapper {
            display: flex;
            align-items: center;
            gap: 60px;
            flex-wrap: wrap;
        }

        .tentang-img {
            flex: 1;
            min-width: 300px;
            height: 380px;
            border-radius: 20px;
            overflow: hidden;
            opacity: 0;
            transform: translateX(-80px);
            transition: .9s;
        }

        .tentang-img.show {
            opacity: 1;
            transform: translateX(0);
        }

        .tentang-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tentang-text {
            flex: 1;
            min-width: 300px;
            font-size: 15px;
            line-height: 1.8;
            color: #475569;
            text-align: center;
            opacity: 0;
            transform: translateX(80px);
            transition: .9s;
        }

        .tentang-text.show {
            opacity: 1;
            transform: translateX(0);
        }

        /* INFORMASI */
        .info-section {
            padding: 100px 0;
            background: #f1f5f9;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .info-card {
            background: white;
            padding: 35px;
            border-radius: 16px;
            text-align: center;
            opacity: 0;
            transform: translateY(60px);
            transition: .6s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
        }

        .info-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .info-number {
            font-size: 34px;
            font-weight: 600;
            color: #0ea5e9;
        }

        .info-title {
            font-size: 13px;
            color: #64748b;
        }

        /* LAYANAN */
        .layanan-section {
            padding: 110px 0;
            background: #f8fafc;
        }

        .layanan-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .layanan-card {
            flex: 0 1 calc(25% - 30px);
            min-width: 200px;
            max-width: 250px;
            background: white;
            padding: 28px 16px;
            border-radius: 16px;
            text-align: center;
            opacity: 0;
            transform: translateY(60px);
            transition: all .5s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
        }

        .layanan-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .layanan-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 30px rgba(0, 0, 0, .12);
            background: #f0fdfa;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            background: #ecfeff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin: 0 auto 10px;
        }

        .layanan-card h3 {
            font-size: 14px;
        }

        /* PENCEGAHAN */
        .pencegahan-section {
            padding: 80px 0;
        }

        .pencegahan-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .pencegahan-card {
            flex: 0 1 calc(33.333% - 30px);
            min-width: 280px;
            max-width: 380px;
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
            opacity: 0;
            transform: translateY(40px);
            transition: .6s;
        }

        .pencegahan-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* GALERI */
        .galeri-section {
            padding: 110px 0;
        }

        .galeri-grid-custom {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .galeri-item {
            border-radius: 12px;
            overflow: hidden;
            opacity: 0;
            transform: translateY(40px);
            transition: .6s;
        }

        .galeri-item.show {
            opacity: 1;
            transform: translateY(0);
        }

        .galeri-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            transition: .3s;
        }

        .galeri-item img:hover {
            transform: scale(1.05);
        }

        .galeri-btn {
            text-align: center;
            margin-top: 40px;
        }

        .btn-galeri {
            background: linear-gradient(135deg, #0d4f4d, #0f766e);
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            transition: .3s;
            display: inline-block;
        }

        .btn-galeri:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .2);
        }

        /* RESPONSIVE */
        @media(max-width:1024px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .tentang-wrapper {
                flex-direction: column;
            }
        }

        @media(max-width:768px) {
            .layanan-card {
                flex: 0 1 calc(50% - 30px);
            }

            .section-title {
                font-size: 28px;
            }
        }
    </style>

    <div class="homepage">
        <section id="home"></section>

        @if($sliders->count())
            <section class="hero-slider">
                <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        @foreach($sliders as $key => $slider)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('slider/' . $slider->gambar) }}" class="slider-img">
                                <div class="slider-overlay"></div>
                                <div class="slider-caption">
                                    <h1>{{ $slider->judul }}</h1>
                                    <p>{{ $slider->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </section>
        @endif

        @if($tentang)
            <section id="tentang" class="tentang-section">
                <div class="container-home">
                    <div class="section-header">
                        <h2 class="section-title">Tentang Posyandu</h2>
                        <p class="section-subtitle">Mengenal lebih dekat peran dan dedikasi kami dalam menjaga kesehatan
                            masyarakat Paguyangan.</p>
                    </div>
                    <div class="tentang-wrapper">
                        <div class="tentang-img animate">
                            <img src="{{ asset('tentang/' . $tentang->gambar) }}">
                        </div>
                        <div class="tentang-text animate">
                            <p>{{ $tentang->deskripsi1 }}</p>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section id="informasi" class="info-section">
            <div class="container-home">
                <div class="section-header">
                    <h2 class="section-title">Informasi Posyandu Paguyangan</h2>
                    <p class="section-subtitle">Data statistik cakupan pelayanan kesehatan yang telah kami laksanakan untuk
                        warga.</p>
                </div>
                <div class="info-grid">
                    @foreach($informasi as $item)
                        <div class="info-card animate">
                            <div class="info-number counter" data-target="{{ $item->angka }}">0</div>
                            <div class="info-title">{{ $item->judul }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if($layanan->count())
            <section id="layanan" class="layanan-section">
                <div class="container-home">
                    <div class="section-header">
                        <h2 class="section-title">Layanan Posyandu</h2>
                        <p class="section-subtitle">Berbagai fasilitas kesehatan dasar yang tersedia secara gratis untuk
                            mendukung tumbuh kembang anak.</p>
                    </div>
                    <div class="layanan-grid">
                        @foreach($layanan as $item)
                            <div class="layanan-card animate">
                                <div class="icon-circle">{!! $item->icon !!}</div>
                                <h3>{{ $item->judul }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($pencegahans->count())
            <section id="pencegahan" class="pencegahan-section">
                <div class="container-home">
                    <div class="section-header">
                        <h2 class="section-title">Lakukan Pencegahan Stunting</h2>
                        <p class="section-subtitle">Langkah strategis dan panduan penting bagi orang tua untuk memastikan
                            generasi masa depan sehat dan kuat.</p>
                    </div>
                    <div class="pencegahan-grid">
                        @foreach($pencegahans as $item)
                            <div class="pencegahan-card animate">
                                <div class="icon-box">🩺</div>
                                <h3>{{ $item->judul }}</h3>
                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section id="galeri" class="galeri-section" style="padding: 110px 0;">
            <div class="container-home">
                <div class="section-header">
                    <h2 class="section-title">Galeri Kegiatan</h2>
                    <p class="section-subtitle">Dokumentasi momen keceriaan dan pelayanan kesehatan rutin di lingkungan
                        Posyandu Paguyangan.</p>
                </div>
                <div class="galeri-grid-custom">
                    @foreach($galeri->take(6) as $item)
                        <div class="galeri-item animate">
                            <img src="{{ asset('upload-galeri/' . $item->gambar) }}">
                        </div>
                    @endforeach
                </div>
                <div class="galeri-btn">
                    <a href="{{ route('galeri') }}" class="btn-galeri">Lihat Semua Galeri →</a>
                </div>
            </div>
        </section>
    </div>

    <script>
        function reveal() {
            document.querySelectorAll('.animate').forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight - 100) {
                    el.classList.add("show");
                }
            });
        }
        window.addEventListener("scroll", reveal);
        reveal();

        document.querySelectorAll(".counter").forEach(counter => {
            counter.innerText = '0';
            const update = () => {
                const target = +counter.getAttribute("data-target");
                const c = +counter.innerText;
                const inc = target / 100;
                if (c < target) { counter.innerText = Math.ceil(c + inc); setTimeout(update, 20); } else { counter.innerText = target; }
            }
            update();
        });
    </script>

@endsection