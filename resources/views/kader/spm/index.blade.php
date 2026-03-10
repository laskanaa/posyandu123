@extends('layouts.app')

@section('title', 'Data SPM')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">

                <h3>Standar Pelayanan Minimal</h3>

                <a href="{{ route('kader.spm.create') }}" class="btn-add">
                    + Tambah SPM
                </a>

            </div>

            <div class="card-table">

                <table>

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Logo</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($spms as $spm)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td class="logo">
                                    {{ $spm->icon }}
                                </td>

                                <td>{{ $spm->judul }}</td>

                                <td>{{ $spm->deskripsi }}</td>

                                <td class="aksi">

                                    <a href="{{ route('kader.spm.edit', $spm->id) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('kader.spm.destroy', $spm->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn-delete">
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

    </div>

@endsection

<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        font-family: sans-serif;
    }

    .logo {
        font-size: 35px;
        text-align: center;
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

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
    }
</style>