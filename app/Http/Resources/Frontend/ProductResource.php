<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\Frontend\Common\ModalProductBrandResource;
use App\Http\Resources\Frontend\Common\ModalProductCategoryResource;
use App\Http\Resources\Frontend\Common\ModalProductOfferResource;
use App\Http\Resources\Frontend\Common\ModalProductSubCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_offers' => ModalProductOfferResource::collection($this->whenLoaded('offers')),
            'brand' => new ModalProductBrandResource($this->whenLoaded('brand')),
            'category' => new ModalProductCategoryResource($this->whenLoaded('category')),
            'sub_category' => new ModalProductSubCategoryResource($this->whenLoaded('sub_category')),
            // Include other product fields as needed
        ];
    }
}
