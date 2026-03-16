@extends('layouts.app')

@section('title', 'Data Balita')

@section('content')

    <div class="wrapper">

        ```
        <!-- SIDEBAR -->
        @include('partials.sidebar_kader')

        <!-- MAIN -->
        <div class="main">

            <div class="topbar">

                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Balita</h3>
                </div>

                <span>Selamat Datang, Kader 👋</span>

            </div>

            <div class="cards">
                <div class="card">
                    <h4>Total Balita</h4>
                    <p>{{ $balitas->count() }}</p>
                </div>
            </div>

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
                                        $umurBulan = $tanggalLahir->diffInDays(\Carbon\Carbon::now()) / 30;
                                        $umurBulan = round($umurBulan * 2) / 2;
                                    @endphp

                                    {{ $umurBulan }} Bulan
                                </td>

                                <td>{{ $balita->nama_ibu }}</td>

                                <td>

                                    @if($balita->kondisi == 'Stunting' || $balita->kondisi == 'Stunting Berat')

                                        <span class="status-stunting">
                                            {{ $balita->kondisi }}
                                        </span>

                                    @else

                                        <span class="status-normal">
                                            {{ $balita->kondisi }}
                                        </span>

                                    @endif

                                </td>

                                <td class="action-buttons">

                                    <a href="{{ route('balita.show', $balita->id) }}" class="btn btn-view">Lihat</a>

                                    <a href="{{ route('balita.edit', $balita->id) }}" class="btn btn-edit">Edit</a>

                                    <form action="{{ route('balita.destroy', $balita->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus data balita ini?')">

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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .card p {
        font-size: 28px;
        font-weight: bold;
        color: #0d4f4d;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .table-actions {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
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

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
    }

    th {
        background: #0d4f4d;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 13px;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-view {
        background: #27ae60;
    }

    .btn-edit {
        background: #f1c40f;
        color: #333;
    }

    .btn-delete {
        background: #e74c3c;
    }

    .status-stunting {
        color: red;
        font-weight: bold;
    }

    .status-normal {
        color: green;
        font-weight: bold;
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