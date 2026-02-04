<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyForm extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
