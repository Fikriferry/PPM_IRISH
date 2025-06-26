<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Categories;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua kategori beserta produk aktifnya
        $categories = Categories::with([
            'products' => function ($query) {
                $query->where('is_active', true);
            }
        ])->get();

        // Ambil semua produk aktif untuk tampilan default (All)
        $products = Product::where('is_active', true)->get();

        // Flag untuk menandakan bahwa ini tampilan "All"
        $isAll = true;

        return view('web.menu', compact('categories', 'products', 'isAll'));
    }



    public function filterByCategory($slug)
    {
        $category = Categories::where('slug', $slug)->firstOrFail();
        $products = Product::where('product_category_id', $category->id)
            ->where('is_active', true)
            ->get();

        $view = view('web.products', compact('products'))->render();
        return response()->json(['products' => $view]);
    }
}