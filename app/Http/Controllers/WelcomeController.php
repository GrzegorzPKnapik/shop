<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\ValueObjects\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index(){
        'cart' => Session::get('cart', new Cart());
        $products=Product::with('image')->get();
        return view('welcome', ['products'=>$products]);
    }
}
