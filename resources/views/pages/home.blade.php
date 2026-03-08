@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @foreach($sliders as $slider)

        <img src="{{ asset('slider/' . $slider->gambar) }}" width="100%">

        <h2>{{ $slider->judul }}</h2>
        <p>{{ $slider->deskripsi }}</p>

    @endforeach

    <div class="home-container">
        <h1>Selamat Datang</h1>
        <p>Ini halaman home.</p>
    </div>

@endsection