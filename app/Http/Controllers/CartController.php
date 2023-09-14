<?php

namespace App\Http\Controllers;



use App\Models\Product;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        //dd(Session::get('cart',new Cart()));
        //$items=Product::with('image')->get();
        return view('cart.index',[
            //prześlij vartość cart jeśli nie ma to nowy pusty obiekt cart
            'cart' => Session::get('cart', new Cart(
            ))
        ]);
    }


    public function store(Product $product): JsonResponse
    {
        //pobieram z sesji obiekt koszyka jesli go nie ma to tworze nowy obiekt
        $cart = Session::get('cart', new Cart());
        Session::put('cart', $cart->addItem($product));
        return response()->json([
            'status' => 'success',
            'message' => (__('shop.cart.status.store.success'))
        ]);
    }



}
