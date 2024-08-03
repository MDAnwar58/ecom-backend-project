<?php

namespace App\Http\Resources\Frontend\Common\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsProductSizesResource extends JsonResource
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
            'size_id' => $this->size_id,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'size' => new CartsProductSizesSizeResource($this->whenLoaded('size')),
        ];
    }
}
