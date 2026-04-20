@extends('layouts.app')

@section('title', 'Edit Penimbangan')

@section('content')

<div class="container">

    <!-- TOPBAR -->
    <div class="topbar">
        <h3>Edit Data Penimbangan</h3>
        <a href="{{ url()->previous() }}" class="btn-back">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('penimbangan.update', $penimbangan->id) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- INFO BALITA (READ ONLY) -->
        <div class="card-form">

            <h4>Data Balita</h4>

            <div class="form-grid">

                <div class="form-group">
                    <label>Nama Balita</label>
                    <input type="text" value="{{ $penimbangan->balita->nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nama Ibu</label>
                    <input type="text" value="{{ $penimbangan->balita->nama_ibu }}" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text"
                        value="{{ \Carbon\Carbon::parse($penimbangan->balita->tanggal_lahir)->format('d M Y') }}"
                        disabled>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" value="{{ $penimbangan->balita->jenis_kelamin }}" disabled>
                </div>

            </div>

        </div>

        <!-- EDIT PENIMBANGAN -->
        <div class="card-form">

            <h4>Edit Penimbangan</h4>

            <div class="form-grid">

                <div class="form-group">
                    <label>Tanggal Penimbangan</label>
                    <input type="date" name="tanggal_penimbangan"
                        value="{{ $penimbangan->tanggal_penimbangan }}" required>
                </div>

                <div class="form-group">
                    <label>Berat Badan (kg)</label>
                    <input type="text" name="berat_badan"
                        value="{{ $penimbangan->berat_badan }}"
                        required oninput="formatAngka(this)">
                </div>

                <div class="form-group">
                    <label>Tinggi Badan (cm)</label>
                    <input type="text" name="tinggi_badan"
                        value="{{ $penimbangan->tinggi_badan }}"
                        required oninput="formatAngka(this)">
                </div>

                <div class="form-group">
                    <label>LILA (cm)</label>
                    <input type="text" name="lila"
                        value="{{ $penimbangan->lila }}"
                        oninput="formatAngka(this)">
                </div>

                <div class="form-group">
                    <label>LIKA (cm)</label>
                    <input type="text" name="lika"
                        value="{{ $penimbangan->lika }}"
                        oninput="formatAngka(this)">
                </div>

                <div class="form-group full">
                    <label>Pesan dari Kader</label>
                    <textarea name="pesan" rows="3"
                        placeholder="Isi pesan...">{{ old('pesan', $penimbangan->pesan) }}</textarea>
                </div>

            </div>

        </div>

        <button type="submit" class="btn-save">
            Update Data
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
.container {
    max-width: 1000px;
    margin: auto;
    padding: 40px;
    font-family: sans-serif;
}

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

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group.full {
    grid-column: span 2;
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
.form-group textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.btn-save {
    background: #0d4f4d;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    width: 100%;
    cursor: pointer;
}

@media(max-width:768px){
    .container { padding:20px; }
    .form-grid { grid-template-columns:1fr; }
    .form-group.full { grid-column:span 1; }
}
</style>