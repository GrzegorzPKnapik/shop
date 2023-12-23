<?php

namespace App\Http\Controllers;


use App\Enums\OrderStatus;
use App\Enums\ShoppingListActive;
use App\Enums\ShoppingListMode;
use App\Enums\ShoppingListStatus;
use App\Events\PurchaseSuccesful;
use App\Events\ShoppingListActivated;
use App\Models\Address;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\Status;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
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

    public function index()
    {
        $orders = Order::all();
        return view('order.index', ['orders' => $orders]);

    }

    public function updateStatus(Order $order, Request $request)
    {
        $order->status = $request->status;
        $order->save();
        return redirect(route('order.index'));
    }

    public function editStatus(Order $order)
    {
        $statuses = Order::allStatuses();
        return view('order.editStatus',['order'=>$order, 'statuses'=>$statuses]);
    }


    public function summary(Order $order)
    {


        $items = Order::join('shopping_lists', 'orders.SHOPPING_LISTS_id', '=', 'shopping_lists.id')
            ->join('shopping_lists_products', 'shopping_lists.id', '=', 'shopping_lists_products.SHOPPING_LISTS_id')
            ->join('products', 'shopping_lists_products.PRODUCTS_id', '=', 'products.id')
            ->join('images', 'products.IMAGES_id', '=', 'images.id')
            ->select('orders.id as order_id', 'orders.*', 'shopping_lists_products.*', 'shopping_lists.*', 'products.name as product_name', 'products.*', 'images.name')->where('orders.id', $order->id)
            ->get();

        $order = Order::with(['shopping_list.user', 'shopping_list.address', 'shopping_list.shopping_lists_products.product.image'])->where('id', $order->id)->first();
        //dd($order->shopping_list);
        return view('order.order_summary', ['items' => $items, 'order' => $order]);
    }



    //git
    public function show(Order $order)
    {

        $order = Order::with(['shopping_list.address', 'shopping_list.user'])
        ->with(['shopping_list.shopping_lists_products' => function($query)
        {
            $query->where('confirmed', true);
        }])
            ->where('id', $order->id)
            ->get();

        return view('order.order_show', ['order' => $order]);
    }



    public function save_day(Order $order, Request $request)
    {

//        $object = json_decode($request->select);
//
//
//        $deliveryDayDate = $object[0]->date;

       // $user = Auth::user();

            //$shopping_list = Shopping_list::where('status', 'shopping_list')->where('USERS_id', $user->id)->first();
            //najpier kopia potem id do ordera czyli id do shoppoing_list

        $s_l = Shopping_list::where('id', $order->SHOPPING_LISTS_id)->first();




        if($request->select!=0)
        {
            $order->delivery_date = $request->select;
            $s_l->end_mod_date = $this->endDate($request->select);
            $s_l->mod_available_date = $this->mod_available_date($request->select);

        }




            try {
            $s_l->save();
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

    public function storeSL(Shopping_list $shopping_list)
    {


        $order = new Order();
        $order->SHOPPING_LISTS_id = $shopping_list->id;
        $order->status = OrderStatus::NONE;


        try {
            $order->save();
            return response()->json([
                //event(new PurchaseSuccesful($order)),
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
        $user = Auth::user();
        $shopping_list = Shopping_list::where('status', ShoppingListStatus::CART)
            ->where('USERS_id', $user->id)
            ->with('shopping_lists_products.product')
            ->first();

        if(!isset($shopping_list->address)){
            return response()->json([
                'status' => 'warning',
                'message' => 'Adres nie został przypisany!'
            ]);
        }




        /*foreach ($shopping_list->shopping_lists_products as $item_product) {
            if(!$item_product->product->status->isEnable())
            {
                $item_product->update(['confirmed' => false]);
                //$item_product->confirmed = false;
                //$item_product->save();
            }else if ($item_product->product->status->isEnable() && $item_product->selected == true)
            {
                $item_product->update(['confirmed' => true]);

                //$item_product->confirmed = true;
                //$item_product->save();
            }
        }*/

        $order = new Order();
        $order->SHOPPING_LISTS_id = $shopping_list->id;
        $order->status = OrderStatus::NONE;

        $shopping_list->delivery_date = $request->selectDate;
        $shopping_list->end_mod_date = null;
        $shopping_list->mod_available_date = null;
        $shopping_list->status = ShoppingListStatus::ORDER;

        try {
            $shopping_list->save();
            $order->save();
            return response()->json([
                'status' => 'success',
                'order' => $order->id,
            event(new PurchaseSuccesful($order))
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
            ])->setStatusCode(500);
        }



    }



    public function nextDate()
    {
        $daysToAdd = 7;
        $date = date('Y-m-d', strtotime("+$daysToAdd days"));
        return $date;
    }


    private function endDate($date)
    {
        $end_date = date('Y-m-d', strtotime($date . ' -1 day'));
        return $end_date;
    }

    private function mod_available_date($date)
    {
        $mod_date = date('Y-m-d', strtotime($date . ' -2 day'));
        return $mod_date;
    }




}
