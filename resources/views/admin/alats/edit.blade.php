<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Alat: {{ $alat->nama_alat }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('admin.alats.update', $alat) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id',$alat->kategori_id)==$kat->id?'selected':'' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Alat</label>
                        <input type="text" name="nama_alat" value="{{ old('nama_alat',$alat->nama_alat) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Alat</label>
                        <input type="text" name="kode_alat" value="{{ old('kode_alat',$alat->kode_alat) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Total</label>
                        <input type="number" name="jumlah_total" value="{{ old('jumlah_total',$alat->jumlah_total) }}" min="1"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                        <select name="kondisi" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="baik" {{ old('kondisi',$alat->kondisi)=='baik'?'selected':'' }}>Baik</option>
                            <option value="rusak" {{ old('kondisi',$alat->kondisi)=='rusak'?'selected':'' }}>Rusak</option>
                            <option value="perbaikan" {{ old('kondisi',$alat->kondisi)=='perbaikan'?'selected':'' }}>Perbaikan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (opsional)</label>
                        <textarea name="deskripsi" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('deskripsi',$alat->deskripsi) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Alat (opsional)</label>
                        @if($alat->foto)
                            <img src="{{ Storage::url($alat->foto) }}" class="w-24 h-24 object-cover rounded-lg mb-2">
                        @endif
                        <input type="file" name="foto" accept="image/*"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-indigo-700">Update Alat</button>
                        <a href="{{ route('admin.alats.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>