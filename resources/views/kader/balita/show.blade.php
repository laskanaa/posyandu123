@extends('layouts.app')

@section('title', 'Detail Balita')

@section('content')

    <style>
        .container {
            max-width: 1100px;
        }

        .card-box {
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            padding: 12px 18px;
            font-weight: 600;
            font-size: 16px;
        }

        .biodata-header {
            background: #4e73df;
            color: white;
        }

        .akun-header {
            background: #1cc88a;
            color: white;
        }

        .riwayat-header {
            background: #f6c23e;
        }

        .grafik-header {
            background: #36b9cc;
            color: white;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table th {
            width: 220px;
            background: #f8f9fc;
            padding: 10px;
            border: 1px solid #dcdcdc;
        }

        .detail-table td {
            padding: 10px;
            border: 1px solid #dcdcdc;
        }

        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
        }

        .riwayat-table th {
            background: #2c3e50;
            color: white;
            padding: 10px;
            border: 1px solid #dcdcdc;
        }

        .riwayat-table td {
            padding: 10px;
            border: 1px solid #dcdcdc;
        }

        .riwayat-table tr:hover {
            background: #f5f7ff;
        }

        .badge-status {
            background: #e74a3b;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .btn-edit {
            background: #4e73df;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #2e59d9;
        }

        .chart-box {
            padding: 20px;
        }
    </style>

    <div class="container mt-4">

        <h3 class="mb-4">Detail Data Balita</h3>


        {{-- BIODATA --}}
        <div class="card-box">

            <div class="card-header biodata-header">
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



        {{-- AKUN ORANG TUA --}}
        <div class="card-box">

            <div class="card-header akun-header">
                Akun Orang Tua
            </div>

            <table class="detail-table">

                <tr>
                    <th>Username</th>
                    <td>{{ $balita->user->username }}</td>
                </tr>

                <tr>
                    <th>Password Awal</th>
                    <td>(password = nama ibu saat didaftarkan)</td>
                </tr>

            </table>

        </div>



        {{-- RIWAYAT PENIMBANGAN --}}
        <div class="card-box">

            <div class="card-header riwayat-header">
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
                        <th>Aksi</th>
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

                            <td>

                                <a href="{{ route('penimbangan.edit', $p->id) }}" class="btn-edit">
                                    Edit
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" align="center">
                                Belum ada data penimbangan
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- GRAFIK --}}
        <div class="card-box">

            <div class="card-header grafik-header">
                Grafik Pertumbuhan Balita
            </div>

            <div class="chart-box">

                <canvas id="kmsChart"></canvas>

            </div>

        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('kmsChart');

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