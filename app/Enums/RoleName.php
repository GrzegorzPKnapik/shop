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


    public static function getAdmin():string
    {
        return self::ADMIN->value;
    }
    public static function getUser():string
    {
        return self::USER->value;
    }
    public static function getEmployee():string
    {
        return self::EMPLOYEE->value;
    }





    public static function allRoles(): array
    {
        return [
            self::ADMIN->value,
            self::USER->value,
            self::EMPLOYEE->value,
        ];
    }

}
