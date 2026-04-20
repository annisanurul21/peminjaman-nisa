<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Bayar Denda</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div style="background:white;border-radius:16px;padding:28px;box-shadow:0 2px 10px rgba(0,0,0,0.07);">

                <!-- Info Denda -->
                <div style="background:#fff5f5;border:1px solid #ffcaca;border-radius:12px;padding:16px;margin-bottom:20px;">
                    <h3 style="font-size:14px;font-weight:700;color:#CC4444;margin-bottom:10px;">💸 Detail Tagihan</h3>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:13px;">
                        <div><span style="color:#999;">Alat:</span> <strong>{{ $denda->peminjaman->alat->nama_alat }}</strong></div>
                        <div><span style="color:#999;">Jenis:</span> <strong>{{ ucfirst($denda->jenis) }}</strong></div>
                        @if($denda->hari_terlambat > 0)
                        <div><span style="color:#999;">Terlambat:</span> <strong>{{ $denda->hari_terlambat }} hari</strong></div>
                        @endif
                        <div><span style="color:#999;">Nominal:</span> <strong style="color:#CC4444;font-size:15px;">{{ $denda->nominal_format }}</strong></div>
                    </div>
                    @if($denda->keterangan_petugas)
                    <div style="margin-top:10px;padding-top:10px;border-top:1px solid #ffcaca;">
                        <p style="font-size:12px;color:#999;">Keterangan petugas:</p>
                        <p style="font-size:13px;color:#333;">{{ $denda->keterangan_petugas }}</p>
                    </div>
                    @endif
                </div>

                @if($errors->any())
                <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                    <ul style="padding-left:16px;margin:0;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form action="{{ route('user.denda.submit', $denda) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Alasan -->
                    <div style="margin-bottom:18px;">
                        <label style="display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:6px;">
                            📝 Alasan / Penjelasan <span style="color:#CC4444;">*</span>
                        </label>
                        <textarea name="alasan_user" rows="5" required
                                  style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:12px 14px;font-size:14px;outline:none;font-family:'Figtree',sans-serif;resize:vertical;"
                                  placeholder="Jelaskan kenapa terlambat / barang hilang / rusak. Tulis dengan jujur dan lengkap...">{{ old('alasan_user') }}</textarea>
                        <p style="font-size:12px;color:#aaa;margin-top:4px;">Minimal 10 karakter. Jawab dengan jujur.</p>
                    </div>

                    <!-- Pilih Metode Bayar -->
                    <div style="margin-bottom:18px;">
                        <label style="display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:10px;">
                            💳 Metode Pembayaran <span style="color:#CC4444;">*</span>
                        </label>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                            <!-- Cash -->
                            <label style="cursor:pointer;">
                                <input type="radio" name="metode_bayar" value="cash" onchange="toggleQris(false)"
                                       style="display:none;" {{ old('metode_bayar')=='cash'?'checked':'' }}>
                                <div id="card-cash"
                                     style="border:2px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center;transition:all .2s;"
                                     onclick="selectMetode('cash')">
                                    <div style="font-size:28px;margin-bottom:8px;">💵</div>
                                    <p style="font-weight:700;color:#333;font-size:14px;">Cash / Tunai</p>
                                    <p style="font-size:12px;color:#888;margin-top:4px;">Bayar langsung ke petugas</p>
                                </div>
                            </label>
                            <!-- QRIS -->
                            <label style="cursor:pointer;">
                                <input type="radio" name="metode_bayar" value="qris" onchange="toggleQris(true)"
                                       style="display:none;" {{ old('metode_bayar')=='qris'?'checked':'' }}>
                                <div id="card-qris"
                                     style="border:2px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center;transition:all .2s;"
                                     onclick="selectMetode('qris')">
                                    <div style="font-size:28px;margin-bottom:8px;">📱</div>
                                    <p style="font-weight:700;color:#333;font-size:14px;">QRIS</p>
                                    <p style="font-size:12px;color:#888;margin-top:4px;">Scan & upload bukti bayar</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- QRIS Info -->
                    <div id="qris-section" style="display:none;margin-bottom:18px;">
                        <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:16px;margin-bottom:12px;text-align:center;">
                            <p style="font-size:13px;font-weight:700;color:#1e40af;margin-bottom:8px;">📱 Scan QRIS Berikut</p>
                            <!-- Ganti dengan gambar QRIS sekolah -->
                            <div style="background:#e5e7eb;border-radius:8px;padding:40px;display:inline-block;margin:8px 0;">
                                <p style="color:#888;font-size:13px;">[ Gambar QRIS Sekolah ]</p>
                                <p style="color:#555;font-size:12px;margin-top:4px;">Tambahkan file QRIS di public/qris.png</p>
                            </div>
                            <p style="font-size:13px;color:#1e40af;margin-top:8px;">
                                Nominal: <strong style="font-size:16px;">{{ $denda->nominal_format }}</strong>
                            </p>
                        </div>
                        <div>
                            <label style="display:block;font-size:13px;font-weight:700;color:#444;margin-bottom:6px;">
                                📸 Upload Bukti Pembayaran QRIS <span style="color:#CC4444;">*</span>
                            </label>
                            <input type="file" name="bukti_bayar" accept="image/*"
                                   style="width:100%;border:2px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:14px;">
                            <p style="font-size:12px;color:#aaa;margin-top:4px;">Format: JPG, PNG. Maks 2MB.</p>
                        </div>
                    </div>

                    <button type="submit"
                            style="width:100%;background:linear-gradient(135deg,#CC4444,#aa3333);color:white;padding:14px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;margin-top:8px;">
                        💸 Kirim Pembayaran
                    </button>
                </form>

                <a href="{{ route('user.denda.index') }}"
                   style="display:block;text-align:center;background:#f3f4f6;color:#374151;padding:11px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;margin-top:12px;">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
let selected = null;
function selectMetode(m) {
    selected = m;
    document.querySelector('input[value="cash"]').checked = m === 'cash';
    document.querySelector('input[value="qris"]').checked = m === 'qris';
    document.getElementById('card-cash').style.borderColor = m === 'cash' ? '#CC4444' : '#e5e7eb';
    document.getElementById('card-cash').style.background = m === 'cash' ? '#fff5f5' : 'white';
    document.getElementById('card-qris').style.borderColor = m === 'qris' ? '#3b82f6' : '#e5e7eb';
    document.getElementById('card-qris').style.background = m === 'qris' ? '#eff6ff' : 'white';
    document.getElementById('qris-section').style.display = m === 'qris' ? 'block' : 'none';
}
</script>