<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Petugas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Menunggu Persetujuan</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\Peminjaman::where('status','menunggu')->count() }}
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\Peminjaman::where('status','disetujui')->count() }}
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">Total Peminjaman</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\Peminjaman::count() }}
                    </p>
                </div>
            </div>

            <!-- Menu -->
            <h3 class="text-lg font-medium text-gray-700 mb-4">Menu Petugas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('petugas.peminjaman.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-yellow-200">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-2xl">📋</div>
                    <div>
                        <p class="font-medium text-gray-800">Kelola Peminjaman</p>
                        <p class="text-sm text-gray-500">Setujui atau tolak pengajuan</p>
                    </div>
                </a>
                <a href="{{ route('petugas.pengembalian.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-blue-200">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-2xl">🔄</div>
                    <div>
                        <p class="font-medium text-gray-800">Monitor Pengembalian</p>
                        <p class="text-sm text-gray-500">Pantau alat yang belum dikembalikan</p>
                    </div>
                </a>
            </div>

            <!-- Pengajuan Terbaru -->
            <h3 class="text-lg font-medium text-gray-700 mt-8 mb-4">Pengajuan Terbaru</h3>
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse(\App\Models\Peminjaman::with(['user','alat'])->latest()->take(5)->get() as $p)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $p->user->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $p->alat->nama_alat }}</td>
                            <td class="px-4 py-3">
                                @php $badge = match($p->status) {
                                    'menunggu' => 'bg-yellow-100 text-yellow-700',
                                    'disetujui' => 'bg-green-100 text-green-700',
                                    'ditolak' => 'bg-red-100 text-red-700',
                                    'dikembalikan' => 'bg-blue-100 text-blue-700',
                                    default => 'bg-gray-100 text-gray-700'
                                }; @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $badge }}">{{ ucfirst($p->status) }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('petugas.peminjaman.show', $p) }}" class="text-indigo-600 text-sm hover:underline">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-4 py-3 text-center text-gray-400 text-sm">Belum ada peminjaman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>