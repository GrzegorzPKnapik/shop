<?php

namespace App\Http\Controllers;


use App\Models\Shopping_lists_product;
use Exception;
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


    public function store()
    {

        $cart = Session::get('cart', new Cart());
        foreach ($cart->getItems() as $item)
        {
            $shopping_lists_product = new Shopping_lists_product();

            $shopping_lists_product->sub_total = $item->getSubTotal();
            $shopping_lists_product->quantity = $item->getQuantity();
            //$shopping_lists_product->SHOPPING_LISTS_id =2;
            $shopping_lists_product->PRODUCTS_id = $item->getProductId();
            try {
                $shopping_lists_product->save();
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Błąd zapisu w bazie!'
                ])->setStatusCode(500);
            }
        }

        Session::forget('cart');
        return redirect()->route('product.index')->with('status',__('shop.product.status.store.success'));
    }



}
