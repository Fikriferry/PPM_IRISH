<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('sku', 'like', '%' . $request->q . '%');
            })
            ->with('category')
            ->paginate(10);

        return view('web.products.index', [
            'products' => $products,
            'q' => $request->q
        ]);
    }

    public function create()
    {
        $categories = Categories::all();
        return view('web.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:products',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorMessage', 'Validasi Error, silakan periksa kembali.');
        }

        $product = new Product();
        $product->fill($request->only([
            'name',
            'slug',
            'description',
            'sku',
            'price',
            'stock',
            'product_category_id'
        ]));

        // Checkbox aktif (true/false)
        $product->is_active = $request->has('is_active');

        // Upload gambar jika ada
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/product', $imageName, 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('successMessage', 'Produk berhasil disimpan');
    }

    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('web.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::all();
        return view('web.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:products,slug,$id",
            'description' => 'nullable|string',
            'sku' => "required|string|max:50|unique:products,sku,$id",
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorMessage', 'Validasi Error, silakan periksa kembali.');
        }

        $product->fill($request->only([
            'name',
            'slug',
            'description',
            'sku',
            'price',
            'stock',
            'product_category_id'
        ]));

        $product->is_active = $request->has('is_active');

        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/product', $imageName, 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('successMessage', 'Produk berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('successMessage', 'Produk berhasil dihapus');
    }
}
