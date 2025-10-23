<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 text-left">ID Pesanan</th>
                                    <th class="py-2 px-4 text-left">Tanggal</th>
                                    <th class="py-2 px-4 text-left">Produk</th>
                                    <th class="py-2 px-4 text-left">Total</th>
                                    <th class="py-2 px-4 text-left">Status</th>
                                    <th class="py-2 px-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">#{{ $order->id }}</td>
                                        <td class="py-2 px-4">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="py-2 px-4">{{ $order->product ? $order->product->name : '[Produk Dihapus]' }}</td>
                                        <td class="py-2 px-4">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 capitalize">{{ $order->status }}</td>
                                        <td class="py-2 px-4">
                                            <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-900">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 text-center">Anda belum memiliki riwayat pesanan.</td>
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