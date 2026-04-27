@extends('layouts.app')

@section('title', 'Data Galeri')

@section('hideHeader', true)
@section('hideFooter', true)

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --teal-dark:  #0a3d38;
            --teal:       #0f766e;
            --teal-mid:   #14b8a6;
            --teal-light: #ccfbf1;
            --accent:     #f59e0b;
            --bg:         #f0f7f6;
            --sidebar-w:  260px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: #0d1f1e;
        }

        /* ─── LAYOUT ─────────────────────────────────────────────── */
        .dash-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ─── SIDEBAR ────────────────────────────────────────────── */
        .dash-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--teal-dark);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform .4s cubic-bezier(.22,1,.36,1);
            overflow: hidden;
        }

        .dash-sidebar::before {
            content: '';
            position: absolute;
            top: -80px; left: -80px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(20,184,166,.15), transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .dash-sidebar::after {
            content: '';
            position: absolute;
            bottom: -60px; right: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(245,158,11,.08), transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1;
            flex-shrink: 0;
        }

        .sidebar-brand-emblem {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(20,184,166,.3);
            flex-shrink: 0;
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
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
            position: relative; z-index: 1;
            scrollbar-width: none;
        }

        .sidebar-nav::-webkit-scrollbar { display: none; }

        .sidebar-foot {
            padding: 16px 24px 24px;
            border-top: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1;
        }

        .sidebar-foot-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-avatar {
            width: 36px; height: 36px;
            background: rgba(20,184,166,.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
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
            .dash-sidebar { transform: translateX(-100%); }
            .dash-sidebar.open { transform: translateX(0); }
        }

        /* ─── MAIN AREA ──────────────────────────────────────────── */
        .dash-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin .4s;
        }

        @media (max-width: 900px) {
            .dash-main { margin-left: 0; }
        }

        /* ─── TOPBAR ─────────────────────────────────────────────── */
        .dash-topbar {
            position: sticky;
            top: 0; z-index: 100;
            background: rgba(240,247,246,.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15,118,110,.08);
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
            width: 40px; height: 40px;
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

        .dash-hamburger:hover { background: var(--teal); }

        @media (max-width: 900px) {
            .dash-hamburger { display: flex; }
        }

        .topbar-breadcrumb {
            display: flex;
            flex-direction: column;
        }

        .topbar-page {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--teal-dark);
            line-height: 1.2;
        }

        .topbar-sub {
            font-size: 13px;
            color: #7a9e9b;
        }

        /* ─── CONTENT ────────────────────────────────────────────── */
        .dash-content {
            padding: 32px;
            flex: 1;
        }

        /* Section header */
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
            width: 5px; height: 5px;
            background: var(--teal);
            border-radius: 50%;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dash-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--teal-dark);
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(13,79,77,.25);
            transition: all .3s cubic-bezier(.22,1,.36,1);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13,79,77,.35);
        }

        /* ─── TABLE CARD ─────────────────────────────────────────── */
        .card-table {
            background: white;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(15,118,110,.07);
            border: 1px solid rgba(15,118,110,.06);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
        }

        thead th {
            padding: 14px 16px;
            color: white;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            text-align: center;
        }

        tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f7f6;
            text-align: center;
            font-size: 14px;
            color: #2d5a57;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: background .2s;
        }

        tbody tr:hover {
            background: #f8fffe;
        }

        .img-table {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
            transition: transform .3s;
        }

        tbody tr:hover .img-table {
            transform: scale(1.04);
        }

        .btn-delete {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all .25s;
            box-shadow: 0 2px 8px rgba(244,63,94,.25);
        }

        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(244,63,94,.4);
        }

        .empty {
            padding: 48px 20px;
            color: #7a9e9b;
            font-size: 15px;
            text-align: center;
        }

        /* ─── OVERLAY ────────────────────────────────────────────── */
        .dash-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.35);
            z-index: 900;
            backdrop-filter: blur(2px);
        }

        .dash-overlay.open { display: block; }

        @media (max-width: 640px) {
            .dash-content { padding: 20px 16px; }
            .dash-topbar  { padding: 0 16px; }
        }
    </style>

    <div class="dash-wrapper">

        {{-- ── Sidebar ── --}}
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

        {{-- ── Main ── --}}
        <div class="dash-main">

            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div class="topbar-breadcrumb">
                        <span class="topbar-page">Data Galeri</span>
                        <span class="topbar-sub">Kelola foto galeri posyandu</span>
                    </div>
                </div>
            </header>

            <div class="dash-content">

                <div class="dash-section-tag">Galeri</div>

                <div class="section-header">
                    <h2 class="dash-section-title">Foto Galeri</h2>
                    <a href="{{ route('kader.galeri.create') }}" class="btn-add">
                        + Tambah Gambar
                    </a>
                </div>

                <div class="card-table">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galeri as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('upload-galeri/' . $item->gambar) }}" class="img-table">
                                    </td>
                                    <td>
                                        <form action="{{ route('kader.galeri.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-delete">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="empty">🖼️ Belum ada foto di galeri</td>
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
        const toggle  = document.getElementById('toggleSidebar');

        function openSidebar()  { sidebar.classList.add('open');    overlay.classList.add('open'); }
        function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }

        toggle.addEventListener('click', function () {
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);
    })();

    function confirmDelete() {
        return confirm('Yakin mau hapus gambar ini?');
    }
    </script>

@endsection