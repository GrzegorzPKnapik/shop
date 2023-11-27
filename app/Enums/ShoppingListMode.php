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

    public static function getNormal():string
    {
        return self::NORMAL->value;
    }
    public static function getShoppingList():string
    {
        return self::SHOPPING_LIST->value;
    }

    public static function allModes(): array
    {
        return [
            self::NORMAL->value,
            self::SHOPPING_LIST->value,
        ];
    }

}
