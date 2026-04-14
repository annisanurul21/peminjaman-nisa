<x-admin-layout>
    <x-slot name="header">Kelola Kategori Alat</x-slot>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <div>
            <h3 style="font-size:20px;font-weight:700;color:#333;">Daftar Kategori</h3>
            <p style="font-size:13px;color:#888;margin-top:2px;">Kelola semua kategori alat peminjaman</p>
        </div>
        <a href="{{ route('admin.kategoris.create') }}"
           style="background:#F075AE;color:white;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;">
            + Tambah Kategori
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
                    <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Nama Kategori</th>
                    <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Deskripsi</th>
                    <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Jumlah Alat</th>
                    <th style="padding:14px 16px;text-align:left;font-size:13px;font-weight:700;color:white;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $i => $kat)
                <tr style="border-bottom:1px solid #f3f4f6;{{ $i % 2 == 0 ? '' : 'background:#fafafa;' }}">
                    <td style="padding:14px 16px;font-size:14px;color:#555;">{{ $i+1 }}</td>
                    <td style="padding:14px 16px;font-size:14px;font-weight:600;color:#333;">{{ $kat->nama_kategori }}</td>
                    <td style="padding:14px 16px;font-size:14px;color:#666;">{{ $kat->deskripsi ?? '-' }}</td>
                    <td style="padding:14px 16px;">
                        <span style="background:#FFD8DF;color:#c0446a;padding:4px 12px;border-radius:20px;font-size:13px;font-weight:600;">
                            {{ $kat->alats_count }} alat
                        </span>
                    </td>
                    <td style="padding:14px 16px;display:flex;gap:8px;">
                        <a href="{{ route('admin.kategoris.edit', $kat) }}"
                           style="background:#A8DF8E;color:#2d5a1a;padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;">
                            Edit
                        </a>
                        <form action="{{ route('admin.kategoris.destroy', $kat) }}" method="POST"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button style="background:#FFD8DF;color:#c0446a;padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:40px;text-align:center;color:#aaa;font-size:14px;">
                        Belum ada kategori. Tambah kategori pertama!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>