@extends('layouts.app')

@section('title', 'Tambah SPM')

@section('content')

    <div class="container">

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
                    <input type="text" name="icon" id="icon" readonly>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" id="judul" readonly>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"></textarea>
                </div>

                <button class="btn-save">
                    Simpan SPM
                </button>

            </form>

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
    .container {
        max-width: 800px;
        margin: auto;
        padding: 40px;
        font-family: sans-serif;
    }

    .form-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 18px;
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
        background: #0d4f4d;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
    }
</style>