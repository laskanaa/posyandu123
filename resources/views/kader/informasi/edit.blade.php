@extends('layouts.app')

@section('title', 'Edit Informasi')

@section('content')

    <div class="wrapper">

        <div class="main">

            <div class="topbar">
                <h3>Edit Informasi</h3>
            </div>

            <div class="card-form">
                <form action="{{ route('kader.informasi.update', $informasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" value="{{ $informasi->judul }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Angka</label>
                        <input type="number" name="angka" value="{{ $informasi->angka }}" required>
                    </div>

                    <button type="submit" class="btn-save">
                        Update
                    </button>
                </form>
            </div>

        </div>

    </div>

@endsection

<style>
    .wrapper {
        display: flex;
        min-height: 100vh;
        background: #f1f5f9;
    }

    .main {
        flex: 1;
        padding: 40px;
    }

    .topbar {
        margin-bottom: 25px;
    }

    .topbar h3 {
        font-size: 22px;
        font-weight: 600;
        color: #0f172a;
    }

    .card-form {
        background: white;
        padding: 30px;
        border-radius: 14px;
        max-width: 600px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group label {
        margin-bottom: 6px;
        font-size: 14px;
        color: #334155;
    }

    .form-group input {
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-save:hover {
        background: #0f766e;
    }
</style>