@extends('layouts.app')

@section('title', 'Dashboard Kader')

@section('content')


    <div class="dashboard-container">

        <!-- Sidebar -->
        @include('partials.sidebar_kader')

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
        /* Dashboard Container */
        .dashboard-container {
            display: flex;
            min-height: 80vh;
            font-family: sans-serif;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            background: #f4f6f9;
        }

        /* Topbar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        /* Cards */
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