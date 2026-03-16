@extends('layouts.app')

@section('title', 'Tentang Posyandu')

@section('content')

    <div class="wrapper">

        <!-- SIDEBAR -->
        @include('partials.sidebar_kader')

        <!-- MAIN -->
        <div class="main">

            <div class="topbar">

                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Tentang Posyandu</h3>
                </div>

                <a href="{{ route('kader.tentang.create') }}" class="btn-add">
                    Tambah Data
                </a>

            </div>

            <div class="card-table">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if($tentang)

                            <tr>

                                <td>1</td>

                                <td>
                                    @if($tentang->gambar)
                                        <img src="{{ asset('storage/' . $tentang->gambar) }}" width="100"
                                            style="border-radius:8px;">
                                    @else
                                        <span class="placeholder-icon">❔</span>
                                    @endif
                                </td>

                                <td>
                                    <p>{{ $tentang->deskripsi1 }}</p>

                                    @if($tentang->deskripsi2)
                                        <p>{{ $tentang->deskripsi2 }}</p>
                                    @endif
                                </td>

                                <td class="aksi">

                                    <a href="{{ route('kader.tentang.edit', $tentang->id) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('kader.tentang.destroy', $tentang->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">Hapus</button>
                                    </form>

                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

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
        vertical-align: middle;
    }

    table th {
        background: #f7f7f7;
        text-align: left;
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
        color: black;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .placeholder-icon {
        font-size: 36px;
        color: #bbb;
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