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

        h2 {
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
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h2>Data Balita</h2>

    <table>
        <tr>
            <th>Nama</th>
            <td>{{ $balita->nama }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $balita->nik }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $balita->tanggal_lahir }}</td>
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
            <td>{{ $balita->kondisi }}</td>
        </tr>
    </table>

    <h3>Riwayat Penimbangan</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>BB</th>
                <th>TB</th>
                <th>LILA</th>
                <th>LIKA</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($balita->penimbangans as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->tanggal_penimbangan }}</td>
                    <td>{{ $p->berat_badan }}</td>
                    <td>{{ $p->tinggi_badan }}</td>
                    <td>{{ $p->lila }}</td>
                    <td>{{ $p->lika }}</td>
                    <td>{{ $p->pesan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>