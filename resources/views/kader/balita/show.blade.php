@extends('layouts.app')

@section('title', 'Detail Balita')

@section('content')

    <div class="dashboard-container">

        {{-- SIDEBAR --}}
        @include('partials.sidebar_kader')


        {{-- MAIN --}}
        <div class="main-content">

            <div class="topbar">
                <h3>Detail Data Balita</h3>

                <a href="{{ route('balita.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>



            {{-- BIODATA --}}
            <div class="card-box">

                <div class="card-header biodata">
                    Biodata Balita
                </div>

                <table class="detail-table">

                    <tr>
                        <th>Nama</th>
                        <td>{{ $balita->nama }}</td>
                    </tr>

                    <tr>
                        <th>NIK</th>
                        <td>{{ $balita->nik }}</td>
                    </tr>

                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>
                            {{ $balita->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $balita->jenis_kelamin }}</td>
                    </tr>

                    <tr>
                        <th>Nama Ibu</th>
                        <td>{{ $balita->nama_ibu }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge-status">
                                {{ $balita->kondisi }}
                            </span>
                        </td>
                    </tr>

                </table>

            </div>



            {{-- AKUN ORTU --}}
            <div class="card-box">

                <div class="card-header akun">
                    Akun Orang Tua
                </div>

                <table class="detail-table">

                    <tr>
                        <th>Username</th>
                        <td>{{ $balita->user->email }}</td>
                    </tr>

                    <tr>
                        <th>Password Awal</th>
                        <td>Nama Ibu saat pendaftaran</td>
                    </tr>

                </table>

            </div>



            {{-- RIWAYAT PENIMBANGAN --}}
            <div class="card-box">

                <div class="card-header riwayat">
                    Riwayat Penimbangan
                </div>

                <table class="riwayat-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>LILA</th>
                            <th>LIKA</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($balita->penimbangans as $p)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('F Y') }}
                                </td>

                                <td>{{ $p->berat_badan }} kg</td>

                                <td>{{ $p->tinggi_badan }} cm</td>

                                <td>{{ $p->lila }} cm</td>

                                <td>{{ $p->lika }} cm</td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" align="center">
                                    Belum ada data penimbangan
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>



            {{-- GRAFIK --}}
            <div class="card-box">

                <div class="card-header grafik">
                    Grafik Pertumbuhan
                </div>

                <div class="chart-box">
                    <canvas id="chartBalita"></canvas>
                </div>

            </div>

        </div>

    </div>



    <style>
        /* LAYOUT */

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            font-family: sans-serif;
        }

        .sidebar {
            width: 230px;
            background: #0d4f4d;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 25px;
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
            background: none;
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

        .btn-back {
            background: #4e73df;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #2e59d9;
        }



        /* CARD */

        .card-box {
            background: white;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 12px 18px;
            font-weight: 600;
            color: white;
        }

        .biodata {
            background: #4e73df;
        }

        .akun {
            background: #1cc88a;
        }

        .riwayat {
            background: #f6c23e;
            color: black;
        }

        .grafik {
            background: #36b9cc;
        }



        /* TABLE */

        .detail-table,
        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table th {
            width: 220px;
            background: #f8f9fc;
            padding: 10px;
            border: 1px solid #e3e6f0;
            text-align: left;
        }

        .detail-table td {
            padding: 10px;
            border: 1px solid #e3e6f0;
        }

        .riwayat-table th {
            background: #2c3e50;
            color: white;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .riwayat-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .riwayat-table tr:hover {
            background: #f1f4ff;
        }



        /* STATUS */

        .badge-status {
            background: #e74a3b;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
        }



        /* GRAFIK */

        .chart-box {
            padding: 20px;
        }
    </style>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('chartBalita');

        new Chart(ctx, {
            type: 'line',

            data: {
                labels: [
                    @foreach($balita->penimbangans as $p)
                        "{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('M Y') }}",
                    @endforeach
            ],

                datasets: [

                    {
                        label: 'Berat Badan',
                        data: [
                            @foreach($balita->penimbangans as $p)
                                {{ $p->berat_badan }},
                            @endforeach
            ],
                        borderWidth: 3
                    },

                    {
                        label: 'Tinggi Badan',
                        data: [
                            @foreach($balita->penimbangans as $p)
                                {{ $p->tinggi_badan }},
                            @endforeach
            ],
                        borderWidth: 3
                    }

                ]

            }

        });

    </script>

@endsection