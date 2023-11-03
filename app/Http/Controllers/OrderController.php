<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\ValueObjects\Cart;
use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{

    private $checkoutController;

    public function __construct(CheckoutController $checkoutController)
    {
        $this->checkoutController = $checkoutController;
    }

    //git
    public function summary(Order $order)
    {


        $items = Order::join('shopping_lists', 'orders.SHOPPING_LISTS_id', '=', 'shopping_lists.id')
            ->join('shopping_lists_products', 'shopping_lists.id', '=', 'shopping_lists_products.SHOPPING_LISTS_id')
            ->join('products', 'shopping_lists_products.PRODUCTS_id', '=', 'products.id')
            ->join('images', 'products.IMAGES_id', '=', 'images.id')
            ->select('orders.id as order_id', 'orders.*', 'shopping_lists_products.*', 'shopping_lists.*', 'products.name as product_name', 'products.*', 'images.name')->where('orders.id', $order->id)
            ->get();

        $order = Order::with(['address', 'shopping_list.user', 'shopping_list.shopping_lists_products.product.image'])->where('id', $order->id)->get();

        return view('order.order_summary', ['items' => $items, 'order' => $order]);
    }



    //git
    public function show(Order $order)
    {
        //join działa
//        $order = Order::join('shopping_list', 'orders.SHOPPING_LISTS_id', '=', 'shopping_list.id')
//            ->join('shopping_lists_products', 'shopping_list.id', '=', 'shopping_lists_products.SHOPPING_LISTS_id')
//            ->join('products', 'shopping_lists_products.PRODUCTS_id', '=', 'products.id')
//            ->join('images', 'products.IMAGES_id', '=', 'images.id')
//            ->select('orders.id as order_id', 'users.*', 'addresses.*','shopping_lists_products.*', 'shopping_list.*','products.name as product_name','products.*', 'images.name as image_name', 'products.price as product_price')->where('orders.id', $order->id)
//            ->get();

        $order = Order::with(['address', 'shopping_list.user', 'shopping_list.shopping_lists_products.product.image'])->where('id', $order->id)->get();

        //dd($order);
        return view('order.order_show', ['order' => $order]);
    }

//git


    public function save_day(Order $order, Request $request)
    {

//        $object = json_decode($request->select);
//
//
//        $deliveryDayDate = $object[0]->date;

       // $user = Auth::user();

            //$shopping_list = Shopping_list::where('status', 'shopping_list')->where('USERS_id', $user->id)->first();
            //najpier kopia potem id do ordera czyli id do shoppoing_list

        if($request->select!=0)
            $order->set_delivery_date = $request->select;



            try {
                $order->save();
                return response()->json([
                    'status' => 'success',
                    'order' => $order->id
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
                ])->setStatusCode(500);
            }


    }



    public function store(Request $request)
    {

        $object = json_decode($request->deliveryDate);

        $deliveryDayName = $object[0]->name;
        $deliveryDayDate = $object[0]->date;


        $addressController = new AddressController();
        $address = $addressController->isAddress();

        if(isset($address)){

        $user = Auth::user();

        $shopping_list = Shopping_list::where('status', 'shopping_list')->where('USERS_id', $user->id)->first();
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


        //zapis dnia w bazie danych czyli nie zpisy=uje dnia tylko date tego dnia i poźniej sie bedą n





        $order = new Order();
        if($request->select==0)

            $order->set_delivery_date = $deliveryDayDate;
        else{
            $order->set_delivery_date = $request->select;
            $shopping_list->mode = 'cyclical';
        }

        $order->SHOPPING_LISTS_id = $shopping_list->id;
        $order->ADDRESSES_id = $copiedAddress->id;

        $shopping_list->status = 'order';

        try {
            $shopping_list->save();
            $order->save();
            return response()->json([
                'status' => 'success',
                'order' => $order->id
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
            ])->setStatusCode(500);
        }
        }else
            return response()->json([
                'status' => 'warning',
                'message' => 'Adres nie został podany!'
            ]);


    }







}
