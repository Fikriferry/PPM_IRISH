<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nomor_meja',
        'total_harga',
        'catatan',
        'waiter_id',
        'metode_pembayaran',
        'status'
    ];

    /**
     * Relasi ke item pesanan
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi ke waiter (customer yang menginput pesanan)
     */
    public function waiter()
    {
        return $this->belongsTo(Customer::class, 'waiter_id');
    }
}