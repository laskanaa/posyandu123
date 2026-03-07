<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Orang Tua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <h2 class="mb-4">Dashboard Orang Tua</h2>

        @if($balita)

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Data Anak
                </div>

                <div class="card-body">

                    <table class="table">

                        <tr>
                            <th>Nama Anak</th>
                            <td>{{ $balita->nama_anak }}</td>
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
                            <th>Alamat</th>
                            <td>{{ $balita->alamat }}</td>
                        </tr>

                    </table>

                </div>
            </div>

        @else

            <div class="alert alert-warning">
                Data balita belum tersedia.
            </div>

        @endif

    </div>

</body>

</html>