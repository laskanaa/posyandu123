@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('hideHeader', true)
@section('hideFooter', true)

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
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

        .dash-wrapper {
            display: flex;
            min-height: 100vh;
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
            transition: margin .4s;
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
            background: rgba(240, 247, 246, .88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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
            flex-shrink: 0;
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

        .topbar-sub {
            font-size: 13px;
            color: #7a9e9b;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--teal-dark);
            padding: 9px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            border: 1px solid rgba(15, 118, 110, .15);
            transition: all .3s;
        }

        .btn-back:hover {
            background: var(--teal-light);
            border-color: var(--teal-mid);
            transform: translateY(-1px);
        }

        .dash-content {
            padding: 32px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .dash-section-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #fef3c7;
            color: #92400e;
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
            background: #f59e0b;
            border-radius: 50%;
        }

        .dash-section-title {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--teal-dark);
            margin-bottom: 24px;
        }

        .form-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(15, 118, 110, .07);
            border: 1px solid rgba(15, 118, 110, .06);
            padding: 32px;
            width: 100%;
            max-width: 680px;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .edit-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fef3c7;
            color: #92400e;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #fde68a;
        }

        .current-layanan {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #f8fdfc;
            border: 1.5px solid rgba(20, 184, 166, .2);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
        }

        .current-icon {
            font-size: 32px;
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(15, 118, 110, .1);
            flex-shrink: 0;
        }

        .current-label {
            font-size: 11px;
            color: var(--teal);
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-bottom: 3px;
        }

        .current-judul {
            font-size: 15px;
            font-weight: 600;
            color: var(--teal-dark);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--teal-dark);
            letter-spacing: .02em;
        }

        .form-input {
            padding: 11px 16px;
            border: 1.5px solid rgba(15, 118, 110, .15);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #0d1f1e;
            background: #fafffe;
            transition: border-color .25s, box-shadow .25s;
            outline: none;
        }

        .form-input:focus {
            border-color: #fbbf24;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, .12);
            background: white;
        }

        .form-input[readonly] {
            background: #f3f8f7;
            color: #7a9e9b;
            cursor: not-allowed;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 8px;
        }

        .btn-update {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #92400e, #f59e0b);
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all .3s;
            box-shadow: 0 4px 14px rgba(245, 158, 11, .3);
            letter-spacing: .02em;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, .4);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #7a9e9b;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1.5px solid rgba(15, 118, 110, .15);
            font-size: 14px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: all .25s;
        }

        .btn-cancel:hover {
            background: #f0f7f6;
            color: var(--teal-dark);
            border-color: rgba(15, 118, 110, .25);
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

        @media (max-width: 640px) {
            .dash-content {
                padding: 20px 16px;
            }

            .dash-topbar {
                padding: 0 16px;
            }

            .form-card {
                padding: 20px;
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
                        <div class="topbar-page">Edit Layanan</div>
                        <div class="topbar-sub">Layanan Posyandu</div>
                    </div>
                </div>
                <a href="{{ route('kader.layanan.index') }}" class="btn-back">← Kembali</a>
            </header>

            <div class="dash-content">

                <div class="dash-section-tag">Edit Data</div>
                <h2 class="dash-section-title">Ubah Data Layanan</h2>

                <div class="form-card">

                    <div class="edit-badge">✏️ Sedang mengedit data layanan</div>
                    <div class="current-layanan">
                        <div class="current-icon">{{ $layanan->icon ?? '❔' }}</div>
                        <div>
                            <div class="current-label">Layanan saat ini</div>
                            <div class="current-judul">{{ $layanan->judul }}</div>
                        </div>
                    </div>

                    <form action="{{ route('kader.layanan.update', $layanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label">Judul Layanan</label>
                            <input type="text" name="judul" class="form-input" value="{{ old('judul', $layanan->judul) }}"
                                readonly>

                            @error('judul')
                                <span style="font-size:12px; color:#ef4444;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-update">✏️ Update Layanan</button>
                            <a href="{{ route('kader.layanan.index') }}" class="btn-cancel">Batal</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle = document.getElementById('toggleSidebar');

            function openSidebar() { sidebar.classList.add('open'); overlay.classList.add('open'); }
            function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }

            toggle.addEventListener('click', function () {
                sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
            });
            overlay.addEventListener('click', closeSidebar);
        })();
    </script>

@endsection