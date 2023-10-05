<?php

namespace App\Http\Controllers;


use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
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

    public function order_summary(Shopping_list $shopping_list)
    {
        return view('checkout.order_summary',['order'=>$shopping_list]);
    }


    public function store()
    {

        $cart = Session::get('cart', new Cart());

        $user = Auth::user();


        $shopping_list = new Shopping_list();
        $shopping_list->total = $cart->getSum();
        //$shopping_list->mode =
        //$shopping_list->status =
        //$shopping_list->mod_available_date
        $shopping_list->USERS_id = $user->id;

        try {
            $shopping_list->save();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie!'
            ])->setStatusCode(500);
        }


        foreach ($cart->getItems() as $item)
        {
            $shopping_lists_product = new Shopping_lists_product();

            $shopping_lists_product->sub_total = $item->getSubTotal();
            $shopping_lists_product->quantity = $item->getQuantity();
            $shopping_lists_product->SHOPPING_LISTS_id =$shopping_list->id;
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
        return redirect()->route('checkout.order_summary', $shopping_list)->with('status',__('shop.product.status.store.success'));
    }



}
