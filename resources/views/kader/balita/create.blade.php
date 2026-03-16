@extends('layouts.app')

@section('title', 'Tambah Balita')

@section('content')

    <div class="container">

        <h3>Tambah Data Balita</h3>

        <form action="{{ route('balita.store') }}" method="POST">

            @csrf

            <!-- BIODATA -->

            <div class="card-form">

                <h4>Biodata Balita</h4>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Nama Balita</label>
                        <input type="text" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" required>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" required>
                    </div>

                </div>

            </div>

            <div class="card-form">

                <h4>Penimbangan Pertama</h4>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Tanggal Penimbangan</label>
                        <input type="date" name="tanggal_penimbangan" required>
                    </div>

                    <div class="form-group">
                        <label>Berat Badan</label>
                        <input type="number" name="berat_badan" required>
                    </div>

                    <div class="form-group">
                        <label>Tinggi Badan</label>
                        <input type="number" name="tinggi_badan" required>
                    </div>

                    <div class="form-group">
                        <label>LILA</label>
                        <input type="number" name="lila" required>
                    </div>

                    <div class="form-group">
                        <label>LIKA</label>
                        <input type="number" name="lika" required>
                    </div>

                </div>

            </div>

            <button type="submit" class="btn-save">
                Simpan Data Balita
            </button>

        </form>

    </div>

@endsection

<style>
    .container {
        max-width: 900px;
        margin: auto;
        padding: 40px;
        font-family: sans-serif;
    }

    .card-form {
        background: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
    }
</style>