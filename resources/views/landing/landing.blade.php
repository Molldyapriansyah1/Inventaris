<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f0f2f8; }

        /* ── Navbar ── */
        .navbar { background: #ffffff; padding: 14px 32px; }
        .nav-logo {
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(255,255,255,0.2);
            color: #000000;
            border: 2px solid rgba(255,255,255,0.35);
            display: flex; align-items: center; justify-content: center;
        }
        .nav-logo i { color: #fff; font-size: 16px; }
        .nav-title { font-size: 15px; font-weight: 700; color: #000000; }
        .btn-masuk {
            background: #808080; color: #ffffff;
            border: none; border-radius: 8px;
            padding: 8px 20px; font-size: 13px; font-weight: 600;
            text-decoration: none; transition: opacity 0.1s;
        }
        .btn-masuk:hover { opacity: 0.9; color: #000000; }

        /* ── Hero ── */
        .hero {
            background: #ffffff;
            padding: 70px 32px 80px;
            text-align: center;
        }
        .hero-tag {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            color: #000000; font-size: 11px; font-weight: 600;
            padding: 4px 14px; border-radius: 100px;
            letter-spacing: 0.06em; text-transform: uppercase;
            margin-bottom: 20px;
        }
        .hero h1 {
            font-size: 38px; font-weight: 800;
            color: #000000; line-height: 1.2; margin-bottom: 14px;
        }
        .hero h1 span { color: #484848; }
        .hero p {
            font-size: 15px; color: rgba(255,255,255,0.65);
            max-width: 480px; margin: 0 auto; line-height: 1.6;
        }

        /* ── Features ── */
        .features { padding: 48px 32px; }
        .feat-card {
            background: #fff; border-radius: 12px;
            padding: 22px; border: 1px solid #e8e8f0; height: 100%;
        }
        .feat-icon {
            width: 42px; height: 42px; border-radius: 10px;
            background: #eeedfe;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }
        .feat-icon i { font-size: 18px; color: #3C3489; }
        .feat-title { font-size: 14px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
        .feat-desc  { font-size: 12px; color: #888; line-height: 1.6; margin: 0; }

        /* ── Footer ── */
        .footer {
            padding: 20px 32px;
            border-top: 1px solid #e0e0ea;
            display: flex; align-items: center; justify-content: space-between;
        }
        .footer-logo {
            width: 50px; height: 50px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .footer-brand { font-size: 13px; font-weight: 700; color: #aaa; }
        .footer-copy  { font-size: 12px; color: #aaa; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <div class="nav-logo">
            <img src="img/wikrama.png" class="img-fluid" alt="">
        </div>
        <span class="nav-title">Inventaris SMK</span>
    </div>
    <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
</nav>

{{-- Hero --}}
<div class="hero">
    <div class="hero-tag">Sistem Inventaris Digital</div>
    <h1>Kelola inventaris<br><span>lebih mudah & rapi</span></h1>
    <p>Platform manajemen aset sekolah — semua dalam satu sistem.</p>
</div>

{{-- Features --}}
<div class="features">
    <div class="row g-3 justify-content-center" style="max-width: 900px; margin: 0 auto;">
        <div class="col-md-4">
            <div class="feat-card">
                <div class="feat-icon">
                    <i class="bi bi-grid-fill"></i>
                </div>
                <div class="feat-title">Dashboard terpusat</div>
                <p class="feat-desc">Pantau semua data inventaris dari satu halaman yang informatif.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feat-card">
                <div class="feat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="feat-title">Manajemen barang</div>
                <p class="feat-desc">Tambah, edit, dan kategorikan barang dengan mudah per divisi.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feat-card">
                <div class="feat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="feat-title">Kelola staff</div>
                <p class="feat-desc">Atur akses dan data pengguna sistem inventaris sekolah.</p>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<div class="footer">
    
    <div class="footer-brand">
        <div class="footer-logo">
            <img src="img/wikrama.png" class="img-fluid" alt="Wikrama">
        </div>
        <br>
        Inventaris SMK
    </div>
    <div class="footer-copy">2026 — Sistem Manajemen Inventaris</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>