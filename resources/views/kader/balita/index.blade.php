@extends('layouts.app')

@section('title', 'Data Balita')

@section('content')
    <div class="dashboard-container">

        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Kader</h2>
            <ul>
                <li><a href="{{ route('dashboard.kader') }}">Dashboard</a></li>
                <li class="active"><a href="{{ route('balita.index') }}">Data Balita</a></li>
                <li>Data Orang Tua</li>
                <li>Slider</li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

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
                <a href="{{ route('balita.create') }}" class="btn-add">+ Tambah Balita</a>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>TTL</th>
                            <th>Nama Ibu</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($balitas as $index => $balita)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $balita->nama }}</td>
                                <td>{{ $balita->nik }}</td>
                                <td>
                                    {{ $balita->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}
                                </td>
                                <td>{{ $balita->nama_ibu }}</td>
                                <td>
                                    @if($balita->kondisi == 'Stunting' || $balita->kondisi == 'Stunting Berat')
                                        <span style="color:red;font-weight:bold;">
                                            {{ $balita->kondisi }}
                                        </span>
                                    @else
                                        <span style="color:green;font-weight:bold;">
                                            {{ $balita->kondisi }}
                                        </span>
                                    @endif
                                </td>
                                <td>

                                    <a href="{{ route('balita.show', $balita->id) }}" class="btn btn-info btn-sm">
                                        Lihat
                                    </a>

                                    <a href="{{ route('balita.edit', $balita->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('balita.destroy', $balita->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin mau hapus data balita ini?')">
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
        /* CSS kamu tetap sama, tidak aku ubah */
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
            align-items: center;
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
            margin-bottom: 10px;
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

        .table-container .btn-add {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 15px;
            background: #0d4f4d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table-container th {
            background: #0d4f4d;
            color: white;
        }

        .table-container td .btn-detail {
            padding: 5px 10px;
            background: #0d4f4d;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>

@endsection