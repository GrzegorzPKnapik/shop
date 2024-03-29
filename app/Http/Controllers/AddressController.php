<?php

namespace App\Http\Controllers;

use App\Enums\AddressStatus;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function index()
    {

        $user = Auth::user();



        $orders = Order::with('shopping_list.user')->whereHas('shopping_list.user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();


        $addresses = Address::with('user')->where('status', AddressStatus::NONE)->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();
        return view('account.index', ['addresses'=>$addresses, 'orders'=>$orders]);
    }


    public function order(Order $order)
    {
        //join działa
//        $order = Order::join('shopping_list', 'orders.SHOPPING_LISTS_id', '=', 'shopping_list.id')
//            ->join('shopping_lists_products', 'shopping_list.id', '=', 'shopping_lists_products.SHOPPING_LISTS_id')
//            ->join('products', 'shopping_lists_products.PRODUCTS_id', '=', 'products.id')
//            ->join('images', 'products.IMAGES_id', '=', 'images.id')
//            ->select('orders.id as order_id', 'user.*', 'addresses.*','shopping_lists_products.*', 'shopping_list.*','products.name as product_name','products.*', 'images.name as image_name', 'products.price as product_price')->where('orders.id', $order->id)
//            ->get();

        $order = Order::with(['address', 'shopping_list.user', 'shopping_list.shopping_lists_products.product.image'])->where('id', $order->id)->get();

        //dd($order);
        return view('account.order-preview',['order'=>$order]);
    }

    public function edit(Address $address){
        return view('account.address-edit',['address'=>$address]);
    }


    public function isAddress(){
        $user = Auth::user();
        $address = Address::where('selected', true)->where('USERS_id', $user->id)->where('status', AddressStatus::NONE)->first();

        return $address;

    }


    public function update(StoreAddressRequest $request, Address $address): RedirectResponse{

        $address->name = $request->name;
        $address->surname = $request->surname;
        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;
        $address->phone_number = $request->phone_number;
        $address->save();


        return redirect()->route('account.index');
    }


    public function destroy(Address $address): JsonResponse{

        if($address->selected)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Nie możesz usunąć głównego adresu!',
            ]);
        }



        try {
            $address->delete();
            return response()->json([
                'status' => 'success',
                'message' => __('shop.address.status.delete.success'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }


    public function selectAddress(Address $address): JsonResponse
    {

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

        return response()->json([
            'status' => 'success',
        ]);
    }


    public function store(StoreAddressRequest $request)
    {


        $user = Auth::user();


        $address = new Address($request->validated());
        $address->name = $request->name;
        $address->surname = $request->surname;
        $address->city = $request->city;
        $address->street = $request->street;
        $address->zip_code = $request->zip_code;
        $address->voivodeship = $request->voivodeship;
        $address->phone_number = $request->phone_number;
        $address->status = AddressStatus::NONE;
        $address->USERS_id = $user->id;

        $hasSelectedAddress = Address::where('selected', true)->where('USERS_id', $user->id)->first();

        if($hasSelectedAddress){
            //$address->selected = false;
            $hasSelectedAddress->selected=false;
            $hasSelectedAddress->save();

            $address->selected = true;
            $address->save();
            //$address->save();
        }else
            //jeżeli nie istnieje zaden adres
            $address->selected = true;
        $address->save();

        return response()->json([
            'status' => 'success',
        ]);
    }


}
