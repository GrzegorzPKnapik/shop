<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shopping_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'mode',
        'status',
        'mod_available_date',
        'USERS_id'
    ];


    public function shopping_lists_products() :HasMany
    {
        return $this->hasMany(Shopping_lists_product::class,'SHOPPING_LISTS_id');
    }



}
