<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = \App\Models\Order::with(['waiter', 'items.product'])
            ->when(
                $this->request->start_date,
                fn($q) =>
                $q->whereDate('created_at', '>=', $this->request->start_date)
            )
            ->when(
                $this->request->end_date,
                fn($q) =>
                $q->whereDate('created_at', '<=', $this->request->end_date)
            )
            ->when($this->request->menu, function ($q) {
                $q->whereHas('items.product', function ($query) {
                    $query->where('name', 'like', '%' . $this->request->menu . '%');
                });
            });

        return $query->get()->map(function ($order) {
            $menuList = $order->items->map(function ($item) {
                return $item->product->name . ' (x' . $item->quantity . ')';
            })->join(', ');

            return [
                'ID' => $order->id,
                'Nama' => $order->nama,
                'Nomor Meja' => $order->nomor_meja,
                'Waiter' => $order->waiter->name ?? '-',
                'Menu' => $menuList,
                'Total Harga' => $order->total_harga,
                'Pembayaran' => $order->metode_pembayaran,
                'Status' => $order->status,
                'Catatan' => $order->catatan ?? '-',
                'Tanggal Order' => $order->created_at->format('Y-m-d H:i'),
            ];
        });
    }


    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Nomor Meja',
            'Waiter',
            'Total Harga',
            'Pembayaran',
            'Status',
            'Catatan',
            'Tanggal Order'
        ];
    }
}