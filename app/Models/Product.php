<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    //każdy obraz moze byc przypisany tylko do jednego produktu
    public function image() :BelongsTo
    {
        return $this->BelongsTo(Image::class, 'IMAGES_id');
    }
}
