<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Direction extends Model
{
    protected $fillable = [
        'title',
        'code',
        'contract_price'
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
