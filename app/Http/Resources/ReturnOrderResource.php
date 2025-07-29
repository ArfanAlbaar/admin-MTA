<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReturnOrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'return_code' => $this->return_code,
            'order_number' => $this->order_number,
            'return_reason' => $this->return_reason,
            'customer_name' => $this->customer_name,
            'return_product_name' => $this->return_product_name,
            'picture_proof' => $this->picture_proof ? asset('storage/' . $this->picture_proof) : null,
            'bank_number' => $this->bank_number,
            'bank_name' => $this->bank_name,
            'name_bank_number' => $this->name_bank_number,
            'resi' => $this->resi,
            'notes' => $this->notes,
            'return_date' => $this->return_date,
            'status_return' => $this->status_return,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
