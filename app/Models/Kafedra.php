<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kafedra extends Model
{
    protected $fillable = [
        'user_id',
        'dekan_id',
        'title',
        'details'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dekan(): BelongsTo
    {
        return $this->belongsTo(Dekan::class);
    }

    public function kurators(): HasMany
    {
        return $this->hasMany(Kurator::class);
    }
}
