<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('web.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('web.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'image_path' => $path,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('galleries.index')->with('success', 'Image uploaded!');
    }

    public function edit(Gallery $gallery)
    {
        return view('web.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = ['is_active' => $request->has('is_active')];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image_path);
            $path = $request->file('image')->store('galleries', 'public');
            $data['image_path'] = $path;
        }

        $gallery->update($data);

        return redirect()->route('galleries.index')->with('success', 'Gallery updated.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Gallery deleted.');
    }
    public function toggleStatus($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();

        return redirect()->route('galleries.index')->with('success', 'Status updated.');
    }
}