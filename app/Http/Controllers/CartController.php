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
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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


    public function index(): View
    {
        //$shopping_list = Shopping_list::where('status', 'lista_a')->first();
        //if($shopping_list != null)
        //$shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image','shopping_list')->get();
        //$cart = new ShoppingList($shopping_lists_product);

        //$cart =$shopping_list;
        //$item = $shopping_lists_product;


        return view('cart.index',[
            //'cart' => $cart,
            //'items' => $item
        ]);
    }

    //count unique products


    public function cartCount(): JsonResponse{

        if(Auth::check()) {
            //quantity rozne od 0 jesli true to quantity, false to null przypisuje
            $quantity = $this->cartService->getQuantity();
            $cartCount = $quantity !=0 ? $quantity: null;
        }
        return response()->json([
            //jesli nie jest zdefiniowana
            'count' => $cartCount ?? null
        ]);
    }


    public function store(Product $product)
    {
        if(!Auth::check()) {
            return response()->json([
                'status' => 'warning',
                'title' => 'Proszę się zalogować'
            ]);
        }

        //jeśli jakoś chcil dodac dod koszyka
        if(!$product->status->isEnable())
            return response()->json([
                'status' => 'warning',
                'title' => 'Produkt niedostępny'
            ]);


            $response = $this->cartService->addItem($product);




                //zwróc wartości z prby dodania produktu moze być
            //jest juz w koszyku lub poprawnie dodano do koszyka
            //dd($response->original['status']);
            /*if($this->cartService->addItem($product)===false)
            {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'produkt jest już w koszyku'
                ]);
            }else

            return response()->json([
                'status' => 'success',
                'message' => (__('shop.cart.status.store.success'))
            ]);*/


             return response()->json([
                 'status' => $response->original['status'],
                 'title' => $response->original['title'],
                 'message' => $response->original['message']
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

    public function value(Product $product, Request $request)
    {
        if (is_numeric($request->valueQuantity)) {
            if ($request->valueQuantity <= 0 || $request->valueQuantity > 99) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nieprawidłowa liczba'
                ]);
            }else
                $this->cartService->value($product, $request);
        }else
            return response()->json([
                'status' => 'error',
                'message' => 'Nieprawidłowa wartość'
            ]);


    }


    public function addValue(Product $product, Request $request)
    {
/*        dd($request->valueQuantity);*/
        if(!Auth::check())
        {
            return response()->json([
                'status' => 'warning',
                'message' => 'Zaloguj się',
                'title' => 'Jesteś niezalogowany'
            ]);
        }


        if (!is_numeric($request->valueQuantity)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nieprawidłowa wartość'
            ]);
        }


            if ($request->valueQuantity <= 0 || $request->valueQuantity > 99) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nieprawidłowa liczba'
                ]);
            }
        $response = $this->cartService->addValue($product, $request->valueQuantity);

        return response()->json([
            'status' => $response->original['status'],
            'title' => $response->original['title'],
            'message' => $response->original['message']
        ]);



    }


}
