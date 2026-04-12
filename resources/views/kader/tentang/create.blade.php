@extends('layouts.app')

@section('title', 'Tambah Tentang')

@section('content')

    <div class="wrapper">

        @include('partials.sidebar_kader')

        <div class="main">

            <div class="topbar">
                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Tambah Tentang</h3>
                </div>
            </div>

            <form action="{{ route('kader.tentang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-form">

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi1" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Gambar</label>
                        <input type="file" name="gambar">
                    </div>

                </div>

                <button type="submit" class="btn-save">Simpan</button>

            </form>

        </div>
    </div>

    <div class="overlay" id="overlay"></div>

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

    .hamburger {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
    }

    .card-form {
        background: white;
        padding: 25px;
        border-radius: 12px;
    }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    input,
    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
    }

    /* RESPONSIVE */
    @media(max-width:768px) {
        .main {
            padding: 15px;
        }
    }
</style>

<script>
    const toggle = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    toggle.onclick = () => {
        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");
    };

    overlay.onclick = () => {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
    };
</script>