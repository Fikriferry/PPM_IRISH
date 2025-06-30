<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        // $customers = Customer::latest()->get();
        return view('web.user.index', compact('customers'));
    }

    public function create()
    {
        return view('web.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'address' => 'nullable|string',
            'password' => 'required|confirmed'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Customer::create($validated);

        return redirect()->route('user.index')->with('successMessage', 'Customer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('web.user.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'address' => 'nullable|string',
            'password' => 'nullable|confirmed'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $customer->update($validated);

        return redirect()->route('user.index')->with('successMessage', 'Customer berhasil diupdate.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('web.user.index')->with('successMessage', 'Customer berhasil dihapus.');
    }
}
