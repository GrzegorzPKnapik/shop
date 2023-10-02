<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    const  ADMIN='admin';
    const USER='user';

<<<<<<< HEAD
    //jedna rola ma wiele użytkowników
    public function users() :HasMany
=======
    public function user() :BelongsTo
>>>>>>> parent of 6017fda (relations changes bad)
    {
        return $this->belongsTo(User::class,'ROLE_id');
    }



}
