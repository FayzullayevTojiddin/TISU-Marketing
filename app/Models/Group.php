<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'kurator_id',
        'title',
        'type',
        'contract_price'
    ];

    public function kurator(): BelongsTo
    {
        return $this->belongsTo(Kurator::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
