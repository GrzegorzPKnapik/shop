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


    //save jest na bieżąco wykonywany
    public function savee(Shopping_list $shopping_list){

        //dla nadpisania !=delivery



        $shopping_list->save;
        //$order->save;


        return redirect()->route('welcome.index');
    }


    //zmienic nazwe na finish czy final
    public function save(Shopping_list $shopping_list){

        $shopping_list->mode = 'cyclical';
        $shopping_list->status = 'order';
        $shopping_list->save();
        $user = Auth::user();

        $old_cart_shopping_list = Shopping_list::where('status', 'disable')->whereNull('mode')->where('USERS_id', $user->id)->first();

        if(isset($old_cart_shopping_list))
        {
            $old_cart_shopping_list->status = 'shopping_list';
            $old_cart_shopping_list->save();
        }

        return redirect()->route('welcome.index');


    }


    public function upload(Shopping_list $shopping_list)
    {
        //$shopping_list = Shopping_list::where('id', $shopping_list->id)->first();

        $user = Auth::user();
        $old_shopping_list = Shopping_list::where('mode', 'edit')->where('USERS_id', $user->id)->first();

        $old_cart_shopping_list = Shopping_list::where('status', 'shopping_list')->whereNull('mode')->where('USERS_id', $user->id)->first();


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

        //manipulacja stary cart i s_l
        //jeśli istnieje cart to disable
        //stary card
        if(isset($old_cart_shopping_list))
        {
            $old_cart_shopping_list->status = 'disable';
            $old_cart_shopping_list->save();
        }


        //operacje dla manipulacji s_l
        if(isset($old_shopping_list))
        {
            //stara
            $old_shopping_list->status = 'order';
            $old_shopping_list->mode = 'cyclical';
            $old_shopping_list->save();
        }
            //nowa
            $shopping_list->status = 'shopping_list';
            $shopping_list->mode = 'edit';
            $shopping_list->save();






        return redirect()->route('welcome.index');
    }



}
