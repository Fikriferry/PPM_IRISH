<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categories;
use App\Models\Gallery;


class HomepageController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        // Ambil semua galeri (untuk gallery section)
        $galleryImages = Gallery::all(); 

        // Ambil 5 galeri yang aktif untuk carousel
        $carouselImages = Gallery::where('is_active', true)
                                ->latest()
                                ->take(5)
                                ->get();

        return view('pages.home', [
            'title' => 'Homepage',
            'categories' => $categories,
            'galleryImages' => $galleryImages,
            'carouselImages' => $carouselImages
        ]);
    }


    public function products()
    {
        $title = "Products";

        return view('web.products', [
            'title' => $title
        ]);
    }

    public function product($slug)
    {
        return view('web.product', [
            'slug' => $slug
        ]);
    }

    public function categories()
    {
        return view('web.categories', [
            'title' => 'Categories'
        ]);
    }

    public function category($slug)
    {
        $category = Categories::find($slug);

        return view('web.category_by_slug', [
            'slug' => $slug,
            'category' => $category
        ]);
    }

    public function about()
    {
        $aboutImages = Gallery::where('is_active', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.about', compact('aboutImages'));
    }

    public function contact()
    {
        return view('pages.contact',[
            'title'=>'Contact'
        ]);
    }
    public function showGallery()
    {
        $galleryImages = Gallery::where('is_active', true)->get();
        return view('web.gallery', compact('galleryImages'));
    }
}
