<?php

namespace App\Http\Controllers;



use App\Models\Image;
use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Services\CartService;
use App\Services\ShoppingList;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getItems():Cart
    {
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        if($shopping_list != null)
            $this->cart = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image','shopping_list')->get();
        return $this->cart;
    }

    public function index(): View
    {
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        if($shopping_list != null)
            $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image','shopping_list')->get();
        $cart = new ShoppingList($shopping_lists_product);

        $cart =$shopping_list;
            $item = $shopping_lists_product;
        return view('cart.index',[
            //'cart' => $cart,
            //'items' => $item
        ]);
    }

    //count unique products


    public function cartcount(): JsonResponse{

        //$cart=Session::get('cart', new Cart());
        //$cartcount=$cart->getItems()->count();

        $cartcount=$this->cartService->getQuantity();

        return response()->json([
            'count' => $cartcount,
        ]);
    }


    public function store(Product $product): JsonResponse
    {
        $this->cartService->addItem($product);

        return response()->json([
            'status' => 'success',
            'message' => (__('shop.cart.status.store.success'))
        ]);
    }


    public function destroy(Product $product): JsonResponse{

        try {
            $this->cartService->deleteProductFromShoppingList($product);

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
       $this->cartService->increment($product);
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function decrement(Product $product): JsonResponse
    {
       $this->cartService->decrement($product);
        return response()->json([
            'status' => 'success',
        ]);
    }






}
