<x-petugas-layout>
<x-slot name="header">Laporan Peminjaman</x-slot>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h4 style="font-size:21px;font-weight:700;color:#FFF;">Data Laporan</h4>
        <p style="font-size:14px;color:#333;margin-top:2px;">Filter dan cetak laporan peminjaman alat</p>
    </div>
    <a href="{{ route('petugas.laporan.print', request()->query()) }}" target="_blank"
       style="background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:700;text-decoration:none;">
        🖨️ Cetak Laporan
    </a>
</div>

<!-- Filter -->
<div style="background:white;border-radius:14px;padding:20px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <p style="font-size:13px;font-weight:700;color:#CC4444;margin-bottom:14px;text-transform:uppercase;letter-spacing:.05em;">🔍 Filter Laporan</p>
    <form method="GET" action="{{ route('petugas.laporan.index') }}"
          style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
        <div>
            <label style="font-size:12px;font-weight:600;color:#555;display:block;margin-bottom:5px;">Nama Peminjam</label>
            <input type="text" name="nama" value="{{ request('nama') }}"
                   style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;outline:none;"
                   placeholder="Cari nama...">
        </div>
        <div>
            <label style="font-size:12px;font-weight:600;color:#555;display:block;margin-bottom:5px;">Status</label>
            <select name="status" style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;outline:none;">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                <option value="dikembalikan" {{ request('status')=='dikembalikan'?'selected':'' }}>Dikembalikan</option>
            </select>
        </div>
        <div>
            <label style="font-size:12px;font-weight:600;color:#555;display:block;margin-bottom:5px;">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}"
                   style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;outline:none;">
        </div>
        <div>
            <label style="font-size:12px;font-weight:600;color:#555;display:block;margin-bottom:5px;">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}"
                   style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;outline:none;">
        </div>
        <div style="grid-column:span 4;display:flex;gap:10px;">
            <button type="submit"
                    style="background:#CC4444;color:white;padding:9px 24px;border-radius:8px;font-size:13px;font-weight:700;border:none;cursor:pointer;">
                Terapkan Filter
            </button>
            <a href="{{ route('petugas.laporan.index') }}"
               style="background:#f3f4f6;color:#555;padding:9px 24px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Statistik -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px;">
    <div style="background:white;border-radius:12px;padding:16px;border-left:4px solid #6b7280;box-shadow:0 2px 6px rgba(0,0,0,0.05);">
        <p style="font-size:11px;color:#888;text-transform:uppercase;">Total</p>
        <p style="font-size:28px;font-weight:800;color:#333;">{{ $peminjamans->count() }}</p>
    </div>
    <div style="background:white;border-radius:12px;padding:16px;border-left:4px solid #f59e0b;box-shadow:0 2px 6px rgba(0,0,0,0.05);">
        <p style="font-size:11px;color:#888;text-transform:uppercase;">Menunggu</p>
        <p style="font-size:28px;font-weight:800;color:#f59e0b;">{{ $peminjamans->where('status','menunggu')->count() }}</p>
    </div>
    <div style="background:white;border-radius:12px;padding:16px;border-left:4px solid #10b981;box-shadow:0 2px 6px rgba(0,0,0,0.05);">
        <p style="font-size:11px;color:#888;text-transform:uppercase;">Disetujui</p>
        <p style="font-size:28px;font-weight:800;color:#10b981;">{{ $peminjamans->where('status','disetujui')->count() }}</p>
    </div>
    <div style="background:white;border-radius:12px;padding:16px;border-left:4px solid #3b82f6;box-shadow:0 2px 6px rgba(0,0,0,0.05);">
        <p style="font-size:11px;color:#888;text-transform:uppercase;">Dikembalikan</p>
        <p style="font-size:28px;font-weight:800;color:#3b82f6;">{{ $peminjamans->where('status','dikembalikan')->count() }}</p>
    </div>
</div>

<!-- Tabel -->
<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#CC4444,#aa3333);">
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">No</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Peminjam</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Alat</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Jumlah</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Periode</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $p)
            <tr style="border-bottom:1px solid #f3f4f6;{{ $i % 2 != 0 ? 'background:#fafafa;' : '' }}">
                <td style="padding:13px 16px;font-size:14px;color:#888;">{{ $i+1 }}</td>
                <td style="padding:13px 16px;">
                    <p style="font-weight:700;color:#333;font-size:14px;">{{ $p->user->name }}</p>
                    <p style="font-size:12px;color:#999;">{{ $p->user->nisn }} • {{ $p->user->kelas }}</p>
                </td>
                <td style="padding:13px 16px;font-size:14px;color:#333;">{{ $p->alat->nama_alat }}</td>
                <td style="padding:13px 16px;font-size:14px;color:#555;">{{ $p->jumlah_pinjam }} unit</td>
                <td style="padding:13px 16px;font-size:13px;color:#555;">
                    {{ $p->tanggal_pinjam->format('d/m/Y') }}<br>
                    <span style="color:#aaa;font-size:12px;">s/d {{ $p->tanggal_kembali->format('d/m/Y') }}</span>
                </td>
                <td style="padding:13px 16px;">
                    @php $badge = match($p->status) {
                        'menunggu' => 'background:#fef3c7;color:#92400e',
                        'disetujui' => 'background:#d1fae5;color:#065f46',
                        'ditolak' => 'background:#fee2e2;color:#991b1b',
                        'dikembalikan' => 'background:#dbeafe;color:#1e40af',
                        default => 'background:#f3f4f6;color:#374151'
                    }; @endphp
                    <span style="{{ $badge }};padding:5px 12px;border-radius:20px;font-size:12px;font-weight:700;">{{ ucfirst($p->status) }}</span>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="padding:40px;text-align:center;color:#aaa;font-size:14px;">Tidak ada data laporan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-petugas-layout>