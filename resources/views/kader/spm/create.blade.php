@extends('layouts.app')

@section('title', 'Tambah SPM')

@section('content')

    <div class="dashboard-container">

        @include('partials.sidebar_kader')

        <div class="main-content">

            <h2 class="page-title">Tambah Data SPM</h2>

            <div class="form-card">

                <form action="{{ route('kader.spm.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Pilih Bidang</label>

                        <select id="spmSelect" onchange="setSpmData()" required>

                            <option value="">-- Pilih Bidang --</option>
                            <option value="pendidikan">🎓 Pendidikan</option>
                            <option value="kesehatan">🩺 Kesehatan</option>
                            <option value="pu">🚰 Pekerjaan Umum</option>
                            <option value="perumahan">🏠 Perumahan Rakyat</option>
                            <option value="trantibum">🛡 Trantibum Linmas</option>
                            <option value="sosial">🤝 Sosial</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Logo</label>
                        <input type="text" name="icon" id="icon" readonly class="locked-input">
                    </div>

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" id="judul" readonly class="locked-input">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="3"></textarea>
                    </div>

                    <button class="btn-save">
                        Simpan SPM
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>

        function setSpmData() {

            let select = document.getElementById("spmSelect").value

            let icon = document.getElementById("icon")
            let judul = document.getElementById("judul")

            if (select === "pendidikan") {
                icon.value = "🎓"
                judul.value = "Pendidikan"
            }

            if (select === "kesehatan") {
                icon.value = "🩺"
                judul.value = "Kesehatan"
            }

            if (select === "pu") {
                icon.value = "🚰"
                judul.value = "Pekerjaan Umum"
            }

            if (select === "perumahan") {
                icon.value = "🏠"
                judul.value = "Perumahan Rakyat"
            }

            if (select === "trantibum") {
                icon.value = "🛡"
                judul.value = "Ketenteraman dan Ketertiban Umum"
            }

            if (select === "sosial") {
                icon.value = "🤝"
                judul.value = "Sosial"
            }

        }

    </script>

@endsection


<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        font-family: Arial;
    }

    .main-content {
        flex: 1;
        padding: 40px;
        background: #f5f7fa;
    }

    .page-title {
        margin-bottom: 25px;
    }

    .form-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        width: 100%;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 18px;
    }

    .form-group label {
        margin-bottom: 6px;
        font-weight: 600;
    }

    input,
    select,
    textarea {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn-save {
        margin-top: 10px;
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-save:hover {
        background: #083a38;
    }
</style>

<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        font-family: sans-serif;
    }

    .main-content {
        flex: 1;
        padding: 30px;
        background: #f4f6f9;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .btn-add {
        background: #0d4f4d;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }

    .card-table {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .aksi {
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #ffc107;
        padding: 6px 10px;
        border-radius: 4px;
        text-decoration: none;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
    }
</style>