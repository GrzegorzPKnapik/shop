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


        /*$shopping_lists = Shopping_list::with(['user'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->where('mode', 'shopping_list')
            ->orderBy('updated_at', 'desc')
            ->where(function(\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '!=', ShoppingListStatus::ORDER)->orWhereNull('status');
            })->get();*/

        /*$shopping_lists = Shopping_list::with(['user'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->where('mode', 'shopping_list')``
            ->orderBy('updated_at', 'desc')
            ->where(function(\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '!=', ShoppingListStatus::ORDER)->orWhereNull('status');
            })->get();*/


        /*$latest_orders = collect();

        foreach ($shopping_lists as $shopping_list) {
            $latest_order = Order::where('SHOPPING_LISTS_id', $shopping_list->id)
                ->orderByDesc('created_at')
                ->skip(1) // Pominięcie ostatniego rekordu, aby uzyskać przedostatni
                ->first();

            if ($latest_order) {
                $latest_orders->push($latest_order);
            }
        }

        $shopping_lists = $shopping_lists->with($latest_orders)->get();*/

        /*$shopping_lists = Shopping_list::with(['user'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->where('mode', 'shopping_list')
            ->orderBy('updated_at', 'desc')
            ->where(function(\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '!=', ShoppingListStatus::ORDER)->orWhereNull('status');
            })->get();

        $s_l_title = $shopping_lists->title;
        $order = Order::whereHas('shopping_list', function ($query) use ($s_l_title) {
            $query->where('title', $s_l_title)
            ->orderBy('created_at', 'desc')
                ->skip(1) // Pomijamy najnowszy element
                ->take(1);
        })
            ->first();

        $shopping_lists = Shopping_list::with(['user'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->where('mode', 'shopping_list')
            ->orderBy('updated_at', 'desc')
            ->where(function(\Illuminate\Database\Eloquent\Builder $query) {
                $query->where('status', '!=', ShoppingListStatus::ORDER)->orWhereNull('status');
            })->with($order)->get();*/





        $orders = Order::with('shopping_list.user')->whereHas('shopping_list.user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();


        $addresses = Address::with('user')->where('status', AddressStatus::NONE)->whereHas('user', function ($query) use ($user){
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
