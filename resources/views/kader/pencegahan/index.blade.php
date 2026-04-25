@extends('layouts.app')

@section('title', 'Data Pencegahan')

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
                    <h3>Pencegahan Stunting</h3>
                </div>

                <a href="{{ route('kader.pencegahan.create') }}" class="btn-add">
                    + Tambah Pencegahan
                </a>

            </div>

            <div class="card-table">

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pencegahans as $pencegahan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pencegahan->deskripsi }}</td>
                                <td class="aksi">

                                    <!-- EDIT ICON -->
                                    <a href="{{ route('kader.pencegahan.edit', $pencegahan->id) }}" class="btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M12.146.146a.5.5 0 0 1 .708 0l2.999 3a.5.5 0 0 1 0 .708l-9.5 9.5a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l9.5-9.5zM11.207 2 14 4.793 13.207 5.586 10.414 2.793 11.207 2zM10.5 3.207 2 11.707V14h2.293l8.5-8.5-2.293-2.293z" />
                                        </svg>
                                    </a>

                                    <!-- DELETE ICON -->
                                    <form action="{{ route('kader.pencegahan.destroy', $pencegahan->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm4 0A.5.5 0 0 1 10 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5l1-1h4l1 1h2.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z" />
                                            </svg>
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

    /* 🔥 sedikit disesuaikan biar icon enak */
    .btn-edit,
    .btn-delete {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #ffc107;
        color: #000;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
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