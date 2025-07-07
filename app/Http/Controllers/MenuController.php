<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Categories::with([
            'products' => function ($q) {
                $q->where('is_active', true);
            }
        ])->get();

        $products = Product::where('is_active', true)->get();

        return view('pages.menu', [
            'categories' => $categories,
            'products' => $products,
            'isAll' => true
        ]);
    }

    public function filterByCategory($slug)
    {
        $category = Categories::where('slug', $slug)->firstOrFail();

        // pastikan relasi category ikut di-load
        $products = Product::with('category')
            ->where('product_category_id', $category->id)
            ->where('is_active', true)
            ->get();

        // kirim juga selectedCategory ke view
        $html = view('pages.products', [
            'products' => $products,
            'selectedCategory' => $category,
            'isAll' => false
        ])->render();

        return response()->json(['products' => $html]);
    }
}