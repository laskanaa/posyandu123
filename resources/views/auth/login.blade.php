@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --teal-dark:  #0a3d38;
            --teal:       #0f766e;
            --teal-mid:   #14b8a6;
            --teal-light: #ccfbf1;
            --accent:     #f59e0b;
            --blue:       #2563eb;
            --blue-light: #dbeafe;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
        }

        /* ─── PAGE LAYOUT ─── */
        .login-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ─── LEFT PANEL ─── */
        .login-panel-left {
            background: var(--teal-dark);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
        }

        .login-panel-left::before {
            content: '';
            position: absolute;
            top: -100px; left: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(20,184,166,.18), transparent 65%);
            border-radius: 50%; pointer-events: none;
        }

        .login-panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px; right: -80px;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(245,158,11,.1), transparent 65%);
            border-radius: 50%; pointer-events: none;
        }

        .login-brand {
            display: flex; align-items: center; gap: 12px;
            position: relative; z-index: 1;
        }

        .login-brand-emblem {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 14px rgba(20,184,166,.3);
        }

        .login-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 17px; font-weight: 700;
            color: white; line-height: 1.2;
        }

        .login-brand-sub {
            font-size: 11px; color: var(--teal-mid);
            letter-spacing: .08em; text-transform: uppercase;
        }

        .login-panel-center {
            position: relative; z-index: 1;
            flex: 1;
            display: flex; flex-direction: column;
            justify-content: center; gap: 28px;
        }

        .login-panel-heading {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 3vw, 40px);
            font-weight: 700; color: white; line-height: 1.25;
        }

        .login-panel-heading em { font-style: normal; color: var(--accent); }

        .login-panel-desc {
            font-size: 14.5px; color: rgba(255,255,255,.55);
            line-height: 1.75; max-width: 320px;
        }

        .login-features { display: flex; flex-direction: column; gap: 12px; }

        .login-feature {
            display: flex; align-items: center; gap: 12px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 12px; padding: 12px 16px;
        }

        .login-feature-icon {
            width: 36px; height: 36px;
            background: rgba(20,184,166,.15);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }

        .login-feature-text { font-size: 13.5px; color: rgba(255,255,255,.7); line-height: 1.4; }
        .login-feature-text strong {
            display: block; color: white;
            font-weight: 600; font-size: 13px; margin-bottom: 1px;
        }

        .login-panel-credit {
            font-size: 12px; color: rgba(255,255,255,.3);
            position: relative; z-index: 1;
        }

        /* ─── RIGHT PANEL ─── */
        .login-panel-right {
            background: #f8faf9;
            display: flex; align-items: center; justify-content: center;
            padding: 48px 40px;
        }

        /* ── Tombol kembali ke home ── */
        .btn-home {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; height: 50px;
            background: white;
            border: 1.5px solid rgba(15,118,110,.2);
            border-radius: 12px;
            color: var(--teal-dark);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            text-decoration: none;
            transition: all .25s;
            box-shadow: 0 2px 8px rgba(15,118,110,.06);
            margin-top: 12px;
        }

        .btn-home:hover {
            background: var(--teal-light);
            border-color: var(--teal);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(15,118,110,.12);
        }

        .login-card {
            width: 100%; max-width: 400px;
            animation: fadeUp .6s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── CARD HEADER ─── */
        .login-card-header { margin-bottom: 32px; }

        .login-card-tag {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--teal-light); color: var(--teal);
            font-size: 11px; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            padding: 5px 13px; border-radius: 30px; margin-bottom: 14px;
        }
        .login-card-tag::before {
            content: ''; width: 5px; height: 5px;
            background: var(--teal); border-radius: 50%;
        }

        .login-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px; font-weight: 700;
            color: #0d1f1e; margin-bottom: 6px; line-height: 1.2;
        }

        .login-card-subtitle { font-size: 14px; color: #7a9e9b; }

        /* ─── ROLE SELECTOR ─── */
        .role-label {
            font-size: 12px; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase;
            color: #7a9e9b; margin-bottom: 10px; display: block;
        }

        .role-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 10px; margin-bottom: 28px;
        }

        .role-card {
            border: 2px solid #e2e8f0; border-radius: 14px;
            padding: 14px 16px; cursor: pointer;
            transition: all .25s; background: white;
            text-align: left; display: flex; align-items: center; gap: 10px;
        }
        .role-card:hover { border-color: var(--teal-mid); background: var(--teal-light); }
        .role-card.active-kader {
            border-color: var(--teal); background: var(--teal-light);
            box-shadow: 0 0 0 3px rgba(15,118,110,.12);
        }
        .role-card.active-ortu {
            border-color: var(--blue); background: var(--blue-light);
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }

        .role-icon { font-size: 22px; line-height: 1; }
        .role-info strong {
            display: block; font-size: 13px; font-weight: 600;
            color: #0d1f1e; margin-bottom: 1px;
        }
        .role-info span { font-size: 11px; color: #7a9e9b; }

        /* ─── FORM ─── */
        .form-group { margin-bottom: 16px; }

        .form-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: #3d5a58; margin-bottom: 7px;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            font-size: 15px; pointer-events: none;
        }

        .form-group input {
            width: 100%; height: 48px;
            padding: 0 14px 0 42px;
            border: 1.5px solid #e2e8f0; border-radius: 12px;
            font-size: 14px; font-family: 'DM Sans', sans-serif;
            background: white; color: #0d1f1e;
            transition: border-color .25s, box-shadow .25s; outline: none;
        }
        .form-group input::placeholder { color: #b0c4c2; }
        .form-group input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(15,118,110,.1);
        }

        /* ─── SUBMIT ─── */
        .login-submit {
            width: 100%; height: 50px; border: none; border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 600; color: white;
            cursor: pointer; margin-top: 6px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            box-shadow: 0 6px 20px rgba(15,118,110,.3);
            transition: all .3s;
        }
        .login-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(15,118,110,.35);
        }
        .login-submit:active { transform: translateY(0); }
        .login-submit.ortu-mode {
            background: linear-gradient(135deg, #1d4ed8, var(--blue));
            box-shadow: 0 6px 20px rgba(37,99,235,.3);
        }
        .login-submit.ortu-mode:hover {
            box-shadow: 0 10px 28px rgba(37,99,235,.35);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 860px) {
            .login-page { grid-template-columns: 1fr; }
            .login-panel-left { display: none; }
            .login-panel-right { min-height: 100vh; }
        }

        @media (max-width: 480px) {
            .login-panel-right { padding: 32px 24px; }
        }
    </style>

    <div class="login-page">

        {{-- ── Left panel ── --}}
        <div class="login-panel-left">
            <div class="login-brand">
                <div class="login-brand-emblem">🌿</div>
                <div>
                    <div class="login-brand-name">Posyandu</div>
                    <div class="login-brand-sub">Paguyangan</div>
                </div>
            </div>

            <div class="login-panel-center">
                <h1 class="login-panel-heading">
                    Sistem Monitoring<br>
                    <em>Stunting</em> Terpadu
                </h1>
                <p class="login-panel-desc">
                    Platform digital untuk memantau tumbuh kembang balita dan mencegah stunting di wilayah Paguyangan.
                </p>
                <div class="login-features">
                    <div class="login-feature">
                        <div class="login-feature-icon">📊</div>
                        <div class="login-feature-text">
                            <strong>Pemantauan Real-time</strong>
                            Data pertumbuhan balita tercatat otomatis
                        </div>
                    </div>
                    <div class="login-feature">
                        <div class="login-feature-icon">🩺</div>
                        <div class="login-feature-text">
                            <strong>Deteksi Dini Stunting</strong>
                            Sistem notifikasi untuk kader & orang tua
                        </div>
                    </div>
                    <div class="login-feature">
                        <div class="login-feature-icon">📋</div>
                        <div class="login-feature-text">
                            <strong>Laporan Lengkap</strong>
                            Rekap data bulanan yang mudah diakses
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-panel-credit">
                © {{ date('Y') }} Posyandu Paguyangan
            </div>
        </div>

        {{-- ── Right panel ── --}}
        <div class="login-panel-right">

            <div class="login-card">

                <div class="login-card-header">
                    <div class="login-card-tag">Masuk Akun</div>
                    <h2 class="login-card-title">Selamat Datang 👋</h2>
                    <p class="login-card-subtitle">Pilih peran dan masuk ke sistem monitoring.</p>
                </div>

                {{-- Role selector --}}
                <span class="role-label">Masuk sebagai</span>
                <div class="role-grid">
                    <button type="button" onclick="selectRole('kader')" id="btn-kader" class="role-card">
                        <span class="role-icon">🧑‍⚕️</span>
                        <div class="role-info">
                            <strong>Kader</strong>
                            <span>Posyandu</span>
                        </div>
                    </button>
                    <button type="button" onclick="selectRole('ortu')" id="btn-ortu" class="role-card">
                        <span class="role-icon">👨‍👩‍👧</span>
                        <div class="role-info">
                            <strong>Orang Tua</strong>
                            <span>/ Wali</span>
                        </div>
                    </button>
                </div>

                {{-- Form --}}
                <form method="POST" action="#">
                    @csrf
                    <input type="hidden" name="role" id="role">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrap">
                            <span class="input-icon">📧</span>
                            <input type="email" id="email" name="email"
                                placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="password" name="password"
                                placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <button type="submit" id="login-btn" class="login-submit">
                        Masuk ke Sistem →
                    </button>

                    {{-- Tombol kembali ke home --}}
                    <a href="{{ url('/') }}" class="btn-home">
                        ← Kembali ke Beranda
                    </a>
                </form>

            </div>
        </div>

    </div>

    <script>
    function selectRole(role) {
        document.getElementById('role').value = role;

        const kaderBtn = document.getElementById('btn-kader');
        const ortuBtn  = document.getElementById('btn-ortu');
        const loginBtn = document.getElementById('login-btn');

        kaderBtn.classList.remove('active-kader');
        ortuBtn.classList.remove('active-ortu');

        if (role === 'kader') {
            kaderBtn.classList.add('active-kader');
            loginBtn.classList.remove('ortu-mode');
        } else {
            ortuBtn.classList.add('active-ortu');
            loginBtn.classList.add('ortu-mode');
        }
    }
    </script>

@endsection