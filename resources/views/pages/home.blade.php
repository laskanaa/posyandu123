@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- ================= SLIDER ================= --}}
    @if ($sliders->count() > 0)
        <section id="beranda" class="relative overflow-hidden">
            <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="5000">
                <div class="carousel-inner">
                    @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            {{-- Gambar --}}
                            <img src="{{ asset('slider/' . $slider->gambar) }}" class="d-block w-100"
                                style="height:90vh; object-fit:cover;">
                            {{-- Overlay gelap --}}
                            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center"
                                style="background: rgba(0,0,0,0.35); padding: 30px; border-radius: 12px;">
                                <h2 style="font-size:50px; font-weight:bold; text-shadow:2px 2px 6px rgba(0,0,0,0.7);">
                                    {{ $slider->judul }}
                                </h2>
                                <p style="font-size:20px; text-shadow:1px 1px 3px rgba(0,0,0,0.5); max-width:700px;">
                                    {{ $slider->deskripsi }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Controls --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>
    @endif

    {{-- ================= STYLE GLOBAL ================= --}}
    <style>
        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #0d4f4d;
            margin: 12px auto 0 auto;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .section-subtitle {
            color: #64748b;
            text-align: center;
            margin-bottom: 40px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
        }

        .layanan-section {
            background: linear-gradient(to bottom, #ffffff, #f3f7ff);
            padding: 60px 20px;
        }

        .layanan-card {
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s;
            width: 280px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        .layanan-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.12);
        }

        .layanan-icon {
            font-size: 36px;
            margin-bottom: 12px;
        }

        .layanan-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #0d4f4d;
        }

        .layanan-desc {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        .tentang-section {
            background: #f9fafc;
            padding: 60px 20px;
            text-align: center;
        }

        .tentang-section img {
            max-width: 80%;
            margin-top: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
    </style>

    {{-- ================= TENTANG POSYANDU ================= --}}
    @if($tentang)
        <section class="tentang-section section-padding text-center">
            <h2 class="section-title">Tentang Posyandu</h2>
            <p>{{ $tentang->deskripsi1 }}</p>
        </section>
    @endif

    {{-- ================= SPM ================= --}}
    @if($spm->count() > 0)
        <section class="layanan-section section-padding">
            <h2 class="section-title">Standar Pelayanan Minimal (SPM)</h2>
            <div class="card-container">
                @foreach($spm as $item)
                    <div class="layanan-card">
                        <div class="layanan-icon">{!! $item->icon !!}</div>
                        <div class="layanan-title">{{ $item->judul }}</div>
                        <p class="layanan-desc">{{ $item->deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= LAYANAN POSYANDU ================= --}}
    @if($layanan->count() > 0)
        <section class="layanan-section section-padding">
            <h2 class="section-title">Layanan Posyandu</h2>
            <div class="card-container">
                @foreach($layanan as $item)
                    <div class="layanan-card">
                        <div class="layanan-icon">{!! $item->icon !!}</div>
                        <div class="layanan-title">{{ $item->judul }}</div>
                        <p class="layanan-desc">{{ $item->deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= WELCOME ================= --}}
    <div class="container text-center mt-5 mb-5">
        <h1>Selamat Datang</h1>
        <p>Ini halaman home sistem informasi Posyandu.</p>
    </div>

@endsection