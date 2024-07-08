<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CollectionResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'products' => $item->products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'discount_price' => $product->discount_price,
                        'image_url' => $product->image_url,
                        'collection_id' => $product->collection_id,
                    ];
                }),
            ];
        })->toArray();
    }
}
