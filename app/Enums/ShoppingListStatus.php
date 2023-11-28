<?php

namespace App\Enums;


enum ShoppingListStatus: string
{
    case NONE='none';
    case RESUME='resume';
    case STOP='stop';
    case CART='cart';
    case ORDER='order';
    case CART_DISABLE='cart_disable';



    public function isResume():bool
    {
        return $this === self::RESUME;
    }
    public function isStop():bool
    {
        return $this === self::STOP;
    }
    public function isCart():bool
    {
        return $this === self::CART;
    }

    public function isNone():bool
    {
        return $this === self::NONE;
    }
    public function isOrder():bool
    {
        return $this === self::ORDER;
    }

    public function isCartDisable():bool
    {
        return $this === self::CART_DISABLE;
    }


}
