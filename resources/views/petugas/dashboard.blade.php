<x-petugas-layout>
<x-slot name="header">Dashboard Petugas</x-slot>

<!-- Statistik -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
    <div style="background:white;border-radius:14px;padding:20px;border-left:4px solid #f59e0b;box-shadow:0 2px 10px rgba(0,0,0,0.06);">
        <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;">Menunggu Persetujuan</p>
        <p style="font-size:34px;font-weight:800;color:#f59e0b;margin-top:4px;">{{ \App\Models\Peminjaman::where('status','menunggu')->count() }}</p>
    </div>
    <div style="background:white;border-radius:14px;padding:20px;border-left:4px solid #10b981;box-shadow:0 2px 10px rgba(0,0,0,0.06);">
        <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;">Sedang Dipinjam</p>
        <p style="font-size:34px;font-weight:800;color:#10b981;margin-top:4px;">{{ \App\Models\Peminjaman::where('status','disetujui')->count() }}</p>
    </div>
    <div style="background:white;border-radius:14px;padding:20px;border-left:4px solid #CC4444;box-shadow:0 2px 10px rgba(0,0,0,0.06);">
        <p style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:.05em;">Total Peminjaman</p>
        <p style="font-size:34px;font-weight:800;color:#CC4444;margin-top:4px;">{{ \App\Models\Peminjaman::count() }}</p>
    </div>
</div>

<!-- Menu Cepat -->
<p style="font-size:15px;font-weight:700;color:#333;margin-bottom:12px;">Menu Petugas</p>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px;">
    <a href="{{ route('petugas.peminjaman.index') }}"
       style="background:white;border-radius:14px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.06);"
       onmouseover="this.style.boxShadow='0 4px 16px rgba(204,68,68,0.2)'"
       onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
        <div style="width:48px;height:48px;background:#ffecec;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">📋</div>
        <div>
            <p style="font-weight:700;color:#333;font-size:14px;">Kelola Peminjaman</p>
            <p style="font-size:12px;color:#888;">Setujui atau tolak</p>
        </div>
    </a>
    <a href="{{ route('petugas.pengembalian.index') }}"
       style="background:white;border-radius:14px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.06);"
       onmouseover="this.style.boxShadow='0 4px 16px rgba(204,68,68,0.2)'"
       onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
        <div style="width:48px;height:48px;background:#ffecec;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">🔄</div>
        <div>
            <p style="font-weight:700;color:#333;font-size:14px;">Monitor Pengembalian</p>
            <p style="font-size:12px;color:#888;">Pantau alat dipinjam</p>
        </div>
    </a>
    <a href="{{ route('petugas.laporan.index') }}"
       style="background:white;border-radius:14px;padding:20px;display:flex;align-items:center;gap:14px;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.06);"
       onmouseover="this.style.boxShadow='0 4px 16px rgba(204,68,68,0.2)'"
       onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
        <div style="width:48px;height:48px;background:#ffecec;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">📄</div>
        <div>
            <p style="font-weight:700;color:#333;font-size:14px;">Cetak Laporan</p>
            <p style="font-size:12px;color:#888;">Rekap peminjaman</p>
        </div>
    </a>
</div>

<!-- Pengajuan Terbaru -->
<p style="font-size:15px;font-weight:700;color:#333;margin-bottom:12px;">Pengajuan Terbaru</p>
<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#CC4444,#aa3333);">
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Peminjam</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Alat</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Status</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse(\App\Models\Peminjaman::with(['user','alat'])->latest()->take(5)->get() as $p)
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:13px 16px;font-size:14px;font-weight:600;color:#333;">{{ $p->user->name }}</td>
                <td style="padding:13px 16px;font-size:14px;color:#555;">{{ $p->alat->nama_alat }}</td>
                <td style="padding:13px 16px;">
                    @php $badge = match($p->status) {
                        'menunggu' => 'background:#fef3c7;color:#92400e',
                        'disetujui' => 'background:#d1fae5;color:#065f46',
                        'ditolak' => 'background:#fee2e2;color:#991b1b',
                        'dikembalikan' => 'background:#dbeafe;color:#1e40af',
                        default => 'background:#f3f4f6;color:#374151'
                    }; @endphp
                    <span style="{{ $badge }};padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;">{{ ucfirst($p->status) }}</span>
                </td>
                <td style="padding:13px 16px;">
                    <a href="{{ route('petugas.peminjaman.show', $p) }}"
                       style="background:#CC4444;color:white;padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:32px;text-align:center;color:#aaa;font-size:14px;">Belum ada peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-petugas-layout>