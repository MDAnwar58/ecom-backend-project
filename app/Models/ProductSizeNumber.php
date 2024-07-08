<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeNumber extends Model
{
    use HasFactory;
    protected $table = 'product_size_numbers';
    protected $fillable = [
        'product_id',
        'size_number_id',
        'price',
        'discount_price',
    ];

    public function size_number()
    {
        return $this->belongsTo(SizeNumber::class, 'size_number_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
}
