<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TagerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GenralController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail']);


  Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::group(['prefix' => 'shipping'], function () {
        Route::get('/', [CityController::class, 'index']);
        Route::post('/', [CityController::class, 'store']);
        Route::get('/show', [CityController::class, 'show']);
        Route::put('/{id}', [CityController::class, 'update']);
        Route::delete('/{id}', [CityController::class, 'destroy']);
        Route::delete('/DeleteAll', [CityController::class, 'deleteAll']);
        Route::get('/filter', [CityController::class, 'filterCity']);
        //
    });
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::post('/', [ProductController::class, 'store']);
            Route::get('/show', [ProductController::class, 'show']);
            Route::put('/{id}', [ProductController::class, 'update']);
            Route::delete('/{id}', [ProductController::class, 'destroy']);
            Route::delete('/DeleteAll', [ProductController::class, 'deleteAll']);
            Route::get('/filter', [ProductController::class, 'filterCity']);
        });

        Route::group(['prefix' => 'category'], function () {
            Route::post('/', [CategoryController::class, 'store']);
        });

        Route::group(['prefix' => 'supplier'], function () {
            Route::post('/', [SupplierController::class, 'store']);
        });




        Route::group(['prefix' => 'coupon'], function () {
            Route::post('/', [CouponController::class, 'store']);
        });

        //Cart Route Without Auth
        Route::prefix('cart')->group(function () {
            Route::post('/add', [CartController::class, 'addToCart']);
            Route::get('/', [CartController::class, 'viewCart']);
            Route::put('/update/{id}', [CartController::class, 'updateCart']);
            Route::delete('/remove/{id}', [CartController::class, 'removeFromCart']);
        });
        //end cart routes
        // Orders
        Route::post('/order/checkout', [OrderController::class, 'checkout']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);

        //payment routes
        Route::post('/create_payment', [PaymentController::class, 'createPaymentIntent']);
        Route::post('/confirm-payment', [PaymentController::class, 'confirmPayment']);
        //end payment routes



});

