@extends('layouts.app')

@section('title', 'Dashboard Kader')

@section('content')

    <div class="wrapper">

        <div class="sidebar" id="sidebar">
            @include('partials.sidebar_kader')
        </div>

        <div class="main">

            <div class="topbar">
                <button class="hamburger" id="toggleSidebar">☰</button>

                <div class="topbar-text">
                    <h3>Dashboard</h3>
                    <span>Selamat Datang, <strong>Kader 👋</strong></span>
                </div>
            </div>

            <div class="cards">
                <div class="card card-hover">
                    <div class="card-icon">👶</div>
                    <h4>Data Balita</h4>
                    <p>{{ $totalBalita }}</p>
                </div>
            </div>

        </div>

    </div>

    <div class="overlay" id="overlay"></div>

    <script>
        const toggle = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        toggle.onclick = function () {
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
        }

        overlay.onclick = function () {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        }
    </script>

    <style>
        /* ================= WRAPPER ================= */
        .wrapper {
            display: flex;
            min-height: 100vh;
            background: #f4f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed;
            left: -260px;
            top: 0;
            width: 260px;
            height: 100%;
            background: linear-gradient(180deg, #0d4f4d 0%, #126e6c 100%);
            color: white;
            transition: 0.4s;
            z-index: 1000;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 0 12px 12px 0;
        }

        .sidebar.active {
            left: 0;
        }

        /* ================= MAIN ================= */
        .main {
            flex: 1;
            padding: 30px;
            width: 100%;
            transition: 0.3s;
        }

        /* ================= TOPBAR ================= */
        .topbar {
            background: #fff;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .topbar-text h3 {
            margin: 0;
            font-size: 22px;
            color: #0d4f4d;
        }

        .topbar-text span {
            font-size: 14px;
            color: #555;
        }

        .hamburger {
            background: #0d4f4d;
            color: #fff;
            border: none;
            padding: 10px 14px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .hamburger:hover {
            background: #126e6c;
        }

        /* ================= CARDS ================= */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            background: #fff;
            padding: 22px 20px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            border-left: 5px solid #0d4f4d;
            transition: 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.12);
        }

        .card h4 {
            margin: 12px 0 5px;
            font-size: 15px;
            color: #666;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #0d4f4d;
        }

        .card-icon {
            font-size: 30px;
            display: inline-block;
            background: #e0f2f1;
            color: #0d4f4d;
            padding: 12px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
            margin-bottom: 10px;
        }

        .card-hover:hover .card-icon {
            transform: scale(1.1);
        }

        /* ================= OVERLAY ================= */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.35);
            display: none;
            z-index: 900;
        }

        .overlay.active {
            display: block;
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:768px) {
            .main {
                padding: 15px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .topbar-text h3 {
                font-size: 18px;
            }

            .topbar-text span {
                font-size: 13px;
            }

            .cards {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .card p {
                font-size: 22px;
            }
        }

        @media(max-width:480px) {
            .main {
                padding: 12px;
            }

            .topbar {
                padding: 12px;
            }

            .card {
                padding: 16px;
                border-radius: 14px;
            }

            .card h4 {
                font-size: 13px;
            }

            .card p {
                font-size: 20px;
            }
        }
    </style>

@endsection