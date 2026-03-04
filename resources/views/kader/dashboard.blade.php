@extends('layouts.app')

@section('title', 'Dashboard Kader')

@section('content')

    <div class="dashboard-container">

        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Kader</h2>
            <ul>
                <li class="active"><a href="{{ route('dashboard.kader') }}">Dashboard</a></li>
                <li><a href="{{ route('balita.index') }}">Data Balita</a></li>
                <li><a href="#">Data Orang Tua</a></li>
                <li><a href="#">Slider</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">

            <div class="topbar">
                <h3>Dashboard</h3>
                <span>Selamat Datang, Kader 👋</span>
            </div>

            <div class="cards">
                <div class="card">
                    <h4>Total Balita</h4>
                    <p>{{ $totalBalita }}</p>
                </div>

                <div class="card">
                    <h4>Total Orang Tua</h4>
                    <p>{{ $totalOrangTua }}</p>
                </div>

                <div class="card">
                    <h4>Data Stunting</h4>
                    <p>{{ $totalStunting }}</p>
                </div>
            </div>

        </div>

    </div>

    <style>
        .dashboard-container {
            display: flex;
            min-height: 80vh;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #0d4f4d;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 8px;
        }

        .sidebar ul li a,
        .sidebar ul li .logout-btn {
            display: block;
            padding: 12px 10px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active,
        .sidebar ul li .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .logout-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: white;
            padding: 12px 10px;
        }

        /* Main */
        .main-content {
            flex: 1;
            padding: 30px;
            background: #f4f6f9;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card h4 {
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #0d4f4d;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }
        }
    </style>

@endsection