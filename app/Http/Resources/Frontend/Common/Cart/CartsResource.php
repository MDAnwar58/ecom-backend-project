<?php

namespace App\Http\Resources\Frontend\Common\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'qty' => $this->qty,
            'weight_id' => $this->weight_id,
            'size_id' => $this->size_id,
            'size_number_id' => $this->size_number_id,
            'product' => new CartsProductResource($this->whenLoaded('product')),
        ];
    }
}
