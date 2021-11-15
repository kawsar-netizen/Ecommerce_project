<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForntendController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Fontend\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Fontend\CheckoutController;
use App\Http\Controllers\Fontend\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',[ForntendController::class,'index']);

Auth::routes();

//fortend route
Route::get('/home', [HomeController::class, 'index'])->name('home');

//================================ Backend Route =====================

//================================ Admin Login =====================

Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin');
Route::get('admin', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [LoginController::class, 'login']);
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');

//======================== Admin Category ==========================

Route::get('admin/categories',[CategoryController::class,'index'])->name('admin.category');
Route::post('admin/categories',[CategoryController::class,'store'])->name('store.category');
Route::get('admin/categories/edit/{id}',[CategoryController::class,'edit']);
Route::post('admin/categories/update',[CategoryController::class,'update'])->name('update.category');
Route::get('admin/categories/delete/{id}',[CategoryController::class,'delete']);
Route::get('admin/categories/inactive/{id}',[CategoryController::class,'inactive']);
Route::get('admin/categories/active/{id}',[CategoryController::class,'active']);

//======================== Admin Brand ==========================

Route::get('admin/brands',[BrandController::class,'index'])->name('admin.brand');
Route::post('admin/brands',[BrandController::class,'store'])->name('store.brand');
Route::get('admin/brands/edit/{id}',[BrandController::class,'edit']);
Route::post('admin/brands/update',[BrandController::class,'update'])->name('update.brand');
Route::get('admin/brands/delete/{id}',[BrandController::class,'delete']);
Route::get('admin/brands/inactive/{id}',[BrandController::class,'inactive']);
Route::get('admin/brands/active/{id}',[BrandController::class,'active']);

//======================== Admin Product ==========================

Route::get('admin/product/add',[ProductController::class,'add_product'])->name('admin.product.add');
Route::post('admin/product/store',[ProductController::class,'store_products'])->name('store.products');
Route::get('admin/product/manage',[ProductController::class,'manage_product'])->name('admin.manage.product');
Route::get('admin/product/edit/{id}',[ProductController::class,'product_edit']);
Route::post('admin/product/update',[ProductController::class,'update_product'])->name('update.product');
Route::post('admin/product/update/image',[ProductController::class,'update_image'])->name('update.image');
Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
Route::get('admin/product/inactive/{id}',[ProductController::class,'inactive']);
Route::get('admin/product/active/{id}',[ProductController::class,'active']);

//======================== Admin Coupon ==========================

Route::get('admin/coupons',[CouponController::class,'index'])->name('admin.coupon');
Route::post('admin/coupons',[CouponController::class,'store'])->name('store.coupon');
Route::get('admin/coupons/edit/{id}',[CouponController::class,'edit_coupon']);
Route::post('admin/coupons/update',[CouponController::class,'update_coupon'])->name('update.coupon');
Route::get('admin/coupons/delete/{id}',[CouponController::class,'delete_coupon']);
Route::get('admin/coupons/inactive/{id}',[CouponController::class,'inactive']);
Route::get('admin/coupons/active/{id}',[CouponController::class,'active']);

//=============================== Fontend Route ===============================

//=============================== Add to Cart ==================================

Route::post('add_cart/{product_id}',[CartController::class,'AddtoCart'])->name('add.to_cart');
Route::get('cart',[CartController::class,'cartPage'])->name('cart.page');
Route::get('cart/destroy/{cart_id}',[CartController::class,'destroy']);
Route::post('cart/quantity/update/{cart_id}',[CartController::class,'quantity_update']);
Route::post('coupon/apply',[CartController::class,'coupon_apply']);
Route::get('coupon/destroy',[CartController::class,'coupon_destroy']);

//=============================== Add to Wishlist ==================================

Route::get('add_wishlist/{product_id}',[WishlistController::class,'AddWishlist'])->name('add.wishlist');
Route::get('wishlist',[WishlistController::class,'wishlistpage'])->name('wishlist.page');
Route::get('wishlist/destroy/{wishlist_id}',[WishlistController::class,'destroy']);

//=============================== Product Details ==================================

Route::get('product/details/{product_id}',[ForntendController::class,'product_details']);

//=============================== Checkout Route ==================================

Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');

//=============================== Order Route ==================================

Route::post('place/order',[OrderController::class,'orderstore'])->name('place_order');