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


}
