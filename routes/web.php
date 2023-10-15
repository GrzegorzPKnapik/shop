<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
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
        Route::delete('/account/address/{address}', [AccountController::class, 'destroy'])->name('address.delete');
        Route::get('/account/edit/{address}', [AccountController::class, 'edit'])->name('address.edit');
        Route::post('/account/update/{address}', [AccountController::class, 'update'])->name('address.update');
        Route::post('/account/updateSelected/{address}', [AccountController::class, 'updateSelected'])->name('address.updateSelected');
        Route::post('/account/store', [AccountController::class, 'store'])->name('address.store');
        Route::get('/account/order/{order}', [AccountController::class, 'order'])->name('account.order');
        Route::get('/account', [AccountController::class, 'index'])->name('account.index');
        Route::post('/change-address/{address}', [AccountController::class, 'changeAddress']);
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::get('/checkout/order_summary/{order}', [CheckoutController::class, 'order_summary'])->name('checkout.order_summary');;
        Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
        //Route::post('/isAddress/{form}', [CheckoutController::class, 'isAddress'])->name('checkout.isAddress');

        //checkoutContr na address
        Route::post('/addAddress', [AccountController::class, 'addAddress']);
    });


    Route::post('/load-cart-data', [CartController::class, 'cartCount']);
    Route::post('/cart/decrement/{product}', [CartController::class, 'decrement']);
    Route::post('/cart/increment/{product}', [CartController::class, 'increment']);
    Route::delete('/cart/{product}', [CartController::class, 'destroy']);
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->middleware('logged')->name('cart.index');;
});




