<?php

namespace App\Http\Resources\Frontend\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModalProductSizesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'size' => new ModalProductSizeResource($this->whenLoaded('size')),
        ];
    }
}
