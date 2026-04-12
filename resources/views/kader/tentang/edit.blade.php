@extends('layouts.app')

@section('title', 'Edit Tentang')

@section('content')

    <div class="wrapper">

        <div class="main">

            <div class="topbar">
                <h3>Edit Tentang</h3>
            </div>

            <form action="{{ route('kader.tentang.update', $tentang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-form">

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi1" rows="5" required>{{ $tentang->deskripsi1 }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Sekarang</label><br>
                        @if($tentang->gambar)
                            <img src="{{ asset('storage/' . $tentang->gambar) }}" width="150">
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Ganti Gambar</label>
                        <input type="file" name="gambar">
                    </div>

                </div>

                <button type="submit" class="btn-save">Update</button>

            </form>

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
        padding: 30px;
        flex: 1;
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