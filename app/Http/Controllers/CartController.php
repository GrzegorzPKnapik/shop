<?php

namespace App\Http\Controllers;



use App\Dtos\Cart\CartDto;
use App\Dtos\Cart\CartItemDto;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $items=Product::with('image')->get();
        return view('cart.index',['items'=>$items]);
    }


    public function store(Product $product): JsonResponse{
        $cart = Session::get('cart', new CartDto());
        $items = $cart->getItems();
        if(Arr::exists($items, $product->id))
        {

        }else{
        $cartItemDto = new CartItemDto();
            $cartItemDto -> setProductId($product->id);
            $cartItemDto -> setName($product->name);

            $items[$product->id] = $cartItemDto;

        }

        Session::put('cart', $cart);
        return response()->json([
            'status' => 'success'
        ]);




    }



}
