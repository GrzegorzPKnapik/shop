<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Models\Shopping_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
**/





Auth::routes();

Route::get('/home', function () {
    return view('home');
})->middleware('can:isUser');

Route::group(['middleware' => 'cart'], function (){


    Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
    Route::delete('/product/{product}', [ProductController::class, 'destroy']);
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::resource('product', ProductController::class)->only([
        'create', 'index', 'edit', 'update'
    ]);
    Route::group(['middleware' => 'logged'], function () {

        //address
        Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
        Route::get('/address/edit/{address}', [AddressController::class, 'edit'])->name('address.edit');
        Route::post('/address/update/{address}', [AddressController::class, 'update'])->name('address.update');
        Route::delete('/address/{address}', [AddressController::class, 'destroy'])->name('address.delete');
        Route::post('/address/select/{address}', [AddressController::class, 'selectAddress'])->name('address.selectAddress');
        //order
        Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/order/show/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/order/summary/{order}', [OrderController::class, 'summary'])->name('order.summary');

        //shopping list
        Route::get('/shopping_lists/cyclic_show/{order}', [OrderController::class, 'cyclic_show'])->name('order.cyclic_show');

        //account
        Route::get('/account', [AccountController::class, 'index'])->name('account.index');

        //chceckout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    });


    Route::post('/load-cart-data', [CartController::class, 'cartCount']);
    Route::post('/cart/decrement/{product}', [CartController::class, 'decrement']);
    Route::post('/cart/increment/{product}', [CartController::class, 'increment']);
    Route::delete('/cart/{product}', [CartController::class, 'destroy']);
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->middleware('logged')->name('cart.index');;
});




