<?php

namespace App\Http\Requests\Backend\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand_id' => 'nullable',
            'category_id' => 'nullable',
            'sub_category_id' => 'nullable',
            'name' => 'required',
            'title' => 'nullable',
            'price' => 'required',
            'discount_price' => 'nullable',
            'perchese_quantity' => 'required',
            'available_quantity' => 'required',
            'collection_id' => 'nullable',
            'refundable' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'specification' => 'nullable',
            'image_url' => 'required',
            // seo product
            'tags' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            // defferent types stores
            'color_ids' => 'nullable',
            'sizes' => 'nullable',
            'size_numbers' => 'nullable',
            'weights' => 'nullable',
        ];
    }
}
