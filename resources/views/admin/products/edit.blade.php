<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk: ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"   >
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nama Produk')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Harga')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label :value="__('Gambar Sampul Saat Ini')" />
                            <img src="{{ asset('storage/' . $product->cover_image_path) }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover rounded mt-2">
                        </div>

                        <div class="mt-4">
                            <x-input-label for="cover_image" :value="__('Ganti Gambar Sampul (Opsional)')" />
                            <input type="file" id="cover_image" name="cover_image" class="block mt-1 w-full">
                        </div>

                        <div class="mt-4">
                            <x-input-label for="file_path" :value="__('Ganti File Digital (Opsional)')" />
                            <p class="text-sm text-gray-500">File saat ini: <a href="{{ asset('storage/' . $product->file_path) }}" target="_blank" class="text-blue-600">Lihat File</a></p>
                            <input type="file" id="file_path" name="file_path" class="block mt-1 w-full mt-2">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update Produk') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>