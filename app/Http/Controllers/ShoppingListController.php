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

class ShoppingListController extends Controller
{
    private $orderController;
    private $checkoutController;

    public function __construct(OrderController $orderController, CheckoutController $checkoutController)
    {
        $this->orderController = $orderController;
        $this->checkoutController = $checkoutController;
    }

    public function show(Shopping_list $shopping_list)
    {
        $shopping_list = Shopping_list::with(['orders.address', 'user', 'shopping_lists_products.product.image'])->where('id', $shopping_list->id)->get();

        $collectionDates = $this->checkoutController->date();
        return view('shopping_list.index', ['shopping_list' => $shopping_list, 'collectionDates' => $collectionDates]);
    }

    public function save_day(Order $order, Request $request)
    {
        $this->orderController->save_day($order, $request);
    }


    public function save(Shopping_list $shopping_list){

        //dla nadpisania !=delivery
        $shopping_list = Shopping_list::where('SHOPPING_LISTS_id', $shopping_list->id)->first();



        $shopping_list->save;
        //$order->save;


        return redirect()->route('welcome.index');
    }


    public function upload(Shopping_list $shopping_list)
    {
        $uploadShopping_list = Shopping_list::where('id', $shopping_list->id)->first();

        $user = Auth::user();
        $shopping_list = Shopping_list::where('mode', 'edit')->where('USERS_id', $user->id)->first();

        //kopia tabeli


        //jezeli nie ma statusu =='delivered'
        //to po prostu nadpisuje sam shopping list do ordera
        //gdy jest...

        //$order = Order::where('SHOPPING_LISTS_id', $shopping_list->id)->first();

        //if($order->status=='delivered')
       // {
        //    //kopia
        //    if(isset($shopping_list))
        //    {
        //        $shopping_list->mode = 'cyclical';
        //        $shopping_list->save();
        //    }
        //    $uploadShopping_list->mode = 'edit';
       //     $uploadShopping_list->save();
//
      //  }


        //jeżeli aktualny jest edit
        if(isset($shopping_list))
        {
            $shopping_list->mode = 'cyclical';
            $shopping_list->save();
        }
            $uploadShopping_list->mode = 'edit';
            $uploadShopping_list->save();




        return redirect()->route('welcome.index');
    }



}
