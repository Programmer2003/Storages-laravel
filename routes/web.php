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


Route::get('/', 'IndexController')->name('index');

Route::group(['namespace' => 'Product'], function () {
    Route::get('/{storage}/products/', 'IndexController')->name('product.index');
    Route::get('/{storage}/products/create', 'CreateController')->name('product.create');
    Route::post('/products', 'StoreController')->name('product.store');
    Route::post('/products/{product}', 'ShowController')->name('product.show');
    Route::get('/{storage}/products/{product}/edit', 'EditController')->name('product.edit');
    Route::patch('/products/{product}', 'UpdateController')->name('product.update');
    Route::get('/products/{product}/delete', 'DeleteController')->name('product.delete');
    Route::delete('/products/{product}', 'DestroyController')->name('product.destroy');
});
