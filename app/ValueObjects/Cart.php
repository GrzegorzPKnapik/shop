<?php

namespace App\ValueObjects;

use App\Models\Product;
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
    public function getQuantity(): int
    {
        return $this->items->sum(function ($item) {
            return $item->getQuantity();
        });
    }

    public function getSum(): float
    {
        return $this->items->sum(function ($item) {
            return $item->getSum();
        });
    }
    /**
     * @param Product $product
     * @return Collection
     */


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
    /**
     * @param Collection $items
     * @param Product $product
     * @return Collection
     */



}
