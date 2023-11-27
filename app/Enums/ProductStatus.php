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



    public function getEnable():string
    {
        return self::ENABLE->value;
    }
    public function getDisable():string
    {
        return self::DISABLE->value;
    }
    public function getSoldOut():string
    {
        return self::SOLD_OUT->value;
    }


    public function getStatusText(): string
    {
        return match($this) {
            self::ENABLE => 'Aktywny',
            self::DISABLE => 'Nieaktywny',
            self::SOLD_OUT => 'Wyczerpany',
            // Dodaj inne statusy z ich tekstami
        };
    }





    public static function allStatuses(): array
    {
        return [
            self::ENABLE,
            self::DISABLE,
            self::SOLD_OUT,
        ];
    }


}
