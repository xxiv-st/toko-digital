<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // buat validasi input data
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|integer',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'file_path' => 'required|file|mimes:pdf,zip,rar|max:10240', // Max 10MB
    ]);
    // Buat upload & simpen file
    $coverImagePath = $request->file('cover_image')->store('product-covers', 'public');
    $filePath = $request->file('file_path')->store('digital-products', 'public');

    // Buat nyimpen data ke database
    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'cover_image_path' => $coverImagePath,
        'file_path' => $filePath,
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|integer',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'file_path' => 'nullable|file|mimes:pdf,zip,rar|max:10240',
        ]);

        $data = $request->only('name', 'description', 'price');

        if ($request->hasFile('cover_image')) {
        // Hapus file lama
        Storage::disk('public')->delete($product->cover_image_path);
        // Upload file baru
        $data['cover_image_path'] = $request->file('cover_image')->store('product-covers', 'public');
        }

        if ($request->hasFile('digital_file')) {
        // Hapus file digital lama jika ada
            if ($product->digital_file_path) {
                Storage::disk('public')->delete($product->digital_file_path);
            }
            // Simpan file digital baru
            $validatedData['file_path'] = $request->file('digital_file')->store('product-files', 'public');
        }

        if ($request->hasFile('file_path')) {
        // Hapus file lama
        Storage::disk('public')->delete($product->file_path);
        // Upload file baru
        $data['file_path'] = $request->file('file_path')->store('digital-products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->cover_image_path);
        Storage::disk('public')->delete($product->file_path);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
