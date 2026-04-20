<x-petugas-layout>
<x-slot name="header">Kelola Denda</x-slot>

@if(session('success'))
    <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">✓ {{ session('success') }}</div>
@endif

<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#CC4444,#aa3333);">
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">No</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Peminjam</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Alat</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Jenis Denda</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Nominal</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Metode</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Status</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dendas as $i => $d)
            <tr style="border-bottom:1px solid #f3f4f6;{{ $i%2!=0?'background:#fafafa;':'' }}">
                <td style="padding:13px 16px;font-size:14px;color:#888;">{{ $i+1 }}</td>
                <td style="padding:13px 16px;">
                    <p style="font-weight:700;color:#333;font-size:14px;">{{ $d->user->name }}</p>
                    <p style="font-size:12px;color:#999;">{{ $d->user->nisn }}</p>
                </td>
                <td style="padding:13px 16px;font-size:14px;color:#333;">{{ $d->peminjaman->alat->nama_alat }}</td>
                <td style="padding:13px 16px;">
                    @php $jBadge = match($d->jenis) {
                        'terlambat' => 'background:#fef3c7;color:#92400e',
                        'kehilangan' => 'background:#fee2e2;color:#991b1b',
                        'kerusakan' => 'background:#ffedd5;color:#9a3412',
                    }; @endphp
                    <span style="{{ $jBadge }};padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;">
                        {{ ucfirst($d->jenis) }}
                        @if($d->jenis==='terlambat' && $d->hari_terlambat > 0)
                            ({{ $d->hari_terlambat }} hari)
                        @endif
                    </span>
                </td>
                <td style="padding:13px 16px;font-size:14px;font-weight:700;color:#CC4444;">{{ $d->nominal_format }}</td>
                <td style="padding:13px 16px;font-size:13px;color:#555;">{{ $d->metode_bayar ? strtoupper($d->metode_bayar) : '-' }}</td>
                <td style="padding:13px 16px;">
                    @php $sBadge = match($d->status) {
                        'belum_bayar' => 'background:#fee2e2;color:#991b1b',
                        'menunggu_konfirmasi' => 'background:#fef3c7;color:#92400e',
                        'lunas' => 'background:#d1fae5;color:#065f46',
                    }; @endphp
                    <span style="{{ $sBadge }};padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;">
                        {{ str_replace('_',' ',ucfirst($d->status)) }}
                    </span>
                </td>
                <td style="padding:13px 16px;">
                    @if($d->status === 'menunggu_konfirmasi')
                        <div style="display:flex;flex-direction:column;gap:6px;">
                            @if($d->bukti_bayar)
                                <a href="{{ Storage::url($d->bukti_bayar) }}" target="_blank"
                                   style="background:#3b82f6;color:white;padding:5px 12px;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none;text-align:center;">
                                    👁 Lihat Bukti
                                </a>
                            @endif
                            <form action="{{ route('petugas.denda.konfirmasi.cash', $d) }}" method="POST">
                                @csrf
                                <button style="width:100%;background:#16a34a;color:white;padding:5px 12px;border-radius:8px;font-size:11px;font-weight:700;border:none;cursor:pointer;"
                                        onclick="return confirm('Konfirmasi pembayaran ini?')">
                                    ✓ Konfirmasi Lunas
                                </button>
                            </form>
                        </div>
                    @elseif($d->status === 'lunas')
                        <span style="font-size:12px;color:#16a34a;font-weight:700;">✓ Lunas</span>
                    @else
                        <span style="font-size:12px;color:#999;">Menunggu pembayaran</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="padding:40px;text-align:center;color:#aaa;font-size:14px;">Belum ada data denda.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-petugas-layout>