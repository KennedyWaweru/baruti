<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', 'FireworkController@index')->name('base');

Route::post('products/image_upload', 'ProductController@upload')->name('upload');
Route::get('products/checkSlug', 'ProductController@checkSlug')->name('products.checkSlug');
Route::resource('/products', 'ProductController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('fireworks/checkSlug', 'FireworkController@checkSlug')->name('fireworks.checkSlug');
Route::resource('/fireworks', FireworkController::class);

Route::get('packages/checkSlug','PackageController@checkSlug')->name('packages.checkSlug');
Route::resource('/packages',PackageController::class);


Route::get('order','OrderController@create')->name('order');
Route::get('orders','OrderController@index')->name('order_list');
Route::get('orders/{order}','OrderController@show')->name('order_page');
Route::post('order_completed/{order}','OrderController@complete')->name('order_completed');
Route::get('payment',function(){
  return redirect()->back();
});
Route::post('payment','OrderController@paymentOrder')->name('payment');
Route::get('categories/checkSlug', 'CategoryController@checkSlug')->name('category.checkSlug');
Route::get('categories','CategoryController@index')->name('category');
Route::get('categories/create','CategoryController@create')->name('category.create');
Route::post('categories','CategoryController@store')->name('category.store');
Route::get('categories/{category:slug}',[CategoryController::class, 'show'])->name('category.show');
Route::get('categories/{category:slug}/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::put('categories/{category:slug}/edit',[CategoryController::class,'update'])->name('category.update');
Route::delete('categories/{category:slug}',[CategoryController::class, 'destroy'])->name('category.destroy');


/* Gmail Auth */
Route::get('authorized/google', 'GoogleController@redirectToGoogle');
Route::get('authorized/google/callback', 'GoogleController@handleGoogleCallback');