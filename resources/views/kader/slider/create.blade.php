@extends('layouts.app')

@section('title', 'Tambah Slider')

@section('content')

    <div class="container">

        <h3>Tambah Slider</h3>

        <form action="{{ route('kader.slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-form">

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi">
                </div>

                <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" name="gambar" required>
                </div>

            </div>

            <button type="submit" class="btn-save">
                Simpan Slider
            </button>

        </form>

    </div>

@endsection

<style>
    .container {
        max-width: 700px;
        margin: auto;
        padding: 40px;
        font-family: sans-serif;
    }

    .card-form {
        background: white;
        padding: 25px;
        border-radius: 12px;
        margin-top: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group label {
        margin-bottom: 6px;
        font-weight: 600;
    }

    .form-group input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
    }

    /* ================= RESPONSIVE ================= */
    @media(max-width:768px) {

        .container {
            padding: 20px;
        }

        .card-form {
            padding: 15px;
        }

        .btn-save {
            width: 100%;
            text-align: center;
        }
    }
</style>