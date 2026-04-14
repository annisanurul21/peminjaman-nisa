<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Laporan Peminjaman') }}
            </h2>
            <a href="{{ route('petugas.laporan.print', request()->query()) }}" 
               target="_blank" 
               class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <div class="mb-6 rounded-xl bg-white p-6 shadow-sm border border-gray-100">
                <div class="mb-4 flex items-center border-b border-gray-50 pb-3">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-600">Filter Laporan</h3>
                </div>
                <form method="GET" action="{{ route('petugas.laporan.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-500 uppercase">Nama Peminjam</label>
                        <input type="text" name="nama" value="{{ request('nama') }}" 
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" 
                               placeholder="Cari nama...">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-500 uppercase">Status</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>
                            @foreach(['menunggu', 'disetujui', 'ditolak', 'dikembalikan'] as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-500 uppercase">Dari Tanggal</label>
                        <input type="date" name="dari" value="{{ request('dari') }}" 
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-500 uppercase">Sampai Tanggal</label>
                        <input type="date" name="sampai" value="{{ request('sampai') }}" 
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="col-span-full flex items-center gap-3 pt-2">
                        <button type="submit" class="rounded-lg bg-indigo-600 px-6 py-2 text-sm font-bold text-white transition hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('petugas.laporan.index') }}" class="rounded-lg bg-gray-100 px-6 py-2 text-sm font-bold text-gray-600 transition hover:bg-gray-200">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-4">
                @php
                    $stats = [
                        ['label' => 'Total Peminjaman', 'count' => $peminjamans->count(), 'color' => 'border-gray-400', 'text' => 'text-gray-800'],
                        ['label' => 'Menunggu', 'count' => $peminjamans->where('status','menunggu')->count(), 'color' => 'border-yellow-400', 'text' => 'text-yellow-600'],
                        ['label' => 'Disetujui', 'count' => $peminjamans->where('status','disetujui')->count(), 'color' => 'border-green-400', 'text' => 'text-green-600'],
                        ['label' => 'Dikembalikan', 'count' => $peminjamans->where('status','dikembalikan')->count(), 'color' => 'border-blue-400', 'text' => 'text-blue-600'],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="rounded-xl border-l-4 bg-white p-4 shadow-sm {{ $stat['color'] }}">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">{{ $stat['label'] }}</p>
                        <p class="mt-1 text-2xl font-black {{ $stat['text'] }}">{{ $stat['count'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">No</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Peminjam</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Alat</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Jumlah</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Periode</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($peminjamans as $i => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-400">{{ $i + 1 }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="font-bold text-gray-900">{{ $p->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $p->user->nisn }} • {{ $p->user->kelas }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-700">
                                        {{ $p->alat->nama_alat }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $p->jumlah_pinjam }} <span class="text-xs text-gray-400">Unit</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div class="flex flex-col">
                                            <span>{{ $p->tanggal_pinjam->format('d/m/Y') }}</span>
                                            <span class="text-xs text-gray-400">s/d {{ $p->tanggal_kembali->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $badge = match($p->status) {
                                                'menunggu'     => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                                'disetujui'    => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                'ditolak'      => 'bg-red-50 text-red-700 border-red-100',
                                                'dikembalikan' => 'bg-blue-50 text-blue-700 border-blue-100',
                                                default        => 'bg-gray-50 text-gray-700 border-gray-100'
                                            };
                                        @endphp
                                        <span class="inline-flex rounded-full border px-2.5 py-0.5 text-xs font-bold {{ $badge }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <p class="text-sm font-medium text-gray-400">Tidak ada data laporan ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>