<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Panel</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{background:linear-gradient(135deg,#CC4444 0%,#ffffff 100%);font-family:'Figtree',sans-serif;min-height:100vh}
    .sidebar{background:linear-gradient(180deg,#CC4444 0%,#aa3333 100%);min-height:100vh;width:250px;position:fixed;left:0;top:0;z-index:50;display:flex;flex-direction:column}
    .sidebar-logo{padding:24px 20px;border-bottom:1px solid rgba(255,255,255,0.25)}
    .sidebar-logo h1{color:white;font-size:18px;font-weight:700;text-shadow:0 1px 3px rgba(0,0,0,0.15)}
    .sidebar-logo p{color:rgba(255,255,255,0.8);font-size:13px;margin-top:4px}
    .sidebar-menu{padding:12px 0;flex:1}
    .sidebar-label{color:rgba(255,255,255,0.6);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:14px 20px 5px}
    .sidebar-item{display:flex;align-items:center;gap:12px;padding:12px 20px;color:rgba(255,255,255,0.9);font-size:15px;text-decoration:none;border-left:3px solid transparent;transition:all .15s;background:none;border-top:none;border-right:none;border-bottom:none;width:100%;text-align:left;cursor:pointer;font-family:'Figtree',sans-serif}
    .sidebar-item:hover{background:rgba(255,255,255,0.2);color:white}
    .sidebar-item.active{background:rgba(255,255,255,0.25);color:white;border-left-color:white;font-weight:700}
    .main-content{margin-left:250px;min-height:100vh}
    .topbar{background:white;border-bottom:2px solid rgba(204,68,68,0.2);padding:0 28px;height:62px;display:flex;align-items:center;position:sticky;top:0;z-index:40;box-shadow:0 2px 8px rgba(204,68,68,0.1)}
    .topbar-title{font-size:18px;font-weight:700;color:#333}
    .topbar-right{margin-left:auto;display:flex;align-items:center;gap:10px}
    .badge-name{background:#F075AE;color:white;padding:7px 16px;border-radius:20px;font-size:13px;font-weight:600}
    .badge-role{background:#CC4444;color:white;padding:7px 14px;border-radius:20px;font-size:12px;font-weight:700}
    .page-content{padding:28px}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <h1>🔧 Peminjaman Alat</h1>
            <p>Panel Petugas</p>
        </div>
        <nav class="sidebar-menu">
            <div class="sidebar-label">Menu Utama</div>
            <a href="{{ route('petugas.dashboard') }}" class="sidebar-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <span>📊</span> Dashboard
            </a>
            <div class="sidebar-label">Manajemen</div>
            <a href="{{ route('petugas.peminjaman.index') }}" class="sidebar-item {{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}">
                <span>📋</span> Kelola Peminjaman
            </a>
            <a href="{{ route('petugas.pengembalian.index') }}" class="sidebar-item {{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}">
                <span>🔄</span> Pengembalian
            </a>
            <a href="{{ route('petugas.laporan.index') }}" class="sidebar-item {{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}">
                <span>📄</span> Laporan
            </a>
            <a href="{{ route('petugas.denda.index') }}" class="sidebar-item {{ request()->routeIs('petugas.denda.*') ? 'active' : '' }}">
                <span>💸</span> Kelola Denda
            </a>
            <div class="sidebar-label">Akun</div>
            <a href="{{ route('profile.edit') }}" class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span>⚙️</span> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item">
                    <span>🚪</span> Logout
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">@isset($header){{ $header }}@endisset</div>
            <div class="topbar-right">
                <span class="badge-name">👤 {{ Auth::user()->name }}</span>
                <span class="badge-role">Petugas</span>
            </div>
        </div>
        <div class="page-content">
            {{ $slot }}
        </div>
    </div>
</body>
</html>