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
        'USERS_id'

    ];

    //address ma wile users
    public function users() :HasMany
    {
        return $this->hasMany(User::class,'USERS_id');
    }

    public function contact() :BelongsTo
    {
<<<<<<< HEAD
        return $this->belongsTo(Contact::class,'CONTACTS_id');
    }


=======
        return $this->belongsTo(contact::class,'CONTACTS_id');
    }
>>>>>>> parent of 6017fda (relations changes bad)

}
