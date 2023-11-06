<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'set_delivery_date',
        'status',
        'end_date',
        'DELIVERIES_id',
        'PAYMENTS_id',
        'SHOPPING_LISTS_id',
        'ADDRESSES_id'
    ];

    public function shopping_list() :BelongsTo
    {
        return $this->belongsTo(Shopping_list::class,'SHOPPING_LISTS_id');
    }

    public function address() :BelongsTo
    {
        return $this->belongsTo(Address::class,'ADDRESSES_id');
    }







}
