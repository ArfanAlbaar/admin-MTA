<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'size' => $this->size,
            'color' => $this->color,
            'customer_name' => $this->customer_name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'shipping_method' => $this->shipping_method,
            'shipping_cost' => $this->shipping_cost,
            'payment_proof' => $this->payment_proof ? asset('storage/' . $this->payment_proof) : null,
            'order_date' => $this->order_date,
        ];
    }
}
