<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'

    ];

    public function products() :HasMany
    {
        return $this->hasMany(Product::class, 'PRODUCERS_id');
    }

}
