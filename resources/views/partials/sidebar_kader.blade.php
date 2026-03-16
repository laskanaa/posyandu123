<div class="sidebar" id="sidebar">

    <h2>Admin Kader</h2>

    <ul>

        <li class="{{ request()->routeIs('dashboard.kader') ? 'active' : '' }}">
            <a href="{{ route('dashboard.kader') }}">Dashboard</a>
        </li>

        <li class="{{ request()->routeIs('kader.slider.*') ? 'active' : '' }}">
            <a href="{{ route('kader.slider.index') }}">Slider</a>
        </li>

        <li class="{{ request()->routeIs('balita.*') ? 'active' : '' }}">
            <a href="{{ route('balita.index') }}">Data Balita</a>
        </li>

        <li class="{{ request()->routeIs('kader.tentang.*') ? 'active' : '' }}">
            <a href="{{ route('kader.tentang.index') }}">Tentang Posyandu</a>
        </li>

        <li class="{{ request()->routeIs('kader.layanan.*') ? 'active' : '' }}">
            <a href="{{ route('kader.layanan.index') }}">Layanan</a>
        </li>

        <li class="{{ request()->routeIs('kader.spm.*') ? 'active' : '' }}">
            <a href="{{ route('kader.spm.index') }}">SPM</a>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>

    </ul>

</div>


<style>
    .sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        width: 260px;
        height: 100%;
        background: #0d4f4d;
        color: white;
        padding: 25px 20px;
        box-sizing: border-box;
        transition: 0.3s;
        z-index: 1000;
    }

    .sidebar.active {
        left: 0;
    }

    .sidebar h2 {
        margin-bottom: 25px;
        font-size: 18px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        margin-bottom: 10px;
    }

    .sidebar a,
    .sidebar button {
        display: block;
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
    }

    .sidebar a:hover,
    .sidebar button:hover,
    .sidebar li.active a {
        background: rgba(255, 255, 255, 0.2);
    }
</style>