<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Balita</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eee;
        }

        .left {
            text-align: left;
        }
    </style>
</head>

<body>

    <h2>Data Balita</h2>

    <!-- BIODATA -->
    <table>
        <tr>
            <th class="left">Nama</th>
            <td class="left">{{ $balita->nama }}</td>
        </tr>
        <tr>
            <th class="left">NIK</th>
            <td class="left">{{ $balita->nik }}</td>
        </tr>
        <tr>
            <th class="left">Tanggal Lahir</th>
            <td class="left">{{ $balita->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th class="left">Jenis Kelamin</th>
            <td class="left">{{ $balita->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th class="left">Nama Ibu</th>
            <td class="left">{{ $balita->nama_ibu }}</td>
        </tr>
    </table>

    <h3>Riwayat Penimbangan</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penimbangan</th>
                <th>Umur (Bulan)</th>
                <th>BB</th>
                <th>TB</th>
                <th>LILA</th>
                <th>LIKA</th>
                <th>Kesimpulan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($balita->penimbangans as $i => $p)

                @php
                    $umur = round(
                        \Carbon\Carbon::parse($balita->tanggal_lahir)
                            ->diffInDays(\Carbon\Carbon::parse($p->tanggal_penimbangan)) / 30
                    );
                @endphp

                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('d-m-Y') }}</td>
                    <td>{{ $umur }}</td>
                    <td>{{ $p->berat_badan }}</td>
                    <td>{{ $p->tinggi_badan }}</td>
                    <td>{{ $p->lila }}</td>
                    <td>{{ $p->lika }}</td>
                    <td>{{ $p->hasil['kesimpulan'] ?? '-' }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table style="width: 100%; border: none;">
        <tr>
            <td style="border: none; text-align: right;">
                Dicetak pada:
                {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
            </td>
        </tr>
    </table>

</body>

</html>

<style>
    body {
        font-family: sans-serif;
        font-size: 12px;
    }

    h2,
    h3 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
        table-layout: fixed;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 6px;
        text-align: center;
        width: 14.28%;
    }

    th {
        background: #eee;
    }

    .left {
        text-align: left;
    }
</style>