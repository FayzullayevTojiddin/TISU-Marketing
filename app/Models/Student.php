<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'group_id',
        'full_name',
        'sex',
        'nationality',
        'passport_address',
        'image',
        'file',
        'phone_number',
        'JSHSHR',
        'status'
    ];

    protected $casts = [
        'from' => 'array',
        'lives' => 'array',
        'birth_date' => 'date',
        'status' => 'boolean',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(StudentPayment::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(StudentStatus::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(StudentContract::class);
    }
}
