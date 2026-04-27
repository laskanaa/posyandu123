
@extends('layouts.app')

@section('title', 'Tambah Slider')

@section('hideHeader', true)
@section('hideFooter', true)

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --teal-dark: #0a3d38;
            --teal:      #0f766e;
            --teal-mid:  #14b8a6;
            --teal-light:#ccfbf1;
            --bg:        #f0f7f6;
            --sidebar-w: 260px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: #0d1f1e;
        }

        .dash-wrapper { display: flex; min-height: 100vh; }

        /* ─── SIDEBAR ─── */
        .dash-sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: var(--teal-dark); z-index: 1000;
            display: flex; flex-direction: column;
            transition: transform .4s cubic-bezier(.22,1,.36,1);
            overflow: hidden;
        }

        .dash-sidebar::before {
            content: ''; position: absolute;
            top: -80px; left: -80px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(20,184,166,.15), transparent 65%);
            border-radius: 50%; pointer-events: none;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1; flex-shrink: 0;
        }

        .sidebar-brand-emblem {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(20,184,166,.3);
            flex-shrink: 0;
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 700; color: white; line-height: 1.2;
        }

        .sidebar-brand-sub {
            font-size: 10.5px; color: var(--teal-mid);
            letter-spacing: .07em; text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1; overflow-y: auto; padding: 16px 0;
            position: relative; z-index: 1; scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .sidebar-foot {
            padding: 16px 24px 24px;
            border-top: 1px solid rgba(255,255,255,.07);
            position: relative; z-index: 1;
        }

        .sidebar-foot-user { display: flex; align-items: center; gap: 10px; }

        .sidebar-avatar {
            width: 36px; height: 36px;
            background: rgba(20,184,166,.2); border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 16px;
        }

        .sidebar-foot-name { font-size: 13px; font-weight: 600; color: white; line-height: 1.3; }
        .sidebar-foot-role { font-size: 11px; color: var(--teal-mid); }

        @media (max-width: 900px) {
            .dash-sidebar { transform: translateX(-100%); }
            .dash-sidebar.open { transform: translateX(0); }
        }

        /* ─── MAIN ─── */
        .dash-main {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }
        @media (max-width: 900px) { .dash-main { margin-left: 0; } }

        /* ─── TOPBAR ─── */
        .dash-topbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(240,247,246,.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15,118,110,.08);
            padding: 0 32px; height: 68px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }

        .topbar-left  { display: flex; align-items: center; gap: 16px; }
        .topbar-page  { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: var(--teal-dark); }
        .topbar-sub   { font-size: 13px; color: #7a9e9b; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-date {
            font-size: 12.5px; color: #7a9e9b;
            background: white; border: 1px solid rgba(15,118,110,.1);
            border-radius: 8px; padding: 6px 12px;
        }

        .btn-back-top {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 16px;
            background: white; border: 1.5px solid rgba(15,118,110,.2);
            color: var(--teal-dark); border-radius: 10px;
            text-decoration: none; font-size: 13px; font-weight: 600;
            transition: all .25s;
        }
        .btn-back-top:hover { background: var(--teal-light); border-color: var(--teal); }

        .dash-hamburger {
            width: 40px; height: 40px;
            background: var(--teal-dark); border: none; border-radius: 10px;
            color: white; font-size: 18px; cursor: pointer;
            display: none; align-items: center; justify-content: center;
            transition: background .25s;
        }
        .dash-hamburger:hover { background: var(--teal); }
        @media (max-width: 900px) { .dash-hamburger { display: flex; } }

        /* ─── CONTENT ─── */
        .dash-content { padding: 32px; flex: 1; }

        .dash-section-tag {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--teal-light); color: var(--teal);
            font-size: 11px; font-weight: 600; letter-spacing: .1em;
            text-transform: uppercase; padding: 5px 13px;
            border-radius: 30px; margin-bottom: 8px;
        }
        .dash-section-tag::before {
            content: ''; width: 5px; height: 5px;
            background: var(--teal); border-radius: 50%;
        }

        .dash-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 700; color: var(--teal-dark); margin-bottom: 24px;
        }

        /* ─── PANEL ─── */
        .panel {
            background: white; border-radius: 20px;
            box-shadow: 0 2px 12px rgba(15,118,110,.07);
            border: 1px solid rgba(15,118,110,.06);
            overflow: hidden; max-width: 760px;
            animation: slideUp .4s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .panel-header {
            padding: 16px 24px;
            display: flex; align-items: center; gap: 12px;
            background: linear-gradient(135deg, #92400e, #d97706);
        }

        .panel-header-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: rgba(255,255,255,.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }

        .panel-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 700; color: white;
        }

        /* ─── FORM ─── */
        .form-body { padding: 28px 28px 8px; }

        .form-group { display: flex; flex-direction: column; margin-bottom: 22px; }

        .form-label {
            font-size: 12px; font-weight: 600; color: #7a9e9b;
            letter-spacing: .05em; text-transform: uppercase; margin-bottom: 8px;
        }

        .form-input {
            padding: 11px 14px;
            border: 1.5px solid rgba(15,118,110,.15);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: #0d1f1e;
            background: #fafcfc;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(15,118,110,.1);
            background: white;
        }

        /* Upload area */
        .upload-area {
            border: 2px dashed rgba(15,118,110,.25);
            border-radius: 12px;
            background: #f8faf9;
            padding: 28px 20px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; cursor: pointer;
            transition: border-color .2s, background .2s;
            position: relative;
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .upload-area input[type="file"] {
            position: absolute; inset: 0;
            opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }

        .upload-icon { font-size: 30px; }

        .upload-text {
            font-size: 13px; font-weight: 600; color: var(--teal-dark);
        }

        .upload-hint { font-size: 11.5px; color: #7a9e9b; }

        /* Preview setelah pilih file */
        .img-preview-wrap {
            display: none; margin-top: 14px;
        }

        .img-preview-wrap img {
            width: 160px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            display: block;
        }

        .img-preview-label {
            font-size: 11.5px; color: #7a9e9b; margin-bottom: 6px;
        }

        /* ─── FORM FOOTER ─── */
        .form-footer {
            padding: 20px 28px 28px;
            display: flex; gap: 12px; flex-wrap: wrap;
        }

        .btn-save {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 11px 24px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white; border: none; border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600; cursor: pointer;
            box-shadow: 0 4px 12px rgba(15,118,110,.25);
            transition: all .25s;
        }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(15,118,110,.35); }

        .btn-cancel {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 11px 20px;
            background: white; border: 1.5px solid rgba(15,118,110,.2);
            color: var(--teal-dark); border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600; text-decoration: none;
            transition: all .25s;
        }
        .btn-cancel:hover { background: var(--teal-light); border-color: var(--teal); }

        /* ─── OVERLAY ─── */
        .dash-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.35); z-index: 900;
            backdrop-filter: blur(2px);
        }
        .dash-overlay.open { display: block; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 640px) {
            .dash-content { padding: 16px; }
            .dash-topbar  { padding: 0 16px; }
            .topbar-date  { display: none; }
            .form-body    { padding: 20px 16px 4px; }
            .form-footer  { padding: 16px 16px 24px; }
            .btn-save, .btn-cancel { width: 100%; justify-content: center; }
        }
    </style>

    <div class="dash-wrapper">

        {{-- SIDEBAR --}}
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

        {{-- MAIN --}}
        <div class="dash-main">

            {{-- TOPBAR --}}
            <header class="dash-topbar">
                <div class="topbar-left">
                    <button class="dash-hamburger" id="toggleSidebar">☰</button>
                    <div>
                        <div class="topbar-page">Tambah Slider</div>
                        <div class="topbar-sub">Tambah banner baru ke halaman utama</div>
                    </div>
                </div>
                <div class="topbar-right">
                    <span class="topbar-date" id="topbarDate"></span>
                    <a href="{{ route('kader.slider.index') }}" class="btn-back-top">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </header>

            {{-- CONTENT --}}
            <div class="dash-content">

                <div class="dash-section-tag">Manajemen Konten</div>
                <h2 class="dash-section-title">Tambah Slider Baru</h2>

                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-header-icon">🖼️</div>
                        <div class="panel-header-title">Form Tambah Slider</div>
                    </div>

                    <form action="{{ route('kader.slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-body">

                            <div class="form-group">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-input"
                                    value="{{ old('judul') }}" required
                                    placeholder="Masukkan judul slider">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-input"
                                    value="{{ old('deskripsi') }}"
                                    placeholder="Masukkan deskripsi slider (opsional)">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload Gambar</label>
                                <div class="upload-area" id="uploadArea">
                                    <input type="file" name="gambar" accept="image/*"
                                        id="fileInput" required>
                                    <div class="upload-icon">🖼️</div>
                                    <div class="upload-text">Klik atau seret gambar ke sini</div>
                                    <div class="upload-hint">PNG, JPG, WEBP — maks. 2MB</div>
                                </div>
                                <div class="img-preview-wrap" id="previewWrap">
                                    <p class="img-preview-label">Preview gambar:</p>
                                    <img id="imgPreview" src="#" alt="Preview">
                                </div>
                            </div>

                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-floppy-disk"></i> Simpan Slider
                            </button>
                            <a href="{{ route('kader.slider.index') }}" class="btn-cancel">
                                <i class="fas fa-xmark"></i> Batal
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        (function () {
            // Sidebar toggle
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle  = document.getElementById('toggleSidebar');

            toggle.addEventListener('click', () => {
                const open = sidebar.classList.toggle('open');
                overlay.classList.toggle('open', open);
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            });

            // Tanggal topbar
            const dateEl = document.getElementById('topbarDate');
            if (dateEl) dateEl.textContent = new Date().toLocaleDateString('id-ID', {
                weekday: 'short', day: 'numeric', month: 'long', year: 'numeric'
            });

            // Preview gambar
            const fileInput  = document.getElementById('fileInput');
            const previewWrap = document.getElementById('previewWrap');
            const imgPreview  = document.getElementById('imgPreview');
            const uploadArea  = document.getElementById('uploadArea');

            fileInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        imgPreview.src = e.target.result;
                        previewWrap.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Drag & drop visual feedback
            uploadArea.addEventListener('dragover', e => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('dragover');
            });
            uploadArea.addEventListener('drop', () => {
                uploadArea.classList.remove('dragover');
            });
        })();
    </script>

@endsection