<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\CollectionResource;
use App\Http\Resources\Frontend\CollectionResourceCollection;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function get()
    {
        $collections = Collection::where('status', 'active')
            ->with([
                'products' => function ($query) {
                    $query->where('status', 'publish')
                        ->latest();
                },
                'products.offers',
                'products.brand.offers',
                'products.category.offers',
                'products.sub_category.offers',
            ])
            ->latest()
            ->get();
        return CollectionResource::collection($collections);
        // $collections = Collection::select('id', 'name')
        //     ->with(['products:id,name,slug,price,discount_price,image_url,collection_id'])
        //     ->latest()
        //     ->get();

        // // Format the collections with their products
        // $formattedCollections = $collections->map(function ($collection) {
        //     return [
        //         'id' => $collection->id,
        //         'name' => $collection->name,
        //         'products' => $collection->products->map(function ($product) {
        //             return [
        //                 'id' => $product->id,
        //                 'name' => $product->name,
        //                 'slug' => $product->slug,
        //                 'price' => $product->price,
        //                 'discount_price' => $product->discount_price,
        //                 'image_url' => $product->image_url,
        //                 'collection_id' => $product->collection_id,
        //             ];
        //         }),
        //     ];
        // });
        // return $formattedCollections;
    }
}
