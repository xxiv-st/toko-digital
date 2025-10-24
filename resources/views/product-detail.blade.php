<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div>
                            <img src="{{ asset('storage/' . $product->cover_image_path) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                            
                            <p class="text-2xl text-gray-800 font-semibold mb-4">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            
                            <h3 class="text-lg font-semibold mt-6 mb-2">Deskripsi Produk:</h3>
                            <div class="text-gray-700 prose max-w-none">
                                {!! nl2br(e($product->description)) !!}
                            </div>

                            <div class="mt-8">
                                <a href="{{ route('checkout.show', $product) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>