<?php

namespace App\Http\Controllers;



use App\Models\Image;
use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
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
    public function index(): View
    {
        //$products=Product::with('image')->get();
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();

        if($shopping_list != null)
            $cart = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->with('product.image','shopping_list')->get();


        //dd(Session::get('cart',new Cart()));
        //$items=Product::with('image')->get();
       // dd($cart);
        return view('cart.index',[
            //prześlij vartość cart jeśli nie ma to nowy pusty obiekt cart
            //'cart' => Session::get('cart', new Cart())
            'quantity' =>$this->getQuantity(),
            'cart' => $cart
        ]);
    }

    //count unique products
    public function getQuantity(): int
    {
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        $quantity = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)
            ->count('PRODUCTS_id');

            return $quantity;
    }

    public function cartcount(): JsonResponse{

        $cart=Session::get('cart', new Cart());
        $cartcount=$cart->getItems()->count();

        return response()->json([
            'count' => $cartcount,
        ]);
    }


    public function store(Product $product): JsonResponse
    {
        //pobieram z sesji obiekt koszyka jesli go nie ma to tworze nowy obiekt
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        if($shopping_list != null)
        $shoppingListHasProduct = Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id)->first();


            //jest koszyk i produkt był w koszyku dziala
        if ($shopping_list != null && $shoppingListHasProduct) {
            $this->incrementShoppingListProduct($product, $shopping_list);
            $this->updateTotal($shopping_list);
            //nie ma produktu i koszyka1. dziala
        }else if($shopping_list == null) {
            $this->newShoppingList($product);
            $this->newProduct($product, $shopping_list);
            //koszyk jest nie ma produktu dziala
        }else if($shopping_list != null && !$shoppingListHasProduct){
            $this->newProduct($product, $shopping_list);
            $this->updateTotal($shopping_list);
        }


        return response()->json([
            'status' => 'success',
            'message' => (__('shop.cart.status.store.success'))
        ]);
    }


    public function destroy(Product $product): JsonResponse{

        try {
            $shopping_list = Shopping_list::where('status', 'lista_a')->first();
            $shopping_lists_product = Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id);
            $shopping_lists_product->delete();

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
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        $shopping_lists_product = Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id)->first();

        if($shopping_lists_product->quantity <= 98) {
            $this->incrementShoppingListProduct($product, $shopping_list);
            $this->updateTotal($shopping_list);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function decrement(Product $product): JsonResponse
    {
        $shopping_list = Shopping_list::where('status', 'lista_a')->first();
        $shopping_lists_product = Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id)->first();


        if($shopping_lists_product->quantity > 1) {
            $this->decrementShoppingListProduct($product, $shopping_list);
            $this->updateTotal($shopping_list);
        }
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * @param Product $product
     * @return Shopping_list
     */
    private function newShoppingList(Product $product):void
    {
        $shopping_list = new Shopping_list();
        $shopping_list->status = 'lista_a';
        $shopping_list->total = $product->price;
        $shopping_list->save();
    }

    /**
     * @param Product $product
     * @param $shopping_list
     * @return void
     */
    private function newProduct(Product $product, $shopping_list): void
    {
        $shopping_lists_product = new Shopping_lists_product();
        $shopping_lists_product->sub_total = $product->price;
        $shopping_lists_product->quantity = 1;
        $shopping_lists_product->PRODUCTS_id = $product->id;
        $shopping_lists_product->SHOPPING_LISTS_id = $shopping_list->id;
        $shopping_lists_product->save();
    }

    /**
     * @param $shopping_list
     * @return void
     */
    private function updateTotal($shopping_list): void
    {
        $total = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)
                ->sum('sub_total');
        $shopping_list->total = $total;
        $shopping_list->save();
    }

    /**
     * @param Product $product
     * @param $shopping_list
     * @return void
     */
    private function incrementShoppingListProduct(Product $product, $shopping_list): void
    {
        Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id)
            ->update([
                'quantity' => DB::raw('quantity + 1'),
                'sub_total' => DB::raw('(' . $product->price . ' * (quantity + 1))'),
                'PRODUCTS_id' => $product->id
            ]);
    }

    private function decrementShoppingListProduct(Product $product, $shopping_list): void
    {
        Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id)
            ->update([
                'quantity' => DB::raw('quantity - 1'),
                'sub_total' => DB::raw('(' . $product->price . ' * (quantity - 1))'),
                'PRODUCTS_id' => $product->id
            ]);
    }


}
