@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')

    <div class="form-container">

        <div class="form-card">
            <h3>Edit Layanan</h3>

            <form action="{{ route('kader.layanan.update', $layanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" value="{{ $layanan->judul }}" readonly>
                </div>

                <button class="btn-save">Update</button>
            </form>
        </div>

    </div>

@endsection

<style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        background: #f4f6fb;
    }

    .form-card {
        width: 100%;
        max-width: 500px;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .form-card h3 {
        margin-bottom: 20px;
        color: #0d4f4d;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    input {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        padding: 10px;
        border-radius: 6px;
        width: 100%;
    }
</style>