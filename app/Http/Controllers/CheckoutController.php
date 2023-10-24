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






}
