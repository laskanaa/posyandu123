@extends('layouts.app')

@section('title', 'Tambah Balita')

@section('content')

    <div class="dashboard-container">
        @include('partials.sidebar_kader')

        <!-- Main Content -->
        <div class="main-content">

            <div class="topbar">
                <h3>Tambah Data Balita</h3>
            </div>

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


                <!-- PENIMBANGAN -->
                <div class="card-form">

                    <h4>Penimbangan Pertama</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Berat Badan (kg)</label>
                            <input type="number" name="berat_badan" step="any" required>
                        </div>

                        <div class="form-group">
                            <label>Tinggi Badan (cm)</label>
                            <input type="number" name="tinggi_badan" required>
                        </div>

                        <div class="form-group">
                            <label>LILA (cm)</label>
                            <input type="number" name="lila" step="any" required>
                        </div>

                        <div class="form-group">
                            <label>LIKA (cm)</label>
                            <input type="number" name="lika" step="any" required>
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn-save">
                    Simpan Data Balita
                </button>

            </form>

        </div>

    </div>


    <style>
        /* Layout */

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            font-family: sans-serif;
        }

        .sidebar {
            width: 220px;
            background: #0d4f4d;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
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
            background: transparent;
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
            margin-bottom: 25px;
        }


        /* FORM CARD */

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
            transition: 0.2s;
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