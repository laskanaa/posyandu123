@extends('layouts.app')

@section('title', 'Tambah Balita')

@section('hideHeader', true)
@section('hideFooter', true)

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --teal-dark: #0a3d38;
            --teal: #0f766e;
            --teal-mid: #14b8a6;
            --teal-light: #ccfbf1;
            --accent: #f59e0b;
            --bg: #f0f7f6;
            --sidebar-w: 260px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: #0d1f1e;
        }

        .dash-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--teal-dark);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform .4s cubic-bezier(.22, 1, .36, 1);
            overflow: hidden;
        }

        .dash-sidebar::before {
            content: '';
            position: absolute;
            top: -80px;
            left: -80px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(20, 184, 166, .15), transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .dash-sidebar::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(245, 158, 11, .08), transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }

        .sidebar-brand-emblem {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(20, 184, 166, .3);
            flex-shrink: 0;
        }

        .sidebar-brand-name {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }

        .sidebar-brand-sub {
            font-size: 10.5px;
            color: var(--teal-mid);
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0;
            position: relative;
            z-index: 1;
            scrollbar-width: none;
        }

        .sidebar-nav::-webkit-scrollbar {
            display: none;
        }

        .sidebar-foot {
            padding: 16px 24px 24px;
            border-top: 1px solid rgba(255, 255, 255, .07);
            position: relative;
            z-index: 1;
        }

        .sidebar-foot-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-avatar {
            width: 36px;
            height: 36px;
            background: rgba(20, 184, 166, .2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .sidebar-foot-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
            line-height: 1.3;
        }

        .sidebar-foot-role {
            font-size: 11px;
            color: var(--teal-mid);
        }

        @media (max-width: 900px) {
            .dash-sidebar {
                transform: translateX(-100%);
            }

            .dash-sidebar.open {
                transform: translateX(0);
            }
        }

        .dash-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @media (max-width: 900px) {
            .dash-main {
                margin-left: 0;
            }
        }

        .dash-topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(240, 247, 246, .9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15, 118, 110, .08);
            padding: 0 32px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .dash-hamburger {
            width: 40px;
            height: 40px;
            background: var(--teal-dark);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background .25s;
        }

        .dash-hamburger:hover {
            background: var(--teal);
        }

        @media (max-width: 900px) {
            .dash-hamburger {
                display: flex;
            }
        }

        .topbar-page {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--teal-dark);
            line-height: 1.2;
        }

        .topbar-greeting {
            font-size: 13px;
            color: #7a9e9b;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-date {
            font-size: 12.5px;
            color: #7a9e9b;
            background: white;
            border: 1px solid rgba(15, 118, 110, .1);
            border-radius: 8px;
            padding: 6px 12px;
        }

        .btn-back-top {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            background: white;
            border: 1.5px solid rgba(15, 118, 110, .2);
            color: var(--teal-dark);
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all .25s;
        }

        .btn-back-top:hover {
            background: var(--teal-light);
            border-color: var(--teal);
            color: var(--teal-dark);
        }

        .dash-content {
            padding: 32px;
            flex: 1;
        }

        .dash-section-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--teal-light);
            color: var(--teal);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 5px 13px;
            border-radius: 30px;
            margin-bottom: 8px;
        }

        .dash-section-tag::before {
            content: '';
            width: 5px;
            height: 5px;
            background: var(--teal);
            border-radius: 50%;
        }

        .dash-section-title {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--teal-dark);
            margin-bottom: 28px;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(15, 118, 110, .07);
            border: 1px solid rgba(15, 118, 110, .06);
            overflow: hidden;
            margin-bottom: 20px;
            animation: slideUp .4s cubic-bezier(.22, 1, .36, 1) both;
        }

        .form-card:nth-child(2) {
            animation-delay: .05s;
        }

        .form-card:nth-child(3) {
            animation-delay: .1s;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card-header {
            padding: 18px 24px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-card-header-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, .15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .form-card-header-title {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: white;
        }

        .form-card-header-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, .65);
            margin-top: 1px;
        }

        .form-card-body {
            padding: 28px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--teal-dark);
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #0d1f1e;
            background: #fafcfc;
            outline: none;
            transition: border-color .25s, box-shadow .25s, background .25s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--teal);
            background: white;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, .1);
        }

        .form-group input::placeholder {
            color: #b0c4c2;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            padding-right: 48px;
        }

        .input-unit {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            font-weight: 600;
            color: #7a9e9b;
            pointer-events: none;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            padding-top: 8px;
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all .3s;
            box-shadow: 0 4px 14px rgba(15, 118, 110, .25);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 118, 110, .35);
        }

        .btn-save:active {
            transform: translateY(0);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            color: #7a9e9b;
            font-size: 14px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: all .25s;
        }

        .btn-cancel:hover {
            border-color: #cbd5e1;
            background: #f8faf9;
            color: #3d5a58;
        }

        .dash-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .35);
            z-index: 900;
            backdrop-filter: blur(2px);
        }

        .dash-overlay.open {
            display: block;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: span 1;
            }

            .dash-content {
                padding: 16px;
            }

            .dash-topbar {
                padding: 0 16px;
            }

            .topbar-date {
                display: none;
            }
        }
    </style>

    <div class="dash-wrapper">

        <aside class="dash-sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-emblem">🌿</div>
                <div>
                    <div class="sidebar-brand-name">Posyandu</div>
                    <div class="sidebar-brand-sub">Paguyangan</div>
                </div>
            </div>
            <div class="sidebar-nav">
                @include('partials.sidebar_kader')
            </div>
            <div class="sidebar-foot">
                <div class="sidebar-foot-user">
                    <div class="sidebar-avatar">🧑‍⚕️</div>
                    <div>
                        <div class="sidebar-foot-name">Kader Posyandu</div>
                        <div class="sidebar-foot-role">Kader Aktif</div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="dash-overlay" id="overlay"></div>

        <div class="dash-main">
            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div>
                        <div class="topbar-page">Tambah Balita</div>
                        <div class="topbar-greeting">Isi data balita baru</div>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <a href="{{ route('balita.index') }}" class="btn-back-top">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </header>

            <div class="dash-content">

                <div class="dash-section-tag">Manajemen Data</div>
                <h2 class="dash-section-title">Tambah Data Balita Baru</h2>

                <form action="{{ route('balita.store') }}" method="POST">
                    @csrf

                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="form-card-header-icon">👶</div>
                            <div>
                                <div class="form-card-header-title">Biodata Balita</div>
                                <div class="form-card-header-sub">Informasi dasar identitas balita</div>
                            </div>
                        </div>
                        <div class="form-card-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Nama Balita</label>
                                    <input type="text" name="nama" placeholder="Masukkan nama lengkap"
                                        value="{{ old('nama') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" placeholder="16 digit NIK" value="{{ old('nik') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" placeholder="Kota / Desa"
                                        value="{{ old('tempat_lahir') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu" placeholder="Nama lengkap ibu"
                                        value="{{ old('nama_ibu') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="form-card-header-icon">⚖️</div>
                            <div>
                                <div class="form-card-header-title">Penimbangan Pertama</div>
                                <div class="form-card-header-sub">Data antropometri awal balita</div>
                            </div>
                        </div>
                        <div class="form-card-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Berat Badan</label>
                                    <div class="input-wrapper">
                                        <input type="text" name="berat_badan" placeholder="0.0"
                                            value="{{ old('berat_badan') }}" required oninput="formatAngka(this)">
                                        <span class="input-unit">kg</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <div class="input-wrapper">
                                        <input type="text" name="tinggi_badan" placeholder="0.0"
                                            value="{{ old('tinggi_badan') }}" required oninput="formatAngka(this)">
                                        <span class="input-unit">cm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>LILA</label>
                                    <div class="input-wrapper">
                                        <input type="text" name="lila" placeholder="0.0" value="{{ old('lila') }}" required
                                            oninput="formatAngka(this)">
                                        <span class="input-unit">cm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>LIKA</label>
                                    <div class="input-wrapper">
                                        <input type="text" name="lika" placeholder="0.0" value="{{ old('lika') }}" required
                                            oninput="formatAngka(this)">
                                        <span class="input-unit">cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Data Balita
                        </button>
                        <a href="{{ route('balita.index') }}" class="btn-cancel">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function formatAngka(input) {
            input.value = input.value.replace(/[^0-9.,]/g, '');
            input.value = input.value.replace(',', '.');
        }

        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle = document.getElementById('toggleSidebar');

            toggle.addEventListener('click', () => {
                const open = sidebar.classList.toggle('open');
                overlay.classList.toggle('open', open);
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            });

            const dateEl = document.getElementById('topbarDate');
            if (dateEl) {
                dateEl.textContent = new Date().toLocaleDateString('id-ID', {
                    weekday: 'short', day: 'numeric', month: 'long', year: 'numeric'
                });
            }
        })();
    </script>

@endsection