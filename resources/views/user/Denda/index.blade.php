<x-user-layout>

<div style="margin-bottom:20px;">
    <h3 style="font-size:20px;font-weight:700;color:#333;">💸 Tagihan Denda Saya</h3>
    <p style="font-size:13px;color:#888;margin-top:2px;">Pantau dan bayar tagihan dendamu</p>
</div>

@if(session('success'))
    <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
        ✓ {{ session('success') }}
    </div>
@endif

@php $belumBayar = $dendas->whereNotIn('status',['lunas'])->count(); @endphp
@if($belumBayar > 0)
    <div style="background:#fef3c7;border:1px solid #fcd34d;color:#92400e;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;font-weight:600;">
        ⚠️ Kamu memiliki <strong>{{ $belumBayar }} tagihan denda</strong> yang belum lunas. Segera selesaikan!
    </div>
@endif

<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 10px rgba(129,166,198,0.15);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#81A6C6,#E8A0BF);">
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">No</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Alat</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Jenis Denda</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Nominal</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Keterangan</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Status</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dendas as $i => $d)
            <tr style="border-bottom:1px solid #f3f4f6;{{ $i % 2 == 0 ? '' : 'background:#fafafa;' }}">
                <td style="padding:14px 16px;font-size:14px;color:#555;">{{ $i+1 }}</td>
                <td style="padding:14px 16px;font-size:15px;font-weight:600;color:#333;">{{ $d->peminjaman->alat->nama_alat }}</td>
                <td style="padding:14px 16px;">
                    @php $jBadge = match($d->jenis) {
                        'terlambat'  => 'background:#fef3c7;color:#92400e',
                        'kehilangan' => 'background:#fee2e2;color:#991b1b',
                        'kerusakan'  => 'background:#ffedd5;color:#9a3412',
                    }; @endphp
                    <span style="{{ $jBadge }};padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                        {{ ucfirst($d->jenis) }}
                        @if($d->jenis === 'terlambat' && $d->hari_terlambat > 0)
                            ({{ $d->hari_terlambat }} hari)
                        @endif
                    </span>
                </td>
                <td style="padding:14px 16px;font-size:15px;font-weight:800;color:#CC4444;">{{ $d->nominal_format }}</td>
                <td style="padding:14px 16px;font-size:13px;color:#888;font-style:italic;">
                    {{ $d->keterangan_petugas ?? '-' }}
                </td>
                <td style="padding:14px 16px;">
                    @php $sBadge = match($d->status) {
                        'belum_bayar'         => 'background:#fee2e2;color:#991b1b',
                        'menunggu_konfirmasi' => 'background:#fef3c7;color:#92400e',
                        'lunas'               => 'background:#d1fae5;color:#065f46',
                    }; @endphp
                    <span style="{{ $sBadge }};padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                        {{ str_replace('_',' ',ucfirst($d->status)) }}
                    </span>
                </td>
                <td style="padding:14px 16px;">
                    @if($d->status === 'belum_bayar')
                        <a href="{{ route('user.denda.bayar', $d) }}"
                           style="background:linear-gradient(135deg,#81A6C6,#E8A0BF);color:white;padding:7px 16px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">
                            💳 Bayar
                        </a>
                    @elseif($d->status === 'menunggu_konfirmasi')
                        <span style="font-size:12px;color:#92400e;font-weight:600;">⏳ Menunggu konfirmasi</span>
                    @else
                        <span style="font-size:12px;color:#065f46;font-weight:700;">✓ Lunas</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding:60px;text-align:center;">
                    <p style="font-size:40px;">💸</p>
                    <p style="color:#aaa;font-size:15px;margin-top:10px;">Tidak ada tagihan denda.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-user-layout>