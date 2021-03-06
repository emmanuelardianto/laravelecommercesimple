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

Route::get('/', 'App\Http\Controllers\Front\LandingPageController@index');


Route::group([
        'prefix' => 'admin',
        'namespace' => 'App\Http\Controllers\Admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'admin']
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

    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user/create', 'UserController@store')->name('user.store');
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/user/{user}/edit', 'UserController@store')->name('user.update');
    Route::post('/user/{user}/destroy', 'UserController@destroy')->name('user.destroy');
    
    Route::get('/transaction', 'TransactionController@index')->name('transaction');
    Route::get('/transaction/{transaction}', 'TransactionController@detail')->name('transaction.detail');
    Route::get('/transaction/{transaction}/update', 'TransactionController@update')->name('transaction.update');
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers\Front',
    'as' => 'front.'
],function () {
    Route::get('/product', 'ProductController@index')->name('product');
    Route::get('/category/{category}', 'ProductController@byCategory')->name('product.byCategory');
    Route::get('/product/{product}', 'ProductController@show')->name('product.detail');
});

Route::group([
    'prefix' => '/account',
    'namespace' => 'App\Http\Controllers\Front',
    'as' => 'front.',
    'middleware' => ['auth']
],function () {


    Route::get('/account', 'UserController@index')->name('user');
    Route::post('/account/', 'UserController@profileUpdate')->name('user.profile.update');
    Route::get('/account/wishlist', 'UserController@wishlist')->name('user.wishlist');
    Route::post('/account/wishlist/add', 'UserController@addWishlist')->name('user.wishlist.add');
    Route::post('/account/wishlist/remove/{wishlist}', 'UserController@removeWishlist')->name('user.wishlist.remove');
    Route::get('/account/transaction', 'UserController@transaction')->name('user.transaction');
    Route::get('/account/transaction/{transaction}', 'UserController@transactionDetail')->name('user.transactionDetail');
    Route::get('/account/security', 'UserController@password')->name('user.password');
    Route::post('/account/security', 'UserController@passwordUpdate')->name('user.password.update');
    Route::get('/account/profile', 'UserController@profile')->name('user.profile');
    Route::get('/', 'UserController@index')->name('user');
    Route::get('/wishlist', 'UserController@wishlist')->name('user.wishlist');
    Route::post('/wishlist/add', 'UserController@addWishlist')->name('user.wishlist.add');
    Route::post('/wishlist/remove/{wishlist}', 'UserController@removeWishlist')->name('user.wishlist.remove');

    Route::get('/address', 'AddressController@index')->name('user.address');
    Route::get('/address/create', 'AddressController@create')->name('user.address.create');
    Route::post('/address/create', 'AddressController@store')->name('user.address.store');
    Route::get('/address/{address}/edit', 'AddressController@edit')->name('user.address.edit');
    Route::post('/address/{address}/edit', 'AddressController@store')->name('user.address.update');
    Route::post('/address/{address}/destroy', 'AddressController@destroy')->name('user.address.destroy');

    Route::post('/cart/add/{product}', 'TransactionController@addToCart')->name('transaction.addToCart');
    Route::post('/cart/remove/{transactionItem}', 'TransactionController@removeFromCart')->name('transaction.removeFromCart');
    Route::get('/cart/', 'TransactionController@index')->name('transaction.cart');
    Route::post('/cart/{transactionItem}', 'TransactionController@updateQty')->name('transaction.cart.update');
    Route::get('/cart/address', 'TransactionController@address')->name('transaction.address');
    Route::post('/cart/address/{address}', 'TransactionController@selectAddress')->name('transaction.selectAddress');
    Route::get('/cart/payment', 'TransactionController@payment')->name('transaction.payment');
    Route::post('/cart/payment/', 'TransactionController@selectPayment')->name('transaction.selectPayment');
    Route::get('/cart/finalize', 'TransactionController@finalize')->name('transaction.finalize');
    Route::post('/cart/finalize', 'TransactionController@placeOrder')->name('transaction.placeOrder');
    Route::get('/transaction/{transaction}/thank-you', 'TransactionController@thankYou')->name('transaction.thankYou');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
