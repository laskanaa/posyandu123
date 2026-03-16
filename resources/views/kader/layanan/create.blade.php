@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

    <div class="dashboard-container">

        {{-- SIDEBAR --}}
        @include('partials.sidebar_kader')

        <div class="main-content">

            {{-- HEADER + HAMBURGER --}}
            <div class="topbar">
                <div class="topbar-left">
                    <button class="hamburger" onclick="toggleSidebar()">☰</button>
                    <h3>Tambah Layanan</h3>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="card-form">
                <form action="{{ route('kader.layanan.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Pilih Layanan</label>
                            <select id="layananSelect" onchange="setLayananData()" required>
                                <option value="">-- Pilih Layanan --</option>
                                <option value="penimbangan">⚖️ Penimbangan Berat Badan</option>
                                <option value="pengukuran">📏 Pengukuran Tinggi Badan</option>
                                <option value="imunisasi">💉 Imunisasi</option>
                                <option value="pmt">🥣 Pemberian Makanan Tambahan (PMT)</option>
                                <option value="vitamin">💊 Vitamin A</option>
                                <option value="kb">🍼 KB</option>
                                <option value="konseling">🩺 Konseling Kesehatan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" id="icon" name="icon" readonly class="locked-input">
                        </div>

                        <div class="form-group">
                            <label>Judul Layanan</label>
                            <input type="text" id="judul" name="judul" readonly class="locked-input">
                        </div>

                    </div>

                    <button class="btn-save">Simpan Layanan</button>

                </form>
            </div>

        </div>

    </div>

    {{-- SCRIPT PILIH LAYANAN --}}
    <script>
        function setLayananData() {

            const select = document.getElementById('layananSelect').value
            const icon = document.getElementById('icon')
            const judul = document.getElementById('judul')

            switch (select) {

                case 'penimbangan':
                    icon.value = '⚖️'
                    judul.value = 'Penimbangan Berat Badan'
                    break

                case 'pengukuran':
                    icon.value = '📏'
                    judul.value = 'Pengukuran Tinggi Badan'
                    break

                case 'imunisasi':
                    icon.value = '💉'
                    judul.value = 'Imunisasi'
                    break

                case 'pmt':
                    icon.value = '🥣'
                    judul.value = 'Pemberian Makanan Tambahan (PMT)'
                    break

                case 'vitamin':
                    icon.value = '💊'
                    judul.value = 'Vitamin A'
                    break

                case 'kb':
                    icon.value = '🍼'
                    judul.value = 'KB'
                    break

                case 'konseling':
                    icon.value = '🩺'
                    judul.value = 'Konseling Kesehatan'
                    break

                default:
                    icon.value = ''
                    judul.value = ''

            }

        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.classList.toggle('active')
        }
    </script>


    <style>
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6fb;
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        /* TOPBAR */

        .topbar {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hamburger {
            font-size: 20px;
            background: #0d4f4d;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* FORM */

        .card-form {
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            width: 100%;
            box-sizing: border-box;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }

        .form-group input,
        select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .locked-input {
            background: #f0f0f0;
            cursor: not-allowed;
        }

        .btn-save {
            margin-top: 25px;
            background: #0d4f4d;
            color: white;
            border: none;
            padding: 12px 22px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-save:hover {
            background: #0a3c3a;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

@endsection