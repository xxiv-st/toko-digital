<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function indexUser() {
        $orders = Order::where('user_id', Auth::id())
        ->with('product')
        ->latest()
        ->get();

        return view('orders.index', compact("orders"));
    }
    
    public function show(Order $order) {
        if (Auth::id() != $order->user_id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function indexAdmin() {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function complete(Order $order) {
        $order->status = 'completed';
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diubah menjadi completed.');
    }

    public function download(Order $order) {
        if (Auth::id() != $order->user_id) {
            abort(403);
        }

        if ($order->status !== 'completed') {
            abort(403, 'Pesanan belum dibayar lek.');
        }

        $product = $order->product;

        if (!$product || !$product->file_path) {
            abort(404, 'File nya gak ada lek.');
        }

        if (!Storage::disk('public')->exists($product->file_path)) {
            abort(404, 'File gak ada di server lek.');
        }

        return Storage::disk('public')->download($product->file_path);
    }
}
