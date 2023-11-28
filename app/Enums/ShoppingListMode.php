<?php

namespace App\Enums;


enum ShoppingListMode: string
{
    case NORMAL='normal';
    case SHOPPING_LIST='shopping_list';


    public function isNormal():bool
    {
        return $this === self::NORMAL;
    }
    public function isShoppingList():bool
    {
        return $this === self::SHOPPING_LIST;
    }


}
