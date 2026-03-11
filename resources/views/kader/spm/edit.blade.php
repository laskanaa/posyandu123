@extends('layouts.app')

@section('title', 'Edit SPM')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Edit SPM</h3>
            </div>

            <form action="{{ route('kader.spm.update', $spm->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-form">

                    <h4>Edit Data SPM</h4>

                    <div class="form-grid">

                        {{-- <div class="form-group">
                            <label>Icon / Logo</label>
                            <div class="current-icon">
                                @if($spm->logo)
                                    {{ $spm->logo }}
                                @else
                                    <span class="placeholder-icon">❔</span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $spm->judul }}" class="input-text" readonly>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="input-textarea">{{ $spm->deskripsi }}</textarea>
                        </div>

                    </div>

                    <button class="btn-save">
                        Update SPM
                    </button>

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

    /* MAIN CONTENT full width */
    .main-content {
        flex: 1;
        padding: 40px;
    }

    /* Topbar */
    .topbar {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .topbar h3 {
        font-size: 28px;
        font-weight: 600;
        color: #0d4f4d;
    }

    /* Card Form full width */
    .card-form {
        background: #fff;
        padding: 40px;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        width: 100%;
        box-sizing: border-box;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 25px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 16px;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }

    /* Input & Textarea */
    .input-text,
    .input-textarea {
        padding: 14px 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.2s;
    }

    .input-text:focus,
    .input-textarea:focus {
        outline: none;
        border-color: #0d4f4d;
        box-shadow: 0 0 0 3px rgba(13, 79, 77, 0.1);
    }

    .input-text[readonly] {
        background-color: #f0f0f0;
        cursor: not-allowed;
    }

    /* Textarea */
    .input-textarea {
        resize: vertical;
        min-height: 140px;
    }

    /* Icon preview seperti Layanan */
    .current-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
        /* besar seperti layanan */
        padding: 15px;
        border-radius: 12px;
        background: #fafafa;
        border: 1px solid #ddd;
    }

    .placeholder-icon {
        font-size: 64px;
        color: #bbb;
    }

    /* Save Button */
    .btn-save {
        margin-top: 30px;
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 14px 26px;
        font-size: 16px;
        font-weight: 500;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-save:hover {
        background: #0a3c3a;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
</style>