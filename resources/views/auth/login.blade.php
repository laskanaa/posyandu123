@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="login-wrapper">

        <div class="login-container">

            <h2 class="login-title">
                Login Sistem Monitoring Posyandu
            </h2>

            <p class="login-subtitle">
                Silakan pilih peran terlebih dahulu
            </p>

            <div class="role-selection">
                <button type="button" onclick="selectRole('kader')" id="btn-kader" class="role-btn">
                    Kader Posyandu
                </button>

                <button type="button" onclick="selectRole('ortu')" id="btn-ortu" class="role-btn">
                    Orang Tua
                </button>
            </div>

            <form method="POST" action="#">
                @csrf

                <input type="hidden" name="role" id="role">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" id="login-btn" class="login-btn">
                    Login
                </button>

            </form>

        </div>

    </div>

    <style>
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 45px 35px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            animation: fadeUp 0.6s ease;
        }

        /* TITLE */
        .login-title {
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-bottom: 25px;
        }

        /* ROLE */
        .role-selection {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .role-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #e5e7eb;
            font-weight: 500;
            transition: 0.3s;
        }

        .role-btn.kader-active {
            background: #0d4f4d;
            color: white;
        }

        .role-btn.ortu-active {
            background: #2563eb;
            color: white;
        }

        /* FORM */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        /* 🔥 INI YANG DIPERBAIKI */
        .form-group input {
            width: 100%;
            height: 45px;
            /* samain tinggi */
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #0d4f4d;
            outline: none;
        }

        /* BUTTON */
        .login-btn {
            width: 100%;
            height: 45px;
            /* samain tinggi */
            background: #0d4f4d;
            color: white;
            border: none;
            border-radius: 8px;
            margin-top: 10px;
            cursor: pointer;
            font-weight: 500;
        }

        .login-btn:hover {
            opacity: 0.9;
        }

        /* ANIMASI */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        function selectRole(role) {

            document.getElementById('role').value = role;

            let kaderBtn = document.getElementById('btn-kader');
            let ortuBtn = document.getElementById('btn-ortu');
            let loginBtn = document.getElementById('login-btn');

            kaderBtn.classList.remove('kader-active');
            ortuBtn.classList.remove('ortu-active');

            if (role === 'kader') {
                kaderBtn.classList.add('kader-active');
                loginBtn.style.background = "#0d4f4d";
            } else {
                ortuBtn.classList.add('ortu-active');
                loginBtn.style.background = "#2563eb";
            }
        }
    </script>

@endsection