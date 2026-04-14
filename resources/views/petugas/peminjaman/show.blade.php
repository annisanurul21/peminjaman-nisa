<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Pengajuan Peminjaman</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">

                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-medium text-gray-700 mb-3">Informasi Peminjam</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><p class="text-gray-500">Nama</p><p class="font-medium">{{ $peminjaman->user->name }}</p></div>
                        <div><p class="text-gray-500">NISN</p><p class="font-medium">{{ $peminjaman->user->nisn ?? '-' }}</p></div>
                        <div><p class="text-gray-500">Kelas</p><p class="font-medium">{{ $peminjaman->user->kelas ?? '-' }}</p></div>
                        <div><p class="text-gray-500">No. HP</p><p class="font-medium">{{ $peminjaman->no_hp }}</p></div>
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-lg p-4">
                    <h3 class="font-medium text-gray-700 mb-3">Informasi Alat</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><p class="text-gray-500">Nama Alat</p><p class="font-medium">{{ $peminjaman->alat->nama_alat }}</p></div>
                        <div><p class="text-gray-500">Jumlah</p><p class="font-medium">{{ $peminjaman->jumlah_pinjam }} unit</p></div>
                        <div><p class="text-gray-500">Tgl Pinjam</p><p class="font-medium">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</p></div>
                        <div><p class="text-gray-500">Tgl Kembali</p><p class="font-medium">{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</p></div>
                        <div class="col-span-2"><p class="text-gray-500">Keperluan</p><p class="font-medium">{{ $peminjaman->keperluan ?? '-' }}</p></div>
                    </div>
                </div>

                @if($peminjaman->status === 'menunggu')
                <div class="border-t pt-4 space-y-3">
                    <form action="{{ route('petugas.peminjaman.setujui', $peminjaman) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="block text-sm text-gray-600 mb-1">Catatan (opsional)</label>
                            <textarea name="catatan_petugas" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="Catatan untuk peminjam..."></textarea>
                        </div>
                        <button type="submit" style="width:100%;background:#16A34A;color:white;padding:10px;border-radius:8px;font-size:14px;border:none;cursor:pointer;" onclick="return confirm('Setujui peminjaman ini?')">
                            ✓ Setujui Peminjaman
                        </button>
                    </form>
                    <form action="{{ route('petugas.peminjaman.tolak', $peminjaman) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="block text-sm text-gray-600 mb-1">Alasan penolakan</label>
                            <textarea name="catatan_petugas" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="Alasan penolakan..."></textarea>
                        </div>
                        <button type="submit" style="width:100%;background:#DC2626;color:white;padding:10px;border-radius:8px;font-size:14px;border:none;cursor:pointer;" onclick="return confirm('Tolak peminjaman ini?')">
                            ✕ Tolak Peminjaman
                        </button>
                    </form>
                </div>
                @else
                <div class="border-t pt-4 bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Status: <strong>{{ ucfirst($peminjaman->status) }}</strong></p>
                    @if($peminjaman->catatan_petugas)
                        <p class="text-sm text-gray-500 mt-1">Catatan: {{ $peminjaman->catatan_petugas }}</p>
                    @endif
                </div>
                @endif

                <a href="{{ route('petugas.peminjaman.index') }}" style="display:block;text-align:center;background:#F3F4F6;color:#374151;padding:10px;border-radius:8px;font-size:14px;text-decoration:none;">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>