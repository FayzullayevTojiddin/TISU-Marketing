<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentContract extends Model
{
    protected $fillable = [
        'student_id',
        'contract_type_id',
        'amount',
        'is_completed',
        'completed_at',
        'data',
        'file_path'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
        'data' => 'array'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(StudentPayment::class);
    }

    public function getPaidAmountAttribute(): float
    {
        return $this->payments()->sum('amount');
    }

    public function getRemainingAmountAttribute(): float
    {
        return max(0, $this->amount - $this->paid_amount);
    }

    public function getIsFullyPaidAttribute(): bool
    {
        return $this->paid_amount >= $this->amount;
    }
}
