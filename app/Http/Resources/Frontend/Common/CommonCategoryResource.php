<?php

namespace App\Http\Resources\Frontend\Common;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon_image_url' => $this->icon_image_url,
            'sub_categories' => CommonSubCategoryResource::collection($this->whenLoaded('sub_categories')),
        ];
    }
}
