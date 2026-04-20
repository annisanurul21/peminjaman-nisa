<x-petugas-layout>
<x-slot name="header">Profil Saya</x-slot>

<div style="max-width:700px;margin:0 auto;display:flex;flex-direction:column;gap:20px;">

    <!-- Profile Information -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <div style="padding-bottom:16px;margin-bottom:20px;border-bottom:2px solid #f3f4f6;">
            <h3 style="font-size:18px;font-weight:700;color:#333;">⚙️ Informasi Profil</h3>
            <p style="font-size:13px;color:#888;margin-top:4px;">Perbarui nama dan alamat email akunmu</p>
        </div>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#CC4444'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->get('name'))
                    <p style="color:#CC4444;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->get('name')) }}</p>
                @endif
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#CC4444'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->get('email'))
                    <p style="color:#CC4444;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->get('email')) }}</p>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div style="margin-top:8px;background:#fee2e2;padding:10px 14px;border-radius:8px;">
                        <p style="font-size:13px;color:#CC4444;">Email belum terverifikasi.
                            <button form="send-verification" style="background:none;border:none;color:#CC4444;font-weight:700;cursor:pointer;text-decoration:underline;">
                                Kirim ulang verifikasi
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p style="font-size:13px;color:#065f46;margin-top:4px;">Link verifikasi telah dikirim!</p>
                        @endif
                    </div>
                @endif
            </div>

            <div style="display:flex;align-items:center;gap:12px;">
                <button type="submit"
                        style="background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                    💾 Simpan
                </button>
                @if (session('status') === 'profile-updated')
                    <p style="font-size:13px;color:#065f46;font-weight:600;">✓ Tersimpan!</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
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
                       onfocus="this.style.borderColor='#CC4444'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->updatePassword->get('current_password'))
                    <p style="color:#CC4444;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->updatePassword->get('current_password')) }}</p>
                @endif
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password Baru</label>
                <input type="password" name="password" autocomplete="new-password"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#CC4444'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->updatePassword->get('password'))
                    <p style="color:#CC4444;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->updatePassword->get('password')) }}</p>
                @endif
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" autocomplete="new-password"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#CC4444'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->updatePassword->get('password_confirmation'))
                    <p style="color:#CC4444;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->updatePassword->get('password_confirmation')) }}</p>
                @endif
            </div>

            <div style="display:flex;align-items:center;gap:12px;">
                <button type="submit"
                        style="background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
                    💾 Simpan Password
                </button>
                @if (session('status') === 'password-updated')
                    <p style="font-size:13px;color:#065f46;font-weight:600;">✓ Password diperbarui!</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <div style="padding-bottom:16px;margin-bottom:20px;border-bottom:2px solid #fee2e2;">
            <h3 style="font-size:18px;font-weight:700;color:#CC4444;">🗑️ Hapus Akun</h3>
            <p style="font-size:13px;color:#888;margin-top:4px;">Setelah akun dihapus, semua data akan hilang permanen</p>
        </div>

        <p style="font-size:14px;color:#666;margin-bottom:20px;">
            Pastikan kamu sudah mengunduh semua data sebelum menghapus akun ini.
        </p>

        <button onclick="document.getElementById('modal-delete-petugas').style.display='flex'"
                style="background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
            🗑️ Hapus Akun
        </button>
    </div>

</div>

<!-- Modal Hapus Akun -->
<div id="modal-delete-petugas" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:20px;padding:36px 32px;max-width:420px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.15);text-align:center;animation:popIn .2s ease;">
        <div style="width:72px;height:72px;background:linear-gradient(135deg,#fee2e2,#CC4444);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 20px;">
            🗑️
        </div>
        <h3 style="font-size:20px;font-weight:700;color:#333;margin-bottom:8px;">Hapus Akun?</h3>
        <p style="font-size:14px;color:#888;margin-bottom:20px;">Masukkan password untuk konfirmasi. Tindakan ini tidak dapat dibatalkan!</p>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div style="margin-bottom:20px;text-align:left;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password</label>
                <input type="password" name="password" placeholder="Masukkan password kamu"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#CC4444'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->userDeletion->get('password'))
                    <p style="color:#CC4444;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->userDeletion->get('password')) }}</p>
                @endif
            </div>

            <div style="display:flex;gap:12px;">
                <button type="button"
                        onclick="document.getElementById('modal-delete-petugas').style.display='none'"
                        style="flex:1;background:#f3f4f6;color:#555;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                    ✕ Batal
                </button>
                <button type="submit"
                        style="flex:1;background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                    🗑️ Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}
</style>
<script>
document.getElementById('modal-delete-petugas').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
</script>

</x-petugas-layout>