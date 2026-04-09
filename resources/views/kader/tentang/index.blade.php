@extends('layouts.app')

@section('title', 'Data Tentang')

@section('content')

    <div class="wrapper">

        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <div class="main">

            <div class="topbar">
                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Tentang</h3>
                </div>

                @if(!$tentang)
                    <a href="{{ route('kader.tentang.create') }}" class="btn-add">
                        + Tambah Data
                    </a>
                @endif
            </div>

            <div class="card-table">

                @if($tentang)

                    <table>
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>

                                <td>{{ $tentang->deskripsi1 }}</td>

                                <td>
                                    @if($tentang->gambar)
                                        <img src="{{ asset('storage/' . $tentang->gambar) }}" width="120">
                                    @endif
                                </td>

                                <td class="aksi">

                                    <!-- EDIT -->
                                    <a href="{{ route('kader.tentang.edit', $tentang->id) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <!-- HAPUS -->
                                    <form action="{{ route('kader.tentang.destroy', $tentang->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin mau hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        </tbody>
                    </table>

                @else
                    <p>Belum ada data.</p>
                @endif

            </div>

        </div>

    </div>

    <div class="overlay" id="overlay"></div>

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
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-add {
        background: #0d4f4d;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .aksi form {
        margin: 0;
    }

    .card-table {
        background: white;
        padding: 20px;
        border-radius: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
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

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: none;
    }

    .overlay.active {
        display: block;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const toggle = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        if (toggle) {
            toggle.addEventListener("click", function () {
                sidebar.classList.toggle("active");
                overlay.classList.toggle("active");
            });
        }

        if (overlay) {
            overlay.addEventListener("click", function () {
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            });
        }

    });
</script>