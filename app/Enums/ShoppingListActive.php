<?php

namespace App\Enums;


class ShoppingListActive
{
    const TRUE = true;
    const FALSE = false;
    const NULL = null;

    static public function getActiveText($active): string
    {
        $boolean = (boolean)$active;
        return match($boolean) {
            self::TRUE => '<span style="color: green;">Aktywna</span>',
            self::FALSE => '<span style="color: rgba(255,0,0,0.53);">Nie aktywna</span>',
        };
    }




}
