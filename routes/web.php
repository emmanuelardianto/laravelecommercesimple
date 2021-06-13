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
});