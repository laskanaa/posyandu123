@extends('layouts.app')

@section('title', 'Data Slider')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <div class="topbar">
                <h3>Data Slider</h3>

                <a href="{{ route('kader.slider.create') }}" class="btn-add">
                    + Tambah Slider
                </a>
            </div>

            <div class="card-table">

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $slider->judul }}</td>
                                <td>{{ $slider->deskripsi }}</td>

                                <td>
                                    <img src="{{ asset('storage/' . $slider->gambar) }}" width="120">
                                </td>

                                <td class="aksi">

                                    <a href="{{ route('kader.slider.edit', $slider->id) }}" class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('kader.slider.delete', $slider->id) }}" method="POST">
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

        .btn-add:hover {
            background: #0a3f3d;
        }

        /* TABLE */

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
            font-size: 14px;
        }

        table th {
            background: #f9fafb;
        }

        .aksi {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
    </style>

@endsection