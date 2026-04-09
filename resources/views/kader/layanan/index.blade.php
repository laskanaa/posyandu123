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
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Icon</th>
                            <th>Judul</th>
                            {{-- <th>Deskripsi</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanans as $layanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="icon-cell">
                                    {{-- Revisi: langsung tampilkan emoji --}}
                                    @if($layanan->icon)
                                        <span class="emoji-icon">{{ $layanan->icon }}</span>
                                    @else
                                        <span class="placeholder-icon">❔</span>
                                    @endif
                                </td>
                                <td>{{ $layanan->judul }}</td>
                                {{-- <td>{{ $layanan->deskripsi }}</td> --}}
                                <td class="aksi">
                                    <a href="{{ route('kader.layanan.edit', $layanan->id) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('kader.layanan.destroy', $layanan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection

<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        font-family: 'Segoe UI', sans-serif;
        background: #f4f6fb;
    }

    .main-content {
        flex: 1;
        padding: 30px 40px;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .hamburger {
        font-size: 20px;
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 8px 12px;
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
        transition: 0.2s;
    }

    .btn-add:hover {
        background: #0a3c3a;
    }

    .card-table {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .icon-cell {
        text-align: center;
    }

    .emoji-icon {
        font-size: 32px;
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
        color: #333;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-delete:hover {
        background: #b02a37;
    }
</style>

<script>

    function toggleSidebar() {

        const sidebar = document.querySelector('.sidebar')

        sidebar.classList.toggle('active')

    }

</script>