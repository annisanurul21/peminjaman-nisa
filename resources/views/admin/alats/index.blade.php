<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Kelola Alat</h2>
            <a href="{{ route('admin.alats.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">+ Tambah Alat</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Alat</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tersedia</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($alats as $i => $alat)
                        <tr>
                            <td class="px-4 py-4 text-sm">{{ $i+1 }}</td>
                            <td class="px-4 py-4">
                                @if($alat->foto)
                                    <img src="{{ Storage::url($alat->foto) }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">No foto</div>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $alat->nama_alat }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $alat->kode_alat }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $alat->kategori->nama_kategori }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $alat->jumlah_total }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $alat->jumlah_tersedia }}</td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $alat->kondisi === 'baik' ? 'bg-green-100 text-green-700' :
                                       ($alat->kondisi === 'rusak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($alat->kondisi) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm flex gap-2">
                                <a href="{{ route('admin.alats.edit', $alat) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.alats.destroy', $alat) }}" method="POST"
                                      onsubmit="return confirm('Hapus alat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9" class="px-6 py-4 text-center text-gray-400">Belum ada alat. Silakan tambah alat terlebih dahulu.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>