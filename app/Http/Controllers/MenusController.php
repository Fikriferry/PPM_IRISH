<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('menu_order')->get();
        return view('dashboard.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('dashboard.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_text' => 'required|string|max:255',
            'menu_icon' => 'nullable|string|max:255',
            'menu_url' => 'nullable|string|max:255',
            'menu_order' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        Menu::create([
            'menu_text' => $request->menu_text,
            'menu_icon' => $request->menu_icon,
            'menu_url' => $request->menu_url,
            'menu_order' => $request->menu_order ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        return view('dashboard.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu_text' => 'required|string|max:255',
            'menu_icon' => 'nullable|string|max:255',
            'menu_url' => 'nullable|string|max:255',
            'menu_order' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        $menu->update([
            'menu_text' => $request->menu_text,
            'menu_icon' => $request->menu_icon,
            'menu_url' => $request->menu_url,
            'menu_order' => $request->menu_order ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully.');
    }
}
