<?php

namespace App\ValueObjects;

use App\Models\Product;

class CartItem
{

    private int $productId;
    private string $name;
    private float $price;

    private ?string $imagePath;

    private int $quantity = 0;

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSubTotal(): float
    {
        return $this->getPrice()*$this->getQuantity();
    }

    /**
     * @return string|null
     */
    public function getImagePath(): ?string
    {
        return $this->imagePath;
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }


    public function __construct(Product $product, int $quantity = 1){

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->imagePath = $product->image->name;
        $this->quantity = $quantity;
    }


    public function addQuantity(Product $product): CartItem
    {
        return new CartItem($product, ++$this->quantity);
    }

    public function decrementQuantity(Product $product): CartItem
    {
        return new CartItem($product, --$this->quantity);
    }


}
