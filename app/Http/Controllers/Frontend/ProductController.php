<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Common\ModalProductDetailsResource;
use App\Http\Resources\Frontend\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
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
    public function get(Request $request)
    {
        // return $request->sub_category_slug !== null ? true : "false";
        $query = Product::query()
            ->where('status', 'publish')
            ->with('brand.offers', 'category.offers', 'sub_category.offers', 'offers');

        $query->when(!is_null($request->category_slug), function ($q) use ($request) {
            $category = Category::where('slug', $request->category_slug)->first();
            return $q->where('category_id', $category->id);
        });
        $query->when(!is_null($request->sub_category_slug), function ($q) use ($request) {
            $sub_category = SubCategory::where('slug', $request->sub_category_slug)->first();
            return $q->where('sub_category_id', $sub_category->id);
        });
        $query->when(!is_null($request->min_price) && !is_null($request->max_price), function ($q) use ($request) {
            if ($request->min_price === "50") {
                return $q->whereBetween('price', [50, $request->max_price]);
            } elseif ($request->min_price === "100") {
                return $q->whereBetween('price', [100, $request->max_price]);
            } elseif ($request->min_price === "200") {
                return $q->whereBetween('price', [200, $request->max_price]);
            } elseif ($request->min_price === "300") {
                return $q->whereBetween('price', [300, $request->max_price]);
            }
        });
        $query->when(!is_null($request->min_price_range) && !is_null($request->max_price_range), function ($q) use ($request) {
            $min_price_range = intval($request->min_price_range);
            return $q->whereBetween('price', [$min_price_range, $request->max_price_range]);
        });

        $products = $query->latest()->get();
        return ProductResource::collection($products);
    }
    public function modalDetailsShow($id)
    {
        $product = Product::where('status', 'publish')
            ->where('id', $id)
            ->with('collection', 'brand', 'category', 'sub_category', 'product_colors.color', 'product_sizes.size', 'product_size_numbers.size_number', 'product_weights.weight', 'product_images', 'offers', 'brand.offers', 'category.offers', 'sub_category.offers')
            ->first();
        return new ModalProductDetailsResource($product);
    }
    public function categoryId(Request $request)
    {
        $sub_category = SubCategory::where('slug', $request->sub_category_slug)->first();
        return $sub_category->category_id;
    }
    public function show($slug): View
    {
        return view('pages.product-details.product-details');
    }
}
