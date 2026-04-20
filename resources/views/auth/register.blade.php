<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Peminjaman Alat SMKN 1 Ciomas</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Figtree',sans-serif;min-height:100vh;display:flex;background:#f0f4ff}
        .left-panel{width:45%;background:linear-gradient(135deg,#3852B4 0%,#2a3d8f 50%,#1e2d6e 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px;position:relative;overflow:hidden}
        .left-panel::before{content:'';position:absolute;width:400px;height:400px;background:rgba(255,255,255,0.05);border-radius:50%;top:-100px;left:-100px}
        .left-panel::after{content:'';position:absolute;width:300px;height:300px;background:rgba(255,255,255,0.05);border-radius:50%;bottom:-80px;right:-80px}
        .left-content{position:relative;z-index:2;text-align:center}
        .school-logo{width:120px;height:120px;border-radius:50%;border:4px solid rgba(255,255,255,0.3);padding:8px;background:rgba(255,255,255,0.1);margin-bottom:20px;object-fit:contain}
        .school-name{color:white;font-size:20px;font-weight:700;margin-bottom:6px}
        .school-sub{color:rgba(255,255,255,0.75);font-size:13px;margin-bottom:24px}
        .system-badge{background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);border-radius:50px;padding:10px 24px;color:white;font-size:13px;font-weight:600}
        .right-panel{width:55%;display:flex;align-items:center;justify-content:center;padding:32px;background:white;overflow-y:auto}
        .reg-box{width:100%;max-width:480px}
        .reg-header{margin-bottom:24px}
        .reg-header h2{font-size:24px;font-weight:800;color:#1e2d6e;margin-bottom:4px}
        .reg-header p{font-size:13px;color:#888}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .form-group{margin-bottom:14px}
        .form-group label{display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:5px}
        .form-group input{width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:11px 14px;font-size:14px;font-family:'Figtree',sans-serif;outline:none;transition:border .2s;color:#333}
        .form-group input:focus{border-color:#3852B4;box-shadow:0 0 0 3px rgba(56,82,180,0.1)}
        .btn-register{width:100%;background:linear-gradient(135deg,#3852B4,#2a3d8f);color:white;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;box-shadow:0 4px 15px rgba(56,82,180,0.35);margin-top:4px}
        .btn-register:hover{opacity:.92}
        .login-link{text-align:center;margin-top:16px;font-size:13px;color:#888}
        .login-link a{color:#3852B4;font-weight:700;text-decoration:none}
        .error-box{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:14px}
        .info-box{background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px}
        .footer-note{text-align:center;margin-top:20px;font-size:11px;color:#bbb}
    </style>
</head>
<body>

    <!-- Kiri -->
    <div class="left-panel">
        <div class="left-content">
            <img src="{{ asset('LOGO_SKANIC.png') }}" alt="Logo SMKN 1 Ciomas" class="school-logo">
            <h2 class="school-name">SMK Negeri 1 Ciomas</h2>
            <p class="school-sub">Kabupaten Bogor, Jawa Barat</p>
            <div class="system-badge">🔧 Sistem Peminjaman Alat</div>
        </div>
    </div>

    <!-- Kanan -->
    <div class="right-panel">
        <div class="reg-box">
            <div class="reg-header">
                <h2>Daftar Akun</h2>
                <p>Buat akun peminjam baru untuk menggunakan sistem ini</p>
            </div>

            <div class="info-box">
                ℹ️ Akun yang didaftarkan otomatis sebagai <strong>Peminjam/User</strong>. Akun petugas hanya bisa dibuat oleh Admin.
            </div>

            @if($errors->any())
            <div class="error-box">
                <ul style="padding-left:16px;margin:0;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>👤 Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap sesuai data sekolah" required>
                </div>

                <div class="form-group">
                    <label>NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" placeholder="Nomor Induk Siswa Nasional" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XII" required>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: PPLG" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang →</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>

            <div class="footer-note">© {{ date('Y') }} SMK Negeri 1 Ciomas — Sistem Peminjaman Alat</div>
        </div>
    </div>

</body>
</html>