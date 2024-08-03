<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'icon_image_url',
        'banner_url',
        'brand_id',
        'status'
    ];
    public static function generateSlug($name): string
    {
        $category = Category::where('name', $name)->get();
        if ($category->count() > 0) {
            $count = $category->count();
            $slug = Str::slug($name) . '-' . $count;
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
    public static function generateSlugForUpdate($categoryName, $categorySlug, $requestName): mixed
    {
        if ($requestName !== $categoryName) {
            $slug = Category::generateSlug($requestName);
        } else {
            $slug = $categorySlug;
        }
        return $slug;
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
    public function offers()
    {
        return $this->hasMany(Offer::class, 'category_id');
    }
}
