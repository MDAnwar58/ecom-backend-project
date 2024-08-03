<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Common\Cart\CartsResource;
use App\Http\Resources\Frontend\Common\CommonCategoryResource;
use App\Http\Resources\Frontend\Common\FavoritesResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function get()
    {
        $categories = Category::where('status', operator: 'active')->with('sub_categories')->latest()->get();
        return CommonCategoryResource::collection($categories);
    }

    public function getCarts($user_id)
    {
        $carts = Cart::where('user_id', $user_id)
            ->with('product.offers', 'product.brand.offers', 'product.category.offers', 'product.sub_category.offers', 'product.product_weights.weight', 'product.product_sizes.size', 'product.product_size_numbers.size_number')
            ->latest()
            ->get();
        return CartsResource::collection($carts);
    }
    public function storeInCart(Request $request, $user_id)
    {
        $product = Product::where('id', $request->product_id)->first();

        if ($request->qty > $product->available_quantity) {
            $qty = $product->available_quantity;
            if ($qty > 0) {
                return Response::Out("warning", "Product max quantity available " . $qty . "!", "", 200);
            } else {
                return Response::Out("fail", "Product not available now!", "", 200);
            }
        } else {
            if (!is_null($request->weight_id)) {
                $cart_weight = Cart::where('user_id', $user_id)
                    ->where('product_id', $request->product_id)
                    ->where('weight_id', $request->weight_id)
                    ->first();
                if ($cart_weight) {
                    $cart_weight->qty = $cart_weight->qty + $request->qty;
                    $cart_weight->save();
                } else {
                    $cart = new Cart();
                    $cart->user_id = $user_id;
                    $cart->product_id = $request->product_id;
                    $cart->qty = $request->qty;
                    $cart->weight_id = $request->weight_id;
                    $cart->save();
                }

                return Response::Out("success", "This product added to your cart!", "", 200);
            } elseif (!is_null($request->size_id)) {
                $cart_size = Cart::where('user_id', $user_id)
                    ->where('product_id', $request->product_id)
                    ->where('size_id', $request->size_id)
                    ->first();
                if ($cart_size) {
                    $cart_size->qty = $cart_size->qty + $request->qty;
                    $cart_size->save();
                } else {
                    $cart = new Cart();
                    $cart->user_id = $user_id;
                    $cart->product_id = $request->product_id;
                    $cart->qty = $request->qty;
                    $cart->size_id = $request->size_id;
                    $cart->save();
                }

                return Response::Out("success", "This product added to your cart!", "", 200);
            } elseif (!is_null($request->size_number_id)) {
                $cart_size_number = Cart::where('user_id', $user_id)
                    ->where('product_id', $request->product_id)
                    ->where('size_number_id', $request->size_number_id)
                    ->first();
                if ($cart_size_number) {
                    $cart_size_number->qty = $cart_size_number->qty + $request->qty;
                    $cart_size_number->save();
                } else {
                    $cart = new Cart();
                    $cart->user_id = $user_id;
                    $cart->product_id = $request->product_id;
                    $cart->qty = $request->qty;
                    $cart->size_number_id = $request->size_number_id;
                    $cart->save();
                }

                return Response::Out("success", "This product added to your cart!", "", 200);
            }
            // return $request->all();
            $cart = Cart::where('user_id', $user_id)
                ->where('product_id', $request->product_id)
                ->whereNull('weight_id')
                ->whereNull('size_id')
                ->whereNull('size_number_id')
                ->first();
            if ($cart) {
                $cart->qty = $cart->qty + $request->qty;
                $cart->update();

                return Response::Out("success", "This product added to your cart!", "", 200);
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->product_id = $request->product_id;
                $cart->qty = $request->qty;
                $cart->save();

                return Response::Out("success", "Product add in your cart list!", "", 200);
            }
        }
    }
    public function quantityIncrement(Request $request, $id)
    {
        $cart_product = Cart::find($id);
        $product = Product::find($request->product_id);
        if (($cart_product->qty + $request->qty) > $product->available_quantity) {
            return Response::Out("fail", "Cart product quantity over product's quantity.", "", 200);
        }
        $cart_product->qty = $cart_product->qty + $request->qty;
        $cart_product->update();

        return Response::Out("success", "", "", 200);
    }
    public function quantityDecrement(Request $request, $id)
    {
        $cart = Cart::find($id);
        if (($cart->qty - $request->qty) > 0) {
            $cart->qty = $cart->qty - $request->qty;
            $cart->update();
            return Response::Out("success", "", "", 200);
        } else {
            return Response::Out("fail", "Cart product quantity is not available!", "", 200);
        }
    }
    public function countCartProducts($user_id)
    {
        return Cart::where('user_id', $user_id)->count();
    }
    public function removeCartProduct($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return Response::Out("success", "Product delete in your cart list!", "", 200);
    }
    public function getFavorites($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)
            ->with('product.offers', 'product.brand.offers', 'product.category.offers', 'product.sub_category.offers')
            ->latest()
            ->get();
        return FavoritesResource::collection($favorites);
    }
    public function storeInFavorite(Request $request, $user_id)
    {
        $favorite = Favorite::where('user_id', $user_id)->where('product_id', $request->product_id)->first();

        if ($favorite) {
            $favorite->delete();

            return Response::Out("success", "Product Remove Your Favorite List!", "", 200);
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user_id;
            $favorite->product_id = $request->product_id;
            $favorite->save();

            return Response::Out("success", "Product Added Your Favorite List!", "", 200);
        }
    }
    public function countFavoriteProducts($user_id)
    {
        return Favorite::where("user_id", $user_id)->count();
    }
    public function removeFavoriteProduct($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();

        return Response::Out("success", "Favorite Product Deleted!", "", 200);
    }
}
