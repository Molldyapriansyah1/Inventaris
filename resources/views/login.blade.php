<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventaris SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f8; min-height: 100vh; display: flex; flex-direction: column; font-family: sans-serif; }

        .topbar { background: #ffffff; padding: 14px 32px; display: flex; align-items: center; gap: 10px; }
        .top-logo {
            width: 32px; height: 32px; border-radius: 50%;
            background-color: #000000;
            color: #000000;
            border: 2px solid rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
        }
        .top-logo i { color: #fff; font-size: 14px; }
        .top-title { font-size: 14px; font-weight: 700; color: #000000; }

        .login-wrap { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 16px; }

        .login-card {
            background: #fff; border-radius: 14px;
            border: 1px solid #e8e8f0;
            padding: 36px 32px;
            width: 100%; max-width: 380px;
        }
        .card-logo {
            width: 52px; height: 52px; border-radius: 14px;
            background: #eeedfe;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .card-logo i { font-size: 22px; color: #ffffff; }

        .login-card h2 { font-size: 20px; font-weight: 800; color: #1a1a1a; text-align: center; margin-bottom: 4px; }
        .login-card p  { font-size: 13px; color: #aaa; text-align: center; margin-bottom: 28px; }

        .form-label { font-size: 12px; font-weight: 600; color: #555; margin-bottom: 5px; }
        .form-control {
            border: 1px solid #e0e0ea; border-radius: 8px;
            font-size: 13px; color: #1a1a1a;
            padding: 10px 12px;
        }
        .form-control:focus { border-color: #ffffff; box-shadow: none; }

        .btn-login {
            width: 100%; background: #ffffff; color: #000000;
            border: none; border-radius: 8px;
            padding: 11px; font-size: 14px; font-weight: 700;
            transition: background 0.1s;
        }
        .btn-login:hover { background: #4e4e4e; color: #fff; }

        .back-link { text-align: center; margin-top: 16px; font-size: 12px; color: #aaa; }
        .back-link a { color: #000000; font-weight: 600; text-decoration: none; }
        .back-link a:hover { text-decoration: underline; }

        .alert-error {
            background: #FCEBEB; color: #501313;
            border: 1px solid #F09595; border-radius: 8px;
            padding: 10px 14px; font-size: 13px; margin-bottom: 16px;
        }
    </style>
</head>
<body>

{{-- Topbar --}}
<div class="topbar">
    <div class="top-logo">
        <i class="bi bi-shield-fill"></i>
    </div>
    <span class="top-title">Inventaris SMK</span>
</div>

{{-- Login card --}}
<div class="login-wrap">
    <div class="login-card">

        <div class="card-logo">
            <i class="bi bi-person-fill"></i>
        </div>

        <h2>Selamat datang</h2>
        <p>Masuk ke sistem inventaris sekolah</p>

        @if(session('error'))
            <div class="alert-error">
                <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"

    >
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                    >
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="back-link">
            <a href="{{ route('landing') }}">← Kembali ke beranda</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>