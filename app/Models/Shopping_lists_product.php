<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shopping_lists_product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_total',
        'quantity',
        'PRODUCTS_id',
        'SHOPPING_LISTS_id'
    ];

    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class,'PRODUCTS_id');
    }

    public function shopping_list() :BelongsTo
    {
        return $this->belongsTo(Shopping_list::class,'SHOPPING_LISTS_id');
    }



}
