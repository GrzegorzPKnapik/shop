<?php

namespace App\Enums;


enum RoleName: string
{
    case  ADMIN='admin';
    case USER='user';
    case EMPLOYEE='employee';


    public function isAdmin():bool
    {
        return $this === self::ADMIN;
    }
    public function isUser():bool
    {
        return $this === self::USER;
    }
    public function isEmployee():bool
    {
        return $this === self::EMPLOYEE;
    }


}
