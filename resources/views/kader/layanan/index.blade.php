@extends('layouts.app')

@section('title', 'Data Layanan')

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

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: .02em;
            transition: all .3s;
            box-shadow: 0 4px 14px rgba(15, 118, 110, .25);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 118, 110, .35);
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
            margin-bottom: 24px;
        }

        .table-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(15, 118, 110, .07);
            border: 1px solid rgba(15, 118, 110, .06);
            overflow: hidden;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-card thead tr {
            background: linear-gradient(90deg, var(--teal-dark), var(--teal));
        }

        .table-card thead th {
            padding: 14px 20px;
            color: white;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .07em;
            text-transform: uppercase;
            text-align: left;
        }

        .table-card tbody tr {
            border-bottom: 1px solid rgba(15, 118, 110, .06);
            transition: background .2s;
        }

        .table-card tbody tr:last-child {
            border-bottom: none;
        }

        .table-card tbody tr:hover {
            background: #f8fdfc;
        }

        .table-card tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #2d4a48;
            vertical-align: middle;
        }

        .row-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: var(--teal-light);
            color: var(--teal);
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: var(--teal-light);
            border-radius: 11px;
            font-size: 22px;
            border: 1px solid rgba(20, 184, 166, .2);
        }

        .aksi-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: #fee2e2;
            color: #9f1239;
            border-radius: 9px;
            border: 1px solid #fecaca;
            cursor: pointer;
            transition: all .25s;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(239, 68, 68, .3);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7a9e9b;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 14px;
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
                        <div class="topbar-page">Layanan Posyandu</div>
                        <div class="topbar-sub">Kelola data layanan posyandu</div>
                    </div>
                </div>
                <a href="{{ route('kader.layanan.create') }}" class="btn-add">
                    + Tambah Layanan
                </a>
            </header>

            <div class="dash-content">

                <div class="dash-section-tag">Manajemen Data</div>
                <h2 class="dash-section-title">Daftar Layanan Posyandu</h2>

                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th style="width:60px">No</th>
                                <th style="width:80px">Icon</th>
                                <th>Judul Layanan</th>
                                <th style="width:100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($layanans as $layanan)
                                <tr>
                                    <td><span class="row-num">{{ $loop->iteration }}</span></td>
                                    <td>
                                        <span class="icon-badge">{{ $layanan->icon ?? '❔' }}</span>
                                    </td>
                                    <td>{{ $layanan->judul }}</td>
                                    <td>
                                        <div class="aksi-cell">
                                            <form action="{{ route('kader.layanan.destroy', $layanan->id) }}" method="POST"
                                                style="display:inline"
                                                onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-delete" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        fill="currentColor" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm4 0A.5.5 0 0 1 10 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5l1-1h4l1 1h2.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">🏥</div>
                                            <p>Belum ada data layanan. Tambahkan layanan pertama Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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