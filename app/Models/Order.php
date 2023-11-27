<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'DELIVERIES_id',
        'PAYMENTS_id',
        'SHOPPING_LISTS_id'
    ];

    protected $casts = [
        'status' => OrderStatus::class
    ];


    public function shopping_list() :BelongsTo
    {
        return $this->belongsTo(Shopping_list::class,'SHOPPING_LISTS_id');
    }


    public function status() :BelongsTo
    {
        return $this->belongsTo(Status::class, 'STATUSES_id');
    }







}
