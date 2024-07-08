<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_sizes';
    protected $fillable = [
        'product_id',
        'size_id',
        'price',
        'discount_price',
    ];
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
}
