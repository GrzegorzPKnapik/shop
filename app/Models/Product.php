<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

<<<<<<< HEAD
    //każdy obraz moze byc przypisany tylko do jednego produktu
    public function image() :BelongsTo
    {
        return $this->BelongsTo(Image::class, 'IMAGES_id');
=======
    public function image() :BelongsTo
    {
        return $this->belongsTo(Image::class,'IMAGES_id');
>>>>>>> parent of 6017fda (relations changes bad)
    }




}
