@extends('layouts.app')

@section('title', 'Data Balita')

@section('content')
    <div class="dashboard-container">

        <!-- Sidebar -->
        @include('partials.sidebar_kader')

        <!-- Main Content -->
        <div class="main-content">

            <div class="topbar">
                <h3>Data Balita</h3>
                <span>Selamat Datang, Kader 👋</span>
            </div>

            <div class="cards">
                <div class="card">
                    <h4>Total Balita</h4>
                    <p>{{ $balitas->count() }}</p>
                </div>
            </div>

            <div class="table-container">

                <!-- Tambah dan Search -->
                <div class="table-actions">
                    <a href="{{ route('balita.create') }}" class="btn-add">+ Tambah Balita</a>

                    <form method="GET" action="{{ route('balita.index') }}" class="search-form">
                        <input type="text" name="search" placeholder="Cari nama balita / nama ibu..."
                            value="{{ request('search') }}">
                        <button type="submit">Cari</button>
                    </form>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Balita</th>
                            <th>NIK</th>
                            <th>Umur</th>
                            <th>Nama Ibu</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($balitas as $index => $balita)
                            <tr>
                                <td class="nomor">{{ $index + 1 }}</td>

                                <td>{{ $balita->nama }}</td>

                                <td class="nik">{{ $balita->nik }}</td>

                                <td>
                                    @php
                                        $tanggalLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
                                        $umurBulan = $tanggalLahir->diffInDays(\Carbon\Carbon::now()) / 30;
                                        $umurBulan = round($umurBulan * 2) / 2; // dibulatkan ke 0,5 bulan
                                    @endphp
                                    {{ $umurBulan }} Bulan
                                </td>

                                <td>{{ $balita->nama_ibu }}</td>

                                <td>
                                    @if($balita->kondisi == 'Stunting' || $balita->kondisi == 'Stunting Berat')
                                        <span class="status-stunting">{{ $balita->kondisi }}</span>
                                    @else
                                        <span class="status-normal">{{ $balita->kondisi }}</span>
                                    @endif
                                </td>

                                <td class="action-buttons">
                                    <a href="{{ route('balita.show', $balita->id) }}" class="btn btn-view">Lihat</a>
                                    <a href="{{ route('balita.edit', $balita->id) }}" class="btn btn-edit">Edit</a>
                                    <form action="{{ route('balita.destroy', $balita->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus data balita ini?')">Hapus</button>
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
            min-height: 80vh;
            font-family: sans-serif;
        }

        .sidebar {
            width: 220px;
            background: #0d4f4d;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a,
        .sidebar ul li form button {
            color: white;
            text-decoration: none;
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .sidebar ul li a:hover,
        .sidebar ul li form button:hover,
        .sidebar ul li.active a {
            background: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background: #f4f6f9;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
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

        .card h4 {
            font-size: 14px;
            color: #666;
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
            align-items: center;
            margin-bottom: 15px;
        }

        .btn-add {
            padding: 8px 15px;
            background: #0d4f4d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .search-form {
            display: flex;
            gap: 5px;
        }

        .search-form input {
            padding: 7px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .search-form button {
            padding: 7px 12px;
            background: #0d4f4d;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #0d4f4d;
            color: white;
        }

        /* Kolom No kecil */
        th:nth-child(1),
        td:nth-child(1) {
            width: 40px;
            text-align: center;
        }

        /* Lebarin kolom nama */
        th:nth-child(2),
        td:nth-child(2) {
            width: 220px;
        }

        /* NIK tidak turun */
        .nik {
            white-space: nowrap;
            width: 150px;
        }

        /* Kolom aksi kecil */
        th:last-child,
        td:last-child {
            width: 170px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
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

        .btn-view {
            background: #27ae60;
        }

        .btn-edit {
            background: #f1c40f;
            color: #333;
        }

        .btn-delete {
            background: #e74c3c;
        }

        .status-stunting {
            color: red;
            font-weight: bold;
        }

        .status-normal {
            color: green;
            font-weight: bold;
        }
    </style>
@endsection