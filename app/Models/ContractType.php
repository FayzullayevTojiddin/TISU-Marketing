<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContractType extends Model
{
    protected $fillable = [
        'title',
        'keys',
        'base_file_path',
        'status',
        'description',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function studentContracts(): HasMany
    {
        return $this->hasMany(StudentContract::class);
    }
}
