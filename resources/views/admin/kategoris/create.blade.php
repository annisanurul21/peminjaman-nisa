<x-admin-layout>
<x-slot name="header">Tambah Kategori Alat</x-slot>

<div style="display:flex;justify-content:center;align-items:flex-start;min-height:70vh;padding-top:20px;">
    <div style="background:white;border-radius:16px;padding:36px 40px;box-shadow:0 4px 16px rgba(0,0,0,0.08);width:100%;max-width:700px;">

        <!-- Judul Form -->
        <div style="margin-bottom:28px;padding-bottom:16px;border-bottom:2px solid #FFD8DF;">
            <h2 style="font-size:20px;font-weight:700;color:#333;">📁 Tambah Kategori Baru</h2>
            <p style="font-size:13px;color:#888;margin-top:4px;">Isi form di bawah untuk menambahkan kategori alat baru</p>
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

        <form action="{{ route('admin.kategoris.store') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:14px;font-weight:700;color:#444;margin-bottom:8px;">
                    Nama Kategori <span style="color:#F075AE;">*</span>
                </label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:12px 16px;font-size:15px;outline:none;transition:border .2s;"
                       placeholder="Contoh: Elektronik, Mekanik, Optik..."
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
                          placeholder="Tulis deskripsi singkat tentang kategori ini..."
                          onfocus="this.style.borderColor='#A8DF8E'"
                          onblur="this.style.borderColor='#e5e7eb'">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Tombol -->
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:24px;padding-top:16px;border-top:1px solid #f3f4f6;">
    <a href="{{ route('admin.kategoris.index') }}"
       style="background:#A8DF8E;color:#2d5a1a;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">
        ← Kembali
    </a>
    <button type="submit"
            style="background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:13px 32px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;box-shadow:0 3px 10px rgba(168,223,142,0.4);">
        ✓ Simpan Kategori
    </button>
</div>
        </form>

    </div>
</div>

</x-admin-layout>