<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show(Order $order) {
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function indexAdmin() {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
}
