<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyForm extends Model
{
    protected $fillable = [
        'education_level_id',
        'title',
        'status'
    ];

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function directions(): HasMany
    {
        return $this->hasMany(Direction::class);
    }
}
