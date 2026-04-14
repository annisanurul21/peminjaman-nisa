<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500">Total Peminjaman</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPinjam }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Menunggu Persetujuan</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $menunggu }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Disetujui</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $disetujui }}</p>
                </div>
            </div>

            <!-- Menu -->
            <h3 class="text-lg font-medium text-gray-700 mb-4">Menu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('user.alat.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-indigo-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-2xl">🔧</div>
                    <div>
                        <p class="font-medium text-gray-800">Daftar Alat</p>
                        <p class="text-sm text-gray-500">Lihat & pinjam alat tersedia</p>
                    </div>
                </a>
                <a href="{{ route('user.peminjaman.riwayat') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-green-200">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-2xl">📋</div>
                    <div>
                        <p class="font-medium text-gray-800">Riwayat Peminjaman</p>
                        <p class="text-sm text-gray-500">Cek status peminjaman kamu</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>