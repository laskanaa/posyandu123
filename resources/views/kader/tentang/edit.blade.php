@extends('layouts.app')

@section('title', 'Edit Tentang')

@section('content')
    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">
            <div class="topbar">
                <h3>Edit Tentang Posyandu</h3>
            </div>

            <form action="{{ route('kader.tentang.update', $tentang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-form">
                    <h4>Data Tentang</h4>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi1" required>{{ old('deskripsi1', $tentang->deskripsi1) }}</textarea>
                    </div>
                    <button type="submit" class="btn-save">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection

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

    .card-form {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
        min-height: 120px;
    }

    .btn-save {
        margin-top: 15px;
        background: #0d4f4d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }
</style>