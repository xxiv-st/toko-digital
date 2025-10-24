<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $products = Product::latest()->get();
        return view('Welcome', compact('products'));
    }

    public function show(Product $product) {
        return view('product-detail', compact('product'));
    }
}
