<?php

namespace App\Http\Controllers;


use App\Models\Order;
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

    public function order_summary(Order $order)
    {

        $items = Order::join('shopping_lists', 'orders.SHOPPING_LISTS_id', '=', 'shopping_lists.id')
            ->join('shopping_lists_products', 'shopping_lists.id', '=', 'shopping_lists_products.SHOPPING_LISTS_id')
            ->join('products', 'shopping_lists_products.PRODUCTS_id', '=', 'products.id')
            ->join('images', 'products.IMAGES_id', '=', 'images.id')
            ->select('orders.id as order_id', 'shopping_lists_products.*', 'shopping_lists.*','products.name as product_name','products.*', 'images.name')->where('orders.id', $order->id)
            ->get();


        return view('checkout.order_summary',['items'=>$items]);
    }



    public function store()
    {


        $user = Auth::user();

        $r = Shopping_list::where('status', 'lista_zakupów')->first();


        $order = new Order();
        //$order->total = $cart->total;
        //$shopping_list->mode =
        //$shopping_list->status =
        //$shopping_list->mod_available_date
        $order->SHOPPING_LISTS_id = $r->id;

        $r->status = 'zamówienie';
        $r->save();

        try {
            $order->save();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie!'
            ])->setStatusCode(500);
        }

       // <a href="{{ route('product.edit', $product->id) }}">

        return redirect()->route('checkout.order_summary', $order->id)->with('status',__('shop.product.status.store.success'));
    }



}
