<?php

namespace App\Enums;


enum ShoppingListStatus: string
{
    case NONE='none';

    case RESUME='resume';
    case STOP='stop';

    case CART='cart';

    case ORDER='order';


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

    public static function getResume():string
    {
        return self::RESUME->value;
    }
    public static function getStop():string
    {
        return self::STOP->value;
    }
    public static function getCart():string
    {
        return self::CART->value;
    }

    public static function getNone():string
    {
        return self::NONE->value;
    }
    public static function getOrder():string
    {
        return self::ORDER->value;
    }


    public static function allStatuses(): array
    {
        return [
            self::RESUME->value,
            self::STOP->value,
            self::CART->value,
            self::NONE->value,
            self::ORDER->value,
        ];
    }

}
