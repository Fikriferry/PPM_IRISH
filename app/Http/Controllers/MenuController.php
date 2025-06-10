<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Categories;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $products = Product::where('is_active', true)->get();

        return view('web.menu', compact('categories', 'products'));
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

