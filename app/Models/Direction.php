<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Direction extends Model
{
    protected $fillable = [
        'study_form_id',
        'title',
        'code',
        'contract_price'
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function studyForm(): BelongsTo
    {
        return $this->belongsTo(StudyForm::class);
    }
}
