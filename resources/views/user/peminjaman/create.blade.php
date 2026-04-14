<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Form Pengajuan Peminjaman</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <!-- Info Alat -->
                <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-6">
                    <p class="text-sm font-medium text-indigo-800">Alat yang dipinjam:</p>
                    <p class="text-lg font-bold text-indigo-900">{{ $alat->nama_alat }}</p>
                    <p class="text-sm text-indigo-700">Kode: {{ $alat->kode_alat }}</p>
                    <p class="text-sm text-indigo-700">Tersedia: {{ $alat->jumlah_tersedia }} unit</p>
                </div>

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc pl-4">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.peminjaman.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Peminjam</label>
                        <input type="text" value="{{ auth()->user()->name }}" disabled
                               class="w-full border border-gray-200 bg-gray-50 rounded-lg px-3 py-2 text-sm text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pinjam</label>
                        <input type="number" name="jumlah_pinjam" value="{{ old('jumlah_pinjam', 1) }}"
                               min="1" max="{{ $alat->jumlah_tersedia }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <p class="text-xs text-gray-400 mt-1">Maksimal {{ $alat->jumlah_tersedia }} unit</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}"
               min="{{ date('Y-m-d') }}"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        <p class="text-xs text-gray-400 mt-1">Jam pinjam: 07.00</p>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
               min="{{ date('Y-m-d') }}"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        <p class="text-xs text-gray-400 mt-1">Batas kembali: 15.00</p>
    </div>
</div>

<!-- Info batas waktu -->
<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
    <p class="text-xs text-yellow-700">⏰ <strong>Perhatian:</strong> Peminjaman hanya berlaku dari jam 07.00 sampai 15.00 (jam pulang sekolah). Harap kembalikan alat tepat waktu.</p>
</div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan (opsional)</label>
                        <textarea name="keperluan" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                  placeholder="Untuk keperluan apa alat ini dipinjam?">{{ old('keperluan') }}</textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                style="background-color:#4F46E5;color:white;padding:8px 24px;border-radius:8px;font-size:14px;font-weight:500;border:none;cursor:pointer;">
                            Kirim Pengajuan
                        </button>
                        <a href="{{ route('user.alat.index') }}"
                           style="background-color:#F3F4F6;color:#374151;padding:8px 24px;border-radius:8px;font-size:14px;text-decoration:none;">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>