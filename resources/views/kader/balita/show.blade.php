@extends('layouts.app')

@section('content')
    <h1>Detail Balita</h1>

    <p><strong>Nama:</strong> {{ $balita->nama }}</p>
    <p><strong>Umur:</strong> {{ $balita->umur }} bulan</p>
    <p><strong>Berat Badan:</strong> {{ $balita->berat }} kg</p>
    <p><strong>Tinggi Badan:</strong> {{ $balita->tinggi }} cm</p>

    <a href="{{ route('balita.index') }}">Kembali ke Daftar Balita</a>
@endsection