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


}
