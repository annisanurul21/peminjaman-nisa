<x-user-layout>

<!-- Sambutan -->
<div style="background:linear-gradient(135deg,#81A6C6,#E8A0BF);border-radius:20px;padding:32px 36px;margin-bottom:24px;color:white;position:relative;overflow:hidden;">
    <div style="position:absolute;right:-20px;top:-20px;width:160px;height:160px;background:rgba(255,255,255,0.1);border-radius:50%;"></div>
    <div style="position:absolute;right:60px;bottom:-40px;width:100px;height:100px;background:rgba(255,255,255,0.08);border-radius:50%;"></div>
    <p style="font-size:13px;font-weight:600;opacity:.85;letter-spacing:.05em;text-transform:uppercase;margin-bottom:6px;">🏫 SMKN 1 Ciomas</p>
    <h1 style="font-size:26px;font-weight:800;margin-bottom:8px;">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
    <p style="font-size:15px;opacity:.9;font-weight:500;">SELAMAT DATANG SISWA SMKN 1 CIOMAS</p>
    <p style="font-size:13px;opacity:.8;margin-top:4px;">Silahkan meminjam nya, jangan lupa dikembalikan pada waktunya 🙏</p>
</div>

<!-- Statistik -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
    <div style="background:white;border-radius:14px;padding:20px;box-shadow:0 2px 10px rgba(129,166,198,0.15);border-top:4px solid #81A6C6;">
        <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;font-weight:600;">Total Peminjaman</p>
        <p style="font-size:34px;font-weight:800;color:#81A6C6;margin-top:4px;">{{ $totalPinjam }}</p>
    </div>
    <div style="background:white;border-radius:14px;padding:20px;box-shadow:0 2px 10px rgba(129,166,198,0.15);border-top:4px solid #f59e0b;">
        <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;font-weight:600;">Menunggu Persetujuan</p>
        <p style="font-size:34px;font-weight:800;color:#f59e0b;margin-top:4px;">{{ $menunggu }}</p>
    </div>
    <div style="background:white;border-radius:14px;padding:20px;box-shadow:0 2px 10px rgba(129,166,198,0.15);border-top:4px solid #10b981;">
        <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;font-weight:600;">Disetujui</p>
        <p style="font-size:34px;font-weight:800;color:#10b981;margin-top:4px;">{{ $disetujui }}</p>
    </div>
</div>

<!-- Menu -->
<p style="font-size:15px;font-weight:700;color:#444;margin-bottom:12px;">Menu</p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    <a href="{{ route('user.alat.index') }}"
       style="background:white;border-radius:14px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(129,166,198,0.15);border:2px solid transparent;transition:all .2s;"
       onmouseover="this.style.borderColor='#81A6C6';this.style.boxShadow='0 4px 16px rgba(129,166,198,0.25)'"
       onmouseout="this.style.borderColor='transparent';this.style.boxShadow='0 2px 8px rgba(129,166,198,0.15)'">
        <div style="width:52px;height:52px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;">🔧</div>
        <div>
            <p style="font-weight:700;color:#333;font-size:15px;">Daftar Alat</p>
            <p style="font-size:12px;color:#888;margin-top:2px;">Lihat & pinjam alat tersedia</p>
        </div>
    </a>
    <a href="{{ route('user.peminjaman.riwayat') }}"
       style="background:white;border-radius:14px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(129,166,198,0.15);border:2px solid transparent;"
       onmouseover="this.style.borderColor='#E8A0BF';this.style.boxShadow='0 4px 16px rgba(232,160,191,0.25)'"
       onmouseout="this.style.borderColor='transparent';this.style.boxShadow='0 2px 8px rgba(129,166,198,0.15)'">
        <div style="width:52px;height:52px;background:linear-gradient(135deg,#fce7f3,#fbcfe8);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;">📋</div>
        <div>
            <p style="font-weight:700;color:#333;font-size:15px;">Riwayat Peminjaman</p>
            <p style="font-size:12px;color:#888;margin-top:2px;">Cek status peminjaman kamu</p>
        </div>
    </a>
    <a href="{{ route('user.denda.index') }}"
   style="background:white;border-radius:14px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(129,166,198,0.15);border:2px solid transparent;"
   onmouseover="this.style.borderColor='#CC4444';this.style.boxShadow='0 4px 16px rgba(204,68,68,0.2)'"
   onmouseout="this.style.borderColor='transparent';this.style.boxShadow='0 2px 8px rgba(129,166,198,0.15)'">
    <div style="width:52px;height:52px;background:linear-gradient(135deg,#fee2e2,#fecaca);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;">💸</div>
    <div>
        <p style="font-weight:700;color:#333;font-size:15px;">Tagihan Denda</p>
        <p style="font-size:12px;color:#888;margin-top:2px;">Cek & bayar denda kamu</p>
    </div>
</a>
</div>

</x-user-layout>