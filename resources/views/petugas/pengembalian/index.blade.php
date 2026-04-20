<x-petugas-layout>
<x-slot name="header">Monitor Pengembalian Alat</x-slot>

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
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Alat</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Jumlah</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Batas Kembali</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Status</th>
                <th style="padding:13px 16px;text-align:left;font-size:12px;font-weight:700;color:white;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $p)
            @php $terlambat = $p->tanggal_kembali->isPast(); @endphp
            <tr style="border-bottom:1px solid #f3f4f6;{{ $terlambat ? 'background:#fff5f5;' : ($i % 2 != 0 ? 'background:#fafafa;' : '') }}">
                <td style="padding:13px 16px;font-size:14px;color:#888;">{{ $i+1 }}</td>
                <td style="padding:13px 16px;">
                    <p style="font-weight:700;color:#333;font-size:14px;">{{ $p->user->name }}</p>
                    <p style="font-size:12px;color:#999;">{{ $p->user->nisn }}</p>
                </td>
                <td style="padding:13px 16px;font-size:14px;color:#333;font-weight:600;">{{ $p->alat->nama_alat }}</td>
                <td style="padding:13px 16px;font-size:14px;color:#555;">{{ $p->jumlah_pinjam }} unit</td>
                <td style="padding:13px 16px;font-size:14px;{{ $terlambat ? 'color:#CC4444;font-weight:700;' : 'color:#555;' }}">
                    {{ $p->tanggal_kembali->format('d/m/Y') }}
                    @if($terlambat)<br><span style="font-size:11px;background:#ffecec;color:#CC4444;padding:2px 8px;border-radius:10px;">⚠ Terlambat!</span>@endif
                </td>
                <td style="padding:13px 16px;">
                    <span style="background:#d1fae5;color:#065f46;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:700;">Dipinjam</span>
                </td>
                <td style="padding:13px 16px;">
                    <form action="{{ route('petugas.pengembalian.proses', $p) }}" method="POST"
                          onsubmit="return confirm('Konfirmasi pengembalian alat ini?')">
                        @csrf
                        <button type="submit"
                                style="background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:700;border:none;cursor:pointer;">
                            ✓ Konfirmasi Kembali
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="padding:40px;text-align:center;color:#aaa;font-size:14px;">Tidak ada alat yang sedang dipinjam.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</x-petugas-layout>