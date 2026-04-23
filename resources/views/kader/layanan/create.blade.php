@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

    <div class="form-container">

        <div class="form-card">
            <h3>Tambah Layanan</h3>

            <form action="{{ route('kader.layanan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Pilih Layanan</label>
                    <select id="layananSelect" onchange="setLayananData()">
                        <option value="">-- Pilih --</option>
                        <option value="penimbangan">⚖️ Pemantauan Pertumbuhan</option>
                        <option value="imunisasi">💉 Imunisasi</option>
                        <option value="Layanan Kesehatan Ibu dan Anak">🤱 Layanan Kesehatan Ibu dan Anak</option>
                        <option value="Pemberian Makanan Tambahan">🥣 Pemberian Makanan Tambahan</option>
                        <option value="Pemberian Vitamin A & Obat Cacing">💊 Pemberian Vitamin A & Obat Cacing</option>
                        <option value="Konsultasi Gizi dan KB">👨‍👩‍👧‍👦 Konsultasi Gizi dan KB</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" id="icon" name="icon" readonly>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" id="judul" name="judul" readonly>
                </div>

                <button class="btn-save">Simpan</button>
            </form>
        </div>

    </div>

@endsection

<style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        background: #f4f6fb;
    }

    .form-card {
        width: 100%;
        max-width: 500px;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    input,
    select {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn-save {
        background: #0d4f4d;
        color: white;
        padding: 10px;
        border-radius: 6px;
        width: 100%;
    }
</style>

<script>
    function setLayananData() {
        let val = document.getElementById('layananSelect').value;
        let icon = document.getElementById('icon'); // Pastikan ID element input icon sesuai
        let judul = document.getElementById('judul'); // Pastikan ID element input judul sesuai

        switch (val) {
            case 'penimbangan':
                icon.value = '⚖️';
                judul.value = 'Pemantauan Pertumbuhan';
                break;
            case 'imunisasi':
                icon.value = '💉';
                judul.value = 'Imunisasi';
                break;
            case 'Layanan Kesehatan Ibu dan Anak':
                icon.value = '🤱';
                judul.value = 'Layanan Kesehatan Ibu dan Anak';
                break;
            case 'Pemberian Makanan Tambahan':
                icon.value = '🥣';
                judul.value = 'Pemberian Makanan Tambahan';
                break;
            case 'Pemberian Vitamin A & Obat Cacing':
                icon.value = '💊';
                judul.value = 'Pemberian Vitamin A & Obat Cacing';
                break;
            case 'Konsultasi Gizi dan KB':
                icon.value = '👨‍👩‍👧‍👦';
                judul.value = 'Konsultasi Gizi dan KB';
                break;
            default:
                icon.value = '';
                judul.value = '';
        }
    }
</script>