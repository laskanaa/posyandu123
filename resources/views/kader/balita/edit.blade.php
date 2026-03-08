@extends('layouts.app')

@section('title', 'Edit Balita')

@section('content')

    <div class="dashboard-container">

        {{-- SIDEBAR --}}
        @include('partials.sidebar_kader')



        {{-- MAIN --}}
        <div class="main-content">

            <div class="topbar">

                <h3>Edit Data Balita</h3>

                <a href="{{ route('balita.index') }}" class="btn-back">
                    ← Kembali
                </a>

            </div>



            <form action="{{ route('balita.update', $balita->id) }}" method="POST">

                @csrf
                @method('PUT')


                {{-- BIODATA --}}
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



                {{-- PENIMBANGAN BARU --}}
                <div class="card-form">

                    <h4>Tambah Penimbangan Baru</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Tanggal Penimbangan</label>
                            <input type="date" name="tanggal_penimbangan"
                                value="{{ old('tanggal_penimbangan', $penimbangan->tanggal_penimbangan ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Berat Badan (kg)</label>
                            <input type="number" step="0.01" name="berat_badan" required>
                        </div>

                        <div class="form-group">
                            <label>Tinggi Badan (cm)</label>
                            <input type="number" step="0.01" name="tinggi_badan" required>
                        </div>

                        <div class="form-group">
                            <label>LILA (cm)</label>
                            <input type="number" step="0.01" name="lila" required>
                        </div>

                        <div class="form-group">
                            <label>LIKA (cm)</label>
                            <input type="number" step="0.01" name="lika" required>
                        </div>

                        <div class="form-group">
                            <label for="pesan">Pesan dari Kader</label>
                            <textarea name="pesan" id="pesan" class="form-control" rows="3"
                                placeholder="Isi pesan untuk orang tua...">{{ old('pesan', $penimbangan->pesan ?? '') }}</textarea>
                        </div>

                    </div>

                </div>



                <button type="submit" class="btn-save">
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>



    <style>
        /* LAYOUT */

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            font-family: sans-serif;
        }

        .sidebar {
            width: 230px;
            background: #0d4f4d;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 25px;
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a,
        .sidebar ul li form button {
            color: white;
            text-decoration: none;
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .sidebar ul li a:hover,
        .sidebar ul li form button:hover,
        .sidebar ul li.active a {
            background: rgba(255, 255, 255, 0.2);
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

        .btn-back {
            background: #4e73df;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #2e59d9;
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



        /* FORM */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0d4f4d;
            box-shadow: 0 0 0 2px rgba(13, 79, 77, 0.1);
        }



        /* BUTTON */

        .btn-save {
            background: #0d4f4d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #0a3f3d;
        }
    </style>

@endsection