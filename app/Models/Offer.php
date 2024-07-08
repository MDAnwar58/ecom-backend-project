<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';
    protected $fillable = [
        'brand_id',
        'category_id',
        'sub_category_id',
        'product_id',
        'name',
        'percents',
        'start_date',
        'end_date',
        'image_url',
        'status',
    ];
    // brand, category, sub_category, product
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
