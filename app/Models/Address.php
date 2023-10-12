<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'street',
        'zip_code',
        'voivodeship',
        'selected',
        'USERS_id'

    ];

    //jeden address należy do jednego użytkownika
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class,'USERS_id');
    }

    public function contact() :BelongsTo
    {
        return $this->belongsTo(Contact::class,'CONTACTS_id');
    }



}
