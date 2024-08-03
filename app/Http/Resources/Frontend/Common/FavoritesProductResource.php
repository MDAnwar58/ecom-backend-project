<?php

namespace App\Http\Resources\Frontend\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoritesProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'available_quantity' => $this->available_quantity,
            'image_url' => $this->image_url,
            'brand' => new FavoritesProductBrandResource($this->whenLoaded('brand')),
            'category' => new FavoritesProductCategoryResource($this->whenLoaded('category')),
            'sub_category' => new FavoritesProductSubCategoryResource($this->whenLoaded('sub_category')),
            'offers' => FavoritesProductOffersResource::collection($this->whenLoaded('offers')),
        ];
    }
}
