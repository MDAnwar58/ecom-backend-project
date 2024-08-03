<?php


use App\Http\Controllers\Frontend\BannerController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CollectionController;
use App\Http\Controllers\Frontend\CommonController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\OfferController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;



// frontend api routes
// * common routes
Route::get('/all-category-get-for-manus', [CommonController::class, 'get']);
Route::get('/get-carts/{user_id}', [CommonController::class, 'getCarts']);
Route::post('/product-add-to-cart/{user_id}', [CommonController::class, 'storeInCart']);
Route::post('/cart-product-qty-increment/{id}', [CommonController::class, 'quantityIncrement']);
Route::post('/cart-product-qty-decrement/{id}', [CommonController::class, 'quantityDecrement']);
Route::get('/cart-product-count/{user_id}', [CommonController::class, 'countCartProducts']);
Route::get('/remove-product-in-cart-list/{id}', [CommonController::class, 'removeCartProduct']);
Route::get('/get-favorites/{user_id}', [CommonController::class, 'getFavorites']);
Route::post('/product-add-to-favorite/{user_id}', [CommonController::class, 'storeInFavorite']);
Route::get('/favorite-product-count/{user_id}', [CommonController::class, 'countFavoriteProducts']);
Route::get('/remove-product-in-favorite-list/{id}', [CommonController::class, 'removeFavoriteProduct']);

// * home routes
Route::get('/banner', [BannerController::class, 'get']);
Route::get('/our-categories', [CategoryController::class, 'get']);
Route::get('/offer-banners', [OfferController::class, 'get']);
Route::get('/collections', [CollectionController::class, 'get']);
Route::get('/all-products-get', [ProductController::class, 'get']);
Route::get('/modal-product/{id}', [ProductController::class, 'modalDetailsShow']);
Route::get('/all-offers-get', [OfferController::class, 'offerGet']);
Route::get('/get-category-id', [ProductController::class, 'categoryId']);


// * contact routes
Route::post('/contact-store', [ContactController::class, 'store']);
