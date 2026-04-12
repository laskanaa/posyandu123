@extends('layouts.app')

@section('title', 'Data Informasi')

@section('content')
    <div class="wrapper">

        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <div class="main">

            <div class="topbar">
                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Informasi</h3>
                </div>

                <span>Selamat Datang, Kader 👋</span>
            </div>

            <div class="cards">
                <div class="card">
                    <h4>Total Informasi</h4>
                    <p>{{ $data->count() }}</p>
                </div>
            </div>

            <div class="table-container">

                <div class="table-actions">
                    <a href="{{ route('kader.informasi.create') }}" class="btn-add">
                        + Tambah Informasi
                    </a>
                </div>

                <!-- 🔥 TAMBAHAN WRAPPER -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Angka</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->angka }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('kader.informasi.edit', $item->id) }}" class="btn btn-edit">✏️</a>
                                        <form action="{{ route('kader.informasi.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete"
                                                onclick="return confirm('Yakin hapus?')">
                                                🗑️
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

        toggle.onclick = () => { sidebar.classList.toggle("active"); overlay.classList.toggle("active"); };
        overlay.onclick = () => { sidebar.classList.remove("active"); overlay.classList.remove("active"); };
    </script>
@endsection

<style>
    .wrapper {
        display: flex;
        min-height: 100vh;
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
        flex-wrap: wrap;
        gap: 10px;
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
        flex-wrap: wrap;
    }

    .btn-add {
        padding: 8px 15px;
        background: #0d4f4d;
        color: white;
        border-radius: 6px;
        text-decoration: none;
    }

    /* 🔥 RESPONSIVE TABLE */
    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 500px;
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
        flex-wrap: wrap;
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

    .btn-edit {
        background: #f1c40f;
        color: #333;
    }

    .btn-delete {
        background: #e74c3c;
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

    /* 🔥 MOBILE */
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

        .btn-add {
            width: 100%;
            text-align: center;
        }
    }
</style>