@extends('layouts.app')

@section('title', 'Detail Balita')

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
            min-width: 0;
            overflow-x: hidden;
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
            padding: 0 24px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
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
            font-size: 18px;
            font-weight: 700;
            color: var(--teal-dark);
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .topbar-greeting {
            font-size: 12px;
            color: #7a9e9b;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .topbar-date {
            font-size: 12px;
            color: #7a9e9b;
            background: white;
            border: 1px solid rgba(15, 118, 110, .1);
            border-radius: 8px;
            padding: 5px 10px;
            white-space: nowrap;
        }

        .btn-back-top {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: white;
            border: 1.5px solid rgba(15, 118, 110, .2);
            color: var(--teal-dark);
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            transition: all .25s;
        }

        .btn-back-top:hover {
            background: var(--teal-light);
            border-color: var(--teal);
        }

        .dash-content {
            padding: 24px;
            flex: 1;
            min-width: 0;
            overflow-x: hidden;
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
            font-size: 20px;
            font-weight: 700;
            color: var(--teal-dark);
            margin-bottom: 20px;
        }

        .hero-card {
            background: linear-gradient(135deg, var(--teal-dark) 0%, var(--teal) 100%);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            position: relative;
            overflow: hidden;
            animation: slideUp .35s cubic-bezier(.22, 1, .36, 1) both;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, .07), transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-left {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
            min-width: 0;
            flex: 1;
        }

        .hero-avatar {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, .15);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .hero-name {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            word-break: break-word;
        }

        .hero-meta {
            font-size: 12px;
            color: rgba(255, 255, 255, .65);
            margin-top: 4px;
            line-height: 1.5;
        }

        .hero-right {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }

        .hero-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            background: rgba(255, 255, 255, .15);
            color: white;
            border: 1px solid rgba(255, 255, 255, .2);
            white-space: nowrap;
        }

        .hero-badge.danger {
            background: #ef4444;
            border-color: #ef4444;
        }

        .hero-badge.warning {
            background: #f59e0b;
            border-color: #f59e0b;
        }

        .hero-badge.success {
            background: #10b981;
            border-color: #10b981;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: rgba(255, 255, 255, .15);
            color: white;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all .2s;
        }

        .hero-btn:hover {
            background: rgba(255, 255, 255, .25);
        }

        .panel {
            background: white;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(15, 118, 110, .07);
            border: 1px solid rgba(15, 118, 110, .06);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .panel:nth-child(2) {
            animation: slideUp .4s .04s cubic-bezier(.22, 1, .36, 1) both;
        }

        .panel:nth-child(3) {
            animation: slideUp .4s .08s cubic-bezier(.22, 1, .36, 1) both;
        }

        .panel:nth-child(4) {
            animation: slideUp .4s .12s cubic-bezier(.22, 1, .36, 1) both;
        }

        .panel:nth-child(5) {
            animation: slideUp .4s .16s cubic-bezier(.22, 1, .36, 1) both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel-header {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-header-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: rgba(255, 255, 255, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .panel-header-title {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: white;
        }

        .ph-biodata {
            background: linear-gradient(135deg, #0a3d38, #0f766e);
        }

        .ph-akun {
            background: linear-gradient(135deg, #065f46, #059669);
        }

        .ph-riwayat {
            background: linear-gradient(135deg, #92400e, #d97706);
        }

        .ph-grafik {
            background: linear-gradient(135deg, #1e3a5f, #2563eb);
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table tr {
            border-bottom: 1px solid rgba(15, 118, 110, .06);
            transition: background .15s;
        }

        .detail-table tr:last-child {
            border-bottom: none;
        }

        .detail-table tr:hover {
            background: #f8faf9;
        }

        .detail-table th {
            width: 180px;
            padding: 12px 20px;
            font-size: 11px;
            font-weight: 600;
            color: #7a9e9b;
            letter-spacing: .04em;
            text-transform: uppercase;
            background: #fafcfc;
            text-align: left;
            border-right: 1px solid rgba(15, 118, 110, .06);
        }

        .detail-table td {
            padding: 12px 20px;
            font-size: 14px;
            color: #0d1f1e;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-normal {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-normal::before {
            background: #16a34a;
        }

        .status-warning {
            background: #fef3c7;
            color: #d97706;
        }

        .status-warning::before {
            background: #d97706;
        }

        .status-stunting {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-stunting::before {
            background: #dc2626;
        }

        .status-unknown {
            background: #f1f5f9;
            color: #7a9e9b;
        }

        .status-unknown::before {
            background: #94a3b8;
        }

        .status-info {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-info::before {
            background: #2563eb;
        }

        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            background:
                linear-gradient(to right, white 30%, rgba(255, 255, 255, 0)),
                linear-gradient(to left, white 30%, rgba(255, 255, 255, 0)) 100% 0,
                radial-gradient(farthest-side at 0% 50%, rgba(15, 118, 110, .12), transparent),
                radial-gradient(farthest-side at 100% 50%, rgba(15, 118, 110, .12), transparent) 100% 0;
            background-repeat: no-repeat;
            background-size: 48px 100%, 48px 100%, 16px 100%, 16px 100%;
            background-attachment: local, local, scroll, scroll;
        }

        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .riwayat-table thead tr {
            background: var(--teal-dark);
        }

        .riwayat-table th {
            padding: 11px 12px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .85);
            text-align: left;
            white-space: nowrap;
        }

        .riwayat-table tbody tr {
            border-bottom: 1px solid rgba(15, 118, 110, .06);
            transition: background .15s;
        }

        .riwayat-table tbody tr:last-child {
            border-bottom: none;
        }

        .riwayat-table tbody tr:hover {
            background: #f8faf9;
        }

        .riwayat-table td {
            padding: 10px 12px;
            font-size: 13px;
            color: #3d5a58;
            vertical-align: middle;
            white-space: nowrap;
        }

        .riwayat-table td:first-child {
            font-weight: 600;
            color: #7a9e9b;
        }

        .scroll-hint {
            display: none;
            font-size: 11px;
            color: #7a9e9b;
            text-align: right;
            padding: 6px 16px 2px;
        }

        @media (max-width: 640px) {
            .scroll-hint {
                display: block;
            }
        }

        .action-cell {
            display: flex;
            gap: 5px;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            text-decoration: none;
            transition: all .2s;
            background: none;
            padding: 0;
        }

        .btn-icon-edit {
            background: #dbeafe;
            color: #2563eb;
        }

        .btn-icon-edit:hover {
            background: #2563eb;
            color: white;
            transform: scale(1.1);
        }

        .btn-icon-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-icon-delete:hover {
            background: #dc2626;
            color: white;
            transform: scale(1.1);
        }

        .empty-row td {
            text-align: center;
            padding: 40px;
            color: #7a9e9b;
            font-size: 14px;
        }

        .chart-box {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 32px;
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
                padding: 14px;
            }

            .dash-topbar {
                padding: 0 14px;
            }

            .topbar-date {
                display: none;
            }

            .hero-card {
                padding: 18px;
                flex-direction: column;
                gap: 12px;
            }

            .hero-name {
                font-size: 16px;
            }

            .hero-right {
                width: 100%;
            }

            .detail-table th {
                width: 110px;
                padding: 10px 14px;
            }

            .detail-table td {
                padding: 10px 14px;
            }

            .dash-section-title {
                font-size: 18px;
            }
        }

        @media (max-width: 400px) {
            .detail-table {
                display: block;
            }

            .detail-table tr {
                display: grid;
                grid-template-columns: 1fr;
                border-bottom: 2px solid rgba(15, 118, 110, .08);
                padding: 10px 14px;
                gap: 2px;
            }

            .detail-table th {
                width: auto;
                border-right: none;
                background: none;
                padding: 0;
                font-size: 10px;
                color: #7a9e9b;
            }

            .detail-table td {
                padding: 0;
                font-size: 14px;
            }
        }
    </style>

    @php
        function badgeClassBB(string $status): string
        {
            $s = strtolower(trim($status));
            if (str_contains($s, 'sangat kurang') || str_contains($s, 'kurang')) {
                return 'status-stunting';   
            }
            if (str_contains($s, 'lebih')) {
                return 'status-info';       
            }
            return 'status-normal';        
        }


        function badgeClassTB(string $status): string
        {
            $s = strtolower(trim($status));
            if (str_contains($s, 'stunting')) {
                return 'status-stunting';   
            }
            if (str_contains($s, 'tinggi')) {
                return 'status-info';       
            }
            return 'status-normal';     
        }

        function badgeClassKesimpulan(string $status): string
        {
            $s = strtolower(trim($status));
            if (str_contains($s, 'stunting')) {
                return 'status-stunting';
            }
            if (str_contains($s, 'kurang')) {
                return 'status-warning';
            }
            return 'status-normal';
        }
    @endphp

    <div class="dash-wrapper">
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

        <div class="dash-main">
            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div>
                        <div class="topbar-page">Detail Balita</div>
                        <div class="topbar-greeting">Riwayat &amp; grafik pertumbuhan</div>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <a href="{{ route('balita.index') }}" class="btn-back-top">
                        <i class="fas fa-arrow-left"></i>
                        <span class="back-label">Kembali</span>
                    </a>
                </div>
            </header>

            <div class="dash-content">

                <div class="dash-section-tag">Profil Balita</div>
                <h2 class="dash-section-title">Detail Data Balita</h2>

                @php
                    $kesimpulan = $penimbanganTerakhir->hasil['kesimpulan'] ?? null;
                    $isStunting = str_contains(strtolower($kesimpulan ?? ''), 'stunting');
                    $isKurang = str_contains(strtolower($kesimpulan ?? ''), 'kurang');
                @endphp

                <div class="hero-card">
                    <div class="hero-left">
                        <div class="hero-avatar">{{ $balita->jenis_kelamin == 'L' ? '👦' : '👧' }}</div>
                        <div>
                            <div class="hero-name">{{ $balita->nama }}</div>
                            <div class="hero-meta">
                                {{ $balita->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}<br>
                                Ibu: {{ $balita->nama_ibu }}
                            </div>
                        </div>
                    </div>
                    <div class="hero-right">
                        @if($kesimpulan)
                            <span class="hero-badge {{ $isStunting ? 'danger' : ($isKurang ? 'warning' : 'success') }}">
                                {{ $kesimpulan }}
                            </span>
                        @endif
                        <a href="{{ route('balita.edit', $balita->id) }}" class="hero-btn">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                        <a href="{{ route('balita.download', $balita->id) }}" target="_blank" class="hero-btn">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header ph-biodata">
                        <div class="panel-header-icon">📋</div>
                        <div class="panel-header-title">Biodata Balita</div>
                    </div>
                    <table class="detail-table">
                        <tr>
                            <th>Nama</th>
                            <td><strong>{{ $balita->nama }}</strong></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $balita->nik }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tgl Lahir</th>
                            <td>{{ $balita->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Ibu</th>
                            <td>{{ $balita->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <th>Status Terakhir</th>
                            <td>
                                @if($kesimpulan)
                                    <span class="status-badge {{ badgeClassKesimpulan($kesimpulan) }}">
                                        {{ $kesimpulan }}
                                    </span>
                                @else
                                    <span class="status-badge status-unknown">Belum ada data</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel">
                    <div class="panel-header ph-akun">
                        <div class="panel-header-icon">🔑</div>
                        <div class="panel-header-title">Akun Orang Tua</div>
                    </div>
                    <table class="detail-table">
                        <tr>
                            <th>Username</th>
                            <td>{{ $balita->user->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Password Awal</th>
                            <td>Nama Ibu saat pendaftaran</td>
                        </tr>
                    </table>
                </div>

                <div class="panel">
                    <div class="panel-header ph-riwayat">
                        <div class="panel-header-icon">⚖️</div>
                        <div class="panel-header-title">Riwayat Penimbangan</div>
                    </div>
                    <p class="scroll-hint">← Geser untuk melihat semua kolom →</p>
                    <div class="table-wrapper">
                        <table class="riwayat-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Umur</th>
                                    <th>BB (kg)</th>
                                    <th>Z BB/U</th>
                                    <th>Status BB</th>
                                    <th>TB (cm)</th>
                                    <th>Z TB/U</th>
                                    <th>Status TB</th>
                                    <th>LILA</th>
                                    <th>LIKA</th>
                                    <th>Kesimpulan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($balita->penimbangans as $p)
                                    @php
                                        $tglLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
                                        $tglTimbang = \Carbon\Carbon::parse($p->tanggal_penimbangan);
                                        $umurBulan = floor($tglLahir->floatDiffInMonths($tglTimbang));

                                        $hasil = $p->hasil ?? [];
                                        $kesimp = $hasil['kesimpulan'] ?? null;
                                        $statusBB = $hasil['status_bb'] ?? null;
                                        $statusTB = $hasil['status_tb'] ?? null;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_penimbangan)->format('d M Y') }}</td>
                                        <td><strong>{{ $umurBulan }}</strong> bln</td>
                                        <td>{{ $p->berat_badan }}</td>
                                        <td>{{ $hasil['z_bb_u'] ?? '-' }}</td>
                                        <td>
                                            @if($statusBB)
                                                <span class="status-badge {{ badgeClassBB($statusBB) }}"
                                                    style="font-size:11px;padding:3px 9px;">
                                                    {{ $statusBB }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $p->tinggi_badan }}</td>
                                        <td>{{ $hasil['z_tb_u'] ?? '-' }}</td>
                                        <td>
                                            @if($statusTB)
                                                <span class="status-badge {{ badgeClassTB($statusTB) }}"
                                                    style="font-size:11px;padding:3px 9px;">
                                                    {{ $statusTB }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $p->lila }}</td>
                                        <td>{{ $p->lika }}</td>
                                        <td>
                                            @if($kesimp)
                                                <span class="status-badge {{ badgeClassKesimpulan($kesimp) }}"
                                                    style="font-size:11px;padding:3px 9px;">
                                                    {{ $kesimp }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-cell">
                                                <a href="{{ route('penimbangan.edit', $p->id) }}" class="btn-icon btn-icon-edit"
                                                    title="Edit">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <form action="{{ route('penimbangan.destroy', $p->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin hapus data penimbangan ini?')"
                                                    style="margin:0;">
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
                                        <td colspan="13">⚖️ Belum ada data penimbangan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header ph-grafik">
                        <div class="panel-header-icon">📈</div>
                        <div class="panel-header-title">Grafik Pertumbuhan KMS</div>
                    </div>
                    <div class="chart-box">
                        <canvas id="chartBBU"></canvas>
                        <canvas id="chartTBU"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart-kms.js') }}"></script>

    <script>
        window.whoBBU = @json($whoBBU);
        window.whoTBU = @json($whoTBU);

        renderKMSChart(
            'chartBBU', 'bb',
            "{{ strtolower($balita->jenis_kelamin) }}",
            @json($balita->penimbangans),
            "{{ $balita->tanggal_lahir }}"
        );

        renderKMSChart(
            'chartTBU', 'tb',
            "{{ strtolower($balita->jenis_kelamin) }}",
            @json($balita->penimbangans),
            "{{ $balita->tanggal_lahir }}"
        );
    </script>

    <script>
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
            if (dateEl) dateEl.textContent = new Date().toLocaleDateString('id-ID', {
                weekday: 'short', day: 'numeric', month: 'long', year: 'numeric'
            });
        })();
    </script>

@endsection