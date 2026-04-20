<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Peminjaman Alat - SMKN 1 Ciomas</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body{background:linear-gradient(180deg,#81A6C6 0%,#ffffff 50%,#E8A0BF 100%);...}
    .topnav { background:white; box-shadow:0 2px 12px rgba(129,166,198,0.2); padding:0 32px; height:64px; display:flex; align-items:center; position:sticky; top:0; z-index:50; }
    .topnav-brand { display:flex; align-items:center; gap:10px; text-decoration:none; }
    .topnav-brand-icon { width:38px; height:38px; background:linear-gradient(135deg,#81A6C6,#E8A0BF); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; }
    .topnav-brand-text { font-size:16px; font-weight:700; color:#333; }
    .topnav-links { display:flex; align-items:center; gap:4px; margin-left:32px; }
    .topnav-link { padding:8px 16px; border-radius:8px; font-size:14px; font-weight:500; color:#666; text-decoration:none; transition:all .15s; }
    .topnav-link:hover { background:#f3f4f6; color:#333; }
    .topnav-link.active { background:linear-gradient(135deg,#81A6C6,#E8A0BF); color:white; font-weight:600; }
    .topnav-right { margin-left:auto; display:flex; align-items:center; gap:12px; }
    .user-avatar { width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #81A6C6; }
    .user-avatar-placeholder { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#81A6C6,#E8A0BF); display:flex; align-items:center; justify-content:center; font-size:16px; border:2px solid white; }
    .user-name { font-size:14px; font-weight:600; color:#333; }
    .dropdown { position:relative; }
    .dropdown-menu { display:none; position:absolute; right:0; top:calc(100% + 8px); background:white; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.12); min-width:180px; overflow:hidden; z-index:100; }
    .dropdown:hover .dropdown-menu { display:block; }
    .dropdown-item { display:block; padding:11px 16px; font-size:14px; color:#555; text-decoration:none; transition:background .1s; }
    .dropdown-item:hover { background:#f9fafb; }
    .dropdown-divider { height:1px; background:#f3f4f6; }
    .page-content { padding:28px 32px; max-width:1200px; margin:0 auto; }
    </style>
</head>
<body>
    <nav class="topnav">
        <a href="{{ route('user.dashboard') }}" class="topnav-brand">
            <div class="topnav-brand-icon">🔧</div>
            <span class="topnav-brand-text">Peminjaman Alat</span>
        </a>
        <div class="topnav-links">
    <a href="{{ route('user.dashboard') }}" class="topnav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
    <a href="{{ route('user.alat.index') }}" class="topnav-link {{ request()->routeIs('user.alat.*') ? 'active' : '' }}">🔧 Daftar Alat</a>
    <a href="{{ route('user.peminjaman.riwayat') }}" class="topnav-link {{ request()->routeIs('user.peminjaman.*') ? 'active' : '' }}">📋 Riwayat</a>
    <a href="{{ route('user.denda.index') }}" class="topnav-link {{ request()->routeIs('user.denda.*') ? 'active' : '' }}">
        💸 Denda
        @php $dendaBelumBayar = \App\Models\Denda::where('user_id', auth()->id())->whereNotIn('status',['lunas'])->count(); @endphp
        @if($dendaBelumBayar > 0)
            <span style="background:#CC4444;color:white;font-size:10px;font-weight:700;padding:1px 6px;border-radius:20px;margin-left:4px;">{{ $dendaBelumBayar }}</span>
        @endif
    </a>
</div>
        <div class="topnav-right">
            <div class="dropdown">
                <div style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:6px 10px;border-radius:10px;transition:background .15s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'">
                    @if(Auth::user()->foto_profil)
                        <img src="{{ Storage::url(Auth::user()->foto_profil) }}" class="user-avatar">
                    @else
                        <div class="user-avatar-placeholder">👤</div>
                    @endif
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span style="color:#aaa;font-size:12px;">▼</span>
                </div>
                <div class="dropdown-menu">
                    <a href="{{ route('user.profile.edit') }}" class="dropdown-item">⚙️ Profil Saya</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:'Figtree',sans-serif;">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="page-content">
        {{ $slot }}
    </div>
</body>
</html>