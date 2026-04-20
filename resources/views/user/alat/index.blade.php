<x-user-layout>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h3 style="font-size:20px;font-weight:700;color:#333;">🔧 Daftar Alat Tersedia</h3>
        <p style="font-size:13px;color:#888;margin-top:2px;">Pilih alat yang ingin kamu pinjam</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
    @forelse($alats as $alat)
    <div style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 2px 10px rgba(129,166,198,0.15);border:2px solid transparent;transition:all .2s;"
         onmouseover="this.style.borderColor='#81A6C6';this.style.boxShadow='0 6px 20px rgba(129,166,198,0.25)'"
         onmouseout="this.style.borderColor='transparent';this.style.boxShadow='0 2px 10px rgba(129,166,198,0.15)'">
        @if($alat->foto)
            <img src="{{ Storage::url($alat->foto) }}" style="width:100%;height:180px;object-fit:cover;">
        @else
            <div style="width:100%;height:180px;background:linear-gradient(135deg,#dbeafe,#fce7f3);display:flex;align-items:center;justify-content:center;font-size:48px;">🔧</div>
        @endif
        <div style="padding:18px;">
            <span style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:#1e40af;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;">
                {{ $alat->kategori->nama_kategori }}
            </span>
            <h3 style="font-size:16px;font-weight:700;color:#333;margin-top:10px;">{{ $alat->nama_alat }}</h3>
            <p style="font-size:13px;color:#888;margin-top:4px;">Kode: {{ $alat->kode_alat }}</p>
            <div style="display:flex;justify-content:space-between;margin-top:8px;">
                <p style="font-size:13px;color:#666;">Kondisi: <span style="color:#10b981;font-weight:600;">{{ ucfirst($alat->kondisi) }}</span></p>
                <p style="font-size:13px;color:#666;">Tersedia: <span style="color:#81A6C6;font-weight:700;">{{ $alat->jumlah_tersedia }}</span></p>
            </div>
            @if($alat->deskripsi)
                <p style="font-size:12px;color:#aaa;margin-top:8px;">{{ Str::limit($alat->deskripsi, 70) }}</p>
            @endif
            @if($alat->jumlah_tersedia > 0)
                <a href="{{ route('user.peminjaman.create', $alat->id) }}"
                   style="margin-top:14px;display:block;text-align:center;background:linear-gradient(135deg,#81A6C6,#E8A0BF);color:white;padding:10px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">
                    Pinjam Alat
                </a>
            @else
                <div style="margin-top:14px;display:block;text-align:center;background:#f3f4f6;color:#aaa;padding:10px;border-radius:10px;font-size:14px;font-weight:600;">
                    Tidak Tersedia
                </div>
            @endif
        </div>
    </div>
    @empty
    <div style="grid-column:span 3;text-align:center;padding:60px;color:#aaa;">
        <p style="font-size:48px;">🔧</p>
        <p style="font-size:16px;margin-top:12px;">Tidak ada alat yang tersedia saat ini.</p>
    </div>
    @endforelse
</div>

</x-user-layout>