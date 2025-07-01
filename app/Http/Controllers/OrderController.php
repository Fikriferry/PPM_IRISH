<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua produk aktif untuk dropdown filter menu
        $productList = Product::where('is_active', true)->orderBy('name')->get();

        // Mulai query orders dengan relasi items dan produk di-load
        $query = Order::with(['items.product', 'waiter']);

        // Filter berdasarkan tanggal awal (start_date)
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // Filter berdasarkan tanggal akhir (end_date)
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter berdasarkan nama produk (menu)
        if ($request->filled('menu')) {
            $query->whereHas('items.product', function ($q) use ($request) {
                $q->where('name', $request->menu);
            });
        }

        // Ambil hasil query dengan pagination
        $orders = $query->latest()->paginate(10);

        // Kirim data ke view
        return view('web.orders.index', compact('orders', 'productList'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', true)->get();
        $waiters = Customer::all();
        $statusList = ['diproses', 'selesai'];
        $metodePembayaran = ['tunai', 'qris', 'e-wallet'];

        return view('web.orders.create', compact('products', 'waiters', 'statusList', 'metodePembayaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_meja' => 'required|string|max:20',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.note' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $itemsData = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total_price' => $subtotal,
                    'note' => $item['note'] ?? null,
                ];
            }

            $order = Order::create([
                'nama' => $request->nama,
                'nomor_meja' => $request->nomor_meja,
                'total_harga' => $total,
                'catatan' => $request->catatan,
                'waiter_id' => Auth::guard('customer')->id(),
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->status ?? 'diproses'
            ]);

            foreach ($itemsData as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $statusList = ['diproses', 'selesai'];
        $metodePembayaran = ['tunai', 'qris', 'e-wallet'];
        $products = Product::where('is_active', true)->get();

        $order->load('items.product');

        return view('web.orders.edit', compact('order', 'statusList', 'metodePembayaran', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Cek jika order sudah selesai, tidak bisa diubah lagi
        if ($order->status === 'selesai') {
            return redirect()->back()->with('error', 'Pesanan sudah selesai dan tidak bisa diubah.');
        }

        // Jika hanya update status (misal dari dropdown di index)
        if ($request->has('status') && $request->keys() === ['_token', '_method', 'status']) {
            $request->validate([
                'status' => 'required|in:diproses,selesai',
            ]);

            $order->update([
                'status' => $request->status,
            ]);

            return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
        }

        // Jika full update dari form edit
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_meja' => 'required|string|max:20',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|in:diproses,selesai',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.note' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $order) {
            $total = 0;
            $itemsData = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total_price' => $subtotal,
                    'note' => $item['note'] ?? null,
                ];
            }

            $order->update([
                'nama' => $request->nama,
                'nomor_meja' => $request->nomor_meja,
                'total_harga' => $total,
                'catatan' => $request->catatan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->status
            ]);

            $order->items()->delete();
            foreach ($itemsData as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}