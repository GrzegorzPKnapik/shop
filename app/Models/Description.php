<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Description extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //każdy obraz może być przypisany tylko do jednego produktu
    public function product() :HasOne
    {
        return $this->hasOne(Product::class,'DESCRIPTIONS_id');
    }
}
