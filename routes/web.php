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

Route::get('/', function () {
    return view('layout');
});


Route::group([
        'prefix' => 'admin',
        'namespace' => 'App\Http\Controllers\Admin',
        'as' => 'admin.'
    ],function () {
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/category/create', 'CategoryController@store')->name('category.store');
    Route::get('/category/{category}/edit', 'CategoryController@edit')->name('category.edit');
    Route::post('/category/{category}/edit', 'CategoryController@store')->name('category.update');
    Route::post('/category/{category}/destroy', 'CategoryController@destroy')->name('category.destroy');

    Route::get('/product', 'ProductController@index')->name('product');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/create', 'ProductController@store')->name('product.store');
    Route::get('/product/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::post('/product/{product}/edit', 'ProductController@store')->name('product.update');
    Route::post('/product/{product}/destroy', 'ProductController@destroy')->name('product.destroy');
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers\User',
    'as' => 'user.'
],function () {
    Route::get('/product', 'ProductController@index')->name('product');
    Route::get('/category/{category}', 'ProductController@byCategory')->name('product.byCategory');
    Route::get('/product/{product}', 'ProductController@show')->name('product.detail');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
