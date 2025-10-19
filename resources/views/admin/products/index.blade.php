<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        + Tambah Produk
                    </a>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="w-1/4 py-2 px-4 text-left">Gambar</th>
                                    <th class="w-1/4 py-2 px-4 text-left">Nama Produk</th>
                                    <th class="w-1/4 py-2 px-4 text-left">Harga</th>
                                    <th class="w-1/4 py-2 px-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">
                                            <img src="{{ asset('storage/' . $product->cover_image_path) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
                                        </td>
                                    <td class="py-2 px-4">{{ $product->name }}</td>
                                    <td class="py-2 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            
                                {{-- INI BAGIAN YANG DIPERBAIKI --}}
                                    <td class="py-2 px-4 whitespace-nowrap">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-yellow-600 hover:text-yellow-900">
                                         Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
            
                            </tr>
                        @empty
                             <tr>
                                <td colspan="4" class="py-4 px-4 text-center">Belum ada data produk.</td>
                            </tr>
                         @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>