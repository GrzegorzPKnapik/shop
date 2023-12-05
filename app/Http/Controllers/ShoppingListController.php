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
//    private $orderController;
//    private $checkoutController;
//
//    public function __construct(OrderController $orderController, CheckoutController $checkoutController)
//    {
//        $this->orderController = $orderController;
//        $this->checkoutController = $checkoutController;
//    }



    public function show(Shopping_list $shopping_list)
    {
        $user = Auth::user();
        $addresses = Address::with('user')->where('status', null)->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->orderByDesc('selected')->get();

        $shopping_list = Shopping_list::with(['orders', 'user', 'shopping_lists_products.product.image'])->where('id', $shopping_list->id)->get();

        $checkoutController = new CheckoutController();
        $collectionDates = $checkoutController->date();
        //$collectionDates = $this->checkoutController->date();
        return view('shopping_list.index', ['shopping_list' => $shopping_list, 'collectionDates' => $collectionDates, 'addresses' => $addresses]);
    }

    public function save_day(Shopping_list $shopping_list, Request $request)
    {
        if($request->select!=0)
        {
            $shopping_list->delivery_date = $request->select;
            $shopping_list->end_mod_date = $this->endDate($request->select);
            $shopping_list->mod_available_date = $this->mod_available_date($request->select);

        }


        try {
            $shopping_list->save();
            return response()->json([
                'status' => 'success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }


    public function delete_day(Shopping_list $shopping_list)
    {
        $shopping_list->delivery_date = null;
        $shopping_list->end_mod_date = null;
        $shopping_list->mod_available_date = null;


        try {
            $shopping_list->save();
            return response()->json([
                'status' => 'success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }


    public function saveTitle(Shopping_list $shopping_list, Request $request)
    {

            $shopping_list->title = $request->title;


        try {
            $shopping_list->save();
            return response()->json([
                'status' => 'success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function assignAddress(Shopping_list $shopping_list)
    {

        //kopia selecta

        $addressController = new AddressController();
        $address = $addressController->isAddress();


        if(!isset($address)){
            return response()->json([
                'status' => 'warning',
                'message' => 'Adres nie został podany!'
            ]);
        }



        $copiedAddress = new Address();
        $copiedAddress->name = $address->name;
        $copiedAddress->surname = $address->surname;
        $copiedAddress->city = $address->city;
        $copiedAddress->street = $address->street;
        $copiedAddress->zip_code = $address->zip_code;
        $copiedAddress->voivodeship = $address->voivodeship;
        $copiedAddress->phone_number = $address->phone_number;
        $copiedAddress->status = 'order';
        $copiedAddress->USERS_id = $address->USERS_id;
        $copiedAddress->save();



        $shopping_list->ADDRESSES_id = $copiedAddress->id;


        try {
            $shopping_list->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Adres został przypisany'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Błąd zapisu w bazie! ' . $e->getMessage()
            ])->setStatusCode(500);
        }


    }

    //zapis zmian w sl

    /*public function active(Shopping_list $shopping_list){

        if($shopping_list->active == null)
        {
            $shopping_list->active = true;
        }else
            $shopping_list->active = null;

        //zrób order


        $shopping_list->save();


        return redirect()->route('account.index');

    }
    *///tworzenie nowej sl
    //_____do tego save może być
    public function save(Shopping_list $shopping_list){

        //każdy użytkownik no nie musi mieć unikalnych ale zeby program wypluwał nowe mu

        $user = Auth::user();

        if($shopping_list->mode == 'normal')
        {
            $title_number = Shopping_list::where('USERS_id', $user->id)->where('title', 'like', '%Twoja lista zakupów%')->orderBy('id', 'desc')->first();

            if(!isset($title_number))
            {
                //jeżeli nie ma ani jednej takiej listy
                $number = 1;
            }else
            {
                $pattern = '/#(\d+)/';
                preg_match($pattern, $title_number, $matches);
                $number = $matches[1];
                $number++;
            }

            $shopping_list->title = 'Twoja lista zakupów #' . $number;
        }


        $shopping_list->mode = 'shopping_list';
        $shopping_list->status = null;
        $shopping_list->save();

        $old_cart = Shopping_list::where('status', 'cart_disable')->where('mode', 'normal')->where('USERS_id', $user->id)->first();

        if(isset($old_cart))
        {
            $old_cart->status = 'cart';
            $old_cart->save();
        }

        return redirect()->route('account.index')->with('status',__('shop.address.status.delete.success'));
    }


/*    public function save(Shopping_list $shopping_list){

        //$shopping_list->mode = 'shopping_list';
        $shopping_list->status = 'shopping_list';
        $shopping_list->save();
        $user = Auth::user();

        $old_cart_shopping_list = Shopping_list::where('status', 'disable')->whereNull('mode')->where('USERS_id', $user->id)->first();

        if(isset($old_cart_shopping_list))
        {
            $old_cart_shopping_list->status = 'cart';
            $old_cart_shopping_list->save();
        }

        return redirect()->route('welcome.index');


    }*/
    //zmienic nazwe na finish czy final


    public function upload(Shopping_list $shopping_list)
    {



        if($shopping_list->status == 'stop'){
            return response()->json([
                'status' => 'warning',
                'message' => 'Lista zablokowana, nie powinno cie tu być!'
            ]);
        }

        /*$is_not_available = Order::where('SHOPPING_LISTS_id', $shopping_list->id)->where([
            ['status', 'in_prepare'],
        ]);

        if(isset($is_not_available)){
            return response()->json([
                'status' => 'warning',
                'message' => 'Lista zablokowana!'
            ]);
        }*/



        $user = Auth::user();
        //stara lista zapupów załadowane cart
        $old_cart_shopping_list = Shopping_list::where('status', 'cart')->where('mode', 'shopping_list')->where('USERS_id', $user->id)->first();
        //stare zamówienie jednorazowe załadowane cart
        $old_cart = Shopping_list::where('status', 'cart')->where('mode', 'normal')->where('USERS_id', $user->id)->first();



        if(isset($old_cart))
        {
            $old_cart->status = 'cart_disable';
            $old_cart->save();
        }

        //kliknięcie w ten sam rekord
        if(isset($old_cart_shopping_list))
            if ($old_cart_shopping_list->id == $shopping_list->id)
            {
                return redirect()->route('welcome.index');
            }

        //jezeli stare bylo listą zakupów to zmien z cart na shopping_list
        if(isset($old_cart_shopping_list))
        {
            $old_cart_shopping_list->status = null;
            $old_cart_shopping_list->save();
        }
        //nie działa

        //jeżeli jest nie zablokowana czyli status nie order
        if($shopping_list->status == 'resume')
        {
            $this->copy($shopping_list);

            //starą ustawiam na shopping_list
            //$shopping_list->status = null;
            //$shopping_list->save();

            return redirect()->route('welcome.index');


        }






        $shopping_list->status = 'cart';
        $shopping_list->save();



        return redirect()->route('welcome.index');
    }



    public function copyToCart(Shopping_list $shopping_list)
    {
        $user = Auth::user();
        $old_cart_shopping_list = Shopping_list::where('status', 'cart')->where('mode', 'shopping_list')->where('USERS_id', $user->id)->first();
        $old_cart = Shopping_list::where('status', 'cart')->where('mode', 'normal')->where('USERS_id', $user->id)->first();
        $depricated_cart = Shopping_list::where('status', 'cart_disable')->where('USERS_id', $user->id)->first();

        // usuń strary koszyk
        if(isset($depricated_cart))
        {
            $depricated_cart->delete();
        }


        //jeżeli istniał wcześniej koszyk normalny to
        if(isset($old_cart))
        {
            $old_cart->status = 'cart_disable';
            $old_cart->save();
        }

        if(isset($old_cart_shopping_list))
        {
            $old_cart_shopping_list->status = null;
            $old_cart_shopping_list->save();
        }

        $copiedShoppingList = new Shopping_list();

        $copiedShoppingList->total = $shopping_list->total;
        $copiedShoppingList->mode = 'normal';
        $copiedShoppingList->status = 'cart';
        $copiedShoppingList->end_mod_date = null;
        $copiedShoppingList->mod_available_date = null;
        $copiedShoppingList->USERS_id = $shopping_list->USERS_id;

        $copiedShoppingList->save();


        //kopia asocjacyjnej

        $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->get();


        foreach ($shopping_lists_product as $product) {
            $copiedShoppingListsProduct = new Shopping_lists_product();
            $copiedShoppingListsProduct->sub_total = $product->sub_total;
            $copiedShoppingListsProduct->quantity = $product->quantity;
            $copiedShoppingListsProduct->PRODUCTS_id = $product->PRODUCTS_id;
            $copiedShoppingListsProduct->SHOPPING_LISTS_id = $copiedShoppingList->id;
            $copiedShoppingListsProduct->save();
        }

        return redirect()->route('welcome.index');
    }

/*    public function upload(Shopping_list $shopping_list)
    {
        //$shopping_list = Shopping_list::where('id', $shopping_list->id)->first();

        $user = Auth::user();
        //stara lista zapupów załadowane cart
        $old_cart_shopping_list = Shopping_list::where('status', 'cart')->where('mode', 'shopping_list')->where('USERS_id', $user->id)->first();
        //stare zamówienie jednorazowe załadowane cart
        $old_cart = Shopping_list::where('status', 'cart')->where('mode', 'normal')->where('USERS_id', $user->id)->first();


        //kopia tabeli
        $order_is_delivered = Order::where('SHOPPING_LISTS_id', $shopping_list->id)->where('status', 'delivered')->first();


        if(isset($old_cart))
        {
            $old_cart->status = 'disable';
            $old_cart->save();
        }

        //kliknięcie w ten sam rekord
        if(isset($old_cart_shopping_list))
            if ($old_cart_shopping_list->id == $shopping_list->id)
            {
                return redirect()->route('welcome.index');
            }


        //jezeli stare bylo listą zakupów to zmien z cart na shopping_list
        if(isset($old_cart_shopping_list))
        {
            $old_cart_shopping_list->status = 'shopping_list';
            $old_cart_shopping_list->save();
        }

        //jeżeli jest dostarczony, utwórz kopie
        if(isset($order_is_delivered))
        {

            $this->copy($shopping_list, $order_is_delivered);

            //starą ustawian na shopping_list
            $shopping_list->status = 'shopping_list';
            $shopping_list->save();

            return redirect()->route('welcome.index');


        }


        $shopping_list->status = 'cart';
        $shopping_list->save();


        return redirect()->route('welcome.index');
    }*/



    /**
     * @param Shopping_list $shopping_list
     * @param $order_is_delivered
     * @return void
     */
    public function copy(Shopping_list $shopping_list): void
    {
        $order = Order::where('SHOPPING_LISTS_id', $shopping_list->id)->first();


        $copiedShoppingList = new Shopping_list();

        $copiedShoppingList->title = $shopping_list->title;
        $copiedShoppingList->total = $shopping_list->total;
        $copiedShoppingList->mode = $shopping_list->mode;
        $copiedShoppingList->status = 'cart';
        $copiedShoppingList->delivery_date = $shopping_list->delivery_date;
        $copiedShoppingList->mod_available_date = $shopping_list->mod_available_date;
        $copiedShoppingList->end_mod_date = $shopping_list->end_mod_date;
        $copiedShoppingList->created_at = $shopping_list->created_at;
        $copiedShoppingList->updated_at = $shopping_list->updated_at;
        $copiedShoppingList->USERS_id = $shopping_list->USERS_id;

        $copiedShoppingList->save();


        //kopia asocjacyjnej
        $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->get();


        foreach ($shopping_lists_product as $product) {
            $copiedShoppingListsProduct = new Shopping_lists_product();
            $copiedShoppingListsProduct->sub_total = $product->sub_total;
            $copiedShoppingListsProduct->quantity = $product->quantity;
            $copiedShoppingListsProduct->created_at = $product->created_at;
            $copiedShoppingListsProduct->updated_at = $product->updated_at;
            $copiedShoppingListsProduct->PRODUCTS_id = $product->PRODUCTS_id;
            $copiedShoppingListsProduct->SHOPPING_LISTS_id = $copiedShoppingList->id;
            $copiedShoppingListsProduct->save();
        }

        //orde też musze skopiować tworze order z tymi samymi danymi ale zminia sie id shopping_list na skopiowaną

        $copiedOrder = new Order();
        $copiedOrder->set_delivery_date = $shopping_list->set_delivery_date;
        $copiedOrder->create_date = $order->create_date;
        $copiedOrder->created_at = $order->created_at;
        $copiedOrder->updated_at = $order->updated_at;
        $copiedOrder->DELIVERIES_id = $order->DELIVERIES_id;
        $copiedOrder->PAYMENTS_id = $order->PAYMENTS_id;
        $copiedOrder->ADDRESSES_id = $order->ADDRESSES_id;
        $copiedOrder->SHOPPING_LISTS_id = $copiedShoppingList->id;


        $copiedOrder->save();
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