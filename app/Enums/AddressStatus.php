<?php

namespace App\Enums;


enum AddressStatus: string
{
    case NONE='none';
    case ORDER='order';


    public function isNone():bool
    {
        return $this === self::NONE;
    }
    public function isOrder():bool
    {
        return $this === self::ORDER;
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
            self::NONE->value,
            self::ORDER->value,
        ];
    }

}
