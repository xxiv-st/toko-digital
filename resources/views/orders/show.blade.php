<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #' . $order->id) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold">Pesanan Berhasil Dibuat!</strong>
                        <span class="block sm:inline">Silakan selesaikan pembayaran Anda.</span>
                    </div>

                    <h3 class="text-lg font-medium">Produk yang Dipesan:</h3>
                    
                    {{-- Pengecekan jika produk masih ada --}}
                    @if ($order->product)
                        <div class="mt-4 flex items-center border-b pb-4">
                            <img src="{{ asset('storage/' . $order->product->cover_image_path) }}" alt="{{ $order->product->name }}" class="h-20 w-20 object-cover rounded">
                            <div class="ml-4">
                                <p class="font-semibold">{{ $order->product->name }}</p>
                                <p class="text-gray-600">Total Harga: <strong>Rp {{ number_format($order->amount, 0, ',', '.') }}</strong></p>
                                <p class="text-sm text-gray-500">Status: <span class="font-bold capitalize">{{ $order->status }}</span></p>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 border-b pb-4">
                            <p class="text-red-600 font-semibold">[Produk untuk pesanan ini telah dihapus]</p>
                            <p class="text-gray-600">Total Harga: <strong>Rp {{ number_format($order->amount, 0, ',', '.') }}</strong></p>
                            <p class="text-sm text-gray-500">Status: <span class="font-bold capitalize">{{ $order->status }}</span></p>
                        </div>
                    @endif

                    @if ($order->status == 'pending')
                    <h3 class="text-lg font-medium mt-6">Instruksi Pembayaran:</h3>
                    <div class="mt-4 p-4 bg-gray-50 rounded-md">
                        <p>Silakan lakukan transfer ke rekening berikut:</p>
                        <p class="mt-2"><strong>Bank Central Asia (BCA)</strong></p>
                        <p>No. Rekening: <strong>123-456-7890</strong></p>
                        <p>Atas Nama: <strong>Toko Digital Sederhana</strong></p>
                        <p class="mt-4 text-sm text-red-600">PENTING: Admin akan memverifikasi pembayaran secara manual. Pesanan Anda akan diproses setelah pembayaran dikonfirmasi.</p>
                    </div>
                    @elseif ($order->status == 'completed' && $order->product && $order->product->file_path)
                    <h3 class="text-lg font-medium mt-6">File Anda:</h3>
                    <div class="mt-4">
                        <a href="{{ route('orders.download', $order) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Download {{ $order->product->name }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>