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

use App\Category;
use App\Product;
use App\Supplier;

Route::get('/', function () {
    $productList = Product::get();
    $supplierList = Supplier::get();
    $categoriesList = Category::get();
    /*TODO: Set validation for the all lists*/
    return view('index2', ['productList' => $productList, 'supplierList' => $supplierList, 'categoriesList' => $categoriesList]);
});


Route::post('/image', 'ImageController@store');

Route::group(['middleware' => ['web']], function () {
    Route::get('/suppliers', 'SupplierController@index');
    Route::post('/suppliers', 'SupplierController@store');
    Route::get('/suppliers/{id}', 'SupplierController@show');
    Route::delete('/suppliers/{id}', 'SupplierController@destroy');
    Route::get('/suppliers/edit/{id}', 'SupplierController@edit');
    Route::post('/suppliers/edit/{id}', 'SupplierController@update');

    Route::get('/products', 'ProductController@index');
    Route::post('/products', 'ProductController@store');
    Route::get('/products/{id}', 'ProductController@show');
    Route::get('/products/edit/{id}', 'ProductController@edit');
    Route::post('/products/edit/{id}', 'ProductController@update');
    Route::delete('/products/{id}', 'ProductController@destroy');

    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@store');
    Route::get('/categories/{id}', 'CategoryController@show');
    Route::delete('/categories/{id}', 'CategoryController@destroy');
    Route::get('/categories/edit/{id}', 'CategoryController@edit');
    Route::post('/categories/edit/{id}', 'CategoryController@update');

    Route::get('/orders', 'OrderController@index');
    Route::get('/orders/create/{id}', 'OrderController@create');
    Route::delete('/orders/{id}', 'OrderController@destroy');
    Route::post('/orders/add/{id}', 'OrderController@store');


});