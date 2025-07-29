<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'return_code',
        'product_id',
        'product_name',
        'quantity',
        'size',
        'color',
        'customer_name',
        'phone_number',
        'address',
        'shipping_method',
        'shipping_cost',
        'payment_proof',
        'notes',
        'order_status',
        'order_date',
    ];

    /**
     * Relasi: Satu pesanan dimiliki oleh satu produk.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected $casts = [
        'order_date' => 'date', // <-- TAMBAHKAN ATAU PASTIKAN BARIS INI ADA
    ];
}
