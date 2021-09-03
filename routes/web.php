<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/sp', function () {
    return view('single_page');
});

Route::get('index', 'IndexController@index')->name('index');
Route::post('index', 'IndexController@store');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store');
Route::delete('cart/{cartID}', 'CartController@destroy');

Auth::routes();
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('products', 'ProductsController@index')->name('products.index');

Route::get('product/create', 'ProductsController@create')->name('product.create');
Route::get('product/{productID}/edit', 'ProductsController@edit')->name('product.edit');
Route::delete('products/{productsID}', 'ProductsController@destroy');

Route::post('product', 'ProductController@store')->name('product.store');
Route::put('product/{productID}', 'ProductController@update')->name('product.update');

Route::get('orders', 'OrderController@index')->name('orders.index');

Route::get('orders_products/{orderId}', 'OrderProductController@show')->name('order.show');

Route::get('tag/{id}', 'TagController@show')->name('tag.show');
Route::post('tag', 'TagController@store')->name('tag');