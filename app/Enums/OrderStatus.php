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


    public static function getInPrepare():string
    {
        return self::IN_PREPARE->value;
    }
    public static function getDelivered():string
    {
        return self::DELIVERED->value;
    }
    public static function getSkipped():string
    {
        return self::SKIPPED->value;
    }
    public static function getNone():string
    {
        return self::NONE->value;
    }



    public static function allStatuses(): array
    {
        return [
            self::IN_PREPARE->value,
            self::DELIVERED->value,
            self::SKIPPED->value,
            self::NONE->value,
        ];
    }

}
