<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $id = $request->header('id');
        $user = User::find($id);
        return view('pages.products.products', compact('user'));
    }
    public function get()
    {
        return Product::select('id', 'name', 'slug', 'price', 'discount_price', 'image_url', 'collection_id')->with('collection', 'offer')->latest()->get();
    }
    public function show($slug): View
    {
        return view('pages.product-details.product-details');
    }
}
