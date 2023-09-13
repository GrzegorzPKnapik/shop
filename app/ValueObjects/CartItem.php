<?php
namespace App\ValueObjects;

use App\Models\Product;

class CartItem
{
    private int $productId;
    private string $name;
   // private float $price;

    private int $quantity = 0;

    /**
     * @param string $name
     * @param float $price
     */
    public function __construct(Product $product, int $quantity = 1)
    {

        $this->productId = $product->id;
        $this->name = $product->name;
        //$this->price = $product->price;
        $this->quantity += $quantity;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return float
     */
   // public function getPrice(): float
   // {
   //     return $this->price;
   // }

    public function addQuantity(Product $product): CartItem
    {
        return new CartItem($product, ++$this->quantity);
    }






}
