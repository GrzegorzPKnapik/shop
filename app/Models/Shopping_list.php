<?php

namespace App\Models;

use App\Enums\ShoppingListMode;
use App\Enums\ShoppingListStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shopping_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'total',
        'mode',
        'status',
        'active',
        'delivery_date',
        'mod_available_date',
        'end_mod_date',
        'USERS_id',
        'ADDRESSES_id'
    ];




    protected $casts = [
        'status' => ShoppingListStatus::class,
        'mode' => ShoppingListMode::class
    ];





    public function address() :BelongsTo
    {
        return $this->belongsTo(Address::class,'ADDRESSES_id');
    }

    public function shopping_lists_products() :HasMany
    {
        return $this->hasMany(Shopping_lists_product::class,'SHOPPING_LISTS_id');
    }

    public function orders() :HasMany
    {
        return $this->hasMany(Order::class,'SHOPPING_LISTS_id');
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class,'USERS_id');
    }



}
