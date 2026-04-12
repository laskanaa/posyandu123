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

                    <div class="table-wrapper">
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
                                        <a href="{{ route('kader.tentang.edit', $tentang->id) }}" class="btn-edit">
                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('kader.tentang.destroy', $tentang->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-delete">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
        overflow: hidden;
        /* 🔥 INI PENTING biar ga keluar garis */
    }

    /* WRAPPER BIAR SCROLL */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 500px;
        /* 🔥 biar ga gepeng */
        border-collapse: collapse;
        table-layout: fixed;
        /* 🔥 BIAR RAPIH */
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        word-wrap: break-word;
        /* 🔥 biar teks ga keluar */
    }

    th {
        background: #0d4f4d;
        color: white;
        text-align: left;
    }

    td img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
    }

    .aksi {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-edit {
        background: #ffc107;
        padding: 6px 10px;
        border-radius: 4px;
        text-decoration: none;
        color: black;
        white-space: nowrap;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        white-space: nowrap;
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

    /* RESPONSIVE */
    @media(max-width:768px) {

        .main {
            padding: 15px;
        }

        table {
            font-size: 13px;
        }

        th,
        td {
            padding: 8px;
        }

        .topbar h3 {
            font-size: 16px;
        }

        .btn-add {
            padding: 8px 12px;
            font-size: 12px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const toggle = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        if (toggle) {
            toggle.onclick = () => {
                sidebar.classList.toggle("active");
                overlay.classList.toggle("active");
            };
        }

        if (overlay) {
            overlay.onclick = () => {
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            };
        }

    });
</script>