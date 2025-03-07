<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeBannerController;
// use App\Http\Controllers\LocaleSessionRedirectController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        // 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//------------------------------------------------------------------------
//------------------------------------------------------------------------
Route::get('/send',[FrontController::class,'send']);
//------------------------------------------------------------------------
//------------------------------------------------------------------------



Route::get('/',[FrontController::class,'index']);
Route::get('/shop',[FrontController::class,'shop']);
Route::get('/shop/product/{id}',[FrontController::class,'show_product']);

//............Dashboard Route....................
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove_from_cart');

//---------------------------------------------------------------
//---------------------------------------------------------------
 Route::get('/search', [ProductController::class, 'search'])->name('search');
//---------------------------------------------------------------
// ...........Front Product Details  Route........................


Route::get('admin',[AdminController::class,'index']);
Route::POST('admin/auth',[AdminController::class,'auth'])->name('admin.auth');


Route::group(['middleware'=>'admin_auth'],function(){

Route::get('admin/dashboard',[AdminController::class,'dashboard']);

// ............Category Route........................
Route::get('admin/category',[CategoryController::class,'index']);
Route::get('admin/category/create',[CategoryController::class,'create']);
Route::get('admin/category/create/{id}',[CategoryController::class,'manage_category']);
Route::post('admin/category/manage_category_process',[CategoryController::class,'store'])->name('category.store');
Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);


// ............Report Route........................
Route::get('admin/report',[ReportController::class,'index']);


// ............Coupon Route........................

Route::get('admin/coupon',[CouponController::class,'index']);
Route::get('admin/coupon/create',[CouponController::class,'create']);
//Route::get('admin/coupon/edit/{id}',[CouponController::class,'edit']);
Route::post('admin/coupon/store',[CouponController::class,'store'])->name('coupon.store');
Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']);
Route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status']);

//............Size............................................

Route::get('admin/size',[SizeController::class,'index']);
Route::get('admin/size/manage_size',[SizeController::class,'manage_size']);
Route::get('admin/size/manage_size/{id}',[SizeController::class,'manage_size']);
Route::post('admin/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process');
Route::get('admin/size/delete/{id}',[SizeController::class,'delete']);
Route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']);

//............Color............................................

Route::get('admin/color',[ColorController::class,'index']);
Route::get('admin/color/create',[ColorController::class,'create'])->name('color.create');
//Route::get('admin/color/edit/{id}',[ColorController::class,'edit']);
Route::post('admin/color/store',[ColorController::class,'store'])->name('color.store');
Route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']);

//............Products............................................

Route::get('admin/product',[ProductController::class,'index']);
Route::get('admin/product/create',[ProductController::class,'create']);
//Route::get('admin/product/manage_product/{id}',[ProductController::class,'add_product']);
Route::post('admin/product/create',[ProductController::class,'store'])->name('product.store');
Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);


//Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
//Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
//Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);

//............Brands............................................

Route::get('admin/brand',[BrandController::class,'index']);
Route::get('admin/brand/create_brand',[BrandController::class,'create'])->name('brand.create');
Route::post('admin/brand/manage_brand_process',[BrandController::class,'store'])->name('brand.store');
Route::get('admin/brand/delete/{id}',[BrandController::class,'delete']);
Route::get('admin/brand/status/{status}/{id}',[BrandController::class,'status']);

//............Tax............................................

Route::get('admin/tax',[TaxController::class,'index']);
Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']);
Route::get('admin/tax/manage_tax/{id}',[TaxController::class,'manage_tax']);
Route::post('admin/tax/manage_tax_process',[TaxController::class,'manage_tax_process'])->name('tax.manage_tax_process');
Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']);

//............Customers............................................

Route::get('admin/customer',[CustomerController::class,'index']);
Route::get('admin/customer/show/{id}',[CustomerController::class,'show']);
Route::get('admin/customer/status/{status}/{id}',[CustomerController::class,'status']);

// ............Home Brand Route........................

Route::get('admin/homebanner',[HomeBannerController::class,'index']);
Route::get('admin/homebanner/manage_homebanner',[HomeBannerController::class,'manage_homebanner']);
Route::get('admin/homebanner/manage_homebanner/{id}',[HomeBannerController::class,'manage_homebanner']);
Route::post('admin/homebanner/manage_homebanner_process',[HomeBannerController::class,'manage_homebanner_process'])->name('homebanner.manage_homebanner_process');
Route::get('admin/homebanner/delete/{id}',[HomeBannerController::class,'delete']);
Route::get('admin/homebanner/status/{status}/{id}',[HomeBannerController::class,'status']);


// ............Order Route........................

Route::get('admin/order',[OrderController::class,'index']);
Route::get('admin/order_detail/{id}',[OrderController::class,'order_detail']);
Route::post('admin/order_detail/{id}',[OrderController::class,'update_track_detail']);
Route::get('admin/update_payemnt_status/{status}/{id}',[OrderController::class,'update_payemnt_status']);
Route::get('admin/update_order_status/{status}/{id}',[OrderController::class,'update_order_status']);


// Route::get('admin/updatepassword',[AdminController::class,'updatepassword']);
Route::get('admin/logout', function () {
  session()->forget('ADMIN_LOGIN');
  session()->forget('ADMIN_ID');

      return redirect('admin');
});

});


Route::get('/verification/{id}',[FrontController::class,'email_verification']);
Route::post('forgot_password',[FrontController::class,'forgot_password']);
Route::get('/forgot_password_change/{id}',[FrontController::class,'forgot_password_change']);
Route::post('forgot_password_change_process',[FrontController::class,'forgot_password_change_process']);
Route::get('/Checkout',[FrontController::class,'Checkout']);

Route::post('apply_coupon_code',[FrontController::class,'apply_coupon_code']);
Route::post('remove_coupon_code',[FrontController::class,'remove_coupon_code']);

// ................Order Place .......................

Route::post('place_order',[FrontController::class,'place_order']);
Route::get('/order_placed',[FrontController::class,'order_placed']);

// .................Instamojo route.......................

Route::get('/order_fail',[FrontController::class,'order_fail']);
Route::get('/instamojo_payment_redirect',[FrontController::class,'instamojo_payment_redirect']);

// ................ My Order  menu  Place .......................

Route::group(['middleware'=>'user_auth'],function(){

Route::get('/order',[FrontController::class,'order']);
Route::get('/order_detail/{id}',[FrontController::class,'order_detail']);
});



});

