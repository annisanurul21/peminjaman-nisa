<div style="padding-bottom:16px;margin-bottom:20px;border-bottom:2px solid #FFD8DF;">
    <h3 style="font-size:18px;font-weight:700;color:#c0446a;">🗑️ Hapus Akun</h3>
    <p style="font-size:13px;color:#888;margin-top:4px;">Setelah akun dihapus, semua data akan hilang permanen</p>
</div>

<p style="font-size:14px;color:#666;margin-bottom:20px;">
    Pastikan kamu sudah mengunduh semua data sebelum menghapus akun ini.
</p>

<button onclick="document.getElementById('modal-delete-account').style.display='flex'"
        style="background:linear-gradient(135deg,#F075AE,#d4609a);color:white;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;">
    🗑️ Hapus Akun
</button>

<!-- Modal Konfirmasi -->
<div id="modal-delete-account" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:20px;padding:36px 32px;max-width:420px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.15);text-align:center;animation:popIn .2s ease;">

        <div style="width:72px;height:72px;background:linear-gradient(135deg,#FFD8DF,#F075AE);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 20px;">
            🗑️
        </div>

        <h3 style="font-size:20px;font-weight:700;color:#333;margin-bottom:8px;">Hapus Akun?</h3>
        <p style="font-size:14px;color:#888;margin-bottom:20px;">Masukkan password untuk konfirmasi penghapusan akun. Tindakan ini tidak dapat dibatalkan!</p>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div style="margin-bottom:20px;text-align:left;">
                <label style="display:block;font-size:13px;font-weight:600;color:#555;margin-bottom:6px;">Password</label>
                <input type="password" name="password" placeholder="Masukkan password kamu"
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;"
                       onfocus="this.style.borderColor='#F075AE'" onblur="this.style.borderColor='#e5e7eb'">
                @if($errors->userDeletion->get('password'))
                    <p style="color:#c0446a;font-size:12px;margin-top:4px;">{{ implode(', ', $errors->userDeletion->get('password')) }}</p>
                @endif
            </div>

            <div style="display:flex;gap:12px;">
                <button type="button"
                        onclick="document.getElementById('modal-delete-account').style.display='none'"
                        style="flex:1;background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                    ✕ Batal
                </button>
                <button type="submit"
                        style="flex:1;background:linear-gradient(135deg,#F075AE,#d4609a);color:white;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
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
document.getElementById('modal-delete-account').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
</script>