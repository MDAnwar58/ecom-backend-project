<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'banner_url',
        'category_id',
        'status'
    ];
    public static function generateSlug($name): string
    {
        $sub_category = SubCategory::where('name', $name)->get();
        if ($sub_category->count() > 0) {
            $count = $sub_category->count();
            $slug = Str::slug($name) . '-' . $count;
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
    public static function generateSlugForUpdate($subCategoryName, $subCategorySlug, $requestName): mixed
    {
        if ($subCategoryName != $requestName) {
            $slug = SubCategory::generateSlug($requestName);
        } else {
            $slug = $subCategorySlug;
        }
        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
