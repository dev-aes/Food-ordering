<?php

// Admin Restful Controllers

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TaxController;

// User Restful Controllers
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CouponController as UserCouponController;

// Facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin',  'as' => 'admin.'], function() {
    Route::resource('dashboard', AdminDashboardController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
    Route::get('order/{order}', AdminOrderController::class)->name('order.show');

});



Route::group(['middleware' => ['auth', 'user'], 'as' => 'user.'], function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('order', OrderController::class);
    Route::post('coupon', UserCouponController::class)->name('coupon.show');
});




Auth::routes(['register' => false]);
