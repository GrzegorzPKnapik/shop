<?php

namespace App\Services;



use App\Enums\ProductStatus;
use App\Enums\ShoppingListMode;
use App\Enums\ShoppingListStatus;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CartService
{

    private $shopping_list;

    public function getQuantity(): int
    {
        $this->shopping_list = $this->findShoppingList()->first();

        if(isset($this->shopping_list)) {
            $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $this->shopping_list->id)
                ->count('PRODUCTS_id');
            return $shopping_lists_product;
        }else return 0;



    }

    public function addItem(Product $product, $quantity = 1)
    {
        $this->shopping_list = $this->findShoppingList()->first();
        if(!is_null($this->shopping_list))
            $shopping_Lists_Product = $this->findShoppingListsProduct($product, $this->shopping_list)->first();

        //bez this->shopping_lists_product nadpisywal sie pustym obiektem dla pierwszego produktu
        //jest koszyk i produkt był w koszyku dziala
        if (!is_null($this->shopping_list) && !is_null($shopping_Lists_Product)) {
            return response()->json([
                'status' => 'warning',
                'title' => 'Produkt jest już w koszyku',
                'message' => ''
            ]);
            //nie ma produktu i koszyka1 dziala
        }else if(is_null($this->shopping_list)) {
            $this->shopping_list = $this->newShoppingList($product, $quantity);
            $this->newShoppingListsProduct($product, $this->shopping_list, $quantity);
            //koszyk jest nie ma produktu dziala
        }else if(!is_null($this->shopping_list) && is_null($shopping_Lists_Product)){
            $this->newShoppingListsProduct($product, $this->shopping_list, $quantity);
        }


        $this->updateTotal($this->shopping_list);

        return response()->json([
            'status' => 'success',
            'title' => 'Brawo!',
            'message' => 'Poprawnie dodano produkt do koszyka'
        ]);
    }


    private function newShoppingList(Product $product, $quantity)
    {
        $user = Auth::user();

        $shopping_list = new Shopping_list();
        $shopping_list->status = ShoppingListStatus::CART;
        $shopping_list->mode = ShoppingListMode::NORMAL;
        $shopping_list->total = $product->price * $quantity;
        $shopping_list->USERS_id = $user->id;
        $shopping_list->save();
        return $shopping_list;
    }

    /**
     * @param Product $product
     * @param $shopping_list
     * @return void
     */
    private function newShoppingListsProduct(Product $product, $shopping_list, $quantity): void
    {
        $shopping_lists_product = new Shopping_lists_product();
        $shopping_lists_product->selected = true;
        $shopping_lists_product->sub_total = $product->price * $quantity;
        $shopping_lists_product->quantity = $quantity;
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
        //działa
        $total = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)
            ->where('selected', true)
            ->whereHas('product', function ($query) {
                $query->where('status', ProductStatus::ENABLE);
            })
            ->sum('sub_total');
        $shopping_list->total = $total;
        $shopping_list->save();
    }

    public function increment(Product $product): JsonResponse
    {
        //dodac this! trzeba bo z zewnatrz inc
        $this->shopping_list = $this->findShoppingList()->first();
        $shopping_lists_product = $this->findShoppingListsProduct($product, $this->shopping_list)->first();
        if($shopping_lists_product->quantity <= 98) {
            $this->findShoppingListsProduct($product, $this->shopping_list)
                ->update([
                    'quantity' => DB::raw('quantity + 1'),
                    'sub_total' => DB::raw('(' . $product->price . ' * (quantity))'),
                    'PRODUCTS_id' => $product->id
                ]);
            $this->updateTotal($this->shopping_list);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function decrement(Product $product): JsonResponse
    {
        $this->shopping_list = $this->findShoppingList()->first();
        $shopping_lists_product = $this->findShoppingListsProduct($product, $this->shopping_list)->first();
        if($shopping_lists_product->quantity > 1) {
            $this->findShoppingListsProduct($product, $this->shopping_list)
                ->update([
                    'quantity' => DB::raw('quantity - 1'),
                    'sub_total' => DB::raw('(' . $product->price . ' * (quantity))'),
                    'PRODUCTS_id' => $product->id
                ]);
            $this->updateTotal($this->shopping_list);
        }
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function value(Product $product, Request $request)
    {
        $this->shopping_list = $this->findShoppingList()->first();
        $shopping_lists_product = $this->findShoppingListsProduct($product, $this->shopping_list)->first();

        if ($shopping_lists_product->quantity <= 99) {
            $this->findShoppingListsProduct($product, $this->shopping_list)
                ->update([
                    'quantity' => $request->valueQuantity,
                    'sub_total' => DB::raw('(' . $product->price . ' * (quantity))'),
                    'PRODUCTS_id' => $product->id
                ]);
            $this->updateTotal($this->shopping_list);
        }



    }


    public function addValue(Product $product, $quantity)
    {

            $response = $this->addItem($product, $quantity);
                return response()->json([
                    'status' => $response->original['status'],
                    'title' => $response->original['title'],
                    'message' => $response->original['message']
                ]);
    }



    public function deleteProductFromShoppingList(Product $product)
    {
        $shopping_list = $this->findShoppingList()->first();
        $this->findShoppingListsProduct($product, $shopping_list)->delete();
        $this->updateTotal($shopping_list);

        $user = Auth::user();

        $old_cart = Shopping_list::where('status', ShoppingListStatus::CART_DISABLE)->where('mode', ShoppingListMode::NORMAL)->where('USERS_id', $user->id)->first();

        if($shopping_list->total == 0 && isset($old_cart))
        {
                $old_cart->status = 'cart';
                $old_cart->save();
        }

    }

    /**
     * @return mixed
     */
    private function findShoppingList()
    {
        $user = Auth::user();

        return Shopping_list::where('status', ShoppingListStatus::CART)->where('USERS_id', $user->id);
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
