<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeNumber extends Model
{
    use HasFactory;
    protected $table = 'size_numbers';
    protected $fillable = [
        'name',
    ];
}
