<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreRequest;
use App\Http\Requests\Backend\Product\UpdateRequest;
use App\Models\Collection;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductSizeNumber;
use App\Models\ProductWeight;
use App\Models\Size;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\String_;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.product.index');
    }
    // make some functions as like get, store, status, edit, update, delete and multipleDestroy functions
    public function get(Request $request)
    {
        $status = $request->status;
        $status_value = $request->status_value;
        $collection = $request->collection;
        $collection_id = $request->collection_id;
        $brand = $request->brand;
        $brand_id = $request->brand_id;
        $category = $request->category;
        $category_id = $request->category_id;
        $sub_category = $request->sub_category;
        $sub_category_id = $request->sub_category_id;

        $query = Product::query()->with([
            'collection',
            'brand',
            'category',
            'sub_category',
            'product_colors.color',
            'product_sizes.size',
            'product_size_numbers.size_number',
            'product_weights.weight',
            'product_images'
        ]);

        $query->when($request->status, function ($q) use ($request) {
            return $q->where('status', $request->status_value === '1' ? 'publish' : 'unpublish');
        });

        $query->when($request->collection, function ($q) use ($request) {
            return $q->where('collection_id', $request->collection_id);
        });

        $query->when($request->brand, function ($q) use ($request) {
            return $q->where('brand_id', $request->brand_id);
        });

        $query->when($request->category, function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        });

        $query->when($request->sub_category, function ($q) use ($request) {
            return $q->where('sub_category_id', $request->sub_category_id);
        });

        $products = $query->latest()->get();

        // if (isset($status) && isset($collection) && isset($brand) && isset($category) && isset($sub_category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->where('category_id', $category_id)
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->where('category_id', $category_id)
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($collection) && isset($brand) && isset($category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->where('category_id', $category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->where('category_id', $category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($collection) && isset($brand) && isset($sub_category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($collection) && isset($brand)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->where('brand_id', $brand_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($collection) && isset($category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->where('category_id', $category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->where('category_id', $category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($collection) && isset($sub_category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($collection)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('collection_id', $collection_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('collection_id', $collection_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($brand)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('brand_id', $brand_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('brand_id', $brand_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('category_id', $category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('category_id', $category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status) && isset($sub_category)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->where('sub_category_id', $sub_category_id)
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($status)) {
        //     if ($status_value === "1") {
        //         $products = Product::where("status", "publish")
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     } elseif ($status_value === "2") {
        //         $products = Product::where("status", "unpublish")
        //             ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //             ->latest()
        //             ->get();
        //     }
        // } elseif (isset($collection)) {
        //     $products = Product::where("collection_id", $collection_id)
        //         ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //         ->latest()
        //         ->get();
        // } elseif (isset($brand)) {
        //     $products = Product::where("brand_id", $brand_id)
        //         ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //         ->latest()
        //         ->get();
        // } elseif (isset($category)) {
        //     $products = Product::where("category_id", $category_id)
        //         ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //         ->latest()
        //         ->get();
        // } elseif (isset($sub_category)) {
        //     $products = Product::where("sub_category_id", $sub_category_id)
        //         ->with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //         ->latest()
        //         ->get();
        // } else {
        //     $products = Product::with('collection', 'brand', 'category', 'sub_category', 'product_colors', 'product_colors.color', 'product_sizes', 'product_sizes.size', 'product_size_numbers', 'product_size_numbers.size_number', 'product_weights', 'product_weights.weight')
        //         ->latest()
        //         ->get();
        // }

        $data = [
            'products' => $products,
        ];
        return Response::Out("", "", $data, 200);
    }
    public function store(Request $request)
    {
        // store as like columns 'brand_id','category_id','sub_category_id','name','slug','sku','title','price','discount_price','perchese_quantity','available_quantity','color_id','size_id','size_num_id','weight_id','remark','refundable','status','description','specification','image_url','meta_tag','meta_title','meta_description',
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->name = $request->name;
            $product->slug = Product::generateSlug($request->name);
            $product->sku = Str::random(15);
            $product->title = $request->title;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->perchese_quantity = $request->perchese_quantity;
            $product->available_quantity = $request->available_quantity;
            $product->collection_id = $request->collection_id;
            // $product->remark = $request->remark;
            $product->refundable = $request->refundable;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->specification = $request->specification;
            $product->image_url = $request->image_url;
            // seo product
            // $product->meta_tag = $request->tags;
            if (is_array($request->tags) && count($request->tags)) {
                // foreach ($request->tags as $tag) {
                $objects = $request->tags;
                // Extract the text values using array_map
                $texts = array_map(function ($object) {
                    return $object['text'];
                }, $objects);
                // Convert the array of texts to a single string
                $tagsString = implode(', ', $texts);
                $product->meta_tag = $tagsString;
            }
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->save();

            if (is_array($request->color_ids) && count($request->color_ids) > 0) {
                foreach ($request->color_ids as $color) {
                    $product_color = new ProductColor();
                    $product_color->product_id = $product->id;
                    $product_color->color_id = $color;
                    $product_color->save();
                }
            }
            if (is_array($request->sizes)) {
                // Filter out objects with all null values
                $filteredSizes = array_filter($request->sizes, function ($size) {
                    return !is_null($size['size_id']) || !is_null($size['price']) || !is_null($size['discount_price']);
                });
                if (count($filteredSizes) > 0) {
                    // Now $filteredSizes contains only non-null objects
                    foreach ($filteredSizes as $size) {
                        $product_size = new ProductSize();
                        $product_size->product_id = $product->id;
                        $product_size->size_id = $size['size_id'];
                        $product_size->price = $size['price'];
                        $product_size->discount_price = $size['discount_price'];
                        $product_size->save();
                    }
                }
            }
            if (is_array($request->size_numbers) && count($request->size_numbers) > 0) {
                $filteredSizeNumbers = array_filter($request->size_numbers, function ($size_number) {
                    return !is_null($size_number['size_number_id']) || !is_null($size_number['price']) || !is_null($size_number['discount_price']);
                });
                if (count($filteredSizeNumbers) > 0) {
                    foreach ($filteredSizeNumbers as $size_number) {
                        $product_size_number = new ProductSizeNumber();
                        $product_size_number->product_id = $product->id;
                        $product_size_number->size_number_id = $size_number['size_number_id'];
                        $product_size_number->price = $size_number['price'];
                        $product_size_number->discount_price = $size_number['discount_price'];
                        $product_size_number->save();
                    }
                }
            }
            if (is_array($request->weights) && count($request->weights) > 0) {
                $filtered_weights = array_filter($request->weights, function ($weight) {
                    return !is_null($weight['weight_id']) || !is_null($weight['price']) || !is_null($weight['discount_price']);
                });
                if (count($filtered_weights) > 0) {
                    foreach ($filtered_weights as $weight) {
                        $product_weight = new ProductWeight();
                        $product_weight->product_id = $product->id;
                        $product_weight->weight_id = $weight['weight_id'];
                        $product_weight->price = $weight['price'];
                        $product_weight->discount_price = $weight['discount_price'];
                        $product_weight->save();
                    }
                }

            }

            DB::commit();
            return Response::Out("success", "Product Created!", "", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    // then create a status function
    public function status($id): JsonResponse
    {
        $product = Product::find($id);
        $product->status = $product->status === "publish" ? "unpublish" : "publish";
        $product->save();

        $status = $product->status === "publish" ? "Publish" : "Unpublish";
        return Response::Out("success", "Product Status $status!", "", 200);
    }
    public function edit($id): JsonResponse
    {
        $product = Product::with('product_colors', 'product_sizes', 'product_size_numbers', 'product_weights')->find($id);
        return Response::Out("", "", $product, 200);
    }
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->name = $request->name;
            $product->slug = Product::generateSlug($request->name);
            $product->sku = Str::random(15);
            $product->title = $request->title;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->perchese_quantity = $request->perchese_quantity;
            $product->available_quantity = $request->available_quantity;
            $product->collection_id = $request->collection_id;
            $product->refundable = $request->refundable;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->specification = $request->specification;
            $product->image_url = $request->image_url;
            // seo product
            if (is_array($request->tags) && count($request->tags)) {
                $objects = $request->tags;
                // Extract the text values using array_map
                $texts = array_map(function ($object) {
                    return $object['text'];
                }, $objects);
                // Convert the array of texts to a single string
                $tagsString = implode(', ', $texts);
                $product->meta_tag = $tagsString;
            }
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->save();

            $not_get_product_colors_ids = ProductColor::where('product_id', $product->id)
                ->whereNotIn('color_id', $request->color_ids)
                ->pluck('id');
            if (!$not_get_product_colors_ids->isEmpty()) {
                ProductColor::where('product_id', $product->id)
                    ->whereIn('id', $not_get_product_colors_ids)
                    ->delete();
            } else {
                $product_colors = ProductColor::where('product_id', $product->id)
                    ->whereIn('color_id', $request->color_ids)
                    ->get()
                    ->keyBy('color_id'); // Key by co
                foreach ($request->color_ids as $color_id) {
                    if (isset($product_colors[$color_id])) {
                        // Update the existing ProductColor record
                        $product_color = $product_colors[$color_id];
                        $product_color->update([
                            'product_id' => $product->id,
                            'color_id' => $color_id,
                        ]);
                    } else {
                        // Create a new ProductColor record
                        ProductColor::create([
                            'product_id' => $product->id,
                            'color_id' => $color_id,
                        ]);
                    }
                }
            }

            $size_ids = collect($request->sizes)->pluck('size_id')->toArray();
            $not_get_product_sizes_ids = ProductSize::where('product_id', $product->id)->whereNotIn('size_id', $size_ids)->get();
            if (!$not_get_product_sizes_ids->isEmpty()) {
                foreach ($not_get_product_sizes_ids as $product_size) {
                    $product_size->delete();
                }
            } else {
                if ($request->sizes) {
                    $product_sizes = ProductSize::where('product_id', $product->id)
                        ->whereIn('size_id', $size_ids)
                        ->get()
                        ->keyBy('size_id');

                    foreach ($request->sizes as $size) {
                        if (isset($product_sizes[$size['size_id']])) {
                            $product_size = $product_sizes[$size['size_id']];
                            $product_size->update([
                                'product_id' => $product->id,
                                'size_id' => $size['size_id'],
                                'price' => $size['price'],
                                'discount_price' => $size['discount_price'],
                            ]);
                        } else {
                            $product_size = new ProductSize();
                            $product_size->product_id = $product->id;
                            $product_size->size_id = $size['size_id'];
                            $product_size->price = $size['price'];
                            $product_size->discount_price = $size['discount_price'];
                            $product_size->save();
                        }
                    }
                }
            }

            $size_number_ids = collect($request->size_numbers)->pluck('size_number_id')->toArray();
            $not_get_product_size_numbers_ids = ProductSizeNumber::where('product_id', $product->id)
                ->whereNotIn('size_number_id', $size_number_ids)
                ->get();
            if (!$not_get_product_size_numbers_ids->isEmpty()) {
                foreach ($not_get_product_size_numbers_ids as $product_size_number) {
                    $product_size_number->delete();
                }
            } else {
                $product_size_numbers = ProductSizeNumber::where('product_id', $product->id)
                    ->whereIn('size_number_id', $size_number_ids)
                    ->get()
                    ->keyBy('size_number_id');
                foreach ($request->size_numbers as $size_number) {
                    if (isset($product_size_numbers[$size_number['size_number_id']])) {
                        $product_size_number = $product_size_numbers[$size_number['size_number_id']];
                        $product_size_number->update([
                            'product_id' => $product->id,
                            'size_number_id' => $size_number['size_number_id'],
                            'price' => $size_number['price'],
                            'discount_price' => $size_number['discount_price'],
                        ]);
                    } else {
                        $product_size_number = new ProductSizeNumber();
                        $product_size_number->product_id = $product->id;
                        $product_size_number->size_number_id = $size_number['size_number_id'];
                        $product_size_number->price = $size_number['price'];
                        $product_size_number->discount_price = $size_number['discount_price'];
                        $product_size_number->save();
                    }
                }
            }

            $weight_ids = collect($request->weights)->pluck('weight_id')->toArray();
            $not_get_product_weights_ids = ProductWeight::where('product_id', $product->id)
                ->whereNotIn('weight_id', $weight_ids)
                ->get();
            if (!$not_get_product_weights_ids->isEmpty()) {
                foreach ($not_get_product_weights_ids as $product_weight) {
                    $product_weight->delete();
                }
            } else {
                $product_weights = ProductWeight::where('product_id', $product->id)
                    ->whereIn('weight_id', $weight_ids)
                    ->get()
                    ->keyBy('weight_id');
                foreach ($request->weights as $weight) {
                    if (isset($product_weights[$weight['weight_id']])) {
                        $product_weight = $product_weights[$weight['weight_id']];
                        $product_weight->update([
                            'product_id' => $product->id,
                            'weight_id' => $weight['weight_id'],
                            'price' => $weight['price'],
                            'discount_price' => $weight['discount_price'],
                        ]);
                    } else {
                        $product_weight = new ProductWeight();
                        $product_weight->product_id = $product->id;
                        $product_weight->weight_id = $weight['weight_id'];
                        $product_weight->price = $weight['price'];
                        $product_weight->discount_price = $weight['discount_price'];
                        $product_weight->save();
                    }
                }
            }

            DB::commit();
            return Response::Out("success", "Product Created!", "", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        $product->delete();

        return Response::Out("success", "Product Deleted!", "", 200);
    }
    public function multipleDestroy(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $product = Product::find($id);
            $product->delete();
        }

        return Response::Out("success", "Products Deleted!", "", 200);
    }
}
