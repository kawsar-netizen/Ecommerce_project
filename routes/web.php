<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForntendController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;

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

//================================ Admin Route =====================

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
