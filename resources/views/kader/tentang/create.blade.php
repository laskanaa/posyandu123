@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <h3 class="page-header">Tambah Layanan</h3>

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

    </script>

@endsection


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

    .page-header {
        font-size: 24px;
        font-weight: 600;
        color: #0d4f4d;
        margin-bottom: 25px;
    }

    .card-form {
        background: white;
        padding: 35px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
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
    }

    .form-group input,
    select {
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
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
        border-radius: 8px;
        cursor: pointer;
    }
</style>