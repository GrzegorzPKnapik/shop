<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingListController;
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
    //shop
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


    //category
    Route::resource('category', CategoryController::class)->only([
        'create', 'index', 'edit', 'update', 'store'
    ]);
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy']);





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
        Route::post('/order/storeSL/{shopping_list}', [OrderController::class, 'storeSL'])->name('order.storeSL');
        Route::get('/order/show/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/order/summary/{order}', [OrderController::class, 'summary'])->name('order.summary');



        //shopping list
        Route::get('/shopping_list/show/{shopping_list}', [ShoppingListController::class, 'show'])->name('shoppingList.show');
        Route::post('/shopping_list/delete_day/{shopping_list}', [ShoppingListController::class, 'delete_day'])->name('shoppingList.delete_day');
        Route::post('/shopping_list/save_day/{shopping_list}', [ShoppingListController::class, 'save_day'])->name('shoppingList.save_day');
        Route::get('/shopping_list/upload/{shopping_list}', [ShoppingListController::class, 'upload'])->name('shoppingList.upload');
        Route::get('/shopping_list/copyToCart/{shopping_list}', [ShoppingListController::class, 'copyToCart'])->name('shoppingList.copyToCart');



        Route::post('/shopping_list/assign/address/{shopping_list}', [ShoppingListController::class, 'assignAddress'])->name('shoppingList.assignAddress');
        Route::post('/shopping_list/save/title/{shopping_list}', [ShoppingListController::class, 'saveTitle'])->name('shoppingList.saveTitle');
        Route::get('/shopping_list/save/{shopping_list}', [ShoppingListController::class, 'save'])->name('shoppingList.save');
        Route::get('/shopping_list/active/{shopping_list}', [ShoppingListController::class, 'active'])->name('shoppingList.active');




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




