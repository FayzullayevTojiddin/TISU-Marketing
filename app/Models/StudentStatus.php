<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentStatus extends Model
{
    protected $fillable = [
        'student_id',
        'description'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
