@extends('layouts.app')

@section('title', 'Data Layanan')

@section('content')

    <div class="dashboard-container">

        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <div class="main-content">

            <div class="topbar">
                <div class="topbar-left">
                    <button class="hamburger" onclick="toggleSidebar()">☰</button>
                    <h3>Layanan Posyandu</h3>
                </div>

                <a href="{{ route('kader.layanan.create') }}" class="btn-add">
                    + Tambah Layanan
                </a>
            </div>

            <div class="card-table">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Icon</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($layanans as $layanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="icon-cell">
                                        <span class="emoji-icon">
                                            {{ $layanan->icon ?? '❔' }}
                                        </span>
                                    </td>

                                    <td>{{ $layanan->judul }}</td>

                                    <td class="aksi">
                                        <a href="{{ route('kader.layanan.edit', $layanan->id) }}" class="btn-edit">✏️</a>

                                        <form action="{{ route('kader.layanan.destroy', $layanan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-delete">🗑️</button>
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

@endsection

<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        background: #f4f6fb;
    }

    /* SIDEBAR */
    .sidebar {
        position: fixed;
        left: -260px;
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
    .main-content {
        flex: 1;
        padding: 30px;
        width: 100%;
    }

    /* TOPBAR */
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .hamburger {
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
    }

    /* BUTTON */
    .btn-add {
        background: #0d4f4d;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
    }

    /* CARD */
    .card-table {
        background: white;
        padding: 20px;
        border-radius: 12px;
        overflow: hidden;
    }

    /* TABLE */
    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 500px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    th {
        background: #0d4f4d;
        color: white;
    }

    /* ICON */
    .emoji-icon {
        font-size: 28px;
    }

    /* ACTION */
    .aksi {
        display: flex;
        gap: 8px;
    }

    .btn-edit {
        background: #ffc107;
        padding: 6px 10px;
        border-radius: 6px;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
    }

    /* RESPONSIVE */
    @media(max-width:768px) {
        .main-content {
            padding: 15px;
        }

        table {
            font-size: 13px;
        }
    }
</style>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
    }
</script>