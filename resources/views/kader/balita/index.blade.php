@extends('layouts.app')

@section('title', 'Data Balita')

@section('content')

    <div class="wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <!-- MAIN -->
        <div class="main">

            <div class="topbar">
                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Balita</h3>
                </div>
                <span>Selamat Datang, Kader 👋</span>
            </div>

            <!-- CARD -->
            <div class="cards">
                <div class="card">
                    <h4>Total Balita</h4>
                    <p>{{ $balitas->count() }}</p>
                </div>
            </div>

            <!-- TABLE -->
            <div class="table-container">

                <div class="table-actions">
                    <a href="{{ route('balita.create') }}" class="btn-add">
                        + Tambah Balita
                    </a>

                    <form method="GET" action="{{ route('balita.index') }}" class="search-form">
                        <input type="text" name="search" placeholder="Cari nama balita / nama ibu..."
                            value="{{ request('search') }}">
                        <button type="submit">Cari</button>
                    </form>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Balita</th>
                                <th>NIK</th>
                                <th>Umur</th>
                                <th>Nama Ibu</th>
                                <th>Kondisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($balitas as $index => $balita)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $balita->nama }}</td>
                                    <td>{{ $balita->nik }}</td>

                                    <td>
                                        @php
                                            $tanggalLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
                                            $umurBulan = $tanggalLahir->diffInDays(now()) / 30;
                                            $umurBulan = round($umurBulan * 2) / 2;
                                        @endphp
                                        {{ $umurBulan }} Bulan
                                    </td>

                                    <td>{{ $balita->nama_ibu }}</td>

                                    <td>
@php
    $last = $balita->penimbangans->last();
    $kondisi = strtolower($last->hasil['kesimpulan'] ?? '');
@endphp

<span class="{{ str_contains($kondisi, 'stunting') ? 'status-stunting' : 'status-normal' }}">
    {{ $last->hasil['kesimpulan'] ?? 'Belum ada data' }}
</span>
                                    </td>

                                    <td class="action-buttons">
                                        <a href="{{ route('balita.show', $balita->id) }}" class="btn btn-view">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('balita.edit', $balita->id) }}" class="btn btn-edit">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('balita.destroy', $balita->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('balita.download', $balita->id) }}" class="btn btn-download"
                                                target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>

                                            <button type="submit" class="btn btn-delete"
                                                onclick="return confirm('Yakin ingin menghapus data balita ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* LAYOUT */
    .wrapper {
        display: flex;
        min-height: 100vh;
        font-family: sans-serif;
        background: #f4f6f9;
    }

    /* SIDEBAR */
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

    /* MAIN */
    .main {
        flex: 1;
        padding: 30px;
        width: 100%;
    }

    /* TOPBAR */
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
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

    /* CARD */
    .cards {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        flex: 1;
    }

    .card p {
        font-size: 28px;
        font-weight: bold;
        color: #0d4f4d;
    }

    /* TABLE */
    .table-container {
        background: white;
        padding: 20px;
        border-radius: 12px;
    }

    .btn i {
        font-size: 14px;
    }

    .btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-actions {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-add {
        padding: 8px 15px;
        background: #0d4f4d;
        color: white;
        border-radius: 6px;
        text-decoration: none;
    }

    .search-form {
        display: flex;
        gap: 5px;
    }

    .search-form input {
        padding: 7px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .search-form button {
        padding: 7px 12px;
        background: #0d4f4d;
        color: white;
        border: none;
        border-radius: 6px;
    }

    /* TABLE WRAPPER */
    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    th {
        background: #0d4f4d;
        color: white;
    }

    /* ACTION */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 13px;
        color: white;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view {
        background: #27ae60;
    }

    .btn-edit {
        background: #f1c40f;
        color: black;
    }

    .btn-download {
        background: #3498db;
    }

    .btn-delete {
        background: #e74c3c;
    }

    /* STATUS */
    .status-stunting {
        color: #e74c3c;
        font-weight: bold;
    }

    .status-normal {
        color: #27ae60;
        font-weight: bold;
    }

    /* OVERLAY */
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

    /* RESPONSIVE */
    @media(max-width:768px) {

        .main {
            padding: 15px;
        }

        .cards {
            flex-direction: column;
        }

        .topbar span {
            display: none;
        }

        .search-form {
            width: 100%;
        }

        .search-form input {
            flex: 1;
        }
    }
</style>