<div style="padding-bottom:16px;margin-bottom:20px;border-bottom:2px solid #f3f4f6;">
    <h3 style="font-size:18px;font-weight:700;color:#333;">⚙️ Informasi Profil</h3>
    <p style="font-size:13px;color:#888;margin-top:4px;">Perbarui nama dan alamat email akunmu</p>
</div>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div style="margin-bottom:16px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus
               style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
               onfocus="this.style.borderColor='#A8DF8E'" onblur="this.style.borderColor='#e5e7eb'">
        @if($errors->get('name'))
            <p style="color:#c0446a;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->get('name')) }}</p>
        @endif
    </div>

    <div style="margin-bottom:24px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
               style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
               onfocus="this.style.borderColor='#A8DF8E'" onblur="this.style.borderColor='#e5e7eb'">
        @if($errors->get('email'))
            <p style="color:#c0446a;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->get('email')) }}</p>
        @endif

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div style="margin-top:8px;background:#FFD8DF;padding:10px 14px;border-radius:8px;">
                <p style="font-size:13px;color:#c0446a;">Email belum terverifikasi.
                    <button form="send-verification" style="background:none;border:none;color:#c0446a;font-weight:700;cursor:pointer;text-decoration:underline;">
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
                style="background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
            💾 Simpan
        </button>
        @if (session('status') === 'profile-updated')
            <p style="font-size:13px;color:#065f46;font-weight:600;">✓ Tersimpan!</p>
        @endif
    </div>
</form>