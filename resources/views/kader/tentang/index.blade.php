@extends('layouts.app')

@section('title', 'Tentang Posyandu')

@section('content')
    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Data Tentang Posyandu</h3>
                <a href="{{ route('kader.tentang.create') }}" class="btn-add">Tambah Data</a>
            </div>

            <div class="card-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tentang)
                            <tr>
                                <td>1</td>
                                <td>{{ $tentang->deskripsi1 }}</td>
                                <td class="aksi">
                                    <a href="{{ route('kader.tentang.edit', $tentang->id) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('kader.tentang.destroy', $tentang->id) }}" method="POST"
                                        style="display:inline;">
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
@endsection

<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        font-family: sans-serif;
    }

    .main-content {
        flex: 1;
        padding: 30px;
        background: #f4f6f9;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
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
        text-align: left;
    }

    table th {
        background: #f7f7f7;
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
</style>