<div style="padding-bottom:16px;margin-bottom:20px;border-bottom:2px solid #f3f4f6;">
    <h3 style="font-size:18px;font-weight:700;color:#333;">🔒 Ubah Password</h3>
    <p style="font-size:13px;color:#888;margin-top:4px;">Gunakan password yang panjang dan acak agar akunmu aman</p>
</div>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password Saat Ini</label>
        <input type="password" name="current_password" autocomplete="current-password"
               style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
               onfocus="this.style.borderColor='#A8DF8E'" onblur="this.style.borderColor='#e5e7eb'">
        @if($errors->updatePassword->get('current_password'))
            <p style="color:#c0446a;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->updatePassword->get('current_password')) }}</p>
        @endif
    </div>

    <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password Baru</label>
        <input type="password" name="password" autocomplete="new-password"
               style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
               onfocus="this.style.borderColor='#A8DF8E'" onblur="this.style.borderColor='#e5e7eb'">
        @if($errors->updatePassword->get('password'))
            <p style="color:#c0446a;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->updatePassword->get('password')) }}</p>
        @endif
    </div>

    <div style="margin-bottom:24px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" autocomplete="new-password"
               style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
               onfocus="this.style.borderColor='#A8DF8E'" onblur="this.style.borderColor='#e5e7eb'">
        @if($errors->updatePassword->get('password_confirmation'))
            <p style="color:#c0446a;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->updatePassword->get('password_confirmation')) }}</p>
        @endif
    </div>

    <div style="display:flex;align-items:center;gap:12px;">
        <button type="submit"
                style="background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
            💾 Simpan Password
        </button>
        @if (session('status') === 'password-updated')
            <p style="font-size:13px;color:#065f46;font-weight:600;">✓ Password diperbarui!</p>
        @endif
    </div>
</form>