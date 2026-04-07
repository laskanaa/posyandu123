@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')

    <div class="wrapper">

        @include('partials.sidebar_kader')

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
                            <input type="file" name="gambar" id="gambar" required>
                        </div>

                        <div class="preview-box">
                            <img id="previewImage" src="">
                            <p>Preview Gambar</p>
                        </div>

                        <button class="btn-save">Simpan</button>

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

    /* TOPBAR */
    .topbar {
        margin-bottom: 20px;
    }

    /* ✅ CENTER FORM */
    .form-wrapper {
        display: flex;
        justify-content: center;
    }

    /* CARD FORM */
    .card-form {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 100%;
        max-width: 700px;
        /* biar ga kecil banget */
        box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
    }

    /* FORM */
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group label {
        margin-bottom: 6px;
    }

    .form-group input {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    /* PREVIEW */
    .preview-box {
        margin-top: 20px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
    }

    .preview-box img {
        max-width: 100%;
        max-height: 200px;
        display: none;
        margin-bottom: 10px;
    }

    /* BUTTON */
    .btn-save {
        margin-top: 20px;
        background: #0d4f4d;
        color: white;
        padding: 12px;
        width: 100%;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }
</style>


<script>
    document.getElementById("gambar").addEventListener("change", function () {
        const file = this.files[0];
        const preview = document.getElementById("previewImage");

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
    });
</script>