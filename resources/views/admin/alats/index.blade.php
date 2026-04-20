<x-admin-layout>
<x-slot name="header">Kelola Alat</x-slot>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h3 style="font-size:20px;font-weight:700;color:#333;">Daftar Alat</h3>
        <p style="font-size:13px;color:#888;margin-top:2px;">Kelola semua alat yang tersedia untuk dipinjam</p>
    </div>
    <a href="{{ route('admin.alats.create') }}"
       style="background:#F075AE;color:white;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">
        + Tambah Alat
    </a>
</div>

@if(session('success'))
    <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;">
        ✓ {{ session('success') }}
    </div>
@endif

<div style="background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:linear-gradient(90deg,#A8DF8E,#8cc970);">
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">No</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Foto</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Nama Alat</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Kode</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Kategori</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Total</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Tersedia</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Kondisi</th>
                <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alats as $i => $alat)
            <tr style="border-bottom:1px solid #f3f4f6;{{ $i % 2 == 0 ? '' : 'background:#fafafa;' }}">
                <td style="padding:14px 16px;font-size:14px;color:#555;">{{ $i+1 }}</td>
                <td style="padding:14px 16px;">
                    @if($alat->foto)
                        <img src="{{ Storage::url($alat->foto) }}" style="width:48px;height:48px;object-fit:cover;border-radius:10px;border:2px solid #A8DF8E;">
                    @else
                        <div style="width:48px;height:48px;background:#f3f4f6;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:11px;color:#aaa;">No foto</div>
                    @endif
                </td>
                <td style="padding:14px 16px;font-size:15px;font-weight:600;color:#333;">{{ $alat->nama_alat }}</td>
                <td style="padding:14px 16px;font-size:14px;color:#666;">{{ $alat->kode_alat }}</td>
                <td style="padding:14px 16px;font-size:14px;color:#666;">{{ $alat->kategori->nama_kategori }}</td>
                <td style="padding:14px 16px;font-size:14px;color:#666;">{{ $alat->jumlah_total }}</td>
                <td style="padding:14px 16px;font-size:14px;color:#666;">{{ $alat->jumlah_tersedia }}</td>
                <td style="padding:14px 16px;">
                    <span style="padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;
                        {{ $alat->kondisi === 'baik' ? 'background:#d1fae5;color:#065f46;' :
                           ($alat->kondisi === 'rusak' ? 'background:#FFD8DF;color:#c0446a;' : 'background:#fef9c3;color:#854d0e;') }}">
                        {{ ucfirst($alat->kondisi) }}
                    </span>
                </td>
                <td style="padding:14px 16px;">
                    <div style="display:flex;gap:8px;">
                        <a href="{{ route('admin.alats.edit', $alat) }}"
                           style="background:#A8DF8E;color:#2d5a1a;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;">
                            ✏️ Edit
                        </a>
                        <button onclick="showModal('{{ $alat->id }}', '{{ $alat->nama_alat }}')"
                                style="background:#FFD8DF;color:#c0446a;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;">
                            🗑️ Hapus
                        </button>
                        <form id="form-hapus-{{ $alat->id }}" action="{{ route('admin.alats.destroy', $alat) }}" method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="padding:40px;text-align:center;color:#aaa;font-size:14px;">
                    Belum ada alat. Klik "+ Tambah Alat" untuk mulai.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-hapus" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:20px;padding:36px 32px;max-width:420px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.15);text-align:center;animation:popIn .2s ease;">
        <div style="width:72px;height:72px;background:linear-gradient(135deg,#FFD8DF,#F075AE);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 20px;">
            🗑️
        </div>
        <h3 style="font-size:20px;font-weight:700;color:#333;margin-bottom:8px;">Hapus Alat?</h3>
        <p style="font-size:14px;color:#888;margin-bottom:6px;">Kamu akan menghapus alat:</p>
        <div style="background:#FFD8DF;border-radius:10px;padding:10px 16px;margin-bottom:20px;">
            <p id="nama-alat-modal" style="font-size:16px;font-weight:700;color:#c0446a;margin:0;"></p>
        </div>
        <p style="font-size:13px;color:#aaa;margin-bottom:24px;">Tindakan ini tidak dapat dibatalkan!</p>
        <div style="display:flex;gap:12px;">
            <button onclick="hideModal()"
                    style="flex:1;background:linear-gradient(135deg,#A8DF8E,#8cc970);color:#2d5a1a;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                ✕ Batal
            </button>
            <button onclick="konfirmHapus()"
                    style="flex:1;background:linear-gradient(135deg,#F075AE,#d4609a);color:white;padding:13px;border-radius:12px;font-size:15px;font-weight:700;border:none;cursor:pointer;">
                🗑️ Hapus
            </button>
        </div>
    </div>
</div>

<style>
@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
</style>

<script>
let currentId = null;

function showModal(id, nama) {
    currentId = id;
    document.getElementById('nama-alat-modal').textContent = nama;
    const modal = document.getElementById('modal-hapus');
    modal.style.display = 'flex';
}

function hideModal() {
    document.getElementById('modal-hapus').style.display = 'none';
    currentId = null;
}

function konfirmHapus() {
    if (currentId) {
        document.getElementById('form-hapus-' + currentId).submit();
    }
}

document.getElementById('modal-hapus').addEventListener('click', function(e) {
    if (e.target === this) hideModal();
});
</script>

</x-admin-layout>