<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function dekan(): HasOne
    {
        return $this->hasOne(Dekan::class);
    }

    public function kafedra(): HasOne
    {
        return $this->hasOne(Kafedra::class);
    }

    public function kurator(): HasOne
    {
        return $this->hasOne(Kurator::class);
    }
}
