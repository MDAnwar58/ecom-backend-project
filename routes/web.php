<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OfferController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\GuestUser;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthUser::class])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/category-list', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/cart-list', [CartController::class, 'index'])->name('cart');
    Route::get('/order-place', [OrderController::class, 'index'])->name('order.place');

    // sign out route
    Route::get('/sign-out', [SignOutController::class, 'signOut'])->name('sign.out');
});


Route::middleware(GuestUser::class)->group(function () {
    // Route::get('/sign-in', [SignInController::class, 'signInPage'])->name('sign.in');
    // Route::get('/sign-up', [SignUpController::class, 'signUpPage'])->name('sign.up');
    Route::get('/forget-password', [ForgetPasswordController::class, 'forgetPasswordPage'])->name('forget.password');
    $num = 765;
    Route::get('/reset-password/organic-chat-t-234rpp-' . $num, [ResetPasswordController::class, 'resetPasswordPage'])->name('reset.password');

    // auth post routes 
    Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('sign.up');
    Route::post('/sign-in', [SignInController::class, 'signIn'])->name('sign.in');
    Route::post('/forget-password-send', [ForgetPasswordController::class, 'forgotPasswordSend'])->name('forgot.password.send');
    Route::post('/reset-password-request', [ResetPasswordController::class, 'resetPasswordRequest'])->name('reset.password.request');
    Route::post('/email-otp-verify', [ForgetPasswordController::class, 'emailOTPVerifyForgotPassword'])->name('email.otp.verify');
    Route::post('/phone-verify-for-forget-password', [ForgetPasswordController::class, 'phoneVerifyForgottenPassword'])->name('phone.otp.verify.forgot.password');
});


// // admin panel pages routes
// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// Route::get('/admin/brands', [App\Http\Controllers\Backend\BrandController::class, 'index'])->name('admin.brand');
// Route::get('/admin/categories', [App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('admin.category');
// Route::get('/admin/sub-categories', [App\Http\Controllers\Backend\SubCategoryController::class, 'index'])->name('admin.sub.category');
// Route::get('/admin/products', [App\Http\Controllers\Backend\ProductController::class, 'index'])->name('admin.product');