@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

    <div class="dashboard-container">

        {{-- SIDEBAR --}}
        @include('partials.sidebar_kader')

        <div class="main-content">

            {{-- HEADER --}}
            <div class="topbar">
                <div class="topbar-left">
                    <button class="hamburger" onclick="toggleSidebar()">☰</button>
                    <h3>Tambah Layanan</h3>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="card-form">
                <form action="{{ route('kader.layanan.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Pilih Layanan</label>
                            <select id="layananSelect" onchange="setLayananData()" required>
                                <option value="">-- Pilih Layanan --</option>
                                <option value="penimbangan">⚖️ Penimbangan Berat Badan</option>
                                <option value="pengukuran">📏 Pengukuran Tinggi Badan</option>
                                <option value="imunisasi">💉 Imunisasi</option>
                                <option value="pmt">🥣 PMT</option>
                                <option value="vitamin">💊 Vitamin A</option>
                                <option value="kb">🍼 KB</option>
                                <option value="konseling">🩺 Konseling</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" id="icon" name="icon" readonly class="locked-input">
                        </div>

                        <div class="form-group">
                            <label>Judul Layanan</label>
                            <input type="text" id="judul" name="judul" readonly class="locked-input">
                        </div>
                    </div>

                    <button class="btn-save">Simpan Layanan</button>

                </form>
            </div>

        </div>

    </div>

    {{-- SCRIPT --}}
    <script>
        function setLayananData() {
            const select = document.getElementById('layananSelect').value
            const icon = document.getElementById('icon')
            const judul = document.getElementById('judul')

            switch (select) {
                case 'penimbangan':
                    icon.value = '⚖️'
                    judul.value = 'Penimbangan Berat Badan'
                    break
                case 'pengukuran':
                    icon.value = '📏'
                    judul.value = 'Pengukuran Tinggi Badan'
                    break
                case 'imunisasi':
                    icon.value = '💉'
                    judul.value = 'Imunisasi'
                    break
                case 'pmt':
                    icon.value = '🥣'
                    judul.value = 'Pemberian Makanan Tambahan (PMT)'
                    break
                case 'vitamin':
                    icon.value = '💊'
                    judul.value = 'Vitamin A'
                    break
                case 'kb':
                    icon.value = '🍼'
                    judul.value = 'KB'
                    break
                case 'konseling':
                    icon.value = '🩺'
                    judul.value = 'Konseling Kesehatan'
                    break
                default:
                    icon.value = ''
                    judul.value = ''
            }
        }

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active')
        }
    </script>

@endsection