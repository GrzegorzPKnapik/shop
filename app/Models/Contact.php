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


    //jeden kontakt ma wiele adresów
    public function addresses() :HasMany
    {
        return $this->hasMany(User::class,'CONTACTS_id');
    }



}
