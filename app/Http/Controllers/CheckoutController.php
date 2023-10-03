<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use App\ValueObjects\Cart;

class CheckoutController extends Controller
{

    public function index()
    {
        return view('checkout.index',[
            'cart' => Session::get('cart', new Cart())
        ]);
    }




}
