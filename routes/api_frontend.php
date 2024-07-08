<?php


use App\Http\Controllers\Frontend\BannerController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CollectionController;
use App\Http\Controllers\Frontend\CommonController;
use App\Http\Controllers\Frontend\OfferController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;



// frontend api routes
// * common routes
Route::get('/all-category-get', [CommonController::class, 'get']);

// * home routes
Route::get('/banner', [BannerController::class, 'get']);
Route::get('/our-categories', [CategoryController::class, 'get']);
Route::get('/offer-banners', [OfferController::class, 'get']);
Route::get('/collections-get', [CollectionController::class, 'get']);
Route::get('/all-products-get', [ProductController::class, 'get']);
Route::get('/all-offers-get', [OfferController::class, 'offerGet']);