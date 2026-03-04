@extends('layouts.app')

@section('content')
    <h1>Tambah Balita</h1>

    <form action="{{ route('balita.store') }}" method="POST">
        @csrf
        <label>Nama Balita:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Umur (bulan):</label><br>
        <input type="number" name="umur" required><br><br>

        <label>Berat Badan (kg):</label><br>
        <input type="number" step="0.1" name="berat" required><br><br>

        <label>Tinggi Badan (cm):</label><br>
        <input type="number" step="0.1" name="tinggi" required><br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection