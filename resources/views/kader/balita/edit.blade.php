@extends('layouts.app')

@section('title', 'Edit Balita')

@section('content')

    <div class="container">

        <!-- TOPBAR -->
        <div class="topbar">
            <h3>Edit Data Balita</h3>
            <a href="{{ route('balita.index') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        <form action="{{ route('balita.update', $balita->id) }}" method="POST">

            @csrf
            @method('PUT')

            <!-- BIODATA -->
            <div class="card-form">

                <h4>Biodata Balita</h4>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Nama Balita</label>
                        <input type="text" name="nama" value="{{ $balita->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" value="{{ $balita->nik }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ $balita->tempat_lahir }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ $balita->tanggal_lahir }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin">
                            <option value="L" {{ $balita->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P" {{ $balita->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ $balita->nama_ibu }}" required>
                    </div>

                </div>

            </div>

            <!-- PENIMBANGAN -->
            <div class="card-form">

                <h4>Tambah Penimbangan Baru</h4>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Tanggal Penimbangan</label>
                        <input type="date" name="tanggal_penimbangan" required>
                    </div>

                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="text" name="berat_badan" required oninput="formatAngka(this)">
                    </div>

                    <div class="form-group">
                        <label>Tinggi Badan (cm)</label>
                        <input type="text" name="tinggi_badan" required oninput="formatAngka(this)">
                    </div>

                    <div class="form-group">
                        <label>LILA (cm)</label>
                        <input type="text" name="lila" required oninput="formatAngka(this)">
                    </div>

                    <div class="form-group">
                        <label>LIKA (cm)</label>
                        <input type="text" name="lika" required oninput="formatAngka(this)">
                    </div>

                    <div class="form-group full">
                        <label>Pesan dari Kader</label>
                        <textarea name="pesan" rows="3"
                            placeholder="Isi pesan untuk orang tua...">{{ old('pesan', $penimbangan->pesan ?? '') }}</textarea>
                    </div>

                </div>

            </div>

            <button type="submit" class="btn-save">
                Simpan Perubahan
            </button>

        </form>

    </div>

    <script>
        function formatAngka(input) {
            input.value = input.value.replace(/[^0-9.,]/g, '');
            input.value = input.value.replace(',', '.');
        }
    </script>

@endsection


<style>
    /* CONTAINER */
    .container {
        max-width: 1000px;
        margin: auto;
        padding: 40px;
        font-family: sans-serif;
    }

    /* TOPBAR */
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-back {
        background: #4e73df;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
    }

    /* CARD */
    .card-form {
        background: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .card-form h4 {
        margin-bottom: 20px;
        color: #0d4f4d;
    }

    /* GRID */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* FULL WIDTH */
    .form-group.full {
        grid-column: span 2;
    }

    /* INPUT */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 5px;
        font-weight: 500;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    /* BUTTON */
    .btn-save {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
    }

    /* RESPONSIVE */
    @media(max-width:768px) {

        .container {
            padding: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            /* 🔥 jadi 1 kolom */
        }

        .form-group.full {
            grid-column: span 1;
        }

        .btn-save {
            width: 100%;
        }

    }

    @media(max-width:480px) {

        .topbar h3 {
            font-size: 18px;
        }

        .btn-back {
            font-size: 12px;
            padding: 6px 10px;
        }

    }
</style>