<style>
    :root {
        --teal-dark: #0a3d38;
        --teal: #0f766e;
        --teal-mid: #14b8a6;
        --teal-light: #ccfbf1;
        --accent: #f59e0b;
    }

    .site-footer {
        background: var(--teal-dark);
        color: white;
        font-family: 'DM Sans', sans-serif;
        position: relative;
        overflow: hidden;
    }

    .site-footer::before {
        content: '';
        position: absolute;
        top: -120px;
        left: -120px;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(20, 184, 166, .12), transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .site-footer::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: -80px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(245, 158, 11, .08), transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .footer-top {
        border-bottom: 1px solid rgba(255, 255, 255, .07);
        padding: 48px 0 32px;
    }

    .footer-top-inner {
        max-width: 1240px;
        margin: auto;
        padding: 0 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .footer-logo-circle {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--teal), var(--teal-mid));
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(20, 184, 166, .3);
    }

    .footer-brand-name {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.2;
    }

    .footer-brand-sub {
        font-size: 11px;
        color: var(--teal-mid);
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .footer-tagline {
        font-size: 13.5px;
        color: rgba(255, 255, 255, .5);
        max-width: 340px;
        line-height: 1.6;
        text-align: right;
    }

    .footer-main {
        max-width: 1240px;
        margin: auto;
        padding: 56px 40px;
        display: grid;
        grid-template-columns: 2fr 1fr 1.3fr 1.8fr;
        gap: 48px;
        position: relative;
        z-index: 1;
    }

    .footer-col h4 {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--teal-mid);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-col h4::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255, 255, 255, .08);
    }

    .footer-about p {
        font-size: 14px;
        color: rgba(255, 255, 255, .55);
        line-height: 1.8;
        margin-bottom: 24px;
    }

    .footer-socials {
        display: flex;
        gap: 10px;
    }

    .social-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        text-decoration: none;
        color: white;
        transition: all .3s;
    }

    .social-btn:hover {
        background: var(--teal);
        border-color: var(--teal);
        transform: translateY(-3px);
        color: white;
    }

    .footer-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .footer-nav-list li a {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: rgba(255, 255, 255, .55);
        text-decoration: none;
        padding: 6px 0;
        transition: all .25s;
    }

    .footer-nav-list li a::before {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--teal-mid);
        opacity: 0;
        transition: opacity .25s;
        flex-shrink: 0;
    }

    .footer-nav-list li a:hover {
        color: white;
        padding-left: 6px;
    }

    .footer-nav-list li a:hover::before {
        opacity: 1;
    }

    .footer-contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .footer-contact-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 14px;
        color: rgba(255, 255, 255, .55);
        line-height: 1.5;
    }

    .contact-icon {
        width: 32px;
        height: 32px;
        background: rgba(20, 184, 166, .12);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .map-wrap {
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .3);
        border: 1px solid rgba(255, 255, 255, .08);
    }

    .map-wrap iframe {
        width: 100%;
        height: 180px;
        display: block;
        border: none;
        filter: grayscale(30%) contrast(1.05);
    }

    .map-open-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 12px;
        background: rgba(20, 184, 166, .12);
        border: 1px solid rgba(20, 184, 166, .25);
        color: var(--teal-mid);
        font-size: 13px;
        font-weight: 500;
        padding: 9px 16px;
        border-radius: 10px;
        text-decoration: none;
        transition: all .3s;
        width: 100%;
        text-align: center;
    }

    .map-open-btn:hover {
        background: var(--teal);
        border-color: var(--teal);
        color: white;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .07);
        padding: 20px 40px;
        max-width: 1240px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .footer-bottom-copy {
        font-size: 12.5px;
        color: rgba(255, 255, 255, .35);
    }

    .footer-bottom-copy strong {
        color: rgba(255, 255, 255, .6);
        font-weight: 500;
    }

    .footer-bottom-badge {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        color: rgba(255, 255, 255, .3);
    }

    .footer-bottom-badge span {
        color: var(--accent);
    }

    @media (max-width: 1024px) {
        .footer-main {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 640px) {
        .footer-main {
            grid-template-columns: 1fr;
            padding: 40px 24px;
        }

        .footer-top-inner {
            padding: 0 24px;
        }

        .footer-tagline {
            text-align: left;
        }

        .footer-bottom {
            padding: 20px 24px;
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-top-inner">
            <div class="footer-brand">
                <div class="footer-logo-circle">🌿</div>
                <div>
                    <div class="footer-brand-name">Posyandu</div>
                    <div class="footer-brand-sub">Puskesmas Paguyangan</div>
                </div>
            </div>
            <p class="footer-tagline">
                Bersama menjaga kesehatan ibu & anak demi generasi yang lebih kuat dan sehat.
            </p>
        </div>
    </div>

    <div class="footer-main">
        <div class="footer-col footer-about">
            <h4>Tentang</h4>
            <p>
                Posyandu (Pos Pelayanan Terpadu) merupakan layanan kesehatan masyarakat yang berfokus
                pada pemantauan pertumbuhan balita, pencegahan stunting, serta peningkatan gizi anak dan ibu.
            </p>
        </div>

        <div class="footer-col">
            <h4>Navigasi</h4>
            <ul class="footer-nav-list">
                <li><a href="/">Home</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#pencegahan">Pencegahan</a></li>
                <li><a href="#galeri">Galeri</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <ul class="footer-contact-list">
                <li>
                    <div class="contact-icon">📞</div>
                    <div>0289432010</div>
                </li>
                <li>
                    <div class="contact-icon">🕐</div>
                    <div>Senin – Jumat<br>08.00 – 16.00 WIB</div>
                </li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Lokasi</h4>
            <div class="map-wrap">
                <iframe src="https://www.google.com/maps?q=-7.3006596,109.0381553&z=15&output=embed" allowfullscreen=""
                    loading="lazy" title="Lokasi Posyandu Paguyangan">
                </iframe>
            </div>
            <a href="https://www.google.com/maps/place/Puskesmas+Paguyangan/@-7.3006596,109.0355804,864m/data=!3m2!1e3!4b1!4m6!3m5!1s0x2e6f88dde831e67d:0x329a62fe3dda579d!8m2!3d-7.3006596!4d109.0381553!16s%2Fg%2F11clvc11g8"
                target="_blank" class="map-open-btn">
                🗺 Buka di Google Maps
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="footer-bottom-copy">
            © {{ date('Y') }} <strong>Sistem Monitoring Posyandu Puskesmas Paguyangan</strong>. All Rights Reserved.
        </p>
    </div>
</footer>