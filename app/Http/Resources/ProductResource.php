<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'rating' => $this->rating,
            'stock' => $this->stock,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'link' => $this->link,
            'description' => $this->description,
        ];
    }
}
