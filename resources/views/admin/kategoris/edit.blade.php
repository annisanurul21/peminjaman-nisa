<x-admin-layout>
<x-slot name="header">Edit Kategori Alat</x-slot>

<div style="display:flex;justify-content:center;align-items:flex-start;min-height:70vh;padding-top:20px;">
    <div style="background:white;border-radius:16px;padding:36px 40px;box-shadow:0 4px 16px rgba(0,0,0,0.08);width:100%;max-width:700px;">

        <div style="margin-bottom:28px;padding-bottom:16px;border-bottom:2px solid #FFD8DF;">
            <h2 style="font-size:20px;font-weight:700;color:#333;">✏️ Edit Kategori</h2>
            <p style="font-size:13px;color:#888;margin-top:4px;">Perbarui informasi kategori alat</p>
        </div>

        @if($errors->any())
        <div style="background:#FFD8DF;border:1px solid #F075AE;color:#c0446a;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.kategoris.update', $kategori) }}" method="POST">
            @csrf @method('PUT')

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:14px;font-weight:700;color:#444;margin-bottom:8px;">
                    Nama Kategori <span style="color:#F075AE;">*</span>
                </label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:12px 16px;font-size:15px;outline:none;"
                       onfocus="this.style.borderColor='#A8DF8E'"
                       onblur="this.style.borderColor='#e5e7eb'"
                       required>
            </div>

            <div style="margin-bottom:28px;">
                <label style="display:block;font-size:14px;font-weight:700;color:#444;margin-bottom:8px;">
                    Deskripsi <span style="color:#aaa;font-weight:400;">(opsional)</span>
                </label>
                <textarea name="deskripsi" rows="5"
                          style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:12px 16px;font-size:15px;resize:vertical;outline:none;"
                          onfocus="this.style.borderColor='#A8DF8E'"
                          onblur="this.style.borderColor='#e5e7eb'">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit"
                        style="flex:1;background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:14px 24px;border-radius:10px;font-size:15px;font-weight:700;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(168,223,142,0.4);">
                    ✓ Update Kategori
                </button>
                <a href="{{ route('admin.kategoris.index') }}"
                   style="flex:1;background:#FFD8DF;color:#c0446a;padding:14px 24px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;text-align:center;box-shadow:0 2px 8px rgba(240,117,174,0.2);">
                    ✕ Batal
                </a>
            </div>
        </form>

    </div>
</div>

</x-admin-layout>