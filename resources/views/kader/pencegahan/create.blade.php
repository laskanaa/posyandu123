@extends('layouts.app')

@section('title', 'Tambah Pencegahan')

@section('content')
    <div class="container">
        <h2 class="page-title">Tambah Data Pencegahan</h2>

        <div class="form-card">
            <form action="{{ route('kader.pencegahan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Judul</label>
                    <textarea name="deskripsi" required placeholder="Masukkan deskripsi pencegahan"></textarea>
                </div>

                <button class="btn-save">Simpan Pencegahan</button>
            </form>
        </div>
    </div>

    <style>
        .container {
            max-width: 600px;
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

        input {
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
@endsection