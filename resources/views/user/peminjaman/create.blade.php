<x-user-layout>

<div style="max-width:640px;margin:0 auto;">
    <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 2px 10px rgba(129,166,198,0.15);">

        <div style="margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid #f3f4f6;">
            <h3 style="font-size:20px;font-weight:700;color:#333;">📝 Form Pengajuan Peminjaman</h3>
            <p style="font-size:13px;color:#888;margin-top:4px;">Isi form berikut untuk mengajukan peminjaman alat</p>
        </div>

        <!-- Info Alat -->
        <div style="background:linear-gradient(135deg,#dbeafe,#fce7f3);border-radius:12px;padding:16px;margin-bottom:20px;">
            <p style="font-size:12px;font-weight:600;color:#1e40af;margin-bottom:6px;">🔧 Alat yang dipinjam:</p>
            <p style="font-size:18px;font-weight:700;color:#333;">{{ $alat->nama_alat }}</p>
            <p style="font-size:13px;color:#666;margin-top:2px;">Kode: {{ $alat->kode_alat }} &nbsp;|&nbsp; Tersedia: <strong>{{ $alat->jumlah_tersedia }} unit</strong></p>
        </div>

        @if($errors->any())
            <div style="background:#fce7f3;border:1px solid #E8A0BF;color:#9d174d;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
                <ul style="padding-left:16px;margin:0;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.peminjaman.store') }}" method="POST">
            @csrf
            <input type="hidden" name="alat_id" value="{{ $alat->id }}">

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama Peminjam</label>
                <input type="text" value="{{ auth()->user()->name }}" disabled
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;background:#f9fafb;color:#888;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Jumlah Pinjam</label>
                <input type="number" name="jumlah_pinjam" value="{{ old('jumlah_pinjam', 1) }}"
                       min="1" max="{{ $alat->jumlah_tersedia }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                <p style="font-size:12px;color:#aaa;margin-top:4px;">Maksimal {{ $alat->jumlah_tersedia }} unit</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" min="{{ date('Y-m-d') }}" required
                           style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                           onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                    <p style="font-size:11px;color:#aaa;margin-top:4px;">⏰ Jam pinjam: 07.00</p>
                </div>
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" min="{{ date('Y-m-d') }}" required
                           style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                           onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                    <p style="font-size:11px;color:#aaa;margin-top:4px;">⏰ Batas: 15.00</p>
                </div>
            </div>

            <div style="background:#fef9c3;border:1px solid #fde68a;border-radius:10px;padding:12px 14px;margin-bottom:16px;">
                <p style="font-size:12px;color:#92400e;">⏰ <strong>Perhatian:</strong> Peminjaman berlaku dari jam 07.00 sampai 15.00. Harap kembalikan alat tepat waktu.</p>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Keperluan <span style="color:#aaa;font-weight:400;">(opsional)</span></label>
                <textarea name="keperluan" rows="3"
                          placeholder="Untuk keperluan apa alat ini dipinjam?"
                          style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;resize:vertical;font-family:'Figtree',sans-serif;"
                          onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">{{ old('keperluan') }}</textarea>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit"
                        style="flex:1;background:linear-gradient(135deg,#81A6C6,#E8A0BF);color:white;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                    📤 Kirim Pengajuan
                </button>
                <a href="{{ route('user.alat.index') }}"
                   style="flex:1;background:#f3f4f6;color:#555;padding:13px;border-radius:12px;font-size:15px;font-weight:600;text-decoration:none;text-align:center;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

</x-user-layout>