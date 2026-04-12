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
                            <th>TTL</th>
                            <td>{{ $balita->tempat_lahir }},
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
                            <td><span class="badge-status">{{ $balita->kondisi }}</span></td>
                        </tr>
                    </table>
                </div>

                {{-- AKUN --}}
                <div class="card-box">
                    <div class="card-header akun">Akun Orang Tua</div>
                    <table class="detail-table">
                        <tr>
                            <th>Email</th>
                            <td>{{ $balita->user->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Password Awal</th>
                            <td>Nama Ibu saat pendaftaran</td>
                        </tr>
                    </table>
                </div>

                {{-- RIWAYAT + PESAN --}}
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
                                    <th>Pesan Kader</th> {{-- 🔥 --}}
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

                                        {{-- 🔥 PESAN --}}
                                        <td class="pesan-cell">
                                            @if($p->pesan)
                                                <div class="pesan-box">
                                                    {{ $p->pesan }}
                                                </div>
                                            @else
                                                <span class="no-pesan">-</span>
                                            @endif
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
        .dashboard-container {
            width: 100%;
            padding: 20px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .main-content {
            max-width: 1200px;
            margin: auto;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
        }

        .page-subtitle {
            color: #64748b;
            margin-bottom: 25px;
        }

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

        .detail-table,
        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table th {
            width: 220px;
            background: #f8f9fc;
        }

        .detail-table th,
        .detail-table td,
        .riwayat-table th,
        .riwayat-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .riwayat-table th {
            background: #2c3e50;
            color: white;
        }

        .riwayat-table td {
            text-align: center;
        }

        /* 🔥 PESAN STYLE */
        .pesan-cell {
            max-width: 220px;
        }

        .pesan-box {
            background: #ecfeff;
            padding: 8px 10px;
            border-radius: 10px;
            font-size: 13px;
            text-align: left;
            color: #0f172a;
        }

        .no-pesan {
            color: #999;
        }

        /* STATUS */
        .badge-status {
            background: #e74a3b;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
        }

        /* CHART */
        .chart-box {
            padding: 20px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 400px !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-kms.js') }}"></script>

    <script>
        window.whoData = @json($whoData ?? []);

        renderKMSChart(
            'chartBalita',
            "{{ strtolower($balita->jenis_kelamin ?? '') }}",
            @json($balita->penimbangans ?? []),
            "{{ $balita->tanggal_lahir ?? '' }}"
        );
    </script>

@endsection