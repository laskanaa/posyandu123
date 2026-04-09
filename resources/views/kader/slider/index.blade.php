@extends('layouts.app')

@section('title', 'Data Slider')

@section('content')

    <div class="wrapper">

        ```
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <!-- MAIN -->
        <div class="main">

            <div class="topbar">

                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Slider</h3>
                </div>

                <a href="{{ route('kader.slider.create') }}" class="btn-add">
                    + Tambah Slider
                </a>

            </div>

            <div class="card-table">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($sliders as $slider)

                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $slider->judul }}</td>
                                <td>{{ $slider->deskripsi }}</td>

                                <td>
                                    <img src="{{ asset('storage/' . $slider->gambar) }}" width="120">
                                </td>

                                <td class="aksi">

                                    <a href="{{ route('kader.slider.edit', $slider->id) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('kader.slider.delete', $slider->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        ```

    </div>

    <div class="overlay" id="overlay"></div>

    <script>

        const toggle = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        toggle.onclick = function () {
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
        }

        overlay.onclick = function () {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        }

    </script>

@endsection

<style>
    .wrapper {
        display: flex;
        min-height: 100vh;
        font-family: sans-serif;
        background: #f4f6f9;
    }

    .sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        width: 260px;
        height: 100%;
        background: #0d4f4d;
        transition: 0.3s;
        z-index: 1000;
    }

    .sidebar.active {
        left: 0;
    }

    .main {
        flex: 1;
        padding: 30px;
        width: 100%;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .hamburger {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 8px 12px;
        font-size: 18px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-add {
        background: #0d4f4d;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }

    .card-table {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .aksi {
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #ffc107;
        padding: 6px 10px;
        border-radius: 4px;
        text-decoration: none;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        z-index: 900;
    }

    .overlay.active {
        display: block;
    }
</style>