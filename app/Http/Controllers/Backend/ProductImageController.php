<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductImage\UpdateRequest;
use App\Http\Requests\Backend\ProductImage\StoreRequest;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    // make some functions as like get, store, edit, update and delete
    // when go to this store and update functions then same process store column number
    public function get(): JsonResponse
    {
        $data = [
            'images' => ProductImage::latest()->get(),
        ];
        return Response::Out("", "", $data, 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $image = new ProductImage();
        $image->product_id = $request->product_id;
        $image->image_url = $request->image_url;
        $image->save();

        return Response::Out("success", "Image Created!", "", 200);
    }
    // public function edit($id): JsonResponse
    // {
    //     $image = ProductImage::find($id);
    //     return Response::Out("", "", $image, 200);
    // }
    public function update(UpdateRequest $request): JsonResponse
    {
        $image = ProductImage::find($request->id);
        $image->product_id = $request->product_id;
        $image->image_url = $request->image_url;
        $image->save();

        return Response::Out("success", "Image Updated!", "", 200);
    }
    public function destroy($id): JsonResponse
    {
        $image = ProductImage::find($id);
        $image->delete();

        return Response::Out("success", "Image Deleted!", "", 200);
    }

    public function ProductImagesShow($productId)
    {
        return ProductImage::where('product_id', $productId)->latest()->get();
    }
    public function ProductImagesStore(Request $request)
    {
        foreach ($request['images'] as $image) {
            $product_image = new ProductImage();
            $product_image->product_id = $request['productId'];
            $product_image->image_url = $image;
            $product_image->save();
        }

        $msg = count($request['images']) > 1 ? "images" : "image";

        return Response::Out("success", "Product " . $msg . " Created!", "", 200);
    }
    public function ProductImageDestroy($id)
    {
        $product_image = ProductImage::find($id);
        $product_image->delete();

        return Response::Out("success", "Product Image Deleted!", "", 200);
    }
}
