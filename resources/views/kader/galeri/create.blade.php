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

                        <button type="submit" class="btn-save">Simpan Gambar</button>

                    </div>

                    @@ -45,75 +45,47 @@

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
                    }

                    .card-form {
                        background: white;
                        padding: 30px;
                        border-radius: 14px;
                        width: 100%;
                        max-width: 700px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, .05);



















                    }

                    .form-group {
                        margin-bottom: 20px;
                    }

                    .form-group label {
                        margin-bottom: 8px;
                        font-weight: 600;
                    }





                    input[type="file"] {




                        padding: 10px;

                        border: 1px solid #ccc;
                        border-radius: 8px;
                        width: 100%;
                    }


                    .preview-box {
                        margin-top: 20px;
                        border: 2px dashed #ccc;
                        border-radius: 10px;
                        padding: 15px;
                        text-align: center;
                        min-height: 220px;
                    }

                    .preview-box img {
                        max-width: 100%;
                        max-height: 280px;
                        display: none;
                        border-radius: 8px;
                    }


                    .btn-save {
                        margin-top: 20px;
                        background: #0d4f4d;
                        @@ -123, 22+95, 31 @@ border-radius: 8px;
                        border: none;
                        cursor: pointer;
                        font-size: 16px;
                    }
                </style>


                <script>
                    // Script preview yang lebih aman
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
                                    previewText.style.display = 'none';   // sembunyikan teks preview
                                }

                                reader.readAsDataURL(file);
                            }
                        });

                    });
                </script>