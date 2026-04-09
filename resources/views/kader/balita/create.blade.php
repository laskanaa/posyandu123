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

            <!-- PENIMBANGAN -->
            <div class="card-form">
                <h4>Penimbangan Pertama</h4>
                <div class="form-grid">

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

                </div>
            </div>

            <button type="submit" class="btn-save">Simpan Data Balita</button>

        </form>
    </div>

    <script>
        function formatAngka(input) {
            // hanya angka + koma + titik
            input.value = input.value.replace(/[^0-9.,]/g, '');
            // ubah koma jadi titik
            input.value = input.value.replace(',', '.');
        }
    </script>

    <style>
        .container {
            max-width: 900px;
            margin: auto;
            padding: 40px 20px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        h3 {
            margin-bottom: 30px;
        }

        h4 {
            margin-bottom: 20px;
        }

        /* CARD */
        .card-form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* GRID FORM */
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
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        /* BUTTON */
        .btn-save {
            background: #0d4f4d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-save:hover {
            background: #0b3c3b;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px 15px;
            }
        }
    </style>

@endsection