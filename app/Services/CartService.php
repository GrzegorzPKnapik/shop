<?php

namespace App\Services;



use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CartService
{

    private $shopping_list;

    public function getQuantity(): int
    {
        $shopping_list = $this->findShoppingList()->first();

        if(isset($shopping_list)) {
            $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)
                ->count('PRODUCTS_id');
            return $shopping_lists_product;
        }else return 0;



    }

    public function addItem(Product $product)
    {
        $this->shopping_list = $this->findShoppingList()->first();
        if(!is_null($this->shopping_list))
            $shopping_Lists_Product = $this->findShoppingListsProduct($product, $this->shopping_list)->first();

        //jest koszyk i produkt był w koszyku dziala
        if (!is_null($this->shopping_list) && !is_null($shopping_Lists_Product)) {
            $this->increment($product);
            //nie ma produktu i koszyka1 dziala
        }else if(is_null($this->shopping_list)) {
            $this->shopping_list = $this->newShoppingList($product);
            $this->newShoppingListsProduct($product, $this->shopping_list);
            //koszyk jest nie ma produktu dziala
        }else if(!is_null($this->shopping_list) && is_null($shopping_Lists_Product)){
            $this->newShoppingListsProduct($product, $this->shopping_list);
        }


        $this->updateTotal($this->shopping_list);
    }


    private function newShoppingList(Product $product)
    {
        $user = Auth::user();

        $shopping_list = new Shopping_list();
        $shopping_list->status = 'lista_zakupów';
        $shopping_list->total = $product->price;
        $shopping_list->USERS_id = $user->id;
        $shopping_list->save();
        return $shopping_list;
    }

    /**
     * @param Product $product
     * @param $shopping_list
     * @return void
     */
    private function newShoppingListsProduct(Product $product, $shopping_list): void
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

    public function increment(Product $product): JsonResponse
    {
        $shopping_list = $this->findShoppingList()->first();
        $shopping_lists_product = $this->findShoppingListsProduct($product, $shopping_list)->first();
        if($shopping_lists_product->quantity <= 98) {
            $this->findShoppingListsProduct($product, $shopping_list)
                ->update([
                    'quantity' => DB::raw('quantity + 1'),
                    'sub_total' => DB::raw('(' . $product->price . ' * (quantity))'),
                    'PRODUCTS_id' => $product->id
                ]);
            $this->updateTotal($shopping_list);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function decrement(Product $product): JsonResponse
    {
        $shopping_list = $this->findShoppingList()->first();
        $shopping_lists_product = $this->findShoppingListsProduct($product, $shopping_list)->first();
        if($shopping_lists_product->quantity > 1) {
            $this->findShoppingListsProduct($product, $shopping_list)
                ->update([
                    'quantity' => DB::raw('quantity - 1'),
                    'sub_total' => DB::raw('(' . $product->price . ' * (quantity))'),
                    'PRODUCTS_id' => $product->id
                ]);
            $this->updateTotal($shopping_list);
        }
        return response()->json([
            'status' => 'success',
        ]);
    }


    public function deleteProductFromShoppingList(Product $product)
    {
        $shopping_list = $this->findShoppingList()->first();
        $this->findShoppingListsProduct($product, $shopping_list)->delete();
        $this->updateTotal($shopping_list);
    }

    /**
     * @return mixed
     */
    private function findShoppingList()
    {
        return Shopping_list::where('status', 'lista_zakupów');
    }

    /**
     * @param Product $product
     * @param $shopping_list
     * @return mixed
     */
    private function findShoppingListsProduct(Product $product, $shopping_list)
    {
        return Shopping_lists_product::where('PRODUCTS_id', $product->id)->where('SHOPPING_LISTS_id', $shopping_list->id);
    }




}
