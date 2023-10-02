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
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ROLES_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

<<<<<<< HEAD
    //jedna rola należy od użytkownika
    public function role() :BelongsTo
=======
    public function roles() :HasMany
>>>>>>> parent of 6017fda (relations changes bad)
    {
        return $this->hasMany(Role::class,'ROLES_id');
    }

<<<<<<< HEAD
    //jede użytkowanik ma wiele adresów hasMany address
    public function  addresses() :HasMany
=======
    //User należy do address
    public function  address() :BelongsTo
>>>>>>> parent of 6017fda (relations changes bad)
    {
        return $this->belongsTo(Address::class,'USER_id');
    }


}
