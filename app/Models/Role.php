<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    const  ADMIN='admin';
    const USER='user';
    const EMPLOYEE='employee';

    public static function allRoles(): array
    {
        return [
            self::ADMIN,
            self::USER,
            self::EMPLOYEE,
        ];
    }

    //jedna rola ma wiele użytkowników
    public function users() :HasMany
    {
        return $this->hasMany(User::class,'ROLES_id');
    }




}
