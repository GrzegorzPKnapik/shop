<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{


    protected $fillable = [
        'email',
        'password',
        'surname',
        'pesel',
        'age',
        'name',
        'email',
        'password',
        'ROLES_id',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        //'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //użytkownik ma jedną role
    public function role() :BelongsTo
    {
        return $this->belongsTo(Role::class,'ROLES_id');
    }

    public function addresses() :HasMany
    {
        return $this->hasMany(Address::class,'USERS_id');
    }

    public function shopping_lists() :HasMany
    {
        return $this->hasMany(Shopping_list::class,'USERS_id');
    }
}
