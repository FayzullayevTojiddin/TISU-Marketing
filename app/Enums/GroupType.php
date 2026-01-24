<?php

namespace App\Enums;

enum GroupType: string
{
    case KUNDUZGI = 'kunduzgi';
    case KECHKI = 'kechki';
    case SIRTQI = 'sirtqi';
    case MASOFAVIY = 'masofaviy';

    case IKKINCHI_OLIY_KUNDUZGI = 'ikkinchi_oliy_kunduzgi';
    case IKKINCHI_OLIY_KECHKI = 'ikkinchi_oliy_kechki';
    case IKKINCHI_OLIY_SIRTQI = 'ikkinchi_oliy_sirtqi';
    case IKKINCHI_OLIY_MASOFAVIY = 'ikkinchi_oliy_masofaviy';

    case QOSHMA_KUNDUZGI = 'qoshma_kunduzgi';
    case QOSHMA_KECHKI = 'qoshma_kechki';
    case QOSHMA_SIRTQI = 'qoshma_sirtqi';
    case QOSHMA_MASOFAVIY = 'qoshma_masofaviy';

    case MAXSUS_SIRTQI = 'maxsus_sirtqi';

    public function label(): string
    {
        return match ($this) {
            self::KUNDUZGI => 'Kunduzgi',
            self::KECHKI => 'Kechki',
            self::SIRTQI => 'Sirtqi',
            self::MASOFAVIY => 'Masofaviy',

            self::IKKINCHI_OLIY_KUNDUZGI => 'Ikkinchi oliy (kunduzgi)',
            self::IKKINCHI_OLIY_KECHKI => 'Ikkinchi oliy (kechki)',
            self::IKKINCHI_OLIY_SIRTQI => 'Ikkinchi oliy (sirtqi)',
            self::IKKINCHI_OLIY_MASOFAVIY => 'Ikkinchi oliy (masofaviy)',

            self::QOSHMA_KUNDUZGI => 'Qo‘shma (kunduzgi)',
            self::QOSHMA_KECHKI => 'Qo‘shma (kechki)',
            self::QOSHMA_SIRTQI => 'Qo‘shma (sirtqi)',
            self::QOSHMA_MASOFAVIY => 'Qo‘shma (masofaviy)',

            self::MAXSUS_SIRTQI => 'Maxsus sirtqi',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [
                $case->value => $case->label(),
            ])
            ->toArray();
    }
}
