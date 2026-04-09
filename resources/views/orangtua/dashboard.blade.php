@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')

    <div class="dashboard-container">

        <div class="main-content">

            <h2 class="page-title">Dashboard Orang Tua</h2>
            <p class="page-subtitle">Pantau tumbuh kembang dan kesehatan buah hati Anda</p>

            @if($balita)

                {{-- BIODATA --}}
                <div class="card-box">
                    <div class="card-header biodata">Biodata Anak</div>
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
                            <td>{{ $balita->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}</td>
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
                            <td><span class="badge-status">{{ $balita->kondisi }}</span></td>
                        </tr>
                    </table>
                </div>

                {{-- AKUN ORTU --}}
                <div class="card-box">
                    <div class="card-header akun">Akun Orang Tua</div>
                    <table class="detail-table">
                        <tr>
                            <th>Email Terdaftar</th>
                            <td>{{ $balita->user->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Password Awal</th>
                            <td>Nama Ibu saat pendaftaran</td>
                        </tr>
                    </table>
                </div>

                {{-- RIWAYAT PENIMBANGAN --}}
                <div class="card-box">
                    <div class="card-header riwayat">Riwayat Penimbangan</div>
                    <div class="table-wrapper">
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
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('F Y') }}</td>
                                        <td>{{ $p->berat_badan }} kg</td>
                                        <td>{{ $p->tinggi_badan }} cm</td>
                                        <td>{{ $p->lila }} cm</td>
                                        <td>{{ $p->lika }} cm</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" align="center">Belum ada data penimbangan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- GRAFIK --}}
                <div class="card-box">
                    <div class="card-header grafik">Grafik Pertumbuhan</div>
                    <div class="chart-box">
                        <canvas id="chartBalita"></canvas>
                    </div>
                </div>

            @else
                <div class="card-box empty-box">
                    <h5>Data balita belum tersedia</h5>
                </div>
            @endif

        </div>
    </div>

    <style>
        /* LAYOUT UTAMA */
        .dashboard-container {
            width: 100%;
            padding: 20px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* TITLE */
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #64748b;
            margin-bottom: 25px;
        }

        /* CARD */
        .card-box {
            background: white;
            border-radius: 12px;
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

        .table-wrapper {
            overflow-x: auto;
        }

        /* STATUS */
        .badge-status {
            background: #e74a3b;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        /* CHART */
        .chart-box {
            width: 100%;
            padding: 20px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 400px !important;
        }

        /* RESPONSIVE */
        @media(max-width:1024px) {
            .chart-box canvas {
                height: 350px !important;
            }

            .detail-table th,
            .detail-table td {
                font-size: 14px;
                padding: 8px;
            }

            .riwayat-table th,
            .riwayat-table td {
                font-size: 13px;
                padding: 8px;
            }
        }

        @media(max-width:768px) {
            .chart-box canvas {
                height: 300px !important;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .page-subtitle {
                font-size: 0.9rem;
            }
        }

        @media(max-width:480px) {
            .chart-box canvas {
                height: 250px !important;
            }

            .detail-table th,
            .detail-table td,
            .riwayat-table th,
            .riwayat-table td {
                font-size: 12px;
                padding: 6px;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-kms.js') }}"></script>
    <script>
        window.whoData = @json($whoData);

        renderKMSChart(
            'chartBalita',
            "{{ strtolower($balita->jenis_kelamin) }}",
            [
                @foreach($balita->penimbangans as $p)
                    {{ $p->berat_badan }},
                @endforeach
        ],
            [
                @foreach($balita->penimbangans as $p)
                    "{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('M Y') }}",
                @endforeach
        ]
        );
    </script>

@endsection