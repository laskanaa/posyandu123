@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

    <style>
        .galeri-page {
            padding: 80px 40px;
            max-width: 1200px;
            margin: auto;
        }

        .galeri-title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .galeri-item {
            max-width: 350px;
            width: 100%;
            margin: auto;
            /* 🔥 center tiap item */

            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .galeri-item:hover {
            transform: scale(1.05);
        }

        .galeri-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        @media(max-width:768px) {
            .galeri-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="galeri-page">

        <h2 class="galeri-title">Galeri Kegiatan</h2>

        <div class="galeri-grid">
            @foreach($galeri as $item)
                <div class="galeri-item">
                    <img src="{{ asset('storage/' . $item->gambar) }}">
                </div>
            @endforeach
        </div>

    </div>

@endsection