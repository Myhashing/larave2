<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['web']], function () {
    Route::get('/suppliers','SupplierController@index');
    Route::post('/suppliers','SupplierController@store');
    Route::get('/suppliers/{id}','SupplierController@show');
    Route::post('/suppliers/products','SupplierController@showProducts');
    Route::delete('/suppliers/{id}','SupplierController@destroy');

    Route::get('/products','ProductController@index');
    Route::post('/products','ProductController@store');
    Route::get('/products/{id}','ProductController@show');
    Route::delete('/products/{id}','ProductController@destroy');


});