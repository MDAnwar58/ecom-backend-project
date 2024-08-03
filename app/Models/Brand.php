<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'image_url',
    ];
    public static function generateSlug($name): string
    {
        $brand = Brand::where('name', $name)->get();
        if ($brand->count() > 0) {
            $count = $brand->count();
            $slug = Str::slug($name) . '-' . $count;
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
    public static function generateSlugForUpdate($brandName, $brandSlug, $requestName): mixed
    {
        if ($brandName != $requestName) {
            $slug = Brand::generateSlug($requestName);
        } else {
            $slug = $brandSlug;
        }
        return $slug;
    }
    public function offers()
    {
        return $this->hasMany(Offer::class, 'brand_id');
    }
}
