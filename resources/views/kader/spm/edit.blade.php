@extends('layouts.app')

@section('title', 'Edit SPM')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Edit SPM</h3>
            </div>

            <form action="{{ route('kader.spm.update', $spm->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-form">

                    <h4>Edit Data SPM</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Logo Sekarang</label>
                            <br>
                            <img src="{{ asset('storage/' . $spm->logo) }}" width="100">
                        </div>

                        <div class="form-group">
                            <label>Ganti Logo</label>
                            <input type="file" name="logo">
                        </div>

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $spm->judul }}">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" value="{{ $spm->deskripsi }}">
                        </div>

                    </div>

                </div>

                <button class="btn-save">
                    Update SPM
                </button>

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
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .btn-add {
        background: #0d4f4d;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }

    .card-table {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .aksi {
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #ffc107;
        padding: 6px 10px;
        border-radius: 4px;
        text-decoration: none;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
    }
</style>