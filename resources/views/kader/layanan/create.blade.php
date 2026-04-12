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
                        <option value="penimbangan">⚖️ Penimbangan</option>
                        <option value="imunisasi">💉 Imunisasi</option>
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
        let val = document.getElementById('layananSelect').value

        if (val === 'penimbangan') {
            icon.value = '⚖️'
            judul.value = 'Penimbangan'
        } else if (val === 'imunisasi') {
            icon.value = '💉'
            judul.value = 'Imunisasi'
        }
    }
</script>