<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    use HasFactory;
    protected $table = 'product_weights';
    protected $fillable = [
        'product_id',
        'weight_id',
        'price',
        'discount_price',
    ];
    public function weight()
    {
        return $this->belongsTo(Weight::class, 'weight_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
}
