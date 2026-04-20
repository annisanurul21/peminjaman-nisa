<x-petugas-layout>
<x-slot name="header">Kelola Pengajuan Peminjaman</x-slot>

@if(session('success'))
    <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
        ✓ {{ session('success') }}
    </div>
@endif

<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#CC4444,#aa3333);">
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">No</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Peminjam</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Informasi Alat</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Periode</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Status</th>
                <th style="padding:13px 16px;text-align:center;font-size:12px;font-weight:700;color:white;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $p)
            <tr style="border-bottom:1px solid #f3f4f6;{{ $i % 2 != 0 ? 'background:#fafafa;' : '' }}">
                <td style="padding:13px 16px;font-size:14px;color:#888;">{{ $i+1 }}</td>
                <td style="padding:13px 16px;">
                    <p style="font-weight:700;color:#333;font-size:14px;">{{ $p->user->name }}</p>
                    <p style="font-size:12px;color:#999;">NISN: {{ $p->user->nisn }}</p>
                </td>
                <td style="padding:13px 16px;">
                    <p style="font-size:14px;color:#333;font-weight:600;">{{ $p->alat->nama_alat }}</p>
                    <span style="background:#ffecec;color:#CC4444;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;">{{ $p->jumlah_pinjam }} Unit</span>
                </td>
                <td style="padding:13px 16px;font-size:13px;color:#555;">
                    <div>Dari: <strong>{{ $p->tanggal_pinjam->format('d/m/Y') }}</strong></div>
                    <div>Ke: <strong>{{ $p->tanggal_kembali->format('d/m/Y') }}</strong></div>
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
                <td style="padding:13px 16px;text-align:center;">
                    <a href="{{ route('petugas.peminjaman.show', $p) }}"
                       style="background:#CC4444;color:white;padding:7px 16px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">
                        Detail & Kelola
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="padding:40px;text-align:center;color:#aaa;font-size:14px;">Belum ada pengajuan peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-petugas-layout>