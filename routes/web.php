<?php

use Illuminate\Support\Facades\Route;

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

Route::get('index', 'IndexController@index');
Route::post('index', 'IndexController@store');

Route::get('cart', 'CartController@index');
Route::post('cart', 'CartController@store');
Route::delete('cart/{cartID}', 'CartController@destroy');

Auth::routes();

Route::get('products', 'ProductsController@index')->name('products');
Route::get('products/{productID}/edit', 'ProductsController@edit')->name('products.edit');
Route::delete('products/{productsID}', 'ProductsController@destroy')->name('products.delete');

