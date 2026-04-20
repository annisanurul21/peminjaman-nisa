<x-admin-layout>
<x-slot name="header">Tambah Alat</x-slot>

<div style="max-width:680px;margin:0 auto;">
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">

        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid #f3f4f6;">
            <div>
                <h3 style="font-size:20px;font-weight:700;color:#333;">🔧 Tambah Alat Baru</h3>
                <p style="font-size:13px;color:#888;margin-top:4px;">Isi form berikut untuk menambahkan alat baru</p>
            </div>
            <a href="{{ route('admin.alats.index') }}"
               style="background:#A8DF8E;color:#2d5a1a;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">
                ← Kembali
            </a>
        </div>

        @if($errors->any())
            <div style="background:#FFD8DF;border:1px solid #F075AE;color:#c0446a;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
                <ul style="padding-left:16px;margin:0;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.alats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kategori</label>
                <select name="kategori_id" required
                        style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id')==$kat->id?'selected':'' }}>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama Alat</label>
                <input type="text" name="nama_alat" value="{{ old('nama_alat') }}"
                       placeholder="Contoh: Laptop Lenovo" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kode Alat</label>
                <input type="text" name="kode_alat" value="{{ old('kode_alat') }}"
                       placeholder="Contoh: ALT-001" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Jumlah Total</label>
                <input type="number" name="jumlah_total" value="{{ old('jumlah_total') }}" min="1" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kondisi</label>
                <select name="kondisi" required
                        style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                    <option value="baik" {{ old('kondisi')=='baik'?'selected':'' }}>Baik</option>
                    <option value="rusak" {{ old('kondisi')=='rusak'?'selected':'' }}>Rusak</option>
                    <option value="perbaikan" {{ old('kondisi')=='perbaikan'?'selected':'' }}>Perbaikan</option>
                </select>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Deskripsi <span style="color:#aaa;font-weight:400;">(opsional)</span></label>
                <textarea name="deskripsi" rows="3"
                          placeholder="Deskripsi singkat alat"
                          style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;resize:vertical;">{{ old('deskripsi') }}</textarea>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Foto Alat <span style="color:#aaa;font-weight:400;">(opsional)</span></label>
                <input type="file" name="foto" accept="image/*"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'Figtree',sans-serif;">
            </div>

            <div style="display:flex;justify-content:center;">
    <button type="submit"
            style="background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:13px 48px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;box-shadow:0 3px 10px rgba(168,223,142,0.4);">
        ✓ Simpan Alat
    </button>
</div>
        </form>
    </div>
</div>

</x-admin-layout>