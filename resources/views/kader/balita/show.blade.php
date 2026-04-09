@extends('layouts.app')

@section('title', 'Detail Balita')

@section('content')

    <div class="dashboard-container">

        {{-- SIDEBAR --}}
        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        {{-- MAIN --}}
        <div class="main-content">

            {{-- TOPBAR --}}
            <div class="topbar">
                <div class="left">
                    <button class="btn-toggle" onclick="toggleSidebar()">☰</button>
                    <h3>Detail Data Balita</h3>
                </div>
                <a href="{{ route('balita.index') }}" class="btn-back">← Kembali</a>
            </div>

            {{-- BIODATA --}}
            <div class="card-box">
                <div class="card-header biodata">Biodata Balita</div>
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
                        <th>Username</th>
                        <td>{{ $balita->user->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Password Awal</th>
                        <td>Nama Ibu saat pendaftaran</td>
                    </tr>
                </table>
            </div>

            {{-- RIWAYAT --}}
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
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('M Y') }}</td>
                                    <td>{{ $p->berat_badan }} kg</td>
                                    <td>{{ $p->tinggi_badan }} cm</td>
                                    <td>{{ $p->lila }} cm</td>
                                    <td>{{ $p->lika }} cm</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Belum ada data</td>
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

        </div>
    </div>

    <style>
        /* LAYOUT */
        .dashboard-container {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            background: #0d4f4d;
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: 0.3s;
        }

        /* MAIN */
        .main-content {
            margin-left: 230px;
            width: 100%;
            padding: 20px;
            background: #f4f6f9;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .topbar .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-toggle {
            background: #0d4f4d;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn-back {
            background: #4e73df;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        /* CARD */
        .card-box {
            background: white;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 12px;
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
            width: 200px;
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

        .table-wrapper {
            overflow-x: auto;
        }

        /* STATUS */
        .badge-status {
            background: #e74a3b;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
        }

        /* CHART */
        .chart-box {
            padding: 20px;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 999;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-kms.js') }}"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

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