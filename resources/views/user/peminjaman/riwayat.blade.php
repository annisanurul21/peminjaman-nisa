<x-user-layout>

<div style="margin-bottom:20px;">
    <h3 style="font-size:20px;font-weight:700;color:#333;">📋 Riwayat Peminjaman</h3>
    <p style="font-size:13px;color:#888;margin-top:2px;">Pantau status peminjaman alatmu</p>
</div>

@if(session('success'))
    <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
        ✓ {{ session('success') }}
    </div>
@endif

<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 10px rgba(129,166,198,0.15);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#81A6C6,#E8A0BF);">
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">No</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Alat</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Jumlah</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Periode Pinjam</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Status</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $p)
            <tr style="border-bottom:1px solid #f3f4f6;{{ $i % 2 == 0 ? '' : 'background:#fafafa;' }}">
                <td style="padding:14px 16px;font-size:14px;color:#555;">{{ $i+1 }}</td>
                <td style="padding:14px 16px;font-size:15px;font-weight:600;color:#333;">{{ $p->alat->nama_alat }}</td>
                <td style="padding:14px 16px;font-size:14px;color:#666;">{{ $p->jumlah_pinjam }} unit</td>
                <td style="padding:14px 16px;font-size:13px;color:#666;">
                    {{ $p->tanggal_pinjam->format('d M Y') }}<br>
                    <span style="color:#aaa;">s/d {{ $p->tanggal_kembali->format('d M Y') }}</span>
                </td>
                <td style="padding:14px 16px;">
                    @php $s = match($p->status) {
                        'menunggu'     => 'background:#fef3c7;color:#92400e',
                        'disetujui'    => 'background:#d1fae5;color:#065f46',
                        'ditolak'      => 'background:#fee2e2;color:#991b1b',
                        'dikembalikan' => 'background:#dbeafe;color:#1e40af',
                        default        => 'background:#f3f4f6;color:#374151'
                    }; @endphp
                    <span style="{{ $s }};padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td style="padding:14px 16px;font-size:13px;color:#888;font-style:italic;">{{ $p->catatan_petugas ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:60px;text-align:center;">
                    <p style="font-size:40px;">📋</p>
                    <p style="color:#aaa;font-size:15px;margin-top:10px;">Belum ada riwayat peminjaman.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-user-layout>