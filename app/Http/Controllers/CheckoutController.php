<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show(Product $product) {
        return view ('checkout', compact('product'));
    }

    public function store(Request $request) {
        $product = Product::findOrFail($request->product_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'amount' => $product->price,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.show', $order);
    }
}
