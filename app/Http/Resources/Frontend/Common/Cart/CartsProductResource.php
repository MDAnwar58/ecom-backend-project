<?php

namespace App\Http\Resources\Frontend\Common\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'image_url' => $this->image_url,
            'offers' => CartsProductOffersResource::collection($this->whenLoaded('offers')),
            'brand' => new CartsProductBrandResource($this->whenLoaded('brand')),
            'category' => new CartsProductCategoryResource($this->whenLoaded('category')),
            'sub_category' => new CartsProductSubCategoryResource($this->whenLoaded('sub_category')),
            'product_weights' => CartsProductWeightsResource::collection($this->whenLoaded('product_weights')),
            'product_sizes' => CartsProductSizesResource::collection($this->whenLoaded('product_sizes')),
            'product_size_numbers' => CartsProductSizeNumbersResource::collection($this->whenLoaded('product_size_numbers')),
        ];
    }
}
