<?php

namespace App\Http\Controllers;


use App\Models\Orders;
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
        //return view('checkout.index',[
        //    'cart' => Session::get('cart', new Cart())
        //]);
        return view('checkout.index');
    }

    public function order_summary(Shopping_list $shopping_list)
    {
        return view('checkout.order_summary',['order'=>$shopping_list]);
    }


    public function store()
    {


        $user = Auth::user();

        $r = Shopping_list::where('status', 'lista_a');


        $order = new Orders();
        //$order->total = $cart->total;
        //$shopping_list->mode =
        //$shopping_list->status =
        //$shopping_list->mod_available_date
        $order->SHOPPING_LIST_id = $r->id;

        try {
            $order->save();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie!'
            ])->setStatusCode(500);
        }



        Session::forget('cart');
        return redirect()->route('checkout.order_summary', $shopping_list)->with('status',__('shop.product.status.store.success'));
    }



}
