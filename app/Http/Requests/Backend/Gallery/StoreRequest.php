<?php

namespace App\Http\Requests\Backend\Gallery;

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
            'image_name' => 'required',
            'gallery_category_id' => 'required|integer',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,webp|max:20480',
        ];
    }
}
