<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }


    public function kurators(): BelongsToMany
    {
        return $this->belongsToMany(
            Kurator::class,
            'groups',
            'kafedra_id',
            'kurator_id'
        )->distinct();
    }
}
