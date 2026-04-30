<?php $__env->startSection('title', 'Dashboard Kader'); ?>

<?php $__env->startSection('hideHeader', true); ?>
<?php $__env->startSection('hideFooter', true); ?>


<?php $__env->startSection('content'); ?>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            transition: margin .4s;
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
            background: rgba(240, 247, 246, .88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15, 118, 110, .08);
            padding: 0 32px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
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

        .topbar-breadcrumb {
            display: flex;
            flex-direction: column;
        }

        .topbar-page {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--teal-dark);
            line-height: 1.2;
        }

        .topbar-greeting {
            font-size: 13px;
            color: #7a9e9b;
        }

        .topbar-greeting strong {
            color: var(--teal);
            font-weight: 600;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-date {
            font-size: 12.5px;
            color: #7a9e9b;
            background: white;
            border: 1px solid rgba(15, 118, 110, .1);
            border-radius: 8px;
            padding: 6px 12px;
        }

        .topbar-notif {
            width: 38px;
            height: 38px;
            background: white;
            border: 1px solid rgba(15, 118, 110, .1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all .25s;
            position: relative;
        }

        .topbar-notif:hover {
            background: var(--teal-light);
            border-color: var(--teal-mid);
        }

        .notif-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            background: var(--accent);
            border-radius: 50%;
            border: 2px solid var(--bg);
        }

        .dash-content {
            padding: 32px;
            flex: 1;
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
            font-size: 22px;
            font-weight: 700;
            color: var(--teal-dark);
            margin-bottom: 24px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(15, 118, 110, .07);
            border: 1px solid rgba(15, 118, 110, .06);
            position: relative;
            overflow: hidden;
            transition: all .35s cubic-bezier(.22, 1, .36, 1);
            cursor: default;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), var(--teal-mid));
            border-radius: 18px 18px 0 0;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(15, 118, 110, .13);
        }

        .stat-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: var(--teal-light);
            transition: transform .35s;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .stat-trend {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 9px;
            border-radius: 20px;
            background: #dcfce7;
            color: #16a34a;
        }

        .stat-trend.down {
            background: #fee2e2;
            color: #dc2626;
        }

        .stat-value {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 38px;
            font-weight: 700;
            color: var(--teal-dark);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: #7a9e9b;
            font-weight: 500;
        }

        .stat-card.amber .stat-icon {
            background: #fef3c7;
        }

        .stat-card.amber::before {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .stat-card.amber .stat-value {
            color: #92400e;
        }

        .stat-card.rose .stat-icon {
            background: #ffe4e6;
        }

        .stat-card.rose::before {
            background: linear-gradient(90deg, #f43f5e, #fb7185);
        }

        .stat-card.rose .stat-value {
            color: #9f1239;
        }

        .stat-card.blue .stat-icon {
            background: #dbeafe;
        }

        .stat-card.blue::before {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        .stat-card.blue .stat-value {
            color: #1e3a8a;
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
                padding: 20px 16px;
            }

            .dash-topbar {
                padding: 0 16px;
            }

            .topbar-date {
                display: none;
            }
        }
    </style>

    <div class="dash-wrapper">
        <aside class="dash-sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-emblem">🌿</div>
                <div>
                    <div class="sidebar-brand-name">Posyandu</div>
                    <div class="sidebar-brand-sub">Paguyangan</div>
                </div>
            </div>

            <div class="sidebar-nav">
                <?php echo $__env->make('partials.sidebar_kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

        <div class="dash-main">
            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div class="topbar-breadcrumb">
                        <span class="topbar-page">Dashboard</span>
                        <span class="topbar-greeting">Selamat datang kembali, <strong>Kader 👋</strong></span>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <div class="topbar-notif">
                        🔔
                        <span class="notif-dot"></span>
                    </div>
                </div>
            </header>

            <div class="dash-content">

                <div class="dash-section-tag">Ringkasan</div>
                <h2 class="dash-section-title">Statistik Posyandu</h2>

                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="stat-card-top">
                            <div class="stat-icon">👶</div>
                            <span class="stat-trend">+2 baru</span>
                        </div>
                        <div class="stat-value"><?php echo e($totalBalita); ?></div>
                        <div class="stat-label">Total Balita Terdaftar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle = document.getElementById('toggleSidebar');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('open');
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            }

            toggle.addEventListener('click', function () {
                sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
            });

            overlay.addEventListener('click', closeSidebar);

            const dateEl = document.getElementById('topbarDate');
            if (dateEl) {
                const now = new Date();
                dateEl.textContent = now.toLocaleDateString('id-ID', {
                    weekday: 'short', day: 'numeric', month: 'long', year: 'numeric'
                });
            }
        })();
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ITTP\YOI\posyandu - Salin\resources\views/kader/dashboard.blade.php ENDPATH**/ ?>