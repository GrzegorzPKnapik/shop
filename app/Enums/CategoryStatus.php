<?php

namespace App\Enums;


enum CategoryStatus: string
{
    case ENABLE='enable';
    case DISABLE='disable';

    public function isEnable():bool
    {
        return $this === self::ENABLE;
    }
    public function isDisable():bool
    {
        return $this === self::DISABLE;
    }



    public static function getEnable():string
    {
        return self::ENABLE->value;
    }
    public static function getDisable():string
    {
        return self::DISABLE->value;
    }





    public static function allStatuses(): array
    {
        return [
            self::ENABLE->value,
            self::DISABLE->value,
        ];
    }

}
