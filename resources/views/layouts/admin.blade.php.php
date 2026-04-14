<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #F7DB91; font-family: 'Figtree', sans-serif; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #F075AE 0%, #d4609a 100%);
            min-height: 100vh;
            width: 240px;
            position: fixed;
            left: 0; top: 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
        }
        .sidebar-logo {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.25);
        }
        .sidebar-logo h1 { color: white; font-size: 17px; font-weight: 700; }
        .sidebar-logo p { color: rgba(255,255,255,0.75); font-size: 11px; margin-top: 3px; }

        .sidebar-menu { padding: 12px 0; flex: 1; }
        .sidebar-section-label {
            color: rgba(255,255,255,0.55);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 12px 20px 4px;
        }
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.85);
            font-size: 13.5px;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all .15s;
            cursor: pointer;
            background: none;
            border-top: none;
            border-right: none;
            border-bottom: none;
            width: 100%;
            text-align: left;
        }
        .sidebar-item:hover { background: rgba(255,255,255,0.18); color: white; }
        .sidebar-item.active {
            background: rgba(255,255,255,0.22);
            color: white;
            border-left-color: #F7DB91;
            font-weight: 600;
        }

        /* Main */
        .main-content { margin-left: 240px; min-height: 100vh; }
        .topbar {
            background: white;
            border-bottom: 1px solid rgba(240,117,174,0.15);
            padding: 0 24px;
            height: 56px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 4px rgba(240,117,174,0.1);
        }
        .topbar-title { font-size: 15px; font-weight: 600; color: #444; }
        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
        .badge-name { background: #F075AE; color: white; padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .badge-role { background: #9BC264; color: white; padding: 5px 12px; border-radius: 20px; font-size: 11px; }
        .page-content { padding: 24px; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <h1>🔧 Peminjaman Alat</h1>
            <p>Panel Administrator</p>
        </div>

        <nav class="sidebar-menu">
            <div class="sidebar-section-label">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span> Dashboard
            </a>

            <div class="sidebar-section-label">Manajemen Data</div>

            <a href="{{ route('admin.users.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span>👥</span> Kelola Akun
            </a>

            <a href="{{ route('admin.kategoris.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}">
                <span>🗂️</span> Kategori Alat
            </a>

            <a href="{{ route('admin.alats.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.alats.*') ? 'active' : '' }}">
                <span>🔧</span> Kelola Alat
            </a>

            <div class="sidebar-section-label">Akun Saya</div>

            <a href="{{ route('profile.edit') }}"
               class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-title">
                @isset($header){{ $header }}@endisset
            </div>
            <div class="topbar-right">
                <span class="badge-name">👤 {{ Auth::user()->name }}</span>
                <span class="badge-role">Admin</span>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            {{ $slot }}
        </div>
    </div>

</body>
</html>