@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')

<div class="dashboard-container">
    <div class="main-content">

        {{-- TOPBAR --}}
        <div class="topbar">
            <h3>Dashboard Balita</h3>
        </div>

        {{-- BIODATA --}}
        <div class="card-box">
            <div class="card-header biodata">Biodata Balita</div>
            <table class="detail-table">
                <tr><th>Nama</th><td>{{ $balita->nama }}</td></tr>
                <tr><th>NIK</th><td>{{ $balita->nik }}</td></tr>
                <tr>
                    <th>TTL</th>
                    <td>{{ $balita->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}
                    </td>
                </tr>
                <tr><th>Jenis Kelamin</th><td>{{ $balita->jenis_kelamin }}</td></tr>
                <tr><th>Nama Ibu</th><td>{{ $balita->nama_ibu }}</td></tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge-status">
                            {{ $penimbanganTerakhir->hasil['kesimpulan'] ?? '-' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        {{-- 🔥 AKUN ORANG TUA --}}
        <div class="card-box">
            <div class="card-header akun">Akun Orang Tua</div>
            <table class="detail-table">
                <tr>
                    <th>Username</th>
                    <td>{{ $balita->user->email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>Nama Ibu</td>
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
                            <th>Tanggal</th>
                            <th>Umur</th>
                            <th>BB</th>
                            <th>Status BB</th>
                            <th>TB</th>
                            <th>Status TB</th>
                            <th>LILA</th>
                            <th>LIKA</th>
                            <th>Status</th>
                            <th>Pesan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($balita->penimbangans as $p)

                        @php
                            $tglLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
                            $tglTimbang = \Carbon\Carbon::parse($p->tanggal_penimbangan);
                            $umur = floor($tglLahir->floatDiffInMonths($tglTimbang));
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('d M Y') }}</td>
                            <td><b>{{ $umur }}</b> bln</td>
                            <td>{{ $p->berat_badan }} kg</td>
                            <td>{{ $p->hasil['status_bb'] ?? '-' }}</td>
                            <td>{{ $p->tinggi_badan }} cm</td>
                            <td>{{ $p->hasil['status_tb'] ?? '-' }}</td>
                            <td>{{ $p->lila }} cm</td>
                            <td>{{ $p->lika }} cm</td>
                            <td><b>{{ $p->hasil['kesimpulan'] ?? '-' }}</b></td>
                            <td class="pesan">{{ $p->pesan ?? '-' }}</td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="11">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 🔥 GRAFIK --}}
        <div class="card-box">
            <div class="card-header grafik">Grafik Pertumbuhan</div>

            <div class="chart-box">
                <canvas id="chartBBU"></canvas>
                <canvas id="chartTBU" style="margin-top:40px;"></canvas>
            </div>
        </div>

    </div>
</div>

<style>
.dashboard-container { display:flex; justify-content:center; }
.main-content { width:100%; padding:20px; background:#f4f6f9; }

.topbar { margin-bottom:20px; }

.card-box {
    background:white;
    border-radius:12px;
    margin-bottom:20px;
    overflow:hidden;
}

.card-header { padding:12px; color:white; }
.biodata { background:#4e73df; }
.akun { background:#1cc88a; }
.riwayat { background:#f6c23e; color:black; }
.grafik { background:#36b9cc; }

.detail-table, .riwayat-table {
    width:100%;
    border-collapse:collapse;
}

.detail-table th { width:200px; background:#f8f9fc; }

.detail-table th, .detail-table td,
.riwayat-table th, .riwayat-table td {
    padding:10px;
    border:1px solid #ddd;
}

.riwayat-table th {
    background:#2c3e50;
    color:white;
}

/* 🔥 PESAN LEBAR */
td.pesan {
    min-width:250px;
    max-width:400px;
    white-space:normal;
}

/* SCROLL MOBILE */
.table-wrapper { overflow-x:auto; }
.riwayat-table { min-width:900px; }

.chart-box { padding:20px; }

.badge-status {
    background:#e74a3b;
    color:white;
    padding:5px 10px;
    border-radius:20px;
}

body { background:#eef2f7; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/chart-kms.js') }}"></script>

<script>
window.whoBBU = @json($whoBBU);
window.whoTBU = @json($whoTBU);

renderKMSChart(
    'chartBBU',
    'bb',
    "{{ strtolower($balita->jenis_kelamin) }}",
    @json($balita->penimbangans),
    "{{ $balita->tanggal_lahir }}"
);

renderKMSChart(
    'chartTBU',
    'tb',
    "{{ strtolower($balita->jenis_kelamin) }}",
    @json($balita->penimbangans),
    "{{ $balita->tanggal_lahir }}"
);
</script>

@endsection