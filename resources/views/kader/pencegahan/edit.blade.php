@extends('layouts.app')

@section('title', 'Edit SPM')

@section('content')

    <div class="container">

        <h2>Edit Data Pencegahan</h2>

        <form action="{{ route('kader.pencegahan.update', $pencegahan->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-card">

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" value="{{ $pencegahan->judul }}" readonly>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi">{{ $pencegahan->deskripsi }}</textarea>
                </div>

                <button class="btn-save">
                    Update Pencegahan
                </button>

            </div>

        </form>

    </div>

@endsection


<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 40px;
        font-family: sans-serif;
    }

    .form-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 18px;
    }

    input,
    textarea {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
    }
</style>