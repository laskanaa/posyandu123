@extends('layouts.app')

@section('title', 'Edit Slider')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Edit Slider</h3>
            </div>

            <form action="{{ route('kader.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-form">

                    <h4>Data Slider</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $slider->judul }}" required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" value="{{ $slider->deskripsi }}">
                        </div>

                        <div class="form-group">
                            <label>Gambar Sekarang</label>
                            <br>
                            <img src="{{ asset('storage/' . $slider->gambar) }}" width="150">
                        </div>

                        <div class="form-group">
                            <label>Ganti Gambar</label>
                            <input type="file" name="gambar">
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn-save">
                    Update Slider
                </button>

            </form>

        </div>

    </div>


    <style>
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            font-family: sans-serif;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background: #f4f6f9;
        }

        .topbar {
            margin-bottom: 25px;
        }

        /* CARD */

        .card-form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-form h4 {
            margin-bottom: 20px;
            color: #0d4f4d;
        }

        /* GRID */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0d4f4d;
            box-shadow: 0 0 0 2px rgba(13, 79, 77, 0.1);
        }

        /* BUTTON */

        .btn-save {
            background: #0d4f4d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #0a3f3d;
        }
    </style>

@endsection