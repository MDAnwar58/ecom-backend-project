<?php

namespace App\Http\Resources\Frontend\Common\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'offers' => CartsProductCategoryOffersResource::collection($this->whenLoaded('offers'))
        ];
    }
}
