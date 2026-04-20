@extends('layouts.app')

@section('title', 'Detail Balita')

@section('content')

    <div class="dashboard-container">

        <div class="main-content">

            {{-- TOPBAR --}}
            <div class="topbar">
                <h3>Detail Data Balita</h3>
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
                        <td>
                            <span class="badge-status">
                                {{ $penimbanganTerakhir->hasil['kesimpulan'] ?? '-' }}
                            </span>
                        </td>
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
        <th>Tanggal</th>
        <th>Umur (Bulan)</th> 
        <th>BB</th>
        <th>Z BB/U</th>
        <th>Status BB</th>
        <th>TB</th>
        <th>Z TB/U</th>
        <th>Status TB</th>
        <th>LILA</th>
        <th>LIKA</th>
        <th>Status Akhir</th>
        <th>Aksi</th> 
</thead>
                        <tbody>
                            @forelse($balita->penimbangans as $p)
@php
    $tglLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
    $tglTimbang = \Carbon\Carbon::parse($p->tanggal_penimbangan);

    // 🔥 BULATIN KE BAWAH (FIX KMS STYLE)
    $umurBulan = floor($tglLahir->floatDiffInMonths($tglTimbang));
@endphp

    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('d M Y') }}</td>

        {{-- 🔥 UMUR --}}
        <td><b>{{ $umurBulan }}</b> bln</td>

        {{-- BB --}}
        <td>{{ $p->berat_badan }} kg</td>
        <td>{{ $p->hasil['z_bb_u'] ?? '-' }}</td>
        <td>{{ $p->hasil['status_bb'] ?? '-' }}</td>

        {{-- TB --}}
        <td>{{ $p->tinggi_badan }} cm</td>
        <td>{{ $p->hasil['z_tb_u'] ?? '-' }}</td>
        <td>{{ $p->hasil['status_tb'] ?? '-' }}</td>

        {{-- LILA & LIKA --}}
        <td>{{ $p->lila }} cm</td>
        <td>{{ $p->lika }} cm</td>

        {{-- KESIMPULAN --}}
        <td>
            <b>{{ $p->hasil['kesimpulan'] ?? '-' }}</b>
        </td>

        {{-- 🔥 AKSI --}}
        <td style="white-space:nowrap; display:flex; gap:8px; justify-content:center;">

    <!-- EDIT -->
    <a href="{{ route('penimbangan.edit', $p->id) }}"
        title="Edit"
        style="color:#3b82f6;">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536M9 13l6.232-6.232a2 2 0 112.828 2.828L11.828 16H9v-3z"/>
        </svg>
    </a>

    <!-- DELETE -->
    <form action="{{ route('penimbangan.destroy', $p->id) }}"
        method="POST"
        onsubmit="return confirm('Yakin hapus data ini?')">
        @csrf
        @method('DELETE')

        <button type="submit"
            title="Hapus"
            style="background:none; border:none; color:#ef4444; cursor:pointer; padding:0;">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 7h12M9 7V4h6v3m-8 0l1 12h8l1-12"/>
            </svg>
        </button>
    </form>

</td>
    </tr>
@empty
    <tr>
        <td colspan="13">Belum ada data</td>
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
                    <canvas id="chartBBU"></canvas>
                    <canvas id="chartTBU" style="margin-top:40px;"></canvas>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* LAYOUT */
        .dashboard-container {
            display: flex;
            justify-content: center;
        }

        .main-content {
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

        .btn-back {
            background: #4e73df;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
        }


        td a:hover svg {
    transform: scale(1.2);
    transition: 0.2s;
}

td button:hover svg {
    transform: scale(1.2);
    transition: 0.2s;
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

        /* BACKGROUND BIAR LEBIH BAGUS */
        body {
            background: #eef2f7;
        }

        const chart=Chart.getChart("chartBalita");

        function downloadPDF() {
            const image=chart.toBase64Image();

            // kirim ke server
            const form=document.createElement("form");
            form.method="POST";
            form.action="/balita/{{ $balita->id }}/download";

            const csrf=document.createElement("input");
            csrf.type="hidden";
            csrf.name="_token";
            csrf.value="{{ csrf_token() }}";

            const input=document.createElement("input");
            input.type="hidden";
            input.name="chart_image";
            input.value=image;

            form.appendChild(csrf);
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-kms.js') }}"></script>

    <script src="{{ asset('js/chart-kms.js') }}"></script>

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