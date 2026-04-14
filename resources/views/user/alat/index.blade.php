<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Alat Tersedia</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($alats as $alat)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    @if($alat->foto)
                        <img src="{{ Storage::url($alat->foto) }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Tidak ada foto</span>
                        </div>
                    @endif
                    <div class="p-5">
                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">
                            {{ $alat->kategori->nama_kategori }}
                        </span>
                        <h3 class="font-semibold text-gray-800 mt-3 text-lg">{{ $alat->nama_alat }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Kode: {{ $alat->kode_alat }}</p>
                        <p class="text-sm text-gray-500">Kondisi: <span class="text-green-600 font-medium">{{ ucfirst($alat->kondisi) }}</span></p>
                        <p class="text-sm text-gray-500">Tersedia: <span class="text-green-600 font-bold">{{ $alat->jumlah_tersedia }}</span> unit</p>
                        @if($alat->deskripsi)
                            <p class="text-sm text-gray-400 mt-2">{{ Str::limit($alat->deskripsi, 80) }}</p>
                        @endif
                        <a href="{{ route('user.peminjaman.create', $alat->id) }}"
                           class="mt-4 block text-center bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                            Pinjam Alat
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16">
                    <p class="text-gray-400 text-lg">Tidak ada alat yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>