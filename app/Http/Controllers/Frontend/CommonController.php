<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function get()
    {
        return Category::select('id', 'name', 'icon_image_url')->latest()->get();
    }
}
