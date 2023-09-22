<?php

namespace App\Http\Controllers;



use App\Models\Image;
use App\Models\Product;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        //dd(Session::get('cart',new Cart()));
        //$items=Product::with('image')->get();
        return view('cart.index',[
            //prześlij vartość cart jeśli nie ma to nowy pusty obiekt cart
            'cart' => Session::get('cart', new Cart(
            ))
        ]);
    }


    public function store(Product $product): JsonResponse
    {
        //pobieram z sesji obiekt koszyka jesli go nie ma to tworze nowy obiekt
        $cart = Session::get('cart', new Cart());
        Session::put('cart', $cart->addItem($product));
        return response()->json([
            'status' => 'success',
            'message' => (__('shop.cart.status.store.success'))
        ]);
    }



    public function destroy(Product $product): JsonResponse{

        try {
            $cart = Session::get('cart', new Cart());
            Session::put('cart', $cart->removeItem($product));
            //Session::flash('status', __('shop.product.status.delete.success'));

            return response()->json([
                'status' => 'success',
                'message' =>  __('shop.product.status.delete.success')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }

    }


    public function increment(Product $product): JsonResponse
    {
        //pobieram z sesji obiekt koszyka jesli go nie ma to tworze nowy obiekt
        $cart = Session::get('cart', new Cart());
        Session::put('cart', $cart->addItem($product));
        return response()->json([
            'status' => 'success',
            'message' => (__('shop.cart.status.store.success'))
        ]);
    }

    public function decrement(Product $product): JsonResponse
    {
        //pobieram z sesji obiekt koszyka jesli go nie ma to tworze nowy obiekt
        $cart = Session::get('cart', new Cart());
        Session::put('cart', $cart->decrementQuantity($product));
        return response()->json([
            'status' => 'success',
            'message' => (__('shop.cart.status.store.success'))
        ]);
    }






}
