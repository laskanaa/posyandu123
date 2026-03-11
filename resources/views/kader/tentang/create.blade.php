@extends('layouts.app')

@section('title', 'Tambah Tentang Posyandu')

@section('content')
    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Tambah Data Tentang Posyandu</h3>
            </div>

            <form action="{{ route('kader.tentang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-form">

                    <h4>Data Tentang Posyandu</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Gambar Tentang Posyandu</label>
                            <input type="file" name="gambar" accept="image/*">
                            @error('gambar')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <form action="{{ route('kader.tentang.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar">
                            </div>
                        </form> --}}

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi1" required>{{ old('deskripsi1') }}</textarea>
                            @error('deskripsi1')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label>Deskripsi 2</label>
                            <textarea name="deskripsi2">{{ old('deskripsi2') }}</textarea>
                            @error('deskripsi2')
                            <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div> --}}

                    </div>

                    <button type="submit" class="btn-save">Simpan</button>

                </div>
            </form>

        </div>

    </div>
@endsection

<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        font-family: 'Segoe UI', sans-serif;
    }

    .main-content {
        flex: 1;
        padding: 40px;
        background: #f4f6fb;
    }

    .topbar {
        margin-bottom: 30px;
    }

    .topbar h3 {
        font-size: 28px;
        font-weight: 600;
        color: #0d4f4d;
    }

    .card-form {
        background: white;
        padding: 35px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        width: 100%;
        box-sizing: border-box;
    }

    .card-form h4 {
        margin-bottom: 25px;
        font-size: 22px;
        color: #0d4f4d;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 14px;
        margin-bottom: 6px;
        color: #555;
        font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #0d4f4d;
        box-shadow: 0 0 0 2px rgba(13, 79, 77, 0.1);
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .btn-save {
        margin-top: 25px;
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px 22px;
        font-size: 14px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: #0a3c3a;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .text-error {
        color: #dc3545;
        font-size: 13px;
        margin-top: 4px;
    }
</style>