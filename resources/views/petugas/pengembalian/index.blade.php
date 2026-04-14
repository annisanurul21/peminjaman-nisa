<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Monitor Pengembalian Alat</h2>
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
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Batas Kembali</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($peminjamans as $i => $p)
                        @php $terlambat = $p->tanggal_kembali->isPast() && $p->status === 'disetujui'; @endphp
                        <tr class="{{ $terlambat ? 'bg-red-50' : '' }}">
                            <td class="px-4 py-4 text-sm">{{ $i+1 }}</td>
                            <td class="px-4 py-4 text-sm">
                                <p class="font-medium text-gray-900">{{ $p->user->name }}</p>
                                <p class="text-gray-500 text-xs">{{ $p->user->nisn }}</p>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-900">{{ $p->alat->nama_alat }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $p->jumlah_pinjam }} unit</td>
                            <td class="px-4 py-4 text-sm {{ $terlambat ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                {{ $p->tanggal_kembali->format('d/m/Y') }}
                                @if($terlambat) <span class="text-xs">(Terlambat!)</span> @endif
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Dipinjam</span>
                            </td>
                            <td class="px-4 py-4">
                                <form action="{{ route('petugas.pengembalian.proses', $p) }}" method="POST"
                                      onsubmit="return confirm('Konfirmasi pengembalian alat ini?')">
                                    @csrf
                                    <button type="submit"
                                            style="background-color:#2563EB;color:white;padding:6px 12px;border-radius:6px;font-size:12px;border:none;cursor:pointer;">
                                        Konfirmasi Kembali
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="px-6 py-4 text-center text-gray-400">Tidak ada alat yang sedang dipinjam.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>