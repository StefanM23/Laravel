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
Route::get('index','ProductsController@index');
Route::post('index', 'ProductsController@index');
Route::post('cart','CartController@store');
Route::get('cart','CartController@index');
Route::delete('cart','CartController@destroy');

