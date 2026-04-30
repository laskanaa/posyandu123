@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            --teal-dark: #0a3d38;
            --teal: #0f766e;
            --teal-mid: #14b8a6;
            --teal-light: #ccfbf1;
            --accent: #f59e0b;
            --blue: #2563eb;
            --blue-dark: #1d4ed8;
            --blue-light: #dbeafe;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            background: #f8faf9;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .login-sub {
            font-size: 14px;
            color: #7a9e9b;
            margin-bottom: 20px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 22px;
        }

        .role-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            transition: border-color .2s, background .2s;
        }

        .role-card.active-kader {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .role-card.active-ortu {
            border-color: var(--blue);
            background: var(--blue-light);
        }

        .form-group {
            width: 100%;
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            display: block;
            height: 50px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 0 14px;
            font-size: 14px;
            margin-top: 6px;
            outline: none;
            transition: border-color .2s;
        }

        .form-group input:focus {
            border-color: var(--teal-mid);
        }

        .login-btn {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            transition: opacity .2s;
        }

        .login-btn:hover {
            opacity: .9;
        }

        .login-btn.ortu {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
        }

        .btn-home {
            display: block;
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
            text-decoration: none;
            color: var(--teal);
        }
    </style>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-title">Login Sistem</div>
            <div class="login-sub">Monitoring Stunting Posyandu</div>

            <div class="role-grid">
                <div class="role-card" id="kader" onclick="setRole('kader')">🧑‍⚕️ Kader</div>
                <div class="role-card" id="ortu" onclick="setRole('ortu')">👨‍👩‍👧 Orang Tua</div>
            </div>

            <form method="POST" action="#">
                @csrf
                <input type="hidden" name="role" id="role">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" id="btn" class="login-btn">Masuk</button>

                <a href="{{ url('/') }}" class="btn-home">← Kembali ke Beranda</a>
            </form>

        </div>
    </div>

    <script>
        function setRole(role) {
            document.getElementById('role').value = role;

            document.getElementById('kader').classList.remove('active-kader');
            document.getElementById('ortu').classList.remove('active-ortu');

            const btn = document.getElementById('btn');

            if (role === 'kader') {
                document.getElementById('kader').classList.add('active-kader');
                btn.classList.remove('ortu');
            } else {
                document.getElementById('ortu').classList.add('active-ortu');
                btn.classList.add('ortu');
            }
        }
    </script>

@endsection