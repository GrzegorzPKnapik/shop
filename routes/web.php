<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
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

Route::delete('/product/{product}', [ProductController::class, 'destroy']);
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::resource('product', ProductController::class)->only([
    'create', 'index', 'edit', 'update'
]);
