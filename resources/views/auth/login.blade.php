<<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Peminjaman Alat SMKN 1 Ciomas</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f0f4ff;
        }

        /* Sisi Kiri */
        .left-panel {
            width: 55%;
            background: linear-gradient(135deg, #3852B4 0%, #2a3d8f 50%, #1e2d6e 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -100px; left: -100px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -80px; right: -80px;
        }
        .left-content { position: relative; z-index: 2; text-align: center; }
        .school-logo {
            width: 130px; height: 130px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            padding: 8px;
            background: rgba(255,255,255,0.1);
            margin-bottom: 24px;
            object-fit: contain;
        }
        .school-name { color: white; font-size: 22px; font-weight: 700; margin-bottom: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .school-sub { color: rgba(255,255,255,0.75); font-size: 14px; margin-bottom: 32px; }
        .system-badge {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 50px;
            padding: 10px 24px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }
        .dots { display: flex; gap: 8px; justify-content: center; margin-top: 28px; }
        .dot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.3); }
        .dot.active { background: white; }

        /* Sisi Kanan */
        .right-panel {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
        }
        .login-box { width: 100%; max-width: 380px; }
        .login-header { margin-bottom: 32px; }
        .login-header h2 { font-size: 26px; font-weight: 800; color: #1e2d6e; margin-bottom: 6px; }
        .login-header p { font-size: 14px; color: #888; }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; color: #444; margin-bottom: 6px; }
        .form-group input {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            font-family: 'Figtree', sans-serif;
            outline: none;
            transition: border-color .2s;
            color: #333;
        }
        .form-group input:focus { border-color: #3852B4; box-shadow: 0 0 0 3px rgba(56,82,180,0.1); }

        .remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .remember-row label { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #555; cursor: pointer; }
        .remember-row a { font-size: 13px; color: #3852B4; text-decoration: none; font-weight: 600; }
        .remember-row a:hover { text-decoration: underline; }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #3852B4, #2a3d8f);
            color: white;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            letter-spacing: .3px;
            box-shadow: 0 4px 15px rgba(56,82,180,0.35);
            transition: transform .1s, box-shadow .1s;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(56,82,180,0.4); }
        .btn-login:active { transform: translateY(0); }

        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .footer-note { text-align: center; margin-top: 28px; font-size: 12px; color: #bbb; }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 30px; min-height: auto; }
            .right-panel { width: 100%; }
            .school-logo { width: 90px; height: 90px; }
        }
    </style>
</head>
<body>

    <!-- Sisi Kiri -->
    <div class="left-panel">
        <div class="left-content">
            <img src="{{ asset('LOGO_SKANIC.png') }}" alt="Logo SMKN 1 Ciomas" class="school-logo">
            <h2 class="school-name">SMK Negeri 1 Ciomas</h2>
            <p class="school-sub">Kabupaten Bogor, Jawa Barat</p>
            <div class="system-badge">🔧 Sistem Peminjaman Alat</div>
            <div class="dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>

    <!-- Sisi Kanan -->
    <div class="right-panel">
        <div class="login-box">
            <div class="login-header">
                <h2>Selamat Datang 👋</h2>
                <p>Silakan masuk ke akun Anda untuk melanjutkan</p>
        <div class="login-link" style="text-align:center;margin-top:16px;font-size:13px;color:#888;">
    Belum punya akun? <a href="{{ route('register') }}" style="color:#3852B4;font-weight:700;text-decoration:none;">Daftar di sini</a>
        </div>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>📧 Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="Masukkan email Anda" required autofocus>
                </div>

                <div class="form-group">
                    <label>🔒 Password</label>
                    <input type="password" name="password"
                           placeholder="Masukkan password Anda" required>
                </div>

                <div class="remember-row">
                    <label>
                        <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:#3852B4;">
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    Masuk →
                </button>
            </form>

            <div class="footer-note">
                © {{ date('Y') }} SMK Negeri 1 Ciomas — Sistem Peminjaman Alat
            </div>
        </div>
    </div>

</body>
</html>