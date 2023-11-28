<?php

namespace App\Enums;


enum ProducerStatus: string
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
