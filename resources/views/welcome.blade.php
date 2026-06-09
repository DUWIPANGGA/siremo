<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIREMO – Sistem Informasi Rental Mobil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FDF9F5;
            color: #2A1F18;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 48px;
            background: #fff;
            border-bottom: 1px solid #F0E8E0;
        }
        .nav-logo {
            font-size: 22px;
            font-weight: 800;
            color: #E8622A;
            letter-spacing: -.5px;
        }
        .nav-logo i { margin-right: 8px; }
        .nav-links { display: flex; gap: 12px; align-items: center; }
        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
            transition: background .15s;
        }
        .nav-links .btn-login {
            color: #E8622A;
            border: 1.5px solid #E8622A;
        }
        .nav-links .btn-login:hover { background: #FEF0EA; }
        .nav-links .btn-register {
            background: #E8622A;
            color: #fff;
        }
        .nav-links .btn-register:hover { background: #c9521e; }
        .nav-links .btn-dashboard {
            background: #E8622A;
            color: #fff;
        }
        .nav-links .btn-dashboard:hover { background: #c9521e; }
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            text-align: center;
        }
        .hero-content { max-width: 720px; }
        .hero-badge {
            display: inline-block;
            background: #FEF0EA;
            color: #E8622A;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 18px;
            border-radius: 20px;
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 16px;
            color: #1A130E;
        }
        .hero h1 span { color: #E8622A; }
        .hero p {
            font-size: 16px;
            color: #6A5A4E;
            line-height: 1.6;
            margin-bottom: 36px;
        }
        .hero-actions { display: flex; gap: 14px; justify-content: center; }
        .hero-actions a {
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 10px;
            transition: background .15s, transform .1s;
        }
        .hero-actions a:active { transform: scale(.97); }
        .hero-actions .btn-primary {
            background: #E8622A;
            color: #fff;
        }
        .hero-actions .btn-primary:hover { background: #c9521e; }
        .hero-actions .btn-secondary {
            background: #F5EDE8;
            color: #3A2A1A;
        }
        .hero-actions .btn-secondary:hover { background: #E8DDD8; }
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            padding: 0 48px 60px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            border: 1px solid #F0E8E0;
            transition: box-shadow .15s;
        }
        .feature-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,.06); }
        .feature-icon {
            width: 52px;
            height: 52px;
            background: #FEF0EA;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 24px;
            color: #E8622A;
        }
        .feature-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .feature-card p {
            font-size: 13px;
            color: #6A5A4E;
            line-height: 1.5;
        }
        footer {
            text-align: center;
            padding: 24px 48px;
            font-size: 13px;
            color: #8A7A6E;
            border-top: 1px solid #F0E8E0;
        }
        @media (max-width: 768px) {
            nav { padding: 14px 20px; flex-direction: column; gap: 12px; }
            .hero { padding: 40px 20px; }
            .hero h1 { font-size: 32px; }
            .features { grid-template-columns: 1fr; padding: 0 20px 40px; }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-logo"><i class="bi bi-car-front-fill"></i>SIREMO</div>
    <div class="nav-links">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-login">Masuk</a>
            <a href="{{ route('register') }}" class="btn-register">Daftar</a>
        @endauth
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <div class="hero-badge"><i class="bi bi-shield-check me-1"></i> Rental Mobil Terpercaya</div>
        <h1>Sewa Mobil <span>Cepat & Mudah</span><br>Bersama SIREMO</h1>
        <p>
            Sistem Informasi Rental Mobil yang memudahkan Anda menyewa kendaraan
            kapan saja, di mana saja. Proses cepat, harga transparan, dan armada
            terawat.
        </p>
        <div class="hero-actions">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">
                    <i class="bi bi-person-plus me-1"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn-secondary">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </a>
            @endauth
        </div>
    </div>
</section>

<div class="features">
    <div class="feature-card">
        <div class="feature-icon"><i class="bi bi-car-front"></i></div>
        <h3>Armada Terawat</h3>
        <p>Seluruh kendaraan dalam kondisi prima dan siap pakai dengan perawatan rutin berkala.</p>
    </div>
    <div class="feature-card">
        <div class="feature-icon"><i class="bi bi-cash-stack"></i></div>
        <h3>Harga Transparan</h3>
        <p>Tarif sewa jelas tanpa biaya tersembunyi. Bayar sesuai durasi dan jenis kendaraan.</p>
    </div>
    <div class="feature-card">
        <div class="feature-icon"><i class="bi bi-headset"></i></div>
        <h3>Dukungan 24/7</h3>
        <p>Tim customer service siap membantu Anda kapan pun selama proses penyewaan.</p>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} SIREMO &mdash; Sistem Informasi Rental Mobil
</footer>

</body>
</html>
