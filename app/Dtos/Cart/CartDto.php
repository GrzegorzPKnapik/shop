<?php
namespace App\Dtos\Cart;
use mysql_xdevapi\Collection;

class CartDto{
    private Collection $items;

    /**
     * @param Collection $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }

    /**
     * @return Collection
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */




}
