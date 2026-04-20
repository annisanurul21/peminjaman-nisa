<x-petugas-layout>
<x-slot name="header">Input Denda</x-slot>

@if(session('warning'))
    <div style="background:#fef3c7;border:1px solid #fcd34d;color:#92400e;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
        ⚠️ {{ session('warning') }}
    </div>
@endif

<div style="max-width:620px;">
    <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 2px 10px rgba(0,0,0,0.07);">

        <!-- Info Peminjaman -->
        <div style="background:#fff5f5;border:1px solid #ffcaca;border-radius:12px;padding:16px;margin-bottom:20px;">
            <h3 style="font-size:14px;font-weight:700;color:#CC4444;margin-bottom:10px;">📋 Informasi Pengembalian</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:13px;">
                <div><span style="color:#999;">Peminjam:</span> <strong>{{ $peminjaman->user->name }}</strong></div>
                <div><span style="color:#999;">Alat:</span> <strong>{{ $peminjaman->alat->nama_alat }}</strong></div>
                <div><span style="color:#999;">Tgl Kembali:</span> <strong>{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</strong></div>
                <div><span style="color:#999;">Terlambat:</span>
                    <strong style="color:#CC4444;">{{ $hari_terlambat }} hari</strong>
                </div>
            </div>
        </div>

        <form action="{{ route('petugas.denda.store', $peminjaman) }}" method="POST">
            @csrf

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:6px;">Jenis Denda</label>
                <select name="jenis" required onchange="hitungDenda(this.value)"
                        style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:11px 14px;font-size:14px;outline:none;">
                    <option value="">-- Pilih Jenis Denda --</option>
                    <option value="terlambat" {{ $hari_terlambat > 0 ? 'selected' : '' }}>⏰ Keterlambatan ({{ $hari_terlambat }} hari)</option>
                    <option value="kehilangan">🔍 Kehilangan Aksesoris/Barang</option>
                    <option value="kerusakan">🔧 Kerusakan Alat</option>
                </select>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:6px;">
                    Nominal Denda (Rp)
                    <span style="font-weight:400;color:#999;font-size:12px;">— Terlambat: Rp 5.000/hari otomatis</span>
                </label>
                <input type="number" name="nominal_denda" id="nominal_denda"
                       value="{{ $hari_terlambat > 0 ? $hari_terlambat * 5000 : '' }}"
                       min="1000" required
                       style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:11px 14px;font-size:14px;outline:none;"
                       placeholder="Contoh: 25000">
                <p id="preview_nominal" style="font-size:13px;color:#CC4444;margin-top:4px;font-weight:700;"></p>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:6px;">
                    Keterangan Petugas
                    <span style="font-weight:400;color:#999;">(opsional)</span>
                </label>
                <textarea name="keterangan_petugas" rows="3"
                          style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:11px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;resize:vertical;"
                          placeholder="Contoh: Terlambat 5 hari, kehilangan charger laptop merk Dell..."></textarea>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit"
                        style="flex:1;background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                    💾 Simpan Denda
                </button>
                <a href="{{ route('petugas.denda.index') }}"
                   style="flex:1;background:#f3f4f6;color:#374151;padding:13px;border-radius:12px;font-size:15px;font-weight:600;text-decoration:none;text-align:center;">
                    ← Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
const hariTerlambat = {{ $hari_terlambat }};
function hitungDenda(jenis) {
    const input = document.getElementById('nominal_denda');
    if (jenis === 'terlambat' && hariTerlambat > 0) {
        input.value = hariTerlambat * 5000;
        updatePreview();
    }
}
function updatePreview() {
    const val = document.getElementById('nominal_denda').value;
    const preview = document.getElementById('preview_nominal');
    if (val) {
        preview.textContent = '= Rp ' + parseInt(val).toLocaleString('id-ID');
    } else {
        preview.textContent = '';
    }
}
document.getElementById('nominal_denda').addEventListener('input', updatePreview);
updatePreview();
</script>

</x-petugas-layout>