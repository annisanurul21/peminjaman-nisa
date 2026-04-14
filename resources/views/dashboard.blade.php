<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500">Total Petugas & User</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\User::whereIn('role',['petugas','user'])->count() }}
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Total Petugas</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\User::where('role','petugas')->count() }}
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Total User/Peminjam</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ \App\Models\User::where('role','user')->count() }}
                    </p>
                </div>
            </div>

            <!-- Menu Navigasi Admin -->
            <h3 class="text-lg font-medium text-gray-700 mb-4">Navigasi Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <a href="{{ route('admin.users.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-indigo-200">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-2xl">👥</div>
                    <div>
                        <p class="font-medium text-gray-800">Kelola Akun</p>
                        <p class="text-sm text-gray-500">Tambah petugas & user</p>
                    </div>
                </a>

                <a href="{{ route('admin.kategoris.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-green-200">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-2xl">🗂️</div>
                    <div>
                        <p class="font-medium text-gray-800">Kelola Kategori</p>
                        <p class="text-sm text-gray-500">Kategori alat</p>
                    </div>
                </a>

                <a href="{{ route('admin.alats.index') }}"
                   class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition flex items-center gap-4 border border-transparent hover:border-yellow-200">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-2xl">🔧</div>
                    <div>
                        <p class="font-medium text-gray-800">Kelola Alat</p>
                        <p class="text-sm text-gray-500">Data alat peminjaman</p>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>