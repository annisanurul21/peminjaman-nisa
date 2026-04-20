<x-user-layout>

<div style="max-width:680px;margin:0 auto;display:flex;flex-direction:column;gap:20px;">

    @if(session('success'))
        <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 16px;border-radius:10px;font-size:14px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- Foto & Info Profil -->
    <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 2px 10px rgba(129,166,198,0.15);">

        <div style="padding-bottom:16px;margin-bottom:24px;border-bottom:2px solid #f3f4f6;">
            <h3 style="font-size:18px;font-weight:700;color:#333;">👤 Profil Siswa</h3>
            <p style="font-size:13px;color:#888;margin-top:4px;">Perbarui informasi profil dan foto kamu</p>
        </div>

        <!-- Foto Profil Preview -->
        <div style="display:flex;align-items:center;gap:20px;margin-bottom:24px;">
            <div id="foto-preview" style="width:90px;height:90px;border-radius:50%;overflow:hidden;border:3px solid #81A6C6;flex-shrink:0;">
                @if($user->foto_profil)
                    <img src="{{ Storage::url($user->foto_profil) }}" id="preview-img"
                         style="width:100%;height:100%;object-fit:cover;">
                @else
                    <div id="preview-placeholder"
                         style="width:100%;height:100%;background:linear-gradient(135deg,#81A6C6,#E8A0BF);display:flex;align-items:center;justify-content:center;font-size:36px;">
                        👤
                    </div>
                @endif
            </div>
            <div>
                <p style="font-size:15px;font-weight:700;color:#333;">{{ $user->name }}</p>
                <p style="font-size:13px;color:#888;">{{ $user->email }}</p>
                <p style="font-size:12px;color:#81A6C6;margin-top:4px;font-weight:600;">🎓 Siswa SMKN 1 Ciomas</p>
            </div>
        </div>

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Upload Foto -->
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">
                    Foto Profil <span style="color:#aaa;font-weight:400;">(opsional)</span>
                </label>
                <input type="file" name="foto_profil" accept="image/*" id="input-foto"
                       onchange="previewFoto(event)"
                       style="width:100%;border:2px dashed #81A6C6;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'Figtree',sans-serif;cursor:pointer;">
                <p style="font-size:12px;color:#aaa;margin-top:4px;">Format: JPG, PNG. Maks 2MB.</p>
                @error('foto_profil')
                    <p style="color:#E8A0BF;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama -->
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                @error('name')
                    <p style="color:#E8A0BF;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                @error('email')
                    <p style="color:#E8A0BF;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    style="background:linear-gradient(135deg,#81A6C6,#E8A0BF);color:white;padding:12px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                💾 Simpan Profil
            </button>
        </form>
    </div>

    <!-- Ubah Password -->
    <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 2px 10px rgba(129,166,198,0.15);">
        <div style="padding-bottom:16px;margin-bottom:20px;border-bottom:2px solid #f3f4f6;">
            <h3 style="font-size:18px;font-weight:700;color:#333;">🔒 Ubah Password</h3>
            <p style="font-size:13px;color:#888;margin-top:4px;">Gunakan password yang kuat untuk keamanan akunmu</p>
        </div>

        <form action="{{ route('user.profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password Saat Ini</label>
                <input type="password" name="current_password" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                @error('current_password')
                    <p style="color:#E8A0BF;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password Baru</label>
                <input type="password" name="password" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
                @error('password')
                    <p style="color:#E8A0BF;font-size:12px;margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#81A6C6'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <button type="submit"
                    style="background:linear-gradient(135deg,#81A6C6,#E8A0BF);color:white;padding:12px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                💾 Simpan Password
            </button>
        </form>
    </div>

</div>

<script>
function previewFoto(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const container = document.getElementById('foto-preview');
        container.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
    };
    reader.readAsDataURL(file);
}
</script>

</x-user-layout>