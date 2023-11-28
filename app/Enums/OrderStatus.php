<?php

namespace App\Enums;


enum OrderStatus: string
{
    case NONE='none';

    case IN_PREPARE='in_prepare';
    case DELIVERED='delivered';
    case  SKIPPED='skipped';



    public function isNone():bool
    {
        return $this === self::NONE;
    }
    public function isInPrepare():bool
    {
        return $this === self::IN_PREPARE;
    }
    public function isDelivered():bool
    {
        return $this === self::DELIVERED;
    }
    public function isSkipped():bool
    {
        return $this === self::SKIPPED;
    }

}
