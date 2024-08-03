<?php

namespace App\Http\Resources\Frontend\Common\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsProductWeightsResource extends JsonResource
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
            'weight_id' => $this->weight_id,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'weight' => new CartsProductWeightsWeightResource($this->whenLoaded('weight')),
        ];
    }
}
