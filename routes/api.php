<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\TwoFactorVerifyController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CollectionController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\GalleryCategoryController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\SizeNumberController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\WeightController;
use App\Http\Controllers\Frontend\CommonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// auth api routes
Route::post('/auth-check', [AuthController::class, 'authCheck']);

// * auth api routes for user
Route::post('/sign-up', [SignUpController::class, 'signUp']);
Route::post('/sign-in', [SignInController::class, 'signIn']);
Route::get('/sign-out', [SignOutController::class, 'signOut']);
Route::post('/forget-password', [ForgetPasswordController::class, 'forgotPasswordSend']);
Route::post('/email-otp-verify-for-forget-password', [ForgetPasswordController::class, 'emailOTPVerifyForgotPassword']);
Route::post('/phone-verify-for-forget-password', [ForgetPasswordController::class, 'phoneVerifyForgottenPassword']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordRequest']);
Route::post('/email-two-fa-verify', [TwoFactorVerifyController::class, 'twoFactorVerify']);
Route::post('/phone-two-fa-verify', [TwoFactorVerifyController::class, 'twoFactorVerify']);

// * admin authentication routes
Route::post('/admin-sign-in', [SignInController::class, 'adminSignIn']);



// backend routes
// * gallery category routes
Route::get('/gallery-categories-get', [GalleryCategoryController::class, 'galleryGet']);
Route::post('/gallery-category-store', [GalleryCategoryController::class, 'store']);
Route::get('/gallery-category-edit/{id}', [GalleryCategoryController::class, 'edit']);
Route::post('/gallery-category-update/{id}', [GalleryCategoryController::class, 'update']);
Route::get('/gallery-category-delete/{id}', [GalleryCategoryController::class, 'destroy']);

// * gallery routes
Route::get('/galleries-get', [GalleryController::class, 'get']);
Route::post('/gallery-store', [GalleryController::class, 'store']);
Route::post('/gallery-store/{gallery_category_id}', [GalleryController::class, 'storeGalleryWithGalleryCategory']);
Route::get('/gallery-info-or-edit/{id}', [GalleryController::class, 'infoOrEdit']);
Route::post('/gallery-update/{id}', [GalleryController::class, 'update']);
Route::get('/gallery-delete/{id}', [GalleryController::class, 'destroy']);
Route::post('/gallery-multiple-delete', [GalleryController::class, 'multipleDestroy']);
Route::get('/galleries-get-restore', [GalleryController::class, 'getRestore']);
Route::get('/gallery-restore/{id}', [GalleryController::class, 'restore']);
Route::get('/gallery-permanently-delete/{id}', [GalleryController::class, 'forseDestroy']);
Route::post('/gallery-multiple-restore', [GalleryController::class, 'multipleRestore']);
Route::post('/gallery-multiple-permanently-delete', [GalleryController::class, 'multipleForseDestroy']);
Route::get('/gallery-image-download/{id}', [GalleryController::class, 'imageDownload']);
// Route::get('/gallery-multiple-permanently-delete-in-restore', [GalleryController::class, 'multipleForseDestroyInRestore']);

// * size number routes as like sizes routes are
Route::get('/collections-get', [CollectionController::class, 'get']);
Route::get('/collection-status/{id}', [CollectionController::class, 'status']);
Route::post('/collection-store', [CollectionController::class, 'store']);
Route::get('/collection-edit/{id}', [CollectionController::class, 'edit']);
Route::post('/collection-update/{id}', [CollectionController::class, 'update']);
Route::get('/collection-delete/{id}', [CollectionController::class, 'destroy']);

// * brands routes
Route::get('/brands-get', [BrandController::class, 'get']);
Route::post('/brand-store', [BrandController::class, 'store']);
Route::get('/brand-status/{id}', [BrandController::class, 'status']);
Route::get('/brand-edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand-update/{id}', [BrandController::class, 'update']);
Route::get('/brand-delete/{id}', [BrandController::class, 'destroy']);

// * category routes
Route::get('/categories-get', [CategoryController::class, 'get']);
Route::post('/category-store', [CategoryController::class, 'store']);
Route::post('/category-icon-store-or-update/{id}', [CategoryController::class, 'iconStoreOrUpdate']);
Route::post('/category-banner-store-or-update/{id}', [CategoryController::class, 'bannerStoreOrUpdate']);
Route::get('/category-status/{id}', [CategoryController::class, 'status']);
Route::get('/category-edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category-update/{id}', [CategoryController::class, 'update']);
Route::get('/category-delete/{id}', [CategoryController::class, 'destroy']);

// * sub category routes as like category routes
Route::get('/sub-categories-get', [SubCategoryController::class, 'get']);
Route::post('/sub-category-store', [SubCategoryController::class, 'store']);
Route::post('/sub-category-banner-store-or-update/{id}', [SubCategoryController::class, 'bannerStoreOrUpdate']);
Route::get('/sub-category-status/{id}', [SubCategoryController::class, 'status']);
Route::get('/sub-category-edit/{id}', [SubCategoryController::class, 'edit']);
Route::post('/sub-category-update/{id}', [SubCategoryController::class, 'update']);
Route::get('/sub-category-delete/{id}', [SubCategoryController::class, 'destroy']);

// * color routes as like sub-category routes are
Route::get('/colors-get', [ColorController::class, 'get']);
Route::post('/color-store', [ColorController::class, 'store']);
Route::get('/color-edit/{id}', [ColorController::class, 'edit']);
Route::post('/color-update/{id}', [ColorController::class, 'update']);
Route::get('/color-delete/{id}', [ColorController::class, 'destroy']);

// * size routes as like colors routes are
Route::get('/sizes-get', [SizeController::class, 'get']);
Route::post('/size-store', [SizeController::class, 'store']);
Route::get('/size-edit/{id}', [SizeController::class, 'edit']);
Route::post('/size-update/{id}', [SizeController::class, 'update']);
Route::get('/size-delete/{id}', [SizeController::class, 'destroy']);

// * size number routes as like sizes routes are
Route::get('/size-numbers-get', [SizeNumberController::class, 'get']);
Route::post('/size-number-store', [SizeNumberController::class, 'store']);
Route::get('/size-number-edit/{id}', [SizeNumberController::class, 'edit']);
Route::post('/size-number-update/{id}', [SizeNumberController::class, 'update']);
Route::get('/size-number-delete/{id}', [SizeNumberController::class, 'destroy']);

// * weight routes as like sizes routes and controller WeightController
Route::get('/weights-get', [WeightController::class, 'get']);
Route::post('/weight-store', [WeightController::class, 'store']);
Route::get('/weight-edit/{id}', [WeightController::class, 'edit']);
Route::post('/weight-update/{id}', [WeightController::class, 'update']);
Route::get('/weight-delete/{id}', [WeightController::class, 'destroy']);

// * product routes as like category routes and controller ProductController
Route::get('/products-get', [ProductController::class, 'get']);
Route::post('/product-store', [ProductController::class, 'store']);
Route::get('/product-status/{id}', [ProductController::class, 'status']);
Route::get('/product-edit/{id}', [ProductController::class, 'edit']);
Route::post('/product-update/{id}', [ProductController::class, 'update']);
Route::get('/product-delete/{id}', [ProductController::class, 'destroy']);
Route::post('/multiple-product-delete', [ProductController::class, 'multipleDestroy']);

// * product image routes as like weight routes and controller ProductImageController
Route::get('/product-images-get', [ProductImageController::class, 'get']);
Route::post('/product-image-store', [ProductImageController::class, 'store']);
// Route::get('/product-image-edit/{id}', [ProductImageController::class, 'edit']);
Route::post('/product-image-update/{id}', [ProductImageController::class, 'update']);
Route::get('/product-image-delete/{id}', [ProductImageController::class, 'destroy']);
// * multiple images concept routes
Route::get('/product-images-get/{productId}', [ProductImageController::class, 'ProductImagesShow']);
Route::post('/product-images-store', [ProductImageController::class, 'ProductImagesStore']);
Route::get('/product-images-delete/{id}', [ProductImageController::class, 'ProductImageDestroy']);

Route::get('/offers-get', [OfferController::class, 'get']);
Route::post('/offer-store', [OfferController::class, 'store']);
Route::get('/offer-status/{id}', [OfferController::class, 'status']);
Route::get('/offer-edit/{id}', [OfferController::class, 'edit']);
Route::post('/offer-update/{id}', [OfferController::class, 'update']);
Route::get('/offer-delete/{id}', [OfferController::class, 'destroy']);


// * brands routes
Route::get('/banners-get', [BannerController::class, 'get']);
Route::post('/banner-store', [BannerController::class, 'store']);
Route::get('/banner-status/{id}', [BannerController::class, 'status']);
Route::get('/banner-edit/{id}', [BannerController::class, 'edit']);
Route::post('/banner-update/{id}', [BannerController::class, 'update']);
Route::get('/banner-delete/{id}', [BannerController::class, 'destroy']);
