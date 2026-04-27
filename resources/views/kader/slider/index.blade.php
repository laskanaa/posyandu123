@extends('layouts.app')

@section('title', 'Data Slider')

@section('hideHeader', true)
@section('hideFooter', true)

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --teal-dark: #0a3d38;
            --teal:      #0f766e;
            --teal-mid:  #14b8a6;
            --teal-light:#ccfbf1;
            --accent:    #f59e0b;
            --bg:        #f0f7f6;
            --sidebar-w: 260px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: #0d1f1e;
        }

        /* ─── LAYOUT ─── */
        .dash-wrapper { display: flex; min-height: 100vh; }

        /* ─── SIDEBAR ─── */
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

        .sidebar-brand {
            padding: 28px 24px 20px;
            display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1; flex-shrink: 0;
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
            font-size: 15px; font-weight: 700; color: white; line-height: 1.2;
        }

        .sidebar-brand-sub {
            font-size: 10.5px; color: var(--teal-mid);
            letter-spacing: .07em; text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1; overflow-y: auto;
            padding: 16px 0; position: relative; z-index: 1;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .sidebar-foot {
            padding: 16px 24px 24px;
            border-top: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1;
        }

        .sidebar-foot-user { display: flex; align-items: center; gap: 10px; }

        .sidebar-avatar {
            width: 36px; height: 36px;
            background: rgba(20,184,166,.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }

        .sidebar-foot-name  { font-size: 13px; font-weight: 600; color: white; line-height: 1.3; }
        .sidebar-foot-role  { font-size: 11px; color: var(--teal-mid); }

        @media (max-width: 900px) {
            .dash-sidebar { transform: translateX(-100%); }
            .dash-sidebar.open { transform: translateX(0); }
        }

        /* ─── MAIN ─── */
        .dash-main {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }
        @media (max-width: 900px) { .dash-main { margin-left: 0; } }

        /* ─── TOPBAR ─── */
        .dash-topbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(240,247,246,.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15,118,110,.08);
            padding: 0 32px; height: 68px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }

        .topbar-left  { display: flex; align-items: center; gap: 16px; }
        .topbar-page  { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--teal-dark); }
        .topbar-sub   { font-size: 13px; color: #7a9e9b; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-date {
            font-size: 12.5px; color: #7a9e9b;
            background: white;
            border: 1px solid rgba(15,118,110,.1);
            border-radius: 8px; padding: 6px 12px;
        }

        .dash-hamburger {
            width: 40px; height: 40px;
            background: var(--teal-dark); border: none; border-radius: 10px;
            color: white; font-size: 18px; cursor: pointer;
            display: none; align-items: center; justify-content: center;
            transition: background .25s;
        }
        .dash-hamburger:hover { background: var(--teal); }
        @media (max-width: 900px) { .dash-hamburger { display: flex; } }

        /* ─── BTN ADD ─── */
        .btn-add-top {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white; border-radius: 10px;
            text-decoration: none; font-size: 13px; font-weight: 600;
            box-shadow: 0 4px 12px rgba(15,118,110,.25);
            transition: all .25s;
        }
        .btn-add-top:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(15,118,110,.35); }

        /* ─── CONTENT ─── */
        .dash-content { padding: 32px; flex: 1; }

        .dash-section-tag {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--teal-light); color: var(--teal);
            font-size: 11px; font-weight: 600; letter-spacing: .1em;
            text-transform: uppercase; padding: 5px 13px;
            border-radius: 30px; margin-bottom: 8px;
        }
        .dash-section-tag::before {
            content: ''; width: 5px; height: 5px;
            background: var(--teal); border-radius: 50%;
        }

        .dash-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 700; color: var(--teal-dark); margin-bottom: 24px;
        }

        /* ─── PANEL ─── */
        .panel {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(15,118,110,.07);
            border: 1px solid rgba(15,118,110,.06);
            overflow: hidden;
            animation: slideUp .4s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .panel-header {
            padding: 16px 24px;
            display: flex; align-items: center; gap: 12px;
            background: linear-gradient(135deg, #92400e, #d97706);
        }

        .panel-header-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: rgba(255,255,255,.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }

        .panel-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 700; color: white;
        }

        /* ─── TABLE ─── */
        .table-wrapper { overflow-x: auto; }

        .data-table {
            width: 100%; border-collapse: collapse; min-width: 650px;
        }

        .data-table thead tr { background: var(--teal-dark); }

        .data-table th {
            padding: 12px 16px;
            font-size: 11.5px; font-weight: 600;
            letter-spacing: .05em; text-transform: uppercase;
            color: rgba(255,255,255,.8); text-align: left; white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid rgba(15,118,110,.06);
            transition: background .15s;
        }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #f8faf9; }

        .data-table td {
            padding: 12px 16px;
            font-size: 13px; color: #3d5a58; vertical-align: middle;
        }

        .data-table td:first-child { font-weight: 600; color: #7a9e9b; }

        .img-slider {
            width: 110px; border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
            display: block;
        }

        /* ─── ACTION BUTTONS ─── */
        .action-cell { display: flex; gap: 6px; align-items: center; }

        .btn-icon {
            width: 32px; height: 32px; border-radius: 8px;
            border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; text-decoration: none;
            transition: all .2s; padding: 0;
        }

        .btn-icon-edit   { background: #dbeafe; color: #2563eb; }
        .btn-icon-edit:hover { background: #2563eb; color: white; transform: scale(1.1); }

        .btn-icon-delete { background: #fee2e2; color: #dc2626; }
        .btn-icon-delete:hover { background: #dc2626; color: white; transform: scale(1.1); }

        /* ─── EMPTY ─── */
        .empty-row td {
            text-align: center; padding: 48px;
            color: #7a9e9b; font-size: 14px;
        }

        /* ─── OVERLAY ─── */
        .dash-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.35); z-index: 900;
            backdrop-filter: blur(2px);
        }
        .dash-overlay.open { display: block; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .dash-content { padding: 16px; }
            .dash-topbar  { padding: 0 16px; }
            .topbar-date  { display: none; }
        }
    </style>

    <div class="dash-wrapper">

        {{-- SIDEBAR --}}
        <aside class="dash-sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-emblem">🌿</div>
                <div>
                    <div class="sidebar-brand-name">Posyandu</div>
                    <div class="sidebar-brand-sub">Paguyangan</div>
                </div>
            </div>
            <div class="sidebar-nav">@include('partials.sidebar_kader')</div>
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

        {{-- MAIN --}}
        <div class="dash-main">

            {{-- TOPBAR --}}
            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div>
                        <div class="topbar-page">Data Slider</div>
                        <div class="topbar-sub">Kelola banner & slider halaman utama</div>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <a href="{{ route('kader.slider.create') }}" class="btn-add-top">
                        <i class="fas fa-plus"></i> Tambah Slider
                    </a>
                </div>
            </header>

            {{-- CONTENT --}}
            <div class="dash-content">

                <div class="dash-section-tag">Manajemen Konten</div>
                <h2 class="dash-section-title">Daftar Slider</h2>

                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-header-icon">🖼️</div>
                        <div class="panel-header-title">Data Slider</div>
                    </div>
                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $slider->judul }}</td>
                                        <td>{{ $slider->deskripsi }}</td>
                                        <td>
                                            <img src="{{ asset('slider/' . $slider->gambar) }}" class="img-slider" alt="{{ $slider->judul }}">
                                        </td>
                                        <td>
                                            <div class="action-cell">
                                                <a href="{{ route('kader.slider.edit', $slider->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <form action="{{ route('kader.slider.delete', $slider->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin hapus slider ini?')" style="margin:0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="5">🖼️ Belum ada data slider.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle  = document.getElementById('toggleSidebar');

            toggle.addEventListener('click', () => {
                const open = sidebar.classList.toggle('open');
                overlay.classList.toggle('open', open);
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            });

            const dateEl = document.getElementById('topbarDate');
            if (dateEl) dateEl.textContent = new Date().toLocaleDateString('id-ID', {
                weekday: 'short', day: 'numeric', month: 'long', year: 'numeric'
            });
        })();
    </script>

@endsection