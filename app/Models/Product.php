<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'brand_id',
        'category_id',
        'sub_category_id',
        'name',
        'slug',
        'sku',
        'title',
        'price',
        'discount_price',
        'perchese_quantity',
        'available_quantity',
        'collection_id',
        // 'color_id',
        // 'size_id',
        // 'size_num_id',
        // 'weight_id',
        // 'remark',
        'refundable',
        'status',
        'description',
        'specification',
        'image_url',
        // seo
        'meta_tag',
        'meta_title',
        'meta_description',
    ];

    public static function generateSlug($name): string
    {
        $product = Product::where('name', $name)->get();
        if ($product->count() > 0) {
            $count = $product->count();
            $slug = Str::slug($name) . '-' . $count;
        } else {
            $slug = Str::slug($name);
        }
        return $slug;
    }
    public static function generateSlugForUpdate($productName, $productSlug, $requestName): mixed
    {
        if ($productName != $requestName) {
            $slug = Product::generateSlug($requestName);
        } else {
            $slug = $productSlug;
        }
        return $slug;
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function product_colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function product_sizes()
    {
        return $this->hasMany(ProductSize::class, "product_id");
    }
    public function product_size_numbers()
    {
        return $this->hasMany(ProductSizeNumber::class, "product_id");
    }
    public function product_weights()
    {
        return $this->hasMany(ProductWeight::class, "product_id");
    }
    public function offers()
    {
        return $this->hasMany(Offer::class, "product_id");
    }
}
