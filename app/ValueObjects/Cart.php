<?php

namespace App\ValueObjects;

use App\Models\Product;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use Closure;
use Illuminate\Support\Collection;

class Cart
{
    private Collection $items;

    /**
     * @param Collection|null $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function hasItems(): bool
    {
        return $this->items->isNotEmpty();
    }
    //całej kolekcji a nie jednego produktu


    public function getSum(): float
    {
        return $this->items->sum(function ($item) {
            return $item->getPrice()*$item->getQuantity();
        });
    }
    /**
     * @param Product $product
     * @return Collection
     */




    public function decrementQuantity(Product $product): Cart
    {   //itemy cała lista
        $items = $this->items;
        //jeden item z listy
        $item = $items->first($this->productIdIsItemProductId($product));
        if (!is_null($item)) {
            $items = $this->removeItemFromCollection($items, $product);
            $newItem = $item->decrementQuantity($product);
        } else {
            $newItem = new CartItem($product);
        }
        $items->add($newItem);
        return new Cart($items->sort());
    }

    public function addItem(Product $product): Cart
    {   //itemy cała lista
        $items = $this->items;
        //jeden item z listy
        $item = $items->first($this->productIdIsItemProductId($product));
        if (!is_null($item)) {
            $items = $this->removeItemFromCollection($items, $product);
            $newItem = $item->addQuantity($product);
        } else {
            $newItem = new CartItem($product);
        }
        $items->add($newItem);
        return new Cart($items->sort());
    }

    public function getProductQuantity(Product $product): int
    {
        $items = $this->items;
        $item = $items->first($this->productIdIsItemProductId($product));
        return $item->getQuantity();
    }

    /**
     * @param Product $product
     * @return Closure
     */
    private function productIdIsItemProductId(Product $product): Closure
    {
        return function ($item) use ($product) {
            return $product->id == $item->getProductId();
        };
    }

    /**
     * @param Collection $items
     * @param Product $product
     * @return Collection
     */
    public function removeItem(Product $product): Cart
    {
        $items = $this->removeItemFromCollection($this->items, $product);
        return new Cart($items);
    }

    /**
     * @param Collection $items
     * @param Product $product
     * @return Collection
     */
    private function removeItemFromCollection(Collection $items, Product $product): Collection
    {
        return $items->reject($this->productIdIsItemProductId($product));
    }

    private function findShoppingList()
    {
        return Shopping_list::where('status', 'lista_a');
    }
    /**
     * @param Collection $items
     * @param Product $product
     * @return Collection
     */



}
