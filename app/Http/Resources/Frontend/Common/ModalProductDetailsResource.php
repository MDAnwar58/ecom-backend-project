<?php

namespace App\Http\Resources\Frontend\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModalProductDetailsResource extends JsonResource
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
            'title' => $this->title,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'perchese_quantity' => $this->perchese_quantity,
            'available_quantity' => $this->available_quantity,
            'description' => $this->description,
            'specification' => $this->specification,
            'image_url' => $this->image_url,
            'collection' => new ModalProductCollectionResource($this->whenLoaded('collection')),
            'brand' => new ModalProductBrandResource($this->whenLoaded('brand')),
            'category' => new ModalProductCategoryResource($this->whenLoaded('category')),
            'sub_category' => new ModalProductSubCategoryResource($this->whenLoaded('sub_category')),
            'colors' => ModalProductColorsResource::collection($this->product_colors->pluck('color')),
            'product_sizes' => ModalProductSizesResource::collection($this->whenLoaded('product_sizes')),
            'product_size_numbers' => ModalProductSizeNumbersResource::collection($this->whenLoaded('product_size_numbers')),
            'weights' => ModalProductWeightsResource::collection($this->whenLoaded('product_weights')),
            'images' => ModalProductImagesResource::collection($this->whenLoaded('product_images')),
            'offers' => ModalProductOfferResource::collection($this->whenLoaded('offers')),
        ];
    }
}
