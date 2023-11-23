<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'status'
    ];

    const ENABLE='enable';
    const DISABLE='disable';
    const  SOLD_OUT='sold_out';

    public static function allStatuses(): array
    {
        return [
            self::ENABLE,
            self::DISABLE,
            self::SOLD_OUT,
        ];
    }


    //każdy obraz moze byc przypisany tylko do jednego produktu
    public function image() :BelongsTo
    {
        return $this->belongsTo(Image::class, 'IMAGES_id');
    }

    public function shopping_lists_products() :HasMany
    {
        return $this->hasMany(Shopping_lists_product::class, 'PRODUCTS_id');
    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class, 'CATEGORIES_id');
    }
    public function producer() :BelongsTo
    {
        return $this->belongsTo(Producer::class, 'PRODUCERS_id');
    }

    public function description() :BelongsTo
    {
        return $this->belongsTo(Description::class, 'DESCRIPTIONS_id');
    }

}
