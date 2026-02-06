<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'kurator_id',
        'kafedra_id',
        'direction_id',
        'title',
        'enrollment_year',
        'status',
    ];

    public function kurator(): BelongsTo
    {
        return $this->belongsTo(Kurator::class);
    }

    public function kafedra(): BelongsTo
    {
        return $this->belongsTo(Kafedra::class);
    }

    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
