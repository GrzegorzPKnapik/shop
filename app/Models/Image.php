<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

<<<<<<< HEAD
    //każdy obraz może być przypisany tylko do jednego produktu
=======
>>>>>>> parent of 6017fda (relations changes bad)
    public function product() :HasOne
    {
        return $this->hasOne(Product::class,'IMAGES_id');
    }
}
