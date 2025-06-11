<?php

namespace App\Http\Controllers;

use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThemesController extends Controller
{
    public function index()
    {
        $themes = Themes::latest()->paginate(10); // Tidak perlu Themes::all() sebelumnya
        return view('dashboard.themes.index', compact('themes'));
    }

    public function create()
    {
        return view('dashboard.themes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'folder' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'errors' => $validator->errors(),
                'errorMessage' => 'Validasi gagal. Silakan lengkapi data dengan benar.'
            ]);
        }

        Themes::create([
            'name' => $request->name,
            'folder' => $request->folder,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('themes.index')->with([
            'successMessage' => 'Theme berhasil ditambahkan.'
        ]);
    }

    public function show(Themes $theme)
    {
        return view('dashboard.themes.show', compact('theme'));
    }

    public function edit(Themes $theme)
    {
        return view('dashboard.themes.edit', compact('theme'));
    }

    public function update(Request $request, string $id)
    {
    // Validasi input
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'folder' => 'required|string|max:255',
        'description' => 'nullable|string',
        // status tidak perlu divalidasi boolean jika kita handle manual
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->with([
            'errors' => $validator->errors(),
            'errorMessage' => 'Validasi Error, Silakan lengkapi data terlebih dahulu.'
        ]);
    }

    // Ambil data theme berdasarkan ID
    $theme = Themes::find($id);
    if (!$theme) {
        return redirect()->back()->with([
            'errorMessage' => 'Data tema tidak ditemukan.'
        ]);
    }

    // Update field
    $theme->name = $request->name;
    $theme->folder = $request->folder;
    $theme->description = $request->description;
    $theme->status = $request->has('status') ? 1 : 0;

    $theme->save();

    return redirect()->route('themes.index')->with([
    'successMessage' => 'Data theme berhasil diperbarui.'
    ]);
    }


    public function destroy(Themes $theme)
    {
        $theme->delete();

        return redirect()->route('themes.index')->with('success', 'Theme berhasil dihapus.');
    }
}