@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Edit Layanan</h3>
            </div>

            <form action="{{ route('kader.layanan.update', $layanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-form">

                    <h4>Edit Data Layanan</h4>

                    <div class="form-grid">

                        {{-- <div class="form-group">
                            <label>Icon Saat Ini</label>
                            <div class="current-icon">
                                @if($layanan->icon)
                                    {{ $layanan->icon }}
                                @else
                                    <span class="placeholder-icon">❔</span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $layanan->judul }}" readonly class="locked-input">
                        </div>

                        {{-- <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3">{{ $layanan->deskripsi }}</textarea>
                        </div> --}}

                    </div>

                    <button class="btn-save">Update Layanan</button>

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
        background: #f4f6fb;
    }

    .main-content {
        flex: 1;
        padding: 40px;
        box-sizing: border-box;
    }

    .topbar {
        margin-bottom: 30px;
    }

    .topbar h3 {
        font-size: 24px;
        font-weight: 600;
        color: #0d4f4d;
    }

    .card-form {
        background: white;
        padding: 35px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        width: 100%;
    }

    .card-form h4 {
        margin-bottom: 25px;
        font-size: 20px;
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
        transition: all .2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #0d4f4d;
        box-shadow: 0 0 0 2px rgba(13, 79, 77, 0.1);
    }

    .locked-input {
        background: #e9ecef;
        cursor: not-allowed;
    }

    .current-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        /* emoji besar */
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fafafa;
    }

    .placeholder-icon {
        font-size: 48px;
        color: #bbb;
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
</style>