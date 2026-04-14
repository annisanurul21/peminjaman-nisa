<x-admin-layout>
    <x-slot name="header">Dashboard Admin</x-slot>

    <!-- Statistik -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
        <div style="background:white;border-radius:12px;padding:20px;border-left:4px solid #F075AE;box-shadow:0 2px 8px rgba(240,117,174,0.15);">
            <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;">Total Petugas & User</p>
            <p style="font-size:32px;font-weight:700;color:#333;margin-top:4px;">{{ \App\Models\User::whereIn('role',['petugas','user'])->count() }}</p>
        </div>
        <div style="background:white;border-radius:12px;padding:20px;border-left:4px solid #9BC264;box-shadow:0 2px 8px rgba(155,194,100,0.15);">
            <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;">Total Petugas</p>
            <p style="font-size:32px;font-weight:700;color:#333;margin-top:4px;">{{ \App\Models\User::where('role','petugas')->count() }}</p>
        </div>
        <div style="background:white;border-radius:12px;padding:20px;border-left:4px solid #F7DB91;box-shadow:0 2px 8px rgba(247,219,145,0.3);">
            <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;">Total User/Peminjam</p>
            <p style="font-size:32px;font-weight:700;color:#333;margin-top:4px;">{{ \App\Models\User::where('role','user')->count() }}</p>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <p style="font-size:14px;font-weight:600;color:#555;margin-bottom:12px;">Navigasi Cepat</p>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
        <a href="{{ route('admin.users.index') }}"
           style="background:white;border-radius:12px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(240,117,174,0.25)'"
           onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
            <div style="width:48px;height:48px;background:#FDE8F3;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">👥</div>
            <div>
                <p style="font-weight:600;color:#333;font-size:14px;">Kelola Akun</p>
                <p style="font-size:12px;color:#888;">Petugas & user</p>
            </div>
        </a>
        <a href="{{ route('admin.kategoris.index') }}"
           style="background:white;border-radius:12px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(155,194,100,0.25)'"
           onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
            <div style="width:48px;height:48px;background:#EBF5DC;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🗂️</div>
            <div>
                <p style="font-weight:600;color:#333;font-size:14px;">Kategori Alat</p>
                <p style="font-size:12px;color:#888;">Kelola kategori</p>
            </div>
        </a>
        <a href="{{ route('admin.alats.index') }}"
           style="background:white;border-radius:12px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(247,219,145,0.4)'"
           onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
            <div style="width:48px;height:48px;background:#FEF7DC;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🔧</div>
            <div>
                <p style="font-weight:600;color:#333;font-size:14px;">Kelola Alat</p>
                <p style="font-size:12px;color:#888;">Data alat pinjam</p>
            </div>
        </a>
    </div>
</x-admin-layout>