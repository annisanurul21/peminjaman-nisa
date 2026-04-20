<x-petugas-layout>
<x-slot name="header">Detail Pengajuan Peminjaman</x-slot>

<div style="max-width:680px;">
    <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 2px 10px rgba(0,0,0,0.07);">

        <!-- Info Peminjam -->
        <div style="background:#fff8f8;border:1px solid #ffcaca;border-radius:12px;padding:18px;margin-bottom:16px;">
            <h3 style="font-size:14px;font-weight:700;color:#CC4444;margin-bottom:12px;">👤 Informasi Peminjam</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <div><p style="font-size:12px;color:#999;">Nama</p><p style="font-weight:600;color:#333;">{{ $peminjaman->user->name }}</p></div>
                <div><p style="font-size:12px;color:#999;">NISN</p><p style="font-weight:600;color:#333;">{{ $peminjaman->user->nisn ?? '-' }}</p></div>
                <div><p style="font-size:12px;color:#999;">Kelas</p><p style="font-weight:600;color:#333;">{{ $peminjaman->user->kelas ?? '-' }}</p></div>
                <div><p style="font-size:12px;color:#999;">No. HP</p><p style="font-weight:600;color:#333;">{{ $peminjaman->no_hp }}</p></div>
            </div>
        </div>

        <!-- Info Alat -->
        <div style="background:#f8f9ff;border:1px solid #dde3ff;border-radius:12px;padding:18px;margin-bottom:16px;">
            <h3 style="font-size:14px;font-weight:700;color:#4F46E5;margin-bottom:12px;">🔧 Informasi Alat</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <div><p style="font-size:12px;color:#999;">Nama Alat</p><p style="font-weight:600;color:#333;">{{ $peminjaman->alat->nama_alat }}</p></div>
                <div><p style="font-size:12px;color:#999;">Jumlah</p><p style="font-weight:600;color:#333;">{{ $peminjaman->jumlah_pinjam }} unit</p></div>
                <div><p style="font-size:12px;color:#999;">Tgl Pinjam</p><p style="font-weight:600;color:#333;">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</p></div>
                <div><p style="font-size:12px;color:#999;">Tgl Kembali</p><p style="font-weight:600;color:#333;">{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</p></div>
                <div style="grid-column:span 2;"><p style="font-size:12px;color:#999;">Keperluan</p><p style="font-weight:600;color:#333;">{{ $peminjaman->keperluan ?? '-' }}</p></div>
            </div>
        </div>

        @if($peminjaman->status === 'menunggu')
        <div style="border-top:1px solid #f3f4f6;padding-top:16px;display:flex;flex-direction:column;gap:12px;">
            <!-- Setujui -->
            <form action="{{ route('petugas.peminjaman.setujui', $peminjaman) }}" method="POST">
                @csrf
                <div style="margin-bottom:8px;">
                    <label style="font-size:13px;color:#555;display:block;margin-bottom:4px;">Catatan untuk peminjam (opsional)</label>
                    <textarea name="catatan_petugas" rows="2"
                              style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px 12px;font-size:13px;font-family:'Figtree',sans-serif;"
                              placeholder="Misal: Harap kembalikan sebelum jam 15.00"></textarea>
                </div>
                <button type="submit" onclick="return confirm('Setujui peminjaman ini?')"
                        style="width:100%;background:linear-gradient(135deg,#16a34a,#15803d);color:white;padding:12px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                    ✓ Setujui Peminjaman
                </button>
            </form>
            <!-- Tolak -->
            <form action="{{ route('petugas.peminjaman.tolak', $peminjaman) }}" method="POST">
                @csrf
                <div style="margin-bottom:8px;">
                    <label style="font-size:13px;color:#555;display:block;margin-bottom:4px;">Alasan penolakan</label>
                    <textarea name="catatan_petugas" rows="2"
                              style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px 12px;font-size:13px;font-family:'Figtree',sans-serif;"
                              placeholder="Tulis alasan penolakan..."></textarea>
                </div>
                <button type="submit" onclick="return confirm('Tolak peminjaman ini?')"
                        style="width:100%;background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:12px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                    ✕ Tolak Peminjaman
                </button>
            </form>
        </div>
        @else
        <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:14px;margin-top:8px;">
            <p style="font-size:14px;color:#555;">Status: <strong>{{ ucfirst($peminjaman->status) }}</strong></p>
            @if($peminjaman->catatan_petugas)
                <p style="font-size:13px;color:#777;margin-top:6px;">Catatan: {{ $peminjaman->catatan_petugas }}</p>
            @endif
        </div>
        @endif

        <a href="{{ route('petugas.peminjaman.index') }}"
           style="display:block;text-align:center;background:#f3f4f6;color:#374151;padding:11px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;margin-top:14px;">
            ← Kembali ke Daftar
        </a>
    </div>
</div>

</x-petugas-layout>