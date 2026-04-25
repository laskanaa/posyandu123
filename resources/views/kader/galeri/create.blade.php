@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')

    <div class="wrapper">

        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <div class="main">

            <div class="topbar">
                <h3>Tambah Galeri</h3>
            </div>

            <div class="form-wrapper">
                <form action="{{ route('kader.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-form">

                        <div class="form-group">
                            <label>Upload Gambar</label>
                            <input type="file" name="gambar" id="gambar" accept="image/*" required>
                        </div>

                        <div class="preview-box">
                            <img id="previewImage" src="" alt="Preview">
                            <p id="previewText">Preview Gambar</p>
                        </div>

                        <button type="submit" class="btn-save">
                            Simpan Gambar
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

<style>
    .wrapper {
        display: flex;
        min-height: 100vh;
        background: #f4f6f9;
    }

    .main {
        flex: 1;
        padding: 30px;
    }

    .topbar {
        margin-bottom: 25px;
    }

    .form-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-form {
        background: white;
        padding: 30px;
        border-radius: 14px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    input[type="file"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        background: #fafafa;
    }

    .preview-box {
        margin-top: 20px;
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .preview-box img {
        max-width: 100%;
        max-height: 260px;
        display: none;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .preview-box p {
        color: #888;
        font-size: 14px;
    }

    /* 🔥 TOMBOL BARU (lebih bagus) */
    .btn-save {
        margin-top: 25px;
        width: 100%;
        height: 48px;
        background: linear-gradient(135deg, #0d4f4d, #0f766e);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 4px 12px rgba(13, 79, 77, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(13, 79, 77, 0.4);
    }

    .btn-save:active {
        transform: scale(0.98);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('gambar');
        const previewImg = document.getElementById('previewImage');
        const previewText = document.getElementById('previewText');

        input.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    previewText.style.display = 'none';
                }

                reader.readAsDataURL(file);
            }
        });
    });
</script>