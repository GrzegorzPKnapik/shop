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
        'DELIVERIES_id',
        'PAYMENTS_id',
        'SHOPPING_LISTS_id'
    ];


    const IN_PROGRESS = 'in_progress';
    const DELIVERED = 'delivered';
    const SKIPPED = 'skipped';
    public static function allStatuses(): array
    {
        return [
            self::IN_PROGRESS,
            self::DELIVERED,
            self::SKIPPED,
        ];
    }

    public function shopping_list() :BelongsTo
    {
        return $this->belongsTo(Shopping_list::class,'SHOPPING_LISTS_id');
    }


    public function status() :BelongsTo
    {
        return $this->belongsTo(Status::class, 'STATUSES_id');
    }







}
