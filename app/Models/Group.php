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
        'education_level_id',
        'study_form_id',
        'direction_id',
        'enrollment_year',
        'status',
    ];

    public function kurator(): BelongsTo
    {
        return $this->belongsTo(Kurator::class);
    }

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function studyForm(): BelongsTo
    {
        return $this->belongsTo(StudyForm::class);
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
