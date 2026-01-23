<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kurator extends Model
{
    protected $fillable = [
        'user_id',
        'kafedra_id',
        'details'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kafedra(): BelongsTo
    {
        return $this->belongsTo(Kafedra::class);
    }
}
