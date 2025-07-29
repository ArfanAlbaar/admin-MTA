<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnOrder extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'return_code',
        'order_number',
        'return_reason',
        'customer_name',
        'return_product_name',
        'picture_proof',
        'bank_number',
        'bank_name',
        'name_bank_number',
        'resi',
        'notes',
        'return_date',
        'status_return'
    ];
}
