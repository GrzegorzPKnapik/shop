<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\ValueObjects\Cart;
use function PHPUnit\Framework\isNull;

class CheckoutController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $addresses = Address::with('user')->where('status', null)->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();

        return view('checkout.index',['addresses'=>$addresses]);
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

        $shopping_list = Shopping_list::where('status', 'lista_zakupów')->where('USERS_id', $user->id)->first();
        //najpier kopia potem id do ordera czyli id do shoppoing_list


        $toCopyAddress = Address::where('USERS_id', $user->id)->where('selected', true)->first();

        $copiedAddress = new Address();
        $copiedAddress->name = $toCopyAddress->name;
        $copiedAddress->surname = $toCopyAddress->surname;
        $copiedAddress->city = $toCopyAddress->city;
        $copiedAddress->street = $toCopyAddress->street;
        $copiedAddress->zip_code = $toCopyAddress->zip_code;
        $copiedAddress->voivodeship = $toCopyAddress->voivodeship;
        $copiedAddress->phone_number = $toCopyAddress->phone_number;
        $copiedAddress->status = 'order';
        $copiedAddress->USERS_id = $toCopyAddress->USERS_id;
        $copiedAddress->save();

        $order = new Order();
        $order->SHOPPING_LISTS_id = $shopping_list->id;
        $order->ADDRESSES_id = $copiedAddress->id;
        $order->save();

        $shopping_list->status = 'zamówienie';
        $shopping_list->save();

        try {
            $order->save();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie!'
            ])->setStatusCode(500);
        }

        return redirect()->route('checkout.order_summary', $order->id)->with('status',__('shop.product.status.store.success'));
    }


    public function isAddress(){


        $user = Auth::user();
        $address = Address::where('selected', true)->where('USERS_id', $user->id)->where('status', null)->first();
        //jeżeli to i to jest puste to dopiero


        if(isset($address)){
            return $this->store();
        }else
            return response()->json([
                'status' => 'warning',
            ]);


    }




}
