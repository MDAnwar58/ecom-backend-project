<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommonCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return $this->collection->transform(function ($category) {
        return [
            'id' => $this->id,
            'image_url' => $this->image_url,
        ];
        // });
    }
}
