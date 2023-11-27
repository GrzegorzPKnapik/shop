<?php

namespace App\Http\Controllers;

use App\Enums\AddressStatus;
use App\Enums\ShoppingListStatus;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Shopping_list;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function index()
    {

        $user = Auth::user();


        $shopping_lists = Shopping_list::with(['user', 'orders'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->where('mode', 'shopping_list')
            ->orderBy('updated_at', 'desc')
            ->where(function(\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '!=', ShoppingListStatus::getResume())->orWhereNull('status');
            })
            /*->orWhereNull('status')*/
            ->get();

        /*  $shopping_lists = Shopping_list::with(['user'])
              ->whereHas('user', function ($query) use ($user) {
                  $query->where('id', $user->id);
              })
              ->where("mode", 'shopping_list')
              ->get();*/


        $orders = Order::with('shopping_list.user')->whereHas('shopping_list.user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();


        $addresses = Address::with('user')->where('status', AddressStatus::getNone())->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();
        return view('account.index', ['addresses'=>$addresses, 'orders'=>$orders, 'shopping_lists'=>$shopping_lists]);
    }




    public function edit(Address $address){
        return view('account.address-edit',['address'=>$address]);
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
