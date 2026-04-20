<x-admin-layout>
<x-slot name="header">Edit Alat</x-slot>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h3 style="font-size:20px;font-weight:700;color:#333;">Edit Alat: {{ $alat->nama_alat }}</h3>
        <p style="font-size:13px;color:#888;margin-top:2px;">Perbarui informasi alat di bawah ini</p>
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

<div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);max-width:680px;">
    <form action="{{ route('admin.alats.update', $alat) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kategori</label>
            <select name="kategori_id" required
                    style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id',$alat->kategori_id)==$kat->id?'selected':'' }}>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama Alat</label>
            <input type="text" name="nama_alat" value="{{ old('nama_alat',$alat->nama_alat) }}" required
                   style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kode Alat</label>
            <input type="text" name="kode_alat" value="{{ old('kode_alat',$alat->kode_alat) }}" required
                   style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Jumlah Total</label>
            <input type="number" name="jumlah_total" value="{{ old('jumlah_total',$alat->jumlah_total) }}" min="1" required
                   style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kondisi</label>
            <select name="kondisi" required
                    style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                <option value="baik" {{ old('kondisi',$alat->kondisi)=='baik'?'selected':'' }}>Baik</option>
                <option value="rusak" {{ old('kondisi',$alat->kondisi)=='rusak'?'selected':'' }}>Rusak</option>
                <option value="perbaikan" {{ old('kondisi',$alat->kondisi)=='perbaikan'?'selected':'' }}>Perbaikan</option>
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Deskripsi <span style="color:#aaa;font-weight:400;">(opsional)</span></label>
            <textarea name="deskripsi" rows="3"
                      style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;resize:vertical;">{{ old('deskripsi',$alat->deskripsi) }}</textarea>
        </div>

        <div style="margin-bottom:24px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Foto Alat <span style="color:#aaa;font-weight:400;">(opsional)</span></label>
            @if($alat->foto)
                <div style="margin-bottom:10px;">
                    <img src="{{ Storage::url($alat->foto) }}"
                         style="width:96px;height:96px;object-fit:cover;border-radius:12px;border:3px solid #A8DF8E;">
                    <p style="font-size:12px;color:#aaa;margin-top:4px;">Foto saat ini — upload baru untuk mengganti</p>
                </div>
            @endif
            <input type="file" name="foto" accept="image/*"
                   style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'Figtree',sans-serif;">
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit"
                    style="background:linear-gradient(135deg,#F075AE,#d4609a);color:white;padding:12px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                💾 Update Alat
            </button>
            <a href="{{ route('admin.alats.index') }}"
               style="background:#f3f4f6;color:#555;padding:12px 28px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">
                Batal
            </a>
        </div>
    </form>
</div>

</x-admin-layout>