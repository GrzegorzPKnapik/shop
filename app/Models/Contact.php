<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',

    ];


<<<<<<< HEAD
    //jeden kontakt ma wiele adresów
    public function address() :HasMany
    {
        return $this->hasMany(User::class,'CONTACTS_id');
    }


=======
    public function users() :HasMany
    {
        return $this->hasMany(User::class,'USERS_id');
    }

    public function addresses() :HasMany
    {
        return $this->hasMany(Address::class,'CONTACTS_id');
    }
>>>>>>> parent of 6017fda (relations changes bad)

}
