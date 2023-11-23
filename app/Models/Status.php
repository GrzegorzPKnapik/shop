<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'

    ];

    const  IN_PREPARE='in_prepare';
    const SKIPPED='skipped';
    const DELIVERED='delivered';

    public function orders() :HasMany
    {
        return $this->hasMany(Order::class, 'STATUSES_id');
    }

}
