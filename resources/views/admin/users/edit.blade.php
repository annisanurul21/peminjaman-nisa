<x-admin-layout>
<x-slot name="header">Edit Akun</x-slot>

<div style="max-width:680px;margin:0 auto;">
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">

        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid #f3f4f6;">
            <div>
                <h3 style="font-size:20px;font-weight:700;color:#333;">✏️ Edit Akun: {{ $user->name }}</h3>
                <p style="font-size:13px;color:#888;margin-top:4px;">Perbarui informasi akun di bawah ini</p>
            </div>
            <a href="{{ route('admin.users.index') }}"
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

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn', $user->nisn) }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $user->kelas) }}" required
                           style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                </div>
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}" required
                           style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                </div>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password Baru <span style="color:#aaa;font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" placeholder="Minimal 6 karakter"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Role</label>
                <select name="role" required
                        style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;">
                    <option value="petugas" {{ old('role', $user->role)=='petugas'?'selected':'' }}>Petugas</option>
                    <option value="user" {{ old('role', $user->role)=='user'?'selected':'' }}>User / Peminjam</option>
                </select>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit"
                        style="flex:1;background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                    💾 Update Akun
                </button>
                <a href="{{ route('admin.users.index') }}"
                   style="flex:1;background:#FFD8DF;color:#c0446a;padding:13px;border-radius:12px;font-size:15px;font-weight:700;text-decoration:none;text-align:center;">
                    ✕ Batal
                </a>
            </div>
        </form>
    </div>
</div>

</x-admin-layout>