<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Detail Produk</h3>
                    <div class="mt-4 flex items-center">
                        <img src="{{ asset('storage/' . $product->cover_image_path) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded">
                        <div class="ml-4">
                            <p class="font-semibold">{{ $product->name }}</p>
                            <p class="text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('checkout.store') }}" class="mt-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <h3 class="text-lg font-medium text-gray-900">Detail Pembeli</h3>
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-100" type="text" name="name" :value="auth()->user()->name" readonly />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-100" type="email" name="email" :value="auth()->user()->email" readonly />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Konfirmasi & Buat Pesanan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>