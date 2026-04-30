<?php $__env->startSection('title', 'Dashboard Orang Tua'); ?>

<?php $__env->startSection('hideHeader'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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

        .dash-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            overflow-x: hidden;
        }

        .dash-topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(240, 247, 246, .92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15, 118, 110, .08);
            padding: 0 24px;
            height: 64px;
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

        .hero-badge.success {
            background: #10b981;
            border-color: #10b981;
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
            width: 160px;
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
            min-width: 760px;
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

        td.col-pesan {
            min-width: 180px;
            max-width: 300px;
            white-space: normal;
            line-height: 1.5;
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

            .dash-section-title {
                font-size: 18px;
            }

            .detail-table th {
                width: 110px;
                padding: 10px 14px;
            }

            .detail-table td {
                padding: 10px 14px;
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

        .btn-logout {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: white;
            border: 1px solid rgba(15, 118, 110, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            cursor: pointer;
            transition: all .25s;
        }

        .btn-logout:hover {
            background: #fee2e2;
            border-color: #dc2626;
            color: #dc2626;
        }
    </style>

    <div class="dash-wrapper">
        <div class="dash-main">
            <header class="dash-topbar">
                <div class="topbar-left">
                    <div>
                        <div class="topbar-page">Dashboard Balita</div>
                        <div class="topbar-greeting">Pantau tumbuh kembang si kecil</div>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin:0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </header>

            <div class="dash-content">
                <div class="dash-section-tag">Profil Balita</div>
                <h2 class="dash-section-title">Data &amp; Riwayat Pertumbuhan</h2>

                <?php
                    $kesimpulan = $penimbanganTerakhir->hasil['kesimpulan'] ?? null;
                    $isStunting = str_contains(strtolower($kesimpulan ?? ''), 'stunting');
                ?>

                <div class="hero-card">
                    <div class="hero-left">
                        <div class="hero-avatar">
                            <?php echo e($balita->jenis_kelamin == 'L' ? '👦' : '👧'); ?>

                        </div>
                        <div>
                            <div class="hero-name"><?php echo e($balita->nama); ?></div>
                            <div class="hero-meta">
                                <?php echo e($balita->tempat_lahir); ?>,
                                <?php echo e(\Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y')); ?><br>
                                Ibu: <?php echo e($balita->nama_ibu); ?>

                            </div>
                        </div>
                    </div>
                    <div class="hero-right">
                        <?php if($kesimpulan): ?>
                            <span class="hero-badge <?php echo e($isStunting ? 'danger' : 'success'); ?>">
                                <?php echo e($kesimpulan); ?>

                            </span>
                        <?php endif; ?>
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
                            <td><strong><?php echo e($balita->nama); ?></strong></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td><?php echo e($balita->nik); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat, Tgl Lahir</th>
                            <td><?php echo e($balita->tempat_lahir); ?>,
                                <?php echo e(\Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y')); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?php echo e($balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Ibu</th>
                            <td><?php echo e($balita->nama_ibu); ?></td>
                        </tr>
                        <tr>
                            <th>Status Terakhir</th>
                            <td>
                                <?php if($kesimpulan): ?>
                                    <span class="status-badge <?php echo e($isStunting ? 'status-stunting' : 'status-normal'); ?>">
                                        <?php echo e($kesimpulan); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="status-badge status-unknown">Belum ada data</span>
                                <?php endif; ?>
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
                            <td><?php echo e($balita->user->email ?? '-'); ?></td>
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
                                    <th>Status BB</th>
                                    <th>TB (cm)</th>
                                    <th>Status TB</th>
                                    <th>LILA</th>
                                    <th>LIKA</th>
                                    <th>Kesimpulan</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $balita->penimbangans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $tglLahir = \Carbon\Carbon::parse($balita->tanggal_lahir);
                                        $tglTimbang = \Carbon\Carbon::parse($p->tanggal_penimbangan);
                                        $umurBulan = floor($tglLahir->floatDiffInMonths($tglTimbang));
                                        $kesimp = $p->hasil['kesimpulan'] ?? null;
                                        $stunt = str_contains(strtolower($kesimp ?? ''), 'stunting');
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($p->tanggal_penimbangan)->format('d M Y')); ?></td>
                                        <td><strong><?php echo e($umurBulan); ?></strong> bln</td>
                                        <td><?php echo e($p->berat_badan); ?></td>
                                        <td>
                                            <?php if(isset($p->hasil['status_bb'])): ?>
                                                <span class="status-badge <?php echo e($stunt ? 'status-stunting' : 'status-normal'); ?>"
                                                    style="font-size:11px;padding:3px 9px;">
                                                    <?php echo e($p->hasil['status_bb']); ?>

                                                </span>
                                            <?php else: ?> -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($p->tinggi_badan); ?></td>
                                        <td>
                                            <?php if(isset($p->hasil['status_tb'])): ?>
                                                <span class="status-badge <?php echo e($stunt ? 'status-stunting' : 'status-normal'); ?>"
                                                    style="font-size:11px;padding:3px 9px;">
                                                    <?php echo e($p->hasil['status_tb']); ?>

                                                </span>
                                            <?php else: ?> -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($p->lila ?? '-'); ?></td>
                                        <td><?php echo e($p->lika ?? '-'); ?></td>
                                        <td>
                                            <?php if($kesimp): ?>
                                                <span class="status-badge <?php echo e($stunt ? 'status-stunting' : 'status-normal'); ?>"
                                                    style="font-size:11px;padding:3px 9px;">
                                                    <?php echo e($kesimp); ?>

                                                </span>
                                            <?php else: ?> -
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-pesan"><?php echo e($p->pesan ?? '-'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr class="empty-row">
                                        <td colspan="11">⚖️ Belum ada data penimbangan.</td>
                                    </tr>
                                <?php endif; ?>
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
    <script src="<?php echo e(asset('js/chart-kms.js')); ?>"></script>

    <script>
        window.whoBBU = <?php echo json_encode($whoBBU, 15, 512) ?>;
        window.whoTBU = <?php echo json_encode($whoTBU, 15, 512) ?>;

        renderKMSChart(
            'chartBBU', 'bb',
            "<?php echo e(strtolower($balita->jenis_kelamin)); ?>",
            <?php echo json_encode($balita->penimbangans, 15, 512) ?>,
            "<?php echo e($balita->tanggal_lahir); ?>"
        );

        renderKMSChart(
            'chartTBU', 'tb',
            "<?php echo e(strtolower($balita->jenis_kelamin)); ?>",
            <?php echo json_encode($balita->penimbangans, 15, 512) ?>,
            "<?php echo e($balita->tanggal_lahir); ?>"
        );

        (function () {
            const el = document.getElementById('topbarDate');
            if (el) el.textContent = new Date().toLocaleDateString('id-ID', {
                weekday: 'short', day: 'numeric', month: 'long', year: 'numeric'
            });
        })();
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ITTP\YOI\posyandu - Salin\resources\views/orangtua/dashboard.blade.php ENDPATH**/ ?>