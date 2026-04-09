@extends('layouts.app')

@section('title', 'Tambah Informasi')

@section('content')

    <div class="wrapper">

        <div class="main">

            <div class="topbar">
                <h3>Tambah Informasi</h3>
            </div>

            <div class="card-form">

                <form action="{{ route('kader.informasi.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Judul</label>
                        <select name="judul" id="judulSelect" required>
                            <option value="">-- Pilih --</option>
                            <option value="Jumlah Balita">Jumlah Balita</option>
                            <option value="Balita Stunting">Balita Stunting</option>
                            <option value="Jumlah Posyandu">Jumlah Posyandu</option>
                            <option value="Jumlah Kader">Jumlah Kader</option>
                        </select>
                    </div>

                    <div class="form-group" id="angkaGroup" style="display: none;">
                        <label>Angka</label>
                        <input type="number" name="angka" id="angkaInput">
                    </div>

                    <button class="btn-save">Simpan</button>

                </form>

            </div>

        </div>

    </div>

@endsection

<style>
    .wrapper { display: flex; min-height: 100vh; background: #f4f6f9; }
    .main { flex: 1; padding: 40px; }
    .topbar { margin-bottom: 25px; }
    .card-form { background: white; padding: 30px; border-radius: 14px; max-width: 600px; box-shadow: 0 8px 20px rgba(0,0,0,.05); }
    .form-group { margin-bottom: 20px; }
    .form-group label { margin-bottom: 6px; font-size: 14px; color: #334155; }
    .form-group input, .form-group select { padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; width: 100%; }
    .btn-save { background: #0d4f4d; color: white; padding: 12px 25px; border-radius: 8px; border: none; font-size: 14px; cursor: pointer; width: 100%; }
</style>

<script>
    // Script yang lebih aman
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('judulSelect');
        const angkaGroup = document.getElementById('angkaGroup');

        select.addEventListener('change', function() {
            if (this.value === 'Jumlah Posyandu') {
                angkaGroup.style.display = 'block';
                document.getElementById('angkaInput').required = true;
            } else {
                angkaGroup.style.display = 'none';
                document.getElementById('angkaInput').required = false;
            }
        });
    });
</script>