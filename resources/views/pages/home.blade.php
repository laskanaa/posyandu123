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
            height: 100vh;
        }

        .carousel-item {
            height: 100vh;
            position: relative;
        }

        .slider-img {
            width: 100%;
            height: 100%;
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

        /* TITLE */
        .section-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 60px;
            color: #0f172a;
            font-weight: 600;
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
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            justify-items: center;
        }

        .layanan-card {
            width: 100%;
            max-width: 220px;
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

        /* SPM */
        .spm-section {
            padding: 110px 0;
        }

        .spm-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .spm-card {
            background: white;
            padding: 32px;
            border-radius: 16px;
            text-align: center;
            opacity: 0;
            transform: translateX(-60px);
            transition: .6s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
        }

        .spm-card.show {
            opacity: 1;
            transform: translateX(0);
        }

        .spm-card:hover {
            transform: translateY(-6px) scale(1.04);
            background: #ecfeff;
        }

        .spm-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin: 0 auto 10px;
        }

        .spm-card h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 8px 0 6px;
            color: #0f172a;
        }

        .spm-card p {
            font-size: 14px;
            line-height: 1.6;
            color: #64748b;
        }

        /* PENCEGAHAN */
        .pencegahan-section {
            padding: 80px 0;
        }

        .pencegahan-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .pencegahan-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
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

        .pencegahan-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        /* GALERI */
        .galeri-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .galeri-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            width: 100%;
        }

        .galeri-item {
            flex: 0 0 calc(33.333% - 13px);
            border-radius: 12px;
            overflow: hidden;
        }

        .galeri-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
        }

        .galeri-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #0d4f4d;
            color: white;
            border: none;
            font-size: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 2;
        }

        .galeri-nav.prev {
            left: -15px;
        }

        .galeri-nav.next {
            right: -15px;
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

            .layanan-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .tentang-wrapper {
                flex-direction: column;
            }

            .pencegahan-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:768px) {
            .layanan-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .spm-grid {
                grid-template-columns: 1fr;
            }

            .galeri-item {
                flex: 0 0 80%;
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
                                <img src="{{ asset('storage/slider/' . $slider->gambar) }}">
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
                    <h2 class="section-title">Tentang Posyandu</h2>
                    <div class="tentang-wrapper">
                        <div class="tentang-img animate">
                            <img src="{{ asset('storage/' . $tentang->gambar) }}">
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
                <h2 class="section-title">Informasi Posyandu Paguyangan</h2>
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
                    <h2 class="section-title">Layanan Posyandu</h2>
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

                    <h2 class="section-title">Lakukan Pencegahan Stunting</h2>

                    <div class="pencegahan-grid">

                        @foreach($pencegahans as $item)
                            <div class="pencegahan-card animate">

                                <div class="icon-box">
                                    🩺
                                </div>

                                <h3>{{ $item->judul }}</h3>

                                <p>{{ $item->deskripsi }}</p>

                            </div>
                        @endforeach

                    </div>

                </div>
            </section>
        @endif

        <section id="galeri" class="galeri-section">
            <div class="container-home">
                <h2 class="section-title">Galeri Kegiatan</h2>
                <div class="galeri-wrapper">
                    <div class="galeri-slider" id="galeriSlider">
                        @foreach($galeri as $item)
                            <div class="galeri-item">
                                <img src="{{ asset('storage/' . $item->gambar) }}">
                            </div>
                        @endforeach
                    </div>
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