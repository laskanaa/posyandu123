@extends('layouts.app')

@section('title', 'Data Balita')

@section('hideHeader', true)
@section('hideFooter', true)

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: #0d1f1e; }

        /* ─── LAYOUT ─────────────────────────────────────────────── */
        .dash-wrapper { display: flex; min-height: 100vh; }

        /* ─── SIDEBAR ────────────────────────────────────────────── */
        .dash-sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: var(--teal-dark);
            z-index: 1000; display: flex; flex-direction: column;
            transition: transform .4s cubic-bezier(.22,1,.36,1);
            overflow: hidden;
        }
        .dash-sidebar::before {
            content: ''; position: absolute; top: -80px; left: -80px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(20,184,166,.15), transparent 65%);
            border-radius: 50%; pointer-events: none;
        }
        .dash-sidebar::after {
            content: ''; position: absolute; bottom: -60px; right: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(245,158,11,.08), transparent 65%);
            border-radius: 50%; pointer-events: none;
        }
        .sidebar-brand {
            padding: 28px 24px 20px; display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1; flex-shrink: 0;
        }
        .sidebar-brand-emblem {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
            border-radius: 11px; display: flex; align-items: center; justify-content: center;
            font-size: 18px; box-shadow: 0 4px 12px rgba(20,184,166,.3); flex-shrink: 0;
        }
        .sidebar-brand-name { font-family: 'Playfair Display', serif; font-size: 15px; font-weight: 700; color: white; line-height: 1.2; }
        .sidebar-brand-sub { font-size: 10.5px; color: var(--teal-mid); letter-spacing: .07em; text-transform: uppercase; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 16px 0; position: relative; z-index: 1; scrollbar-width: none; }
        .sidebar-nav::-webkit-scrollbar { display: none; }
        .sidebar-foot { padding: 16px 24px 24px; border-top: 1px solid rgba(255,255,255,.07); position: relative; z-index: 1; }
        .sidebar-foot-user { display: flex; align-items: center; gap: 10px; }
        .sidebar-avatar { width: 36px; height: 36px; background: rgba(20,184,166,.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .sidebar-foot-name { font-size: 13px; font-weight: 600; color: white; line-height: 1.3; }
        .sidebar-foot-role { font-size: 11px; color: var(--teal-mid); }

        @media (max-width: 900px) {
            .dash-sidebar { transform: translateX(-100%); }
            .dash-sidebar.open { transform: translateX(0); }
        }

        /* ─── MAIN ───────────────────────────────────────────────── */
        .dash-main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        @media (max-width: 900px) { .dash-main { margin-left: 0; } }

        /* ─── TOPBAR ─────────────────────────────────────────────── */
        .dash-topbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(240,247,246,.9); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15,118,110,.08);
            padding: 0 32px; height: 68px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .dash-hamburger {
            width: 40px; height: 40px; background: var(--teal-dark); border: none;
            border-radius: 10px; color: white; font-size: 18px; cursor: pointer;
            display: none; align-items: center; justify-content: center; transition: background .25s;
        }
        .dash-hamburger:hover { background: var(--teal); }
        @media (max-width: 900px) { .dash-hamburger { display: flex; } }
        .topbar-page { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--teal-dark); line-height: 1.2; }
        .topbar-greeting { font-size: 13px; color: #7a9e9b; }
        .topbar-greeting strong { color: var(--teal); font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-date { font-size: 12.5px; color: #7a9e9b; background: white; border: 1px solid rgba(15,118,110,.1); border-radius: 8px; padding: 6px 12px; }
        .topbar-notif { width: 38px; height: 38px; background: white; border: 1px solid rgba(15,118,110,.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer; transition: all .25s; position: relative; }
        .topbar-notif:hover { background: var(--teal-light); border-color: var(--teal-mid); }
        .notif-dot { position: absolute; top: 8px; right: 8px; width: 7px; height: 7px; background: var(--accent); border-radius: 50%; border: 2px solid var(--bg); }

        /* ─── CONTENT ────────────────────────────────────────────── */
        .dash-content { padding: 32px; flex: 1; }

        .dash-section-tag {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--teal-light); color: var(--teal);
            font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase;
            padding: 5px 13px; border-radius: 30px; margin-bottom: 8px;
        }
        .dash-section-tag::before { content: ''; width: 5px; height: 5px; background: var(--teal); border-radius: 50%; }
        .dash-section-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--teal-dark); margin-bottom: 24px; }

        /* ─── STAT CARD ──────────────────────────────────────────── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px; }
        .stat-card {
            background: white; border-radius: 18px; padding: 22px;
            box-shadow: 0 2px 12px rgba(15,118,110,.07); border: 1px solid rgba(15,118,110,.06);
            position: relative; overflow: hidden; transition: all .35s cubic-bezier(.22,1,.36,1);
        }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--teal), var(--teal-mid)); border-radius: 18px 18px 0 0; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(15,118,110,.12); }
        .stat-card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 14px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; background: var(--teal-light); }
        .stat-value { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: var(--teal-dark); line-height: 1; margin-bottom: 4px; }
        .stat-label { font-size: 13px; color: #7a9e9b; font-weight: 500; }

        /* ─── TABLE PANEL ────────────────────────────────────────── */
        .table-panel {
            background: white; border-radius: 20px;
            box-shadow: 0 2px 12px rgba(15,118,110,.07);
            border: 1px solid rgba(15,118,110,.06);
            overflow: hidden;
        }

        .table-panel-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(15,118,110,.07);
            display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;
        }

        .table-panel-title { font-size: 15px; font-weight: 600; color: var(--teal-dark); }

        .table-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

        .btn-add {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px; background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white; border-radius: 10px; text-decoration: none;
            font-size: 13px; font-weight: 600;
            box-shadow: 0 4px 14px rgba(15,118,110,.25);
            transition: all .3s;
        }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(15,118,110,.3); color: white; }

        .search-form { display: flex; gap: 6px; }
        .search-form input {
            padding: 9px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 13px; font-family: 'DM Sans', sans-serif;
            width: 220px; transition: border-color .25s, box-shadow .25s; outline: none;
            color: #0d1f1e;
        }
        .search-form input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(15,118,110,.1); }
        .search-form input::placeholder { color: #b0c4c2; }
        .search-form button {
            padding: 9px 16px; background: var(--teal-dark); color: white; border: none;
            border-radius: 10px; font-size: 13px; font-family: 'DM Sans', sans-serif;
            font-weight: 500; cursor: pointer; transition: background .25s;
        }
        .search-form button:hover { background: var(--teal); }

        /* ─── TABLE ──────────────────────────────────────────────── */
        .table-wrapper { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; min-width: 700px; }

        thead tr { background: var(--teal-dark); }

        th {
            padding: 13px 16px; font-size: 12px; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase;
            color: rgba(255,255,255,.8); text-align: left; white-space: nowrap;
        }

        th:first-child { border-radius: 0; }

        tbody tr {
            border-bottom: 1px solid rgba(15,118,110,.06);
            transition: background .2s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f8faf9; }

        td { padding: 13px 16px; font-size: 13.5px; color: #3d5a58; vertical-align: middle; }

        td:first-child { font-weight: 600; color: #7a9e9b; font-size: 13px; }

        /* ─── STATUS BADGES ──────────────────────────────────────── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600;
        }
        .status-badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }

        .status-normal  { background: #dcfce7; color: #16a34a; }
        .status-normal::before  { background: #16a34a; }
        .status-stunting { background: #fee2e2; color: #dc2626; }
        .status-stunting::before { background: #dc2626; }
        .status-unknown  { background: #f1f5f9; color: #7a9e9b; }
        .status-unknown::before  { background: #94a3b8; }

        /* ─── ACTION BUTTONS ─────────────────────────────────────── */
        .action-buttons { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }

        .btn-action {
            width: 32px; height: 32px; border-radius: 8px; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; text-decoration: none; transition: all .25s;
        }

        .btn-view     { background: #dcfce7; color: #16a34a; }
        .btn-view:hover { background: #16a34a; color: white; }

        .btn-edit     { background: #fef3c7; color: #d97706; }
        .btn-edit:hover { background: #d97706; color: white; }

        .btn-download { background: #dbeafe; color: #2563eb; }
        .btn-download:hover { background: #2563eb; color: white; }

        .btn-delete   { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: white; }

        /* ─── EMPTY STATE ────────────────────────────────────────── */
        .empty-state { text-align: center; padding: 60px 20px; color: #7a9e9b; }
        .empty-state-icon { font-size: 40px; margin-bottom: 12px; }
        .empty-state p { font-size: 14px; }

        /* ─── OVERLAY ────────────────────────────────────────────── */
        .dash-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.35); z-index: 900; backdrop-filter: blur(2px); }
        .dash-overlay.open { display: block; }

        /* ─── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 640px) {
            .dash-content { padding: 16px; }
            .dash-topbar  { padding: 0 16px; }
            .topbar-date  { display: none; }
            .search-form input { width: 140px; }
        }
    </style>

    <div class="dash-wrapper">

        {{-- Sidebar --}}
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

        {{-- Main --}}
        <div class="dash-main">

            {{-- Topbar --}}
            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div>
                        <div class="topbar-page">Data Balita</div>
                        <div class="topbar-greeting">Selamat datang, <strong>Kader 👋</strong></div>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <div class="topbar-notif">🔔<span class="notif-dot"></span></div>
                </div>
            </header>

            {{-- Content --}}
            <div class="dash-content">

                <div class="dash-section-tag">Manajemen Data</div>
                <h2 class="dash-section-title">Data Balita</h2>

                {{-- Stat --}}
                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="stat-card-top">
                            <div class="stat-icon">👶</div>
                        </div>
                        <div class="stat-value">{{ $balitas->count() }}</div>
                        <div class="stat-label">Total Balita Terdaftar</div>
                    </div>

                    @php
                        $stuntingCount = $balitas->filter(function ($b) {
                            $last = $b->penimbangans->last();
                            return str_contains(strtolower($last->hasil['kesimpulan'] ?? ''), 'stunting');
                        })->count();
                    @endphp

                    <div class="stat-card" style="--c1:#f43f5e;--c2:#fb7185;">
                        <style>
                            .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #f43f5e, #fb7185); }
                            .stat-card:nth-child(2) .stat-icon { background: #ffe4e6; }
                            .stat-card:nth-child(2) .stat-value { color: #9f1239; }
                        </style>
                        <div class="stat-card-top">
                            <div class="stat-icon">⚠️</div>
                        </div>
                        <div class="stat-value">{{ $stuntingCount }}</div>
                        <div class="stat-label">Terindikasi Stunting</div>
                    </div>

                    <div class="stat-card">
                        <style>
                            .stat-card:nth-child(3)::before { background: linear-gradient(90deg, #10b981, #34d399); }
                            .stat-card:nth-child(3) .stat-icon { background: #d1fae5; }
                            .stat-card:nth-child(3) .stat-value { color: #065f46; }
                        </style>
                        <div class="stat-card-top">
                            <div class="stat-icon">✅</div>
                        </div>
                        <div class="stat-value">{{ $balitas->count() - $stuntingCount }}</div>
                        <div class="stat-label">Status Normal</div>
                    </div>
                </div>

                {{-- Table --}}
                <div class="table-panel">
                    <div class="table-panel-header">
                        <span class="table-panel-title">Daftar Semua Balita</span>
                        <div class="table-actions">
                            <a href="{{ route('balita.create') }}" class="btn-add">
                                <i class="fas fa-plus"></i> Tambah Balita
                            </a>
                            <form method="GET" action="{{ route('balita.index') }}" class="search-form">
                                <input type="text" name="search"
                                    placeholder="Cari nama / nama ibu..."
                                    value="{{ request('search') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Balita</th>
                                    <th>NIK</th>
                                    <th>Umur</th>
                                    <th>Nama Ibu</th>
                                    <th>Kondisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($balitas as $index => $balita)
                                    @php
                                        $tanggalLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
                                        $umurBulan = round(($tanggalLahir->diffInDays(now()) / 30) * 2) / 2;
                                        $last = $balita->penimbangans->last();
                                        $kesimpulan = $last->hasil['kesimpulan'] ?? null;
                                        $isStunting = str_contains(strtolower($kesimpulan ?? ''), 'stunting');
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td style="font-weight:600;color:#0d1f1e;">{{ $balita->nama }}</td>
                                        <td>{{ $balita->nik }}</td>
                                        <td>{{ $umurBulan }} bln</td>
                                        <td>{{ $balita->nama_ibu }}</td>
                                        <td>
                                            @if($kesimpulan)
                                                <span class="status-badge {{ $isStunting ? 'status-stunting' : 'status-normal' }}">
                                                    {{ $kesimpulan }}
                                                </span>
                                            @else
                                                <span class="status-badge status-unknown">Belum ada data</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('balita.show', $balita->id) }}" class="btn-action btn-view" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('balita.edit', $balita->id) }}" class="btn-action btn-edit" title="Edit">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="{{ route('balita.download', $balita->id) }}" class="btn-action btn-download" target="_blank" title="Unduh">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <form action="{{ route('balita.destroy', $balita->id) }}" method="POST" style="margin:0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus data {{ $balita->nama }}?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <div class="empty-state-icon">👶</div>
                                                <p>Belum ada data balita yang terdaftar.</p>
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
    </div>

    <script>
    (function () {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('overlay');
        const toggle   = document.getElementById('toggleSidebar');

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