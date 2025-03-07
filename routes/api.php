<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\reviewcontroller;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CouponApplicationController;

/*********************** Public Routes ***********************/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);//notComplete
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/{id}', [AuthController::class, 'show']);
        Route::put('/{id}', [AuthController::class, 'update']);
    });

    Route::group(['prefix' => 'addresses'], function () {
        Route::get('/', [AddressController::class, 'index']);
        Route::post('/', [AddressController::class, 'store']);
        Route::get('/{id}', [AddressController::class, 'show']);
        Route::put('/{id}', [AddressController::class, 'update']);
        Route::delete('/{id}', [AddressController::class, 'destroy']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'addToCart']);
        Route::put('/{id}', [CartController::class, 'update']);
        Route::delete('/{id}', [CartController::class, 'destroy']);
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/checkout', [OrderController::class, 'checkout']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::put('/{id}', [OrderController::class, 'update']);
        Route::delete('/{id}', [OrderController::class, 'destroy']);
    });

// routes/api.php
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
// Route::post('/orders/{order}/ship', [OrderController::class, 'shipOrder'])->name('orders.ship');

Route::middleware('auth:api')->group(function () {
    Route::post('/orders/{order}/ship', [OrderController::class, 'shipOrder']);
});

    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::post('/', [PaymentController::class, 'store']);
        Route::get('/{id}', [PaymentController::class, 'show']);
        Route::put('/{id}', [PaymentController::class, 'update']);
        Route::delete('/{id}', [PaymentController::class, 'destroy']);
    });

    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('/', [WishlistController::class, 'index']);
        Route::post('/', [WishlistController::class, 'store']);
        Route::delete('/{id}', [WishlistController::class, 'destroy']);
    });

    Route::group(['prefix' => 'reviews'], function () {
        Route::get('/', [reviewcontroller::class, 'index']);
        Route::post('/', [reviewcontroller::class, 'store']);
        Route::get('/{id}', [reviewcontroller::class, 'show']);
        Route::put('/{id}', [reviewcontroller::class, 'update']);
        Route::delete('/{id}', [reviewcontroller::class, 'destroy']);
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/{id}', [NotificationController::class, 'show']);
        Route::put('/{id}', [NotificationController::class, 'update']);

    });

    Route::group(['prefix' => 'coupons'], function () {
        Route::post('/apply', [CouponController::class, 'apply']);
        Route::get('/', [CouponController::class, 'index']);
        Route::get('/{id}', [CouponController::class, 'show']);
    });
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::delete('/DeleteAll', [ProductController::class, 'deleteAll']);
        Route::get('/filter', [ProductController::class, 'filterCity']);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::group(['prefix' => 'suppliers'], function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('/{id}', [SupplierController::class, 'show']);
        Route::put('/{id}', [SupplierController::class, 'update']);
        Route::delete('/{id}', [SupplierController::class, 'destroy']);
    });

    //not Complete
    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/', [InventoryController::class, 'index']);
        Route::post('/', [InventoryController::class, 'store']);
        Route::get('/{id}', [InventoryController::class, 'show']);
        Route::put('/{id}', [InventoryController::class, 'update']);
        Route::delete('/{id}', [InventoryController::class, 'destroy']);
    });

    Route::group(['prefix' => 'promotions'], function () {
        Route::get('/', [PromotionController::class, 'index']);
        Route::post('/', [PromotionController::class, 'store']);
        Route::get('/{id}', [PromotionController::class, 'show']);
        Route::put('/{id}', [PromotionController::class, 'update']);
        Route::delete('/{id}', [PromotionController::class, 'destroy']);
    });

    Route::group(['prefix' => 'shipping'], function () {
        Route::get('/', [ShippingController::class, 'index']);
        Route::post('/', [ShippingController::class, 'store']);
        Route::get('/{id}', [ShippingController::class, 'show']);
        Route::put('/{id}', [ShippingController::class, 'update']);
        Route::delete('/{id}', [ShippingController::class, 'destroy']);
    });

    Route::group(['prefix' => 'coupon-applications'], function () {
        Route::get('/', [CouponApplicationController::class, 'index']);
        Route::post('/', [CouponApplicationController::class, 'store']);
        Route::get('/{id}', [CouponApplicationController::class, 'show']);
        Route::put('/{id}', [CouponApplicationController::class, 'update']);
        Route::delete('/{id}', [CouponApplicationController::class, 'destroy']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [AuthController::class, 'index']);
        Route::post('/', [AuthController::class, 'store']);
        Route::get('/{id}', [AuthController::class, 'show']);
        Route::put('/{id}', [AuthController::class, 'update']);
        Route::delete('/{id}', [AuthController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

Route::group(['prefix' => 'suppliers'], function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/{id}', [SupplierController::class, 'show']);
});


