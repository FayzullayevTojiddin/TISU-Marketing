<?php

namespace App\Enums;

enum PaymentType: string
{
    case PLUS = 'plus';
    case MINUS = 'minus';

    public function label(): string
    {
        return match ($this) {
            self::PLUS => 'Kirim (+)',
            self::MINUS => 'Chiqim (-)',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PLUS => 'success',
            self::MINUS => 'danger',
        };
    }
}
