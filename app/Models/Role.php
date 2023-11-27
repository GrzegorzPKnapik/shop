<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\RoleName;


class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'status' => RoleName::class
    ];


    //jedna rola ma wiele użytkowników
    public function users() :HasMany
    {
        return $this->hasMany(User::class,'ROLES_id');
    }




}
