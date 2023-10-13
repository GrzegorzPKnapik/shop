<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function index()
    {

        $user = Auth::user();



        $orders = Order::with('shopping_list.user')->whereHas('shopping_list.user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();


        $addresses = Address::with('contact','user')->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();
        return view('account.index', ['addresses'=>$addresses, 'orders'=>$orders]);
    }


    public function order(Order $order)
    {
        //join działa
//        $order = Order::join('shopping_lists', 'orders.SHOPPING_LISTS_id', '=', 'shopping_lists.id')
//            ->join('shopping_lists_products', 'shopping_lists.id', '=', 'shopping_lists_products.SHOPPING_LISTS_id')
//            ->join('products', 'shopping_lists_products.PRODUCTS_id', '=', 'products.id')
//            ->join('images', 'products.IMAGES_id', '=', 'images.id')
//            ->select('orders.id as order_id', 'users.*', 'addresses.*','shopping_lists_products.*', 'shopping_lists.*','products.name as product_name','products.*', 'images.name as image_name', 'products.price as product_price')->where('orders.id', $order->id)
//            ->get();

        $order = Order::with(['shopping_list.user.addresses.contact','shopping_list.shopping_lists_products.product.image'])->where('id', $order->id)->get();

        //dd($order);
        return view('account.order-preview',['order'=>$order]);
    }

    public function edit(Address $address){
        return view('account.address-edit',['address'=>$address]);
    }


    public function store(StoreAddressRequest $request): RedirectResponse
    {

        $user = Auth::user();

        $contact = new Contact($request->validated());
        $contact->phone_number = $request->phone_number;
        $contact->save();

        $address = new Address($request->validated());
        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;
        $address->CONTACTS_id = $contact->id;
        $address->USERS_id=$user->id;

        $hasSelectedAddress = Address::where('selected', true)->where('USERS_id', $user->id)->first();

        if($hasSelectedAddress){
            $address->selected = false;
            $address->save();
        }else
        $address->selected = true;
        $address->save();

        return redirect()->route('account.index')->with('status',__('shop.address.status.store.success'));
    }

    public function update(StoreAddressRequest $request, Address $address): RedirectResponse{
        $contact = Contact::find($address->CONTACTS_id);
        $contact->phone_number = $request->phone_number;
        $contact->save();

        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;
        $address->save();


        return redirect()->route('account.index');
    }

    public function updateSelected(Address $address): RedirectResponse{

        $user = Auth::user();
        $oldAddress = Address::where('selected', true)->where('USERS_id', $user->id)->first();
        $newAddress = Address::where('id', $address->id)->first();
        //dzieki onchange nie trzeba Address::where('id', $address->id)->first(); bo musimy pracowac na obiekcie nowym czyli na $oldAddress

        if($oldAddress != $newAddress) {
                $oldAddress->selected = false;
                $oldAddress->save();

            $newAddress->selected = true;
            $newAddress->save();
        }

        return redirect()->route('account.index');
    }


    public function destroy(Address $address): RedirectResponse{

        try {
            $address->delete();
            return redirect()->route('account.index')->with('status',__('shop.address.status.delete.success'));
        } catch (Exception $e) {
            return redirect()->route('account.index')->with('status',__('shop.address.status.delete.fail'))->setStatusCode(500);
        }

    }


}
