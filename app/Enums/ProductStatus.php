<?php

namespace App\Enums;


enum ProductStatus: string
{
    case ENABLE='enable';
    case DISABLE='disable';
    case  SOLD_OUT='sold_out';


    public function isEnable():bool
    {
        return $this === self::ENABLE;
    }
    public function isDisable():bool
    {
        return $this === self::DISABLE;
    }
    public function isSoldOut():bool
    {
        return $this === self::SOLD_OUT;
    }

    public function getStatusText(): string
    {
        return match($this) {
            self::ENABLE => 'Available',
            self::DISABLE,
            self::SOLD_OUT => 'Sold out',
            // Dodaj inne statusy z ich tekstami
        };
    }


}
