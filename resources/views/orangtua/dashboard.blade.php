@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        body {
            background: #f1f5f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
        }

        .wrapper {
            max-width: 1050px;
            margin: auto;
            padding: 40px 20px;
        }

        .page-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .page-subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 45px;
        }

        /* CARD */

        .card {
            border: none;
            border-radius: 22px;
            background: white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: all .25s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.07);
        }

        .card-header {
            padding: 18px 26px;
            font-size: 14px;
            font-weight: 700;
            color: white;
            letter-spacing: .04em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* HEADER COLORS */

        .header-biodata {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .header-akun {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .header-riwayat {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .header-grafik {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .card-body {
            padding: 30px;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-info th,
        .table-info td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-info th {
            width: 30%;
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table-info td {
            font-weight: 500;
        }

        /* RIWAYAT */

        .table-riwayat thead th {
            background: #f1f5f9;
            padding: 14px;
            font-size: .85rem;
            color: #475569;
            text-align: center;
            font-weight: 700;
        }

        .table-riwayat tbody td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-riwayat tbody tr:hover {
            background: #f8fafc;
        }

        /* STATUS */

        .badge-status {
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .status-normal {
            background: #ecfdf5;
            color: #059669;
        }

        .status-stunting {
            background: #fef2f2;
            color: #dc2626;
        }

        .status-risiko {
            background: #fff7ed;
            color: #ea580c;
        }

        /* CHART */

        .chart-container {
            height: 360px;
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
        }

        /* EMPTY */

        .empty-box {
            padding: 60px;
            text-align: center;
        }

        .empty-box img {
            width: 150px;
            margin-bottom: 15px;
            opacity: .7;
        }

        @media(max-width:768px) {

            .wrapper {
                padding: 20px 15px;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .card-body {
                padding: 22px;
            }

            .table-info th {
                width: 40%;
            }

        }
    </style>

    <div class="wrapper">

        <h3 class="page-title">Dashboard Orang Tua</h3>
        <p class="page-subtitle">Pantau tumbuh kembang dan kesehatan buah hati Anda</p>

        @if($balita)

            <div class="card">

                <div class="card-header header-biodata">
                    Biodata Anak
                </div>

                <div class="card-body">

                    <div class="table-wrapper">

                        <table class="table table-info">

                            <tr>
                                <th>Nama Lengkap</th>
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
                                    {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') }}
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
                                <th>Status Kondisi</th>
                                <td>

                                    @php $status = strtolower($balita->kondisi); @endphp

                                    @if($status == 'normal') <span class="badge-status status-normal">
                                        {{ strtoupper($balita->kondisi) }} </span>

                                    @elseif($status == 'stunting')

                                        <span class="badge-status status-stunting">
                                            {{ strtoupper($balita->kondisi) }}
                                        </span>

                                    @else

                                        <span class="badge-status status-risiko">
                                            {{ strtoupper($balita->kondisi) }}
                                        </span>

                                    @endif

                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header header-akun">
                    Akun Orang Tua
                </div>

                <div class="card-body">

                    <table class="table table-info">

                        <tr>
                            <th>Email Terdaftar</th>
                            <td>{{ $balita->user->email ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Informasi Password</th>
                            <td style="font-style:italic;color:#64748b">
                                Password standar adalah nama ibu saat pendaftaran
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

            <div class="card">

                <div class="card-header header-riwayat">
                    Riwayat Penimbangan
                </div>

                <div class="card-body">

                    <div class="table-wrapper">

                        <table class="table table-riwayat">

                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>BB (Kg)</th>
                                    <th>TB (Cm)</th>
                                    <th>LILA</th>
                                    <th>LIKA</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($balita->penimbangans as $p)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td style="font-weight:600">
                                            {{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->translatedFormat('M Y') }}
                                        </td>

                                        <td>{{ $p->berat_badan }}</td>

                                        <td>{{ $p->tinggi_badan }}</td>

                                        <td>{{ $p->lila }}</td>

                                        <td>{{ $p->lika }}</td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" style="padding:40px;color:#94a3b8">
                                            Belum ada data penimbangan
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header header-grafik">
                    Grafik Pertumbuhan
                </div>

                <div class="card-body">

                    <div class="chart-container">
                        <canvas id="chartBalita"></canvas>
                    </div>

                </div>

            </div>

        @else

            <div class="card empty-box">

                <img src="https://illustrations.popsy.co/gray/empty-box.svg">

                <h5 style="color:#64748b">
                    Data balita belum tersedia
                </h5>

            </div>

        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-kms.js') }}"></script>

    <script>
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