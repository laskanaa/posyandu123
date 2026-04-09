@extends('layouts.app')

@section('title', 'Data Galeri')

@section('content')

    <div class="wrapper">

        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <div class="main">

            <div class="topbar">
                <div class="left">
                    <button id="toggleSidebar" class="hamburger">☰</button>
                    <h3>Data Galeri</h3>
                </div>

                <a href="{{ route('kader.galeri.create') }}" class="btn-add">
                    + Tambah
                </a>
            </div>

            <div class="card-table">

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($galeri as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="img-table">
                                </td>

                                <td class="aksi">
                                    <form action="{{ route('kader.galeri.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty">Belum ada data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

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

    /* ✅ HAMBURGER DISAMAIN */
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

    .card-table {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    .img-table {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .aksi {
        display: flex;
        justify-content: center;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
    }

    .empty {
        padding: 20px;
        color: #64748b;
    }

    .overlay {
        position: fixed;
        inset: 0;
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

        if (toggle && sidebar && overlay) {

            toggle.addEventListener("click", function () {
                sidebar.classList.toggle("active");
                overlay.classList.toggle("active");
            });

            overlay.addEventListener("click", function () {
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            });

        }

    });

    function confirmDelete() {
        return confirm("Yakin mau hapus gambar ini?");
    }
</script>